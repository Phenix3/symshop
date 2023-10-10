<?php


namespace App\Admin\Event\Category;


use App\Entity\Category;

class CategoryUpdated
{
    public function __construct(private Category $category, private Category $oldCategory)
    {
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getOldCategory(): Category
    {
        return $this->oldCategory;
    }


}