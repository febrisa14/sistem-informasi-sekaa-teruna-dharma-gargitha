<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Baju extends Model
{
    use HasFactory;

    protected $table = 'baju';

    protected $primaryKey = 'baju_id';

    public $incrementing = false;

    protected $fillable = [
        'baju_id','nama_baju', 'harga', 'deskripsi', 'foto_baju','tgl_batas_order'
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
