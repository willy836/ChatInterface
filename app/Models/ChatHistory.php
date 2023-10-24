<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    use HasFactory;

    protected $fillable = ['user', 'message', 'typing'];
    
    public function scopeFilter($query){
        if(request('search')){
            $query->where('message', 'LIKE', '%' . request('search') . '%');
        }
    }
}
