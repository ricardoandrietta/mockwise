<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <h2 class="text-xl font-semibold text-gray-200">Your Saved Schemas</h2>
            <button
                wire:click="toggleViewMode"
                class="px-3 py-1 text-sm font-medium rounded-md bg-gray-800 text-gray-200 hover:bg-gray-700 border border-gray-700 transition-colors duration-200"
            >
                <span x-show="$wire.viewMode === 'simple'">Show Details</span>
                <span x-show="$wire.viewMode === 'detailed'">Simple View</span>
            </button>
        </div>
        <a href="{{ route('schema.index') }}"
           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
            Create New Schema
        </a>
    </div>

    @empty($schemas)
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-200">No schemas</h3>
            <p class="mt-1 text-sm text-gray-400">Get started by creating a new schema.</p>
            <div class="mt-6">
                <a href="{{ route('schema.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Schema
                </a>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 gap-4">
            @foreach($schemas as $schema)
                <div class="glass-effect border border-gray-700 rounded-lg shadow-sm hover:shadow-lg transition-shadow duration-200">
                    <div class="p-4" :class="{ 'lg:grid lg:grid-cols-2 lg:gap-4': $wire.viewMode === 'detailed' }">
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-200">{{ $schema['id'] . ' - ' . $schema['name'] }}</h3>
                            <p class="text-sm text-gray-400 line-clamp-2">{{ $schema['prompt'] }}</p>
                            <div class="flex justify-between items-center">
                                <div class="text-xs text-gray-400">
                                    Created {{ \Carbon\Carbon::parse($schema['created_at'])->diffForHumans() }}
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('schema.preview', ['schemaId' => $schema['id']]) }}"
                                       class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                        View
                                    </a>
                                    <button
                                        wire:click="deleteSchema({{ $schema['id'] }})"
                                        wire:confirm="Are you sure you want to delete this schema?"
                                        class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if($viewMode === 'detailed')
                        <div class="mt-4 lg:mt-0 border-t lg:border-t-0 lg:border-l border-gray-700 lg:pl-4 pt-4 lg:pt-0">
                            <div class="relative">
                                <div class="text-sm font-mono bg-gray-900 rounded-md p-3 overflow-hidden {{ isset($expandedSchemas[$schema['id']]) && !$expandedSchemas[$schema['id']] ? 'max-h-32' : '' }}">
                                    <pre id="schema-{{ $schema['id'] }}" class="text-gray-300 whitespace-pre-wrap">{{ json_encode($schema['mock_schema'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                </div>

                                @if(isset($expandedSchemas[$schema['id']]) && !$expandedSchemas[$schema['id']])
                                <div class="absolute bottom-0 left-0 right-0 h-12 bg-gradient-to-t from-gray-900 to-transparent pointer-events-none"></div>

                                <div class="absolute bottom-3 right-3 flex space-x-4 text-xs">
                                    <a
                                        href="#"
                                        onclick="copySchemaContent({{ $schema['id'] }}, event)"
                                        class="text-indigo-400 hover:text-indigo-300 cursor-pointer"
                                    >
                                        Copy
                                    </a>
                                    <a
                                        href="#"
                                        wire:click.prevent="toggleSchemaExpansion({{ $schema['id'] }})"
                                        class="text-indigo-400 hover:text-indigo-300 cursor-pointer"
                                    >
                                        Show more
                                    </a>
                                </div>
                                @else
                                <div class="mt-2 text-right mr-3 flex justify-end space-x-4 text-xs">
                                    <a
                                        href="#"
                                        onclick="copySchemaContent({{ $schema['id'] }}, event)"
                                        class="text-indigo-400 hover:text-indigo-300 cursor-pointer"
                                    >
                                        Copy
                                    </a>
                                    <a
                                        href="#"
                                        wire:click.prevent="toggleSchemaExpansion({{ $schema['id'] }})"
                                        class="text-indigo-400 hover:text-indigo-300 cursor-pointer"
                                    >
                                        Show less
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endempty
</div>
