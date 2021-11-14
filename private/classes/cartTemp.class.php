<?php

class CartTemp
{
    public $cart_items = [];
    public $id;
    public $userId;
    public $productId;
    public $quantity;
    public $createdOn;
    public $errors = [];

    public function __construct($args = [])
    {
        $this->cart_items = $this->get_cart_from_cookie();
        $this->userId = $args['userId'] ?? "";
        $this->productId = $args['productId'] ?? "";
        $this->quantity = $args['quantity'] ?? 1;
        $this->createdOn = $args['createdOn'] ?? date('Y-m-d H:i:s');
    }


    private function get_cart_from_cookie()
    {
        if (isset($_COOKIE['cart_items'])) {
            return json_decode($_COOKIE['cart_items'], true);
        }
    }

    // Cout the numbers of items in your cart
    public function cartCount()
    {
        if (!empty($this->cart_items)) {
            return count($this->cart_items);
        }
    }

    public function setCart($args = [])
    {
        $item = $args['item'];
        //Check if the product is already in the cart 

        if (empty($this->cart_items)) {
            $this->cart_items[$item['productId']] = $item;
            setcookie("cart_items", json_encode($this->cart_items), time() + (86400 * 30 * 5), '/');
            return true;
        } else {
            $match = false;
            foreach ($this->cart_items as $key => $value) {
                if ($value['productId'] === $item['productId']) {
                    $match = true;
                }
            }
            if ($match) {

                // If product Exist then simply Add 
                return "Exist";
            } else if (!$match) {

                // The item is not in the cookie then add it now  
                $this->cart_items[$item['productId']] = $item;
                setcookie("cart_items", json_encode($this->cart_items), time() + (86400 * 30 * 5), '/');
                return true;
            }
            // The item was not added , therefore return false
            return false;
        }
    }
    public function getCart()
    {
        if (isset($this->cart_items)) {
            return $this->cart_items;
        }
    }

    public function clearCart()
    {
        if (isset($_COOKIE['cart_items'])) {
            setcookie("cart_items", "", time() - 3600, '/');
            return true;
        } else {
            return false;
        }
    }
    public function deleteItem($id)
    {
        if (isset($_COOKIE['cart_items'])) {

            unset($this->cart_items[$id]);
            setcookie("cart_items", json_encode($this->cart_items), time() + (86400 * 30 * 5), '/');
            return true;
        } else {
            return false;
        }
    }
}