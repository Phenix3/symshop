<?php

namespace App\Admin\DataClass;

interface CrudDataInterface
{
    public function getEntity(): object;

    public function getFormClass(): string;

    public function hydrate(): void;
}