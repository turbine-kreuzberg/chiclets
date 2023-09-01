<?php

namespace App\Livewire;

use App\Window\FireworkWindow;
use Livewire\Component;

class FireWorkTrigger extends Component
{
    public const WINDOW_NAME = 'fire-work';

    private FireworkWindow $fireworkWindow;

    public function boot(FireworkWindow $fireworkWindow)
    {
        $this->fireworkWindow = $fireworkWindow;
    }

    public function render()
    {
        return view('livewire.fire-work-trigger');
    }

    public function open(): void
    {
        $this->fireworkWindow->open();
    }

    public function close(): void
    {
        $this->fireworkWindow->close();
    }
}
