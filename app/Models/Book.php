<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = ['title', 'author', 'is_available'];

    /**
     * Relationship with Borrow.
     * A book can have multiple borrow records.
     */
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}
