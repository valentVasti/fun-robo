<?php

namespace App\Models;

use App\Traits\ChangeLoggingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Awards extends Model
{
    use HasFactory, ChangeLoggingTrait;

    protected $table = "awards";

    protected $primaryKey = "id";

    protected $fillable = [
        'achievement',
        'event',
        'year',
        'place',
        'type'  
    ];

    public function img()
    {
        return $this->hasMany(AwardsImage::class, 'id_awards');
    }
}
