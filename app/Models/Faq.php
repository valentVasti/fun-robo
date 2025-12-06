<?php

namespace App\Models;

use App\Traits\ChangeLoggingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory, ChangeLoggingTrait;

    protected $table = "faq";

    protected $primaryKey = "id";

    protected $fillable = [
        'question',
        'answer'
    ];
}
