<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog_auths extends Model
{
   protected $fillable = [ 'name' ,'description' , 'image'];
}
