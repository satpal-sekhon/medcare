<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInput extends Component
{
    public $name;
    public $label;
    public $type;
    public $value;
    public $attributes;
    public $multiple;
    public $labelClass;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $label = '', $type = 'text', $value = null, $attributes = [], $multiple = false, $labelClass = '')
    {
        $this->name = $name;
        $this->label = $label ?? $name;
        $this->type = $type;
        $this->value = $value;
        $this->attributes = $attributes;
        $this->multiple = $multiple;
        $this->labelClass = $labelClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-input');
    }
}
