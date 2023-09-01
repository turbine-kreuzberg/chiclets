<x-html>
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
</x-html>
