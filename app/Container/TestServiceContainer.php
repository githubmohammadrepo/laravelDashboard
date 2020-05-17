<?php
namespace App\Container;

use Illuminate\Support\Str;

class TestServiceContainer {

    protected $curency;
    protected $discount;

    //constructor method
    public function __construct($curency)
    {
        $this->discount = 0;
        $this->curency = $curency;
    }

    //charge method
    public function charge($amount){
        return [
            'amount' => $amount-$this->discount,
            'confirmation_number' => Str::random(),
            'currency' => $this->curency,
            'discount' => $this->discount,
        ];
    }


    //set discount
    public function setDisCount($amount){
        $this->discount = $amount;
    }


}
