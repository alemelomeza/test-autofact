<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the role thas owns the user
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the quizes thas owns the user
     */
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    /**
     * Get the quiz thas owns the user for the current month
     */
    public function getQuizMonthly()
    {
        $quiz = DB::table('quizzes')
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->whereUserId($this->id)
                    ->orderBy('created_at', 'desc')
                    ->first();

        return $quiz;
    }

    public function isAdmin()
    {
        return $this->role_id == 1;
    }
}
