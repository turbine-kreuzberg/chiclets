<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use App\Models\NavigationItem;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function settingsAction(): View
    {
        return \view('settings', [
            'navigation' => Navigation::create([
                NavigationItem::createCloseItem('Quit'),
            ]),
        ]);
    }

    public function pipelinesAction(): View
    {
        return \view('pipelines', [
            'navigation' => Navigation::create([
                NavigationItem::createCloseItem('Quit'),
                NavigationItem::create('Settings', '/settings'),
            ]),
        ]);
    }

    public function fireWorkAction(): View
    {
        return \view('fire-work');
    }
}
