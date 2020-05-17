<?php
namespace App\Container;

use Illuminate\Support\Str;

class TestServiceContainer {

    protected $curency;


    //constructor method
    public function __construct($curency)
    {
        $this->curency = $curency;
    }

    //charge method
    public function charge($amount){
        return [
            'amount' => $amount,
            'confirmation_number' => Str::random(),
            'currency' => $this->curency,
        ];
    }


}
