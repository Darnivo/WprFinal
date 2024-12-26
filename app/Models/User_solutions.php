<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\User;

class User_solutions extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_id',
        'part1_correct',
        'part2_correct'
    ];

    protected $casts = [
        'part1_correct' => 'boolean',
        'part2_correct' => 'boolean'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}