<?php

namespace App\Models;

use App\Traits\ChangeLoggingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, ChangeLoggingTrait;

    protected $table = "tag";

    protected $primaryKey = "id";

    protected $fillable = [
        'tag_name'
    ];

    public function ArticleTags() {
        return $this->hasMany(ArticleTag::class, 'id');
    }

    public function tableAs() {
        return $this->belongsToMany(Article::class, 'article_tag', 'id', 'id');
    }
    
}
