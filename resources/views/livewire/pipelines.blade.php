<div>
    <livewire:projects />

    <hr />

    @foreach ($pipelines as $pipeline)
        @include('includes.pipeline', $pipeline)
    @endforeach
</div>
