<?php

namespace App\Models;

use App\Traits\ChangeLoggingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    use HasFactory, ChangeLoggingTrait;

    protected $table = "article_tag";

    protected $primaryKey = "id";

    protected $fillable = [
        'id_article',
        'id_tag'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class, 'id_article', 'id');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'id_tag', 'id');
    }

}
