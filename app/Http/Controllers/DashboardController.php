<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatGeneratorRequest;
use App\Models\ChatHistory;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function chatGenerator(ChatGeneratorRequest $request){
        $validatedUserInput = $request->validated();

        // Save user input to db
        ChatHistory::create([
            'user' => true,
            'message' => substr($validatedUserInput['chat'], 0, 20)
        ]);

        // Response generated by AI
        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Write a chat reply about" . $validatedUserInput['chat'] . "\n",
            'max_tokens' => 500,
        ]);

        // Save AI response to db
        ChatHistory::create([
            'user' => false,
            'message' => $result['choices'][0]['text']
        ]);

        // Retrieve chat history from db
        $chatHistory = ChatHistory::all();

        return view('dashboard', ['result' => $result['choices'][0]['text'], 'chatHistory' => $chatHistory]);
    }
}
