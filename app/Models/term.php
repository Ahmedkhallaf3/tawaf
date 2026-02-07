<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class term extends Model
{
    use HasFactory;
    public $timestamps = true;

protected $fillable = ['title1_ar','title1_en','title2_ar','title2_en','title3_ar','title3_en',
'title4_ar','title4_en','description1_ar','description1_en','description2_ar','description2_en',
'description3_ar','description3_en','description4_ar','description4_en','phonenumber','email'];
}
