<?php

namespace App;


class Cart
{
    public $products = null;
    public $totalQuantity = 0;
    public $totalePrice = 0;
    public function __construct($prevCart){
        if ($prevCart){
            $this->$products = $prevCart->products;
            $this->$totalQuantity = $prevCart->totalQuantity;
            $this->$totalePrice = $prevCart->totalePrice;
        }
    }
    public function addProduct($product,$id){
        $storedProduct = ['quantity' => 0, 'price'=>$product->price, 'product'=>$product ];
        if ($this->products){
            if(array_key_exists($id, $this->products)){
                $storedProduct = $this->products[$id];
            }
        }
        $storedProduct['quantity']++;
        $storedProduct['price'] = $product->price * $storedProduct['quantity'];
        $this->products[$id] = $storedProduct;
        $totalQuantity++;
        $this->totalePrice += $product->price;
    }
}