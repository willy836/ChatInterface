<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-2">
            <div style="max-height: 68vh; overflow-y: auto;" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-1/6">
                <div class="p-6 text-gray-900 dark:text-gray-100">Chat History</div>
                <ul class="list-none">
                    @foreach ($chatHistory as $chat)
                        @if ($chat['user'])   
                        <li class="bg-gray-700 text-gray-900 dark:text-gray-100 p-2 mb-1">{{ $chat['message'] }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-5/6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div style="min-height: 60vh;" class="relative">
                        @if (isset($result))
                        <div class="flex-grow">{{ $result }}</div>   
                        @endif
                        <div class="absolute bottom-0 w-full">
                            <form action="{{ route("chatGenerator") }}" method="POST" class="flex gap-1">
                                @csrf
                                <div class="mb-3 w-5/6">
                                    <input class="text-black w-full" type="text" name="chat">
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
    </div>
</x-app-layout>
