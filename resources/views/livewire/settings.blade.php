<div>
    <hr />
    <div class="section">This is your first setup. Please provide your credentials to gitlab.</div>
    <hr />

    @if (session()->has('message'))
        <div class="section">
            <div class="message error">
                {{ session('message') }}
            </div>
        </div>
    @endif
    <form wire:submit.prevent="save">
        <div class="fields mb-2em">
            <label class="section field pb-0">
                <span>Gitlab URL</span>
                <input wire:model="configData.gitlab_url" class="border" spellcheck="false"/>
                @error('configData.gitlab_url') <span
                    class="mt-0.5em text-sm text-red-600">{{ $message }}</span> @enderror
            </label>
            <label class="section field pb-0">
                <span>Access Token</span>
                <input wire:model="configData.gitlab_api_token" class="border" spellcheck="false"/>
                @error('configData.gitlab_api_token') <span
                    class="mt-0.5em text-sm text-red-600">{{ $message }}</span> @enderror
            </label>
            <label class="section field pb-0">
                <span>Max pipelines</span>
                <input type="number" wire:model="configData.pipeline_display_number" class="border" spellcheck="false"/>
                @error('configData.pipeline_display_number') <span
                    class="mt-0.5em text-sm text-red-600">{{ $message }}</span> @enderror
            </label>
        </div>
        <div class="section">
            <button class="button w-full">Save</button>
        </div>
    </form>
</div>
