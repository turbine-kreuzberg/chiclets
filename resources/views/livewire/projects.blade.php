<div>
    <select name="project" id="project" wire:change="setCurrentProject($event.target.value)">
        @foreach ($projects as $project)
            <option wire:key="{{ $project['id'] }}" value="{{ $project['id'] }}"{{ $project['id'] === $currentProjectId ? ' selected' : '' }}>{{ $project['name'] }}</option>
        @endforeach
    </select>
</div>
