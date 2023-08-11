<?php

namespace Modules\Dashboard\app\View\Components;

use Illuminate\View\Component;
use Modules\MenuManagement\app\Models\MenuGroup;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $menus = MenuGroup::query()
            ->with('items', function ($query) {
                return $query->where('status', true)->orderBy('posision');
            })
            ->where('status', true)
            ->orderBy('posision')
            ->get();

        return view('dashboard::components.sidebar', compact('menus'));
    }
}
