<?php


namespace App\Admin\Event\Category;


use App\Entity\Category;

class CategoryCreated
{
    public function __construct(private Category $category)
    {
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

}