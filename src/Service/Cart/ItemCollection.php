<?php namespace App\Service\Cart;

use Tightenco\Collect\Support\Collection;

class ItemCollection extends Collection
{

    /**
     * ItemCollection constructor.
     * @param array|mixed $items
     * @param $config
     */
    public function __construct($items, /**
     * Sets the config parameters.
     *
     * @var
     */
    protected $config = [])
    {
        parent::__construct($items);
    }

    /**
     * get the sum of price
     *
     * @return mixed|null
     */
    public function getPriceSum()
    {
        return $this->price * $this->quantity;
    }

    public function __get($name)
    {
        if ($this->has($name) || $name == 'model') {
            return is_null($this->get($name)) ? $this->getAssociatedModel() : $this->get($name);
        }
        return null;
    }

    /**
     * return the associated model of an item
     *
     * @return bool
     */
    protected function getAssociatedModel()
    {
        if (!$this->has('associatedModel')) {
            return null;
        }

        // $associatedModel = $this->get('associatedModel');

        return $this->get('associatedModel');
    }

    /**
     * check if item has conditions
     *
     * @return bool
     */
    public function hasConditions()
    {
        if (!isset($this['conditions'])) {
            return false;
        }
        if (is_array($this['conditions'])) {
            return $this['conditions'] !== [];
        }
        $conditionInstance = CartCondition::class;
        return $this['conditions'] instanceof $conditionInstance;
    }

    /**
     * check if item has conditions
     *
     * @return mixed|null
     */
    public function getConditions()
    {
        if (!$this->hasConditions()) {
            return [];
        }
        return $this['conditions'];
    }

    /**
     * get the single price in which conditions are already applied
     * @param bool $formatted
     * @return mixed|null
     */
    public function getPriceWithConditions($formatted = true)
    {
        $originalPrice = $this->price;
        $newPrice = 0.00;
        $processed = 0;

        if ($this->hasConditions()) {
            if (is_array($this->conditions)) {
                foreach ($this->conditions as $condition) {
                    ($processed > 0) ? $toBeCalculated = $newPrice : $toBeCalculated = $originalPrice;
                    $newPrice = $condition->applyCondition($toBeCalculated);
                    $processed++;
                }
            } else {
                $newPrice = $this['conditions']->applyCondition($originalPrice);
            }

            return Helpers::formatValue($newPrice, $formatted, $this->config);
        }
        return Helpers::formatValue($originalPrice, $formatted, $this->config);
    }

    /**
     * get the sum of price in which conditions are already applied
     * @param bool $formatted
     * @return mixed|null
     */
    public function getPriceSumWithConditions($formatted = true)
    {
        return Helpers::formatValue($this->getPriceWithConditions(false) * $this->quantity, $formatted, $this->config);
    }
}
