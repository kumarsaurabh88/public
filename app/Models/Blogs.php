<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    // protected $guarded = [];
    // use HasFactory;

    protected $fillable = [
        'Title','Slug', 'Category_id', 'Author_id', 'Tag_id', 'Description', 'Description2', 'Featured_Image', 'Banner_Image'
    ];

    // Other model methods...
}
