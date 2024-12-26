<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{

    protected $fillable = ['user_id', 'book_id', 'borrowed_at', 'returned_at'];
    protected $casts = [
        'borrowed_at' => 'datetime',
        'returned_at' => 'datetime',
    ];
    /**
     * Relationship with Book.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Relationship with User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
