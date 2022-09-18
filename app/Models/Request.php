<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    public $fillable = [
        'leader_id',
        'helpseeker_id',
        'status',
    ];

    public function helpseeker(){
        return $this->hasOne(User::class, 'id', 'helpseeker_id');
    }

    public function leader(){
        return $this->hasOne(User::class, 'id', 'leader_id');
    }
}
