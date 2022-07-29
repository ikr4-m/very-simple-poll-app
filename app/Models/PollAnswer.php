<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'poll_description_id', 'poll_choice_id'];

    public function PollChoices()
    {
        return $this->belongsTo(PollChoice::class, 'poll_choice_id');
    }
}
