<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public $name;
    public $label;
    public $type;
    public $value;
    public $attributes;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $label = '', $value = '', $attributes = [])
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->attributes = $attributes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.textarea');
    }
}
