<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{

    /**
     * @param array $options
     * @param string $id
     * @param string $name
     * @param string|null $oldValue
     */
    public function __construct(
        public array  $options,
        public string $id,
        public string $name,
        public ?string $oldValue,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
