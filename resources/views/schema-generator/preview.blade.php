<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-effect overflow-hidden shadow-xl sm:rounded-2xl border border-gray-700">
                <div class="p-4 flex justify-between items-center">
                    <h2 class="text-gray-200 text-lg font-semibold">JSON Schema Preview</h2>
                </div>
                <div class="p-4">
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <h2 class="text-xl font-semibold text-gray-200">Generated Schema</h2>
                            <button
                                id="copy-schema"
                                onclick="copySchema(event)"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
                            >
                                Copy to Clipboard
                            </button>
                        </div>
                        <div class="bg-gray-900 p-4 rounded-md border border-gray-700">
                            <pre id="schema-json" class="text-sm overflow-x-auto whitespace-pre-wrap text-gray-200">{{ json_encode(json_decode($schema), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h2 class="text-xl font-semibold mb-4 text-gray-200">What's Next?</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-900 p-4 rounded-md border border-gray-700">
                                <h3 class="text-lg font-medium mb-2 text-gray-200">Use in Your API</h3>
                                <p class="text-gray-300 mb-4">
                                    Implement this schema in your API to validate request and response data.
                                </p>
                                <ul class="list-disc list-inside text-sm text-gray-300">
                                    <li>Validate incoming requests</li>
                                    <li>Document your API</li>
                                    <li>Generate client code</li>
                                </ul>
                            </div>
                            <div class="bg-gray-900 p-4 rounded-md border border-gray-700">
                                <h3 class="text-lg font-medium mb-2 text-gray-200">Create Mock Data</h3>
                                <p class="text-gray-300 mb-4">
                                    Generate realistic mock data based on this schema for testing.
                                </p>
                                <a href="#" class="text-indigo-400 hover:text-indigo-300 font-medium">
                                    Create Mock Data →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/utils.js')
    
    @push('scripts')
    <script>
        function copySchema(event) {
            window.copyToClipboard('#schema-json', event.currentTarget);
        }
        
        window.copySchema = copySchema;
    </script>
    @endpush
</x-app-layout>
