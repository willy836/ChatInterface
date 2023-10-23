<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatGeneratorRequest;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function chatGenerator(ChatGeneratorRequest $request){
        $validatedUserInput = $request->validated();

        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Write a chat reply about" . $validatedUserInput['chat'] . "\n",
            'max_tokens' => 500,
        ]);

        return view('dashboard', ['result' => $result['choices'][0]['text']]);
    }
}
