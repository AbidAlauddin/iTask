<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;

class Sidebar extends Component
{
    public $lists;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Get the first list for the authenticated user
        if (auth()->check()) {
            $this->lists = Category::where('user_id', auth()->id())->first();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}
