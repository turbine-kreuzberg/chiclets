<div>
    <div class="section">
        <livewire:projects />
        <a href="/settings" wire:navigate>Change settings</a>
    </div>

    <hr />

    @foreach ($pipelines as $pipeline)
        @include('includes.pipeline', $pipeline)
    @endforeach
</div>
