<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function groups()
    {
        return $this->hasMany(Group::class, 'section_id', 'id');
    }

    public static function readingSection()
    {
        return Section::where('name', 'Reading')->first();
    }

    public static function listeningSection(){
        return Section::where('name', 'Listening')->first();
    }
    public static function lsSection(){
        return Section::where('name', 'Language System')->first();
    }
}
