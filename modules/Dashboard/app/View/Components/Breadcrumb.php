<?php

namespace Modules\Dashboard\app\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        private string $title,
        private string $page,
        private string $route,
        private string $active,
    ) {
        $this->title = $title;
        $this->page = $page;
        $this->route = $route;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('dashboard::components.breadcrumb', [
            'title' => $this->title,
            'page' => $this->page,
            'route' => $this->route,
            'active' => $this->active,
        ]);
    }
}
