<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Author extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = ['id'];

    public function books()
    {
        return $this->hasMany(Book::class, 'author_id', 'id');
    }
}
