<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $fillable = ['description', 'group_id'];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
