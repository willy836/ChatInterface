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
                <form action="{{ route('searchHistory') }}" method="GET">
                    <input type="text" name="search" placeholder="Search...">
                </form>
                <ul class="list-none">
                    @if (count($chatHistory ?? []) > 0)   
                        @foreach ($chatHistory as $chat) 
                            <li class="bg-gray-700 text-gray-900 dark:text-gray-100 p-2 mb-1 history" data-full-history="{{ $chat->user_input }} {{ $chat->ai_response }}">{{ Str::limit($chat->user_input, 20) }}</li>  
                        @endforeach
                    @else
                        <li class="bg-gray-700 text-gray-900 dark:text-gray-100 p-2">No history</li>
                    @endif
                </ul>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-5/6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div style="min-height: 60vh;" class="relative">
                        <div>
                            {{-- @if (count($chatHistory) > 0 && $latestChat->user == 1 && $latestChat->typing == 1)
                              <p class="italic">Typing...</p>  
                            @endif --}}
                            <div id="result" class="flex-grow">{{ $result ?? '' }}</div>
                            
                        </div>  
                        <div class="absolute bottom-0 w-full flex">
                            <form  action="{{ route('chatGenerator') }}" method="POST" class="w-5/6 flex gap-1">
                                @csrf
                                <div class="mb-3 w-3/4">
                                    <input class="text-black w-full py-2.5 px-2" type="text" name="chat">
                                </div>
                                <select name="personality" id="" class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 h-11">
                                    <option value="Formal" {{ old('personality') === 'Formal' ? 'selected' : '' }}>Formal</option>
                                    <option value="Friendly" {{ old('personality') === 'Friendly' ? 'selected' : '' }}>Friendly</option>
                                    <option value="Humorous" {{ old('personality') === 'Humorous' ? 'selected' : '' }}>Humorous</option>
                                </select>
                                <div>
                                    <button width="100" class="bg-indigo-800 rounded py-2.5 px-5" type="submit">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', ()=> {
            const histories = document.querySelectorAll('.history');
            histories.forEach((history)=> {
                history.addEventListener('click', ()=> {
                    const fullHistory = history.getAttribute('data-full-history');
                    const result = document.getElementById('result')
                    result.innerText = fullHistory
                })
            })
        })
    </script>
</x-app-layout>
