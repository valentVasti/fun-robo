<?php

namespace App\Models;

use App\Traits\ChangeLoggingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, ChangeLoggingTrait;

    protected $table = "article";

    protected $primaryKey = "id";

    protected $fillable = [
        'penulis',
        'judul',
        'isi',
        'thumbnail',
        'thumbnail_desc',
        'thumbnail_caption',
        'highlighted'  
    ];

    public function ArticleTags() {
        return $this->hasMany(ArticleTag::class, 'id');
    }

    public function Tags() {
        return $this->belongsToMany(Tag::class, 'article_tag', 'id', 'id');
    }
        
}
