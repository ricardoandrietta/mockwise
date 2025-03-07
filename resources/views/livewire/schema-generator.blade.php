<div>
    <div class="mb-6">
        <p class="text-gray-200 mb-2">
            Describe the API or data structure you want to create a JSON schema for. 
            Be as detailed as possible about the properties, types, and relationships.
        </p>
    </div>

    <form wire:submit.prevent="generateSchema" class="space-y-6">
        <div>
            <label for="description" class="block text-sm font-medium text-gray-200">
                Description
            </label>
            <div class="mt-1">
                <textarea
                    id="description"
                    wire:model="form.description"
                    rows="8"
                    class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Example: Create a schema for a blog post API with title, content, author information, publication date, and tags."
                    required
                    minlength="10"
                    maxlength="1000"
                ></textarea>
            </div>
            <p class="mt-1 text-sm text-gray-400">
                Minimum 10 characters, maximum 1000 characters.
            </p>
            @error('form.description') 
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end">
            <button
                type="submit"
                wire:loading.class="hidden"
                wire:target="generateSchema"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
            >
                Generate Schema
            </button>
            <div 
                wire:loading
                wire:target="generateSchema" 
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600"
                style="min-width: 130px"
            >
                <div class="flex items-center">
                    <svg class="animate-spin flex-shrink-0 w-4 h-4 self-center" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="ml-2 whitespace-nowrap">Generating...</span>
                </div>
            </div>
        </div>
    </form>

    @if ($errorMessage)
        <div class="mt-6 p-4 bg-red-900 border border-red-700 text-red-200 rounded">
            {{ $errorMessage }}
        </div>
    @endif

    @if ($schema)
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-200">Generated Schema</h2>
            <div class="bg-gray-900 p-4 rounded-md border border-gray-700">
                <pre class="text-sm overflow-x-auto text-gray-200">{{ json_encode($schema, JSON_PRETTY_PRINT) }}</pre>
            </div>
            
            <div class="mt-4 flex justify-center space-x-4">
                <button
                    id="copy-schema-button"
                    onclick="copyGeneratedSchema(event)"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    Copy Schema
                </button>
                <button
                    x-data
                    @click="$dispatch('open-modal', { name: 'save_schema' })"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Save Schema
                </button>
            </div>
        </div>
    @endif

    <x-modal name="save_schema" title="Save Schema">
        <x-slot:body>
            <div class="p-6">
                <p class="mt-1 text-sm text-gray-400">
                    Give your schema a name to save it for future use.
                </p>

                <form wire:submit="saveSchema" class="mt-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-200">Schema Name</label>
                        <div class="mt-1">
                            <input
                                type="text"
                                id="name"
                                wire:model="saveForm.name"
                                class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Enter schema name"
                            />
                        </div>
                        @error('saveForm.name') 
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button
                            type="button"
                            x-data
                            @click="$dispatch('close-modal')"
                            class="inline-flex items-center px-4 py-2 border border-gray-700 text-sm font-medium rounded-md text-gray-200 bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-75 cursor-not-allowed"
                        >
                            <span wire:loading.remove wire:target="saveSchema">Save Schema</span>
                            <span wire:loading wire:target="saveSchema">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Saving...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </x-slot:body>
    </x-modal>

    @push('scripts')
    <script>
        function copyGeneratedSchema(event) {
            window.copyToClipboard('.bg-gray-900 pre', event.currentTarget);
        }

        window.copyGeneratedSchema = copyGeneratedSchema;

        document.addEventListener('livewire:initialized', () => {
            @this.on('schema-saved', (event) => {
                // Close the modal
                window.dispatchEvent(new CustomEvent('close-modal'));
                
                // Show a notification that the schema was saved
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { 
                        type: 'success',
                        message: `Schema "${event.name}" has been saved successfully.`
                    }
                }));
            });
        });
    </script>
    @endpush
</div>
