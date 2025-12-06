<?php

namespace App\Models;

use App\Traits\ChangeLoggingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory, ChangeLoggingTrait;

    protected $table = "benefit";

    protected $primaryKey = "id";

    protected $fillable = [
        'benefit',
        'mascot_path',
    ];
}
