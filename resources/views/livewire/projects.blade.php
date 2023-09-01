<div>
    <p>Select the project you'd like to observe.</p>
    <select wire:change="setCurrentProject($event.target.value)">
        <option value="" {{!$currentProjectId ? 'selected':''}}>Please select</option>
        @foreach ($projects as $project)
            <option
                wire:key="{{ $project['id'] }}"
                value="{{ $project['id'] }}"
                {{ (int)$project['id'] === (int)$currentProjectId ? 'selected' : '' }}
            >{{ $project['name'] }}</option>
        @endforeach
    </select>
</div>
