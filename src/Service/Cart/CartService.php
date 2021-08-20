<?php

namespace App\Service\Cart;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{

    public const CART_SESSION_ID       = '_cart';
    public const CART_ITEMS_SESSION_ID = '_cart_items';

    private $session;
    private $productRepository;
    private $config = [
        'decimals'       => 2,
        'dec_point'      => '.',
        'thousands_sep'  => ',',
        'format_numbers' => true,
    ];

    public function __construct(SessionInterface $session, ProductRepository $productRepository)
    {
        $this->session           = $session;
        $this->productRepository = $productRepository;
    }

    public function add($id, $name = null, $price = null, int $quantity = 1, $associatedModel = null): self
    {
        // if the first argument is an array,
        // we will need to call add again
        if (is_array($id)) {
            // the first argument is an array, now we will need to check if it is a multi dimensional
            // array, if so, we will iterate through each item and call add again
            if (Helpers::isMultiArray($id)) {
                foreach ($id as $item) {
                    $this->add(
                        $item['id'],
                        $item['name'],
                        $item['price'],
                        $item['quantity'],
                        Helpers::issetAndHasValueOrAssignDefault($item['attributes'], array()),
                        Helpers::issetAndHasValueOrAssignDefault($item['conditions'], array()),
                        Helpers::issetAndHasValueOrAssignDefault($item['associatedModel'], null)
                    );
                }
            } else {
                $this->add(
                    $id['id'],
                    $id['name'],
                    $id['price'],
                    $id['quantity'],
                    Helpers::issetAndHasValueOrAssignDefault($id['attributes'], array()),
                    Helpers::issetAndHasValueOrAssignDefault($id['conditions'], array()),
                    Helpers::issetAndHasValueOrAssignDefault($id['associatedModel'], null)
                );
            }

            return $this;
        }

        $data = [
            'id'       => $id,
            'name'     => $name,
            'price'    => $price,
            'quantity' => $quantity,
        ];

        if (isset($associatedModel) && $associatedModel != '') {
            $data['associatedModel'] = $associatedModel;
        }

        if ($this->has($id)) {
            $this->update($id, $data);
        } else {
            $this->addRow($id, $data);
        }

        return $this;
    }

    public function update($id, array $data)
    {
        $cart = $this->getContent();

        $item = $this->get($id);

        foreach ($data as $key => $value) {
            if ($key == 'quantity') {
                if (is_array($value)) {
                    if ((bool) $value['relative']) {
                        $item = $this->updateQuantityRelative($item, $key, $value['value']);
                    } else {
                        $item = $this->updateQuantityNotRelative($item, $key, $value['value']);
                    }
                } else {
                    $item = $this->updateQuantityRelative($item, $key, $value);
                }
            } else {
                $item[$key] = $value;
            }
        }

        $cart->put($id, $item);

        $this->save($cart);
    }

    public function getCart()
    {
        return $this->session->get(self::CART_ITEMS_SESSION_ID, []);
    }

    public function has($id)
    {
        return $this->getContent()->has($id);
    }

    /**
     * Undocumented function
     *
     * @return CartCollection
     */
    public function getContent()
    {
        $content = (new CartCollection($this->getCart()))->reject(function ($item) {
            $item->put('total', $item->getPriceSum());
            return !($item instanceof ItemCollection);
        });
        return $content;
    }

    public function get($id)
    {
        return $this->getContent()->get($id);
    }

    public function remove($id)
    {
        $cart = $this->getContent();
        $cart->forget($id);
        $this->save($cart);
        return true;
    }

    public function clear()
    {
        $this->session->set(self::CART_ITEMS_SESSION_ID, []);
        return true;
    }

    public function getFullCart(): array
    {
        $cart = $this->session->get(self::CART_SESSION_ID, []);

        $cartWithData = [];

        foreach ($cart as $id => $quantity) {
            $cartWithData[] = [
                'product'  => $this->productRepository->find($id),
                'quantity' => $quantity,
            ];
        }

        return $cartWithData;
    }

    public function getSubTotal($formatted = true)
    {
        $sum = $this->getContent()->sum(function (ItemCollection $item) {

            return $item->getPriceSum();
        });

        return $sum;
    }

    public function getTotal()
    {
        $total    = 0;
        $subTotal = $this->getSubTotal(false);

        // foreach ($this->getFullCart() as $item) {
        //     $total += $item['product']->getPrice() * $item['quantity'];
        // }

        return $subTotal;
    }

    public function updateQuantityRelative($item, $key, $value)
    {
        if (preg_match('/\-/', $value) == 1) {
            $value = (int) str_replace('-', '', $value);

            // we will not allowed to reduced quantity to 0, so if the given value
            // would result to item quantity of 0, we will not do it.
            if (($item[$key] - $value) > 0) {
                $item[$key] -= $value;
            }
        } elseif (preg_match('/\+/', $value) == 1) {
            $item[$key] += (int) str_replace('+', '', $value);
        } else {
            $item[$key] += (int) $value;
        }
        return $item;
    }

    public function updateQuantityNotRelative($item, $key, $value)
    {
        $item[$key] = (int) $value;

        return $item;
    }

    public function save($cart)
    {
        $this->session->set(self::CART_ITEMS_SESSION_ID, $cart);
    }

    public function addRow($id, $item)
    {
        $cart = $this->getContent();
        $cart = $cart->put($id, new ItemCollection($item, $this->config));

        $this->save($cart);

        return true;
    }

    public function isEmpty()
    {
        return count($this->getContent()) === 0;
    }
}
