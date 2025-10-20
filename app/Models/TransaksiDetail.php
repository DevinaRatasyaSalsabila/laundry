<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $table = 'tb_detailtransaksi';
    protected $primaryKey = 'id_detail';
    protected $guarded = [];
    public $timestamps = true;
}
