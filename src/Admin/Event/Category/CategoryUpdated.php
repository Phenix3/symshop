<?php


namespace App\Admin\Event\Category;


use App\Entity\Category;

class CategoryUpdated
{
    /**
     * @var Category
     */
    private Category $category;
    /**
     * @var Category
     */
    private Category $oldCategory;

    public function __construct(Category $category, Category $oldCategory)
    {
        $this->category = $category;
        $this->oldCategory = $oldCategory;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @return Category
     */
    public function getOldCategory(): Category
    {
        return $this->oldCategory;
    }


}