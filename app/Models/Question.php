<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User_solutions;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'Title', 'difficulty', 'markdown_file_path', 'input_file_path', 'part1_answer', 'part2_answer'
    ];


    protected $casts = [
        'id' => 'string',
    ];
    
    public function userSolutions()
    {
        return $this->hasMany(User_solutions::class, 'question_id');
    }
}
