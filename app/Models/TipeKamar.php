<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    use HasFactory;

    protected $table = 'tipe_kamar';

    public $timestamps = false;

    public function kamar()
    {
        return $this->hasMany(Kamar::class, 'tipe_kamar_id');
    }
}
