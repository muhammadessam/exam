<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function groups()
    {
        return $this->hasMany(Group::class, 'section_id', 'id');
    }
}
