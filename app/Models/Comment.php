<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'visible',
    ];

    protected $casts = [
        'visible' => 'boolean'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getComments(String $search = '')
    {
        $comments = $this->where(function ($query) use ($search){
            if($search){
                $query->where('body', 'LIKE', "%{$search}%");
                // $query->orWhere('name', 'LIKE', "%{$search}%");
            }
        })->get();

        return $comments;
    }

}
