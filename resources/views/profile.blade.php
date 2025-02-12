<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="glass-effect overflow-hidden shadow-xl sm:rounded-2xl border border-gray-700">
                <div class="p-6">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="glass-effect overflow-hidden shadow-xl sm:rounded-2xl border border-gray-700">
                <div class="p-6">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <div class="glass-effect overflow-hidden shadow-xl sm:rounded-2xl border border-gray-700">
                <div class="p-6">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
