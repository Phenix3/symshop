<?php namespace App\Service\Cart;

use Tightenco\Collect\Support\Collection;

class ItemAttributeCollection extends Collection {

    public function __get($name): mixed
    {
        if( $this->has($name) ) return $this->get($name);
        return null;
    }
}