<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Story;

class History extends Component
{
    public $history;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->history = Story::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.history');
    } 
}
