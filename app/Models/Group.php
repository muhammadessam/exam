<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];

    protected $with = ['questions', 'audio', 'description'];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'group_id', 'id');
    }

    public function audio()
    {
        return $this->hasOne(Audio::class, 'group_id', 'id');
    }

    public function description()
    {
        return $this->hasOne(Description::class, 'group_id', 'id');
    }
}
