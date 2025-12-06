<?php

namespace App\Models;

use App\Traits\ChangeLoggingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsData extends Model
{
    use HasFactory, ChangeLoggingTrait;

    protected $table = "about_us_data";

    protected $primaryKey = "id";

    protected $fillable = [
        'type',
        'content',
    ];
}
