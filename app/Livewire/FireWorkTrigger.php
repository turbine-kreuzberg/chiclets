<?php

namespace App\Livewire;

use Livewire\Component;
use Native\Laravel\Facades\Window;

class FireWorkTrigger extends Component
{
    public const WINDOW_NAME = 'fire-work';

    public function render()
    {
        return view('livewire.fire-work-trigger');
    }

    public function open(): void
    {
        Window::open(self::WINDOW_NAME)
            ->showDevTools(false)
            ->transparent()
            ->fullscreen(true)
            ->route(ROUTE_NAME_FIRE_WORK);
    }

    public function close(): void
    {
        Window::close(self::WINDOW_NAME);
    }
}
