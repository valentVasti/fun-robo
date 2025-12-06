<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeLogs extends Model
{
    protected $table = "change_logs";

    protected $primaryKey = "id";

    protected $fillable = [
        'table_name',
        'action',
        'old_data',  
        'new_data',
        'user_id',
        'color'
    ];
}
