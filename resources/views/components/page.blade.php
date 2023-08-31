<div style="background: yellow">

</div>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Chiclets</title>

    @vite(['resources/css/app.scss', 'resources/js/app.js'])

    @livewireStyles
</head>
<body>

<div class="page">
    <div class="page-content">
        {{ $slot }}
    </div>
    <div class="page-footer">
        <div class="footer">
            @foreach($navigation->getItems() as $item)
                <a href="{{$item->getHref()}}" onclick="{{$item->getOnClick()}}" wire:navigate>
                    {{$item->getLabel()}}
                </a>
            @endforeach
        </div>
    </div>
</div>

@livewireScripts

</body>
</html>
