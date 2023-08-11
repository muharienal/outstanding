<?php

namespace Modules\Dashboard\app\View\Components;

use Illuminate\View\Component;
use Modules\Notivication\app\Models\Notivication;

class Topbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        protected Notivication $notivication
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('dashboard::components.topbar', [
            'user' => auth()->user(),
            'notivications' => auth()->user()->hasAnyRole(['Super Admin'])
                ? $this->notivication->with('user')->where('status', 'unread')->whereNull('target')->latest()->limit(15)->get()
                : $this->notivication->with('user')->where('status', 'unread')->where('target', auth()->user()->id)->latest()->limit(5)->get(),
        ]);
    }
}
