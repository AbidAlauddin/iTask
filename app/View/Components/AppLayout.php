<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $title;
    public $tasksDueSoon;

    /**
     * Create a new component instance.
     *
     * @param string|null $title
     * @param array|null $tasksDueSoon
     * @return void
     */
    public function __construct($title = null, $tasksDueSoon = null)
    {
        $this->title = $title;
        $this->tasksDueSoon = $tasksDueSoon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.app-layout');
    }
}
