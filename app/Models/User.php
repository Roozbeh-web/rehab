<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'type',
        'phone',
        'identity_code',
        'email',
        'password',
        'city',
        'province',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function documents(){
        return $this->hasMany(Document::class, 'user_id', 'id');
    }

    public function posts(){
        return $this->hasMany(Post::class, 'user_id', 'id')->latest('id');
    }

    public function leaders(){
        return $this->hasMany(Request::class, 'helpseeker_id', 'id');
    }

    public function helpseekers(){
        return $this->hasMany(Request::class, 'leader_id', 'id');
    }

    public function drugs(){
        return $this->hasMany(UserDrug::class, 'user_id', 'id');
    }

    public function sentMessages($id){
        return $this->hasMany(Message::class, 'user_id', 'id')->where('messaged_user_id', $id);
    }

    public function reciveMessages($id){
        return $this->hasMany(Message::class, 'messaged_user_id', 'id')->where('user_id', $id);
    }

    public function unreadMessages($senderId = null){
        $unreads = $this->hasMany(Message::class, 'messaged_user_id', 'id')->where('is_read', false);
        if($senderId){
            $unreads = $unreads->where('user_id', $senderId);
        }

        return $unreads;
    }
}
