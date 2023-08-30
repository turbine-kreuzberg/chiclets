<?php

namespace App\Window;

use App\Models\Config;
use Native\Laravel\Facades\Window;

class SettingsWindow
{
    public const WINDOW_IDENTIFIER = 'authentication-window';
    public const ROUTE = 'settings';
    public const WIDTH = 600;
    public const HEIGHT = 665;
    public const X = 400;
    public const Y = 2000;

    public function open(): self
    {
        Window::open(self::WINDOW_IDENTIFIER)
            ->showDevTools(false)
            ->route(self::ROUTE)
            ->width(self::WIDTH)
            ->height(self::HEIGHT)
            ->resizable(false)
            ->position(self::X, self::Y);

        return $this;
    }

    public function openUnlessConfigured(): self
    {
        $config = Config::first();

        if ($config && $config->isConfigured()) {
            return $this;
        }

        return $this->open();
    }
}
