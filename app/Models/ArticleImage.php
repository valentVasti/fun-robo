<?php

namespace App\Models;

use App\Traits\ChangeLoggingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model
{
    use HasFactory, ChangeLoggingTrait;

    protected $table = "article_image";

    protected $primaryKey = "id";

    protected $fillable = [
        'id_artikel',
        'num',
        'path',
        'caption',
        'image_desc'
    ];
}
