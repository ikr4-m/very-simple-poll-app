<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollChoice extends Model
{
    use HasFactory;
    protected $fillable = ['poll_description_id', 'poll_choice_name'];
}
