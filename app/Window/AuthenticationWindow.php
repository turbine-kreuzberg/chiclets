<?php

namespace App\Window;

use Native\Laravel\Facades\Window;

class AuthenticationWindow
{
    public const WINDOW_IDENTIFIER = 'authentication-window';
    public const ROUTE = 'settings';
    public const WIDTH = 400;
    public const HEIGHT = 400;
    public const X = 400;
    public const Y = 2000;

    public function open(): self
    {
        Window::open(self::WINDOW_IDENTIFIER)
            ->showDevTools(false)
            ->route(self::ROUTE)
            ->width(self::WIDTH)
            ->height(self::HEIGHT)
            ->position(self::X, self::Y);

        return $this;
    }
}
