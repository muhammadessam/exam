<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function groups()
    {
        return $this->hasMany(Group::class, 'section_id', 'id');
    }

    public static function Reading()
    {
        return Section::where('name', 'Reading')->first();
    }

    public static function Listening()
    {
        return Section::where('name', 'Listening')->first();
    }

    public static function LS()
    {
        return Section::where('name', 'Language System')->first();
    }
}
