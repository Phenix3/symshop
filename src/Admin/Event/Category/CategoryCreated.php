<?php


namespace App\Admin\Event\Category;


use App\Entity\Category;

class CategoryCreated
{
    /**
     * @var Category
     */
    private Category $category;


    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

}