<?php

namespace App\Models;

use App\Traits\ChangeLoggingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardsImage extends Model
{
    use HasFactory, ChangeLoggingTrait;

    protected $table = "awards_images";

    protected $primaryKey = "id";

    protected $fillable = [
        'id_awards',
        'path',
        'image_desc'  
    ];
}
