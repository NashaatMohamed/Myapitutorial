<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    protected $table = 'catagorys';
    protected $fillable =['name_en','name_ar','active','create_at','update_at'];
}
