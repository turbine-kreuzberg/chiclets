<?php

namespace App\Window;

use App\Services\Config\ChicletsConfig;
use Native\Laravel\Facades\MenuBar;

class DropdownWindow
{
    public const ROUTE = 'settings';

    public const WIDTH = 450;

    public const HEIGHT = 600;

    public const X = 400;

    public const Y = 2000;

    public function __construct(private readonly ChicletsConfig $config)
    {

    }

    public function open(): self
    {
        $route = $this->config->hasConfig() ? ROUTE_NAME_PIPELINES : ROUTE_NAME_SETTINGS;

        if (getenv('IS_ROBERT_LAPTOP') === '1') {
            MenuBar::create()
                ->route($route)
                ->width(self::WIDTH)
                ->height(self::HEIGHT)
                ->blendBackgroundBehindWindow()
                ->transparent()
                ->alwaysOnTop()
                ->icon(storage_path('app/menuBarIconTemplate.png'));

            MenuBar::show();

            return $this;
        }

        MenuBar::create()
            ->route($route)
            ->width(self::WIDTH)
            ->height(self::HEIGHT)
            ->blendBackgroundBehindWindow()
            ->transparent()
            ->icon(storage_path('app/menuBarIconTemplate.png'));

        return $this;
    }
}
