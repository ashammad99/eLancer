<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        ''
    ];

    //to make this model not support create at and updated at
    public $timestamps = false;

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
