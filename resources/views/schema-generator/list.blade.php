<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-effect overflow-hidden shadow-xl sm:rounded-2xl border border-gray-700">
                <div class="p-4">
                    <livewire:user-schemas />
                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/utils.js')

    @push('scripts')
        <script>
            function copySchemaContent(schemaId, event) {
                window.copyToClipboard(`#schema-${schemaId}`, event.currentTarget, {
                    successIcon: '', // No icon for this view
                    successText: 'Copied!'
                });
            }

            window.copySchemaContent = copySchemaContent;
        </script>
    @endpush
</x-app-layout>
