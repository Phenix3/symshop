<?php

namespace App\Admin\Form;

use RuntimeException;
use App\Entity\Attachment;
use App\Entity\GatewayConfig;
use App\Entity\Product;
use App\Entity\RangeValue;
use App\Entity\User;
use App\Form\Type\AttachmentCollectionType;
use App\Form\Type\AttachmentType;
use App\Form\Type\CategoryChoiceType;
use App\Form\Type\DateTimeType;
use App\Form\Type\GatewayConfigType;
use App\Form\Type\MarkdownEditorType;
use App\Form\Type\ProductChoiceType;
use App\Form\Type\RangeChoiceType;
use App\Form\Type\StatusChoiceType;
use App\Form\Type\SwitchType;
use App\Form\Type\UpdatePasswordType;
use App\Form\Type\UserChoiceType;
use DateTimeInterface;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionProperty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AutomaticForm extends AbstractType
{
    public const TYPES = [
        'string' => TextType::class,
        'bool' => SwitchType::class,
        'int' => NumberType::class,
        'float' => NumberType::class,
        DateTimeInterface::class => DateTimeType::class,
        User::class => UserChoiceType::class,
        RangeValue::class => RangeChoiceType::class,
        Attachment::class => AttachmentType::class,
        Product::class => ProductChoiceType::class,
        GatewayConfig::class => GatewayConfigType::class,
    ];

    public const NAMED_TYPES = [
        'content' => MarkdownEditorType::class,
        'description' => MarkdownEditorType::class,
        'color' => ColorType::class,
        'password' => UpdatePasswordType::class,
        'images' => AttachmentCollectionType::class,
        'categories' => CategoryChoiceType::class,
        'status' => StatusChoiceType::class,
    ];


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $data = $options['data'];
        $refClass = new ReflectionClass($data);
        $classProperties = $refClass->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($classProperties as $property) {
            $name = $property->getName();
            $type = $property->getType();
            if (!$type instanceof ReflectionNamedType) {
                return;
            }

            if (array_key_exists($name, self::NAMED_TYPES)) {
                $builder->add($name, self::NAMED_TYPES[$name], [
                    'required' => false,
                ]);
            } elseif (array_key_exists($type->getName(), self::TYPES)) {
                $builder->add($name, self::TYPES[$type->getName()], [
                    'required' => !$type->allowsNull() && 'bool' !== $type->getName(),
                ]);
            } else {
                throw new RuntimeException(\sprintf("Impossible de trouver le champs associe au type %s dans %s::%s", $type->getName(), $data::class, $name));
            }
        }
    }
}
