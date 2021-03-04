<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quiz extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['suggestion', 'right', 'speed', 'user_id'];

    /**
     * Get the user thas owns the quiz
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getRightYes()
    {
        return DB::table('quizzes')->whereRight('yes')->count();
    }

    public static function getRightNo()
    {
        return DB::table('quizzes')->whereRight('no')->count();
    }

    public static function getRightMoreOrLess()
    {
        return DB::table('quizzes')->whereRight('more_or_less')->count();
    }
}
