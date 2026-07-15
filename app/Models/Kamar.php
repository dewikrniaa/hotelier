<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kamar';

    public $incrementing = false;

    protected $keyType = 'string';

    public function checkin()
    {
        return $this->hasMany(Checkin::class, 'id_kamar', 'id_kamar');
    }
}
