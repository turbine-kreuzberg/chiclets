<div>
    <div class="page-section pb-1em">This is your first setup. Please provide your credentials to gitlab.</div>
    <hr/>

    <div class="page-section">
        @if (session()->has('message'))
            <div class="mb-1em">
                <div class="message error">
                    {{ session('message') }}
                </div>
            </div>
        @endif
        <form wire:submit.prevent="save">
            <div class="fields mb-2em">
                <label class="field pb-1em">
                    <span>Gitlab URL</span>
                    <input wire:model="configData.gitlab_url" class="border" spellcheck="false"/>
                    @error('configData.gitlab_url') <span
                        class="mt-0.5em text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
                <label class="field pb-1em">
                    <span>Access Token</span>
                    <input wire:model="configData.gitlab_api_token" class="border" spellcheck="false"/>
                    @error('configData.gitlab_api_token') <span
                        class="mt-0.5em text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
                <label class="field pb-1em">
                    <span>Max pipelines</span>
                    <input type="number" wire:model="configData.pipeline_display_number" class="border"
                           spellcheck="false"/>
                    @error('configData.pipeline_display_number') <span
                        class="mt-0.5em text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
            </div>
            <div class="section">
                <button class="button w-full">Save</button>
            </div>
        </form>
    </div>
</div>
