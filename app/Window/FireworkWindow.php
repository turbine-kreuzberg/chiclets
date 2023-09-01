<?php

namespace App\Window;

use Native\Laravel\Facades\Window;

class FireworkWindow
{
    public const WINDOW_NAME = 'fire-work';

    public function open(): self
    {

        Window::open(self::WINDOW_NAME)
            ->showDevTools(false)
            ->transparent()
            ->fullscreen(true)
            ->route(ROUTE_NAME_FIRE_WORK);

        return $this;
    }

    public function close(): self
    {
        Window::close(self::WINDOW_NAME);

        return $this;
    }
}
