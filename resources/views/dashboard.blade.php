<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div style="min-height: 60vh;" class="p-6 text-gray-900 dark:text-gray-100 relative">
                    <div class="flex-grow"></div>
                    <div class="absolute bottom-0 w-full">
                        <form action="#" method="POST" class="flex gap-1">
                            @csrf
                            <div class="mb-3 w-5/6">
                                <input class="text-black w-full" type="text">
                            </div>
                            <div>
                                <button width="100" class="bg-indigo-800 rounded py-2 px-4" type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
