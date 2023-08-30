<div class="settings">
    <div class="box">
        <h1 class="-mt-0.5em mb-0.5em text-center">Settings</h1>
        <p class="mb-1em">This is your first setup. Please provide your credentials to gitlab.</p>
        <hr />
        <form wire:submit.prevent="save">
            <div class="fields mb-2em">
                <label class="field mb-1em">
                    <span>Gitlab URL</span>
                    <input wire:model="configData.gitlab_url" class="border"/>
                    @error('configData.gitlab_url') <span class="mt-0.5em text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
                <label class="field mb-1em">
                    <span>Access Token</span>
                    <input wire:model="configData.gitlab_api_token" class="border"/>
                    @error('configData.gitlab_api_token') <span class="mt-0.5em text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
                <label class="field mb-1em">
                    <span>Max pipelines</span>
                    <input wire:model="configData.pipeline_display_number" class="border"/>
                    @error('configData.pipeline_display_number') <span class="mt-0.5em text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
            </div>
            <div class="buttons">
                <button class="button w-full">Save</button>
            </div>
        </form>
    </div>
</div>
