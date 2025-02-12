@props(['title', 'name'])
<div
    x-data = "{ visible: false, name: '{{$name}}' }"
    x-show = "visible"
    x-on:open-modal.window = "visible = ($event.detail.name === name)"
    x-on:close-modal.window = "visible = false"
    x-on:keydown.escape.window = "visible = false"
    x-transition

    style="display: none;"
    class="fixed z-50 inset-0 flex items-center justify-center"
>
    <!-- Backdrop -->
    <div
        class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"
        x-on:click="$dispatch('close-modal')"
    ></div>

    <!-- Modal Content -->
    <div class="relative z-50 bg-white/10 rounded-lg w-full sm:max-w-md m-2">
        <!-- Header -->
        <div class="flex items-center justify-between p-4">
            <h3 class="text-lg font-semibold text-gray-200">
                {{ $title ?? 'Header'}}
            </h3>
            <button
                x-on:click="$dispatch('close-modal')"
                class="text-gray-500 hover:text-gray-700 focus:outline-none"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Body -->
        <div class="p-4">
            {{ $body }}
        </div>
    </div>
</div>
