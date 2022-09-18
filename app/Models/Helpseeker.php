<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Helpseeker extends Model
{
    use HasFactory;

    protected $fillable = [
        'leader_id',
        'helpseeker_id',
    ];
}
