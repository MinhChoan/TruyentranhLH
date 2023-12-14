<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Story;

class UpdatedStories extends Component
{
    public $truyen;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->truyen = Story::all(); // Assign the value to the variable.
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.updated-stories');
    }
}
