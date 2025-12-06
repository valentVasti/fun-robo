<?php

namespace App\Models;

use App\Traits\ChangeLoggingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory,ChangeLoggingTrait;

    protected $table = "branch";

    protected $primaryKey = "id";

    protected $fillable = [
        'nama_branch',
        'alamat',
        'kota',  
        'provinsi',
        'gambar_branch',
        'gambar_branch_desc',
        'phone_num',
        'instagram',
        'link_instagram',
        'facebook',
        'link_facebook',
        'link_gmaps',
        'email'
    ];
}
