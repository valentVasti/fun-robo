<?php

namespace App\Models;

use App\Traits\ChangeLoggingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory, ChangeLoggingTrait;

    protected $table = "testimoni";

    protected $primaryKey = "id";

    protected $fillable = [
        'gambar_testimoni',
        'gambar_testimoni_desc',
        'nama_testimoni',
        'keterangan_testimoni',
        'umur_testimoni',
        'isi_testimoni'
    ];
}
