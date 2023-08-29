<?php

namespace App\Providers;

use App\Window\AuthenticationWindow;
use Native\Laravel\Facades\MenuBar;
use Native\Laravel\Contracts\ProvidesPhpIni;

class NativeAppServiceProvider implements ProvidesPhpIni
{

    public function __construct(
        private readonly AuthenticationWindow $authenticationWindow
    ) {
    }

    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        $this->authenticationWindow->open();
        MenuBar::create()
            ->showDockIcon()
            ->label('You are a pussy');
    }

    /**
     * Return an array of php.ini directives to be set.
     */
    public function phpIni(): array
    {
        return [
        ];
    }
}
