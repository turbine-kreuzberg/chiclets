<div wire:poll.15s>
    <div class="section">
        <livewire:projects/>
        <a href="/settings" wire:navigate>Change settings</a>
    </div>

    <hr/>

    @if (!$projectSelected)
        <div class="section">
            No project selected yet.
        </div>
    @else
        @forelse ($pipelines as $pipeline)
            @include('includes.pipeline', $pipeline)
        @empty
            <div class="section">This project has no pipelines.</div>
        @endforelse
    @endif
</div>
