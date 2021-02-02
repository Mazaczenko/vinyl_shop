<?php

namespace App\Models;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Record extends Model
{
    use HasFactory;

    public function genre()
    {
        return $this->belongsTo(Genre::class)->withDefault();   // a record belongs to a genre
    }
}
