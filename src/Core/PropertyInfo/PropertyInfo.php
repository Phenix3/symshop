<?php

namespace App\Core\PropertyInfo;

use App\Core\Str;
use InvalidArgumentException;
use ReflectionClass;

class PropertyInfo
{
    public function getType($class, string $property, ReflectionClass $reflectedClass = null)
    {
        if (is_null($reflectedClass)) {
            $reflectedClass = new ReflectionClass($class);
        }

        if ($reflectedClass->hasProperty($property)) {
            return $this->getPropertyType($property, $reflectedClass);
        }

        return null;
    }

    protected function enumValue(string $property)
    {
        if ($this->isEnum($property)) {
            throw new InvalidArgumentException("'{$property} is not an enum'", 1);
        }
        
        $type = $this->getType($property);
        $enumClass = $type->name;

        return new $enumClass($this->{$property});
    }

    protected function isEnum(string $property)
    {
        $type = $this->getType($property);

        if (!is_object($type)) {
            return false;
        }

        $className = $type->name;

        $reflectedClass = new ReflectionClass($className);
        $reflectedParent = $reflectedClass->getParentClass();

        return $reflectedParent->getName() == 'MyCLabs\Enum\Enum';
    }

    private function getUseStatements(): array
    {
        $reflectedThis = new ReflectionClass($this);
        $contents = file_get_contents($reflectedThis->getFileName());

        $matches = [];

        preg_match_all("/use ([\w\\\\]+)( as \w+)*/", $contents, $matches);

        $results = [];

        foreach ($matches[1] as $index => $value) {
            $results[] = [
                'namespace' => $value,
                'alias' => isset($matches[2][$index]) ? str_replace(' as ', '', $matches[2][$index]) : null
            ];

        }
        return $results;
    }

    private function getPropertyType(string $property, ReflectionClass $reflectedClass)
    {
        $docComment = $reflectedClass->getProperty($property)->getDocComment();

        $type = $this->getPropertyTypeByPropertyDocComment($docComment);

        if (!is_object($type)) {
            $fromClass = $this->getTypeByClassDocComment($property, $reflectedClass->getDocComment());

            if (is_object($fromClass)) {
                return $fromClass;
            }
        }

        return $type;

    }

    private function getPropertyTypeByPropertyDocComment(string $docComment)
    {
        $matches = [];

        if (preg_match("/\@var (\w+) (\[\])*/", $docComment, $matches) === 1) {
            if (count($matches) > 0) {
                $type = $matches[1];
                $isArray = isset($matches[2]);

                $fullyQualifiedName = $this->getFullyQualifiedName($type);

                if (class_exists($fullyQualifiedName)) {
                    return (object) [
                        'name' => $fullyQualifiedName,
                        'array' => $isArray
                    ];
                }
            }

            return $type;
        }
    }

    private function getTypeByClassDocComment(string $property, string $docComment)
    {
        $matches = [];

        if (preg_match_all("/\@property (\w+) (\\$\w+)/", $docComment, $matches) > 0) {
            $type = null;
            $isArray = false;

            foreach ($matches[2] as $index => $value) {
                if ($value == $property) {
                    $type = $matches[1][$index];

                    $isArray = Str::endsWith($type, '[]');
                    $type = str_replace('[]', '', $type);
                }
            }

            if ($type) {
                $fullyQualifiedName = $this->getFullyQualifiedName($type);

                if (class_exists($fullyQualifiedName)) {
                    return (object) [
                        'name' => $fullyQualifiedName,
                        'array' => $isArray
                    ];
                }
            }

            return $type;
        }
    }

    private function getFullyQualifiedName($className)
    {
        $useStatements = collect($this->getUseStatements());
        $aliasedStatement = $useStatements->where('alias', $className);

        if ($aliasedStatement) {
            return $aliasedStatement['namespace'];
        }

        $statement = $useStatements->first(function ($statement) use ($className) {
            return Str::endsWith($statement['namespace'], $className);
        });

        if ($statement) {
            return $statement['namespace'];
        }

        return null;
    }
}