<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollDescription extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'poll_name'];

    public function PollChoices()
    {
        return $this->hasMany(PollChoice::class);
    }

    public static function deleteData(int $id)
    {
        // Delete answer
        PollAnswer::where('poll_description_id', $id)->delete();

        // Delete choice
        PollChoice::where('poll_description_id', $id)->delete();

        // Delete description
        self::where('id', $id)->delete();

    }
}
