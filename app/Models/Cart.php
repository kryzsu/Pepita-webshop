<?php

namespace App\Models;



class Cart
{
   
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        //Ha mér létezik a session kosár alapértelmezett értékek felülírása
        if ($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id){

        $storedItem = [
            'qty' => 0,
            'price' => $item->price,
            'item' => $item
        ];
        //már hozzá van adva a termék a kosárhoz
        if($this->items && array_key_exists($id, $this->items)){
            $storedItem = $this->items[$id];
        }

        $storedItem['qty']++;
        $storedItem['price'] = $item->price*$storedItem['qty'];
        $this->items[$id] = $storedItem;
        //total
        $this->totalQty++;
        $this->totalPrice += $item->price;

    }

    public function destroy($id){
        $this->totalPrice = $this->totalPrice-$this->items[$id]['price'];
        $this->totalQty = $this->totalQty-$this->items[$id]['qty'];
        unset($this->items[$id]);
    }
}
