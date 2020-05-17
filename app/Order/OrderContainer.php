<?php

namespace App\Order;

use App\Container\TestServiceContainer;

class OrderContainer {

    private $serviceContainer ;

    public function __construct(TestServiceContainer $serviceContainer)
    {
        $this->serviceContainer = $serviceContainer;
    }

    public function all(){
        $this->serviceContainer->setDisCount(100);

        return [
            'name' => 'mohammad',
            'address' => 'marivan-ardalan streed, waring'
        ];
    }
}
