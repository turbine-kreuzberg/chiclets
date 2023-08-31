<div>
    <div class="section">
        <livewire:projects />
    </div>

    <hr />

    @foreach ($pipelines as $pipeline)
        @include('includes.pipeline', $pipeline)
    @endforeach
</div>
