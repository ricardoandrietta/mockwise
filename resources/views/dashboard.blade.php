<x-app-layout>
    @isset($plainToken)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="glass-effect overflow-hidden shadow-xl sm:rounded-2xl border border-gray-700">
                    <div class="p-4 flex justify-between items-center ">
                        <h2 class="text-gray-200 text-lg font-semibold">Save this token; it won't be shown again.</h2>
                    </div>
                    <div class="p-4 flex justify-between items-center ">
                        <p class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-4">{{ $plainToken }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-effect overflow-hidden shadow-xl sm:rounded-2xl border border-gray-700">
                <div class="p-4 flex justify-between items-center ">
                    <h2 class="text-gray-200 text-lg font-semibold">{{ __("Tokens") }}</h2>
                    <a href="#"
                       x-data
                       x-on:click="$dispatch('open-modal', {name: 'new_token'})"
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        New Token
                    </a>
                </div>
                <div class="p-4">
                    <div class="w-full overflow-x-auto rounded-lg border border-gray-700">
                        <table class="w-full table-fixed">
                            <thead class="bg-gray-800">
                            <tr>
                                <th scope="col" class="w-2/5 px-6 py-4 text-left text-sm font-semibold text-gray-200">
                                    Token Name
                                </th>
                                <th scope="col" class="w-1/5 px-6 py-4 text-left text-sm font-semibold text-gray-200">
                                    Created At
                                </th>
                                <th scope="col" class="w-1/5 px-6 py-4 text-left text-sm font-semibold text-gray-200">
                                    Last Used
                                </th>
                                <th scope="col" class="w-1/5 px-6 py-4 text-right text-sm font-semibold text-gray-200">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700 bg-gray-900">
                            @foreach($tokens as $token)
                                <tr class="hover:bg-gray-800 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-200">
                                        {{ $token->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-200">
                                        {{ $token->created_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-200">
                                        {{ $token->last_used_at ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                        <a href="#"
                                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <x-modal title="Create Token" name="new_token">
        @slot('body')
            <form method="POST" action="{{ route('token.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-200">Token Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Enter token name"
                        required
                    />
                </div>

                <div class="gap-4">
                    <x-primary-button>
                        {{ __('Create Token') }}
                    </x-primary-button>
                </div>
            </form>
        @endslot
    </x-modal>

</x-app-layout>
