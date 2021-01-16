<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    public function genre() 
    {
        return $this->belongsTo(Genre::class)->withDefault();   // a record belongs to a genre
    }
}
