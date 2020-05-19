<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $type;
    public $content;
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type,$content,$title)
    {
        $this->type = $type;
        $this->content = $content;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
