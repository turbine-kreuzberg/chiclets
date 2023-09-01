<div wire:poll.5s>
    <div class="page-section">
        <livewire:projects/>
    </div>

    <div class="page-section">
        <div class="pipelines">
            @if (!$projectSelected)
                <div>
                    No project selected yet.
                </div>
            @else
                @forelse ($pipelines as $pipeline)
                    <a href="#"
                       wire:key="{{ $pipeline['id'] }}"
                       wire:click.prevent="openPipelineUrl('{{$pipeline['webUrl']}}')"
                    >
                        <i class="{{$pipeline['statusIcon']}} mr-0.5em"></i>
                        {{ $pipeline['id'] }}
                    </a>
                @empty
                    <div>This project has no pipelines.</div>
                @endforelse
            @endif
        </div>
    </div>
    <div class="page-section">
        <livewire:fire-work-trigger />
    </div>
</div>
