<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_name',
        'sender_email',
        'sender_phone',
        'sender_project',
        'sender_subject',
        'sender_message',
    ];
}
