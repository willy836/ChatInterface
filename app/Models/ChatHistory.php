<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    use HasFactory;

    protected $fillable = ['user_input', 'user_id', 'ai_response', 'typing'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function scopeFilter($query){
        if(request('search')){
            $query->where('user_input', 'LIKE', '%' . request('search') . '%');
        }
    }
}
