<?php


namespace App\DataClass;

use App\Entity\Category;

class SearchData
{
    /**
     * @var string
     */
    public $q;

    /**
     * Undocumented variable
     *
     * @var int|null
     */
    public $min;

    /**
     * Undocumented variable
     *
     * @var int|null
     */
    public $max;

    /**
     * Undocumented variable
     *
     * @var Category[]
     */
    public $categories = [];

    /**
     * @var int
     */
    public $page = 1;
}