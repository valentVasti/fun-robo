<?php

namespace App\Models;

use App\Traits\ChangeLoggingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory, ChangeLoggingTrait;

    protected $table = "curriculum";

    protected $primaryKey = "id";

    protected $fillable = [
        'curriculum_name',
        'price',
        'duration',  
        'description',
        'details',
        'age_min',
        'age_max',
        'image_path',
        'image_description'
    ];


}
