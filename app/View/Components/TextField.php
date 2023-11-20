<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextField extends Component
{
    public $name;
    public $label;
    public $id;
    public $placeholder;
    public $value;

    /**
     * Create a new component instance.
     */
    public function __construct($name='', $label='', $id='', $placeholder='', $value='')
    {
        $this->name = $name;
        $this->label = $label;
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text-field');
    }
}
