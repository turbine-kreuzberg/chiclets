<div class="settings">
    <div class="box">
        <h1 class="-mt-0.5em mb-0.5em text-center">Settings</h1>
        <p class="mb-1em">This is your first setup. Please provide your credentials to gitlab.</p>
        <hr />
        <form wire:submit="save">
            <div class="fields mb-2em">
                <label class="field mb-1em">
                    <span>Gitlab URLs</span>
                    <input wire:model="configData.gitlab_url" class="border"/>
                </label>
                <label class="field mb-1em">
                    <span>Access Token</span>
                    <input wire:model="configData.gitlab_api_token" class="border"/>
                </label>
                <label class="field mb-1em">
                    <span>Max pipelines</span>
                    <input wire:model="configData.pipeline_display_number" class="border"/>
                </label>
            </div>
            <div class="buttons">
                <button class="button w-full">Save</button>
            </div>
        </form>
    </div>
</div>
