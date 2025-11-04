<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loket extends Model
{
    use HasFactory;

    // Allowed mass assignment fields
    // name: nama loket (e.g. Umum, Poli Gigi, Farmasi)
    // type: tipe/kode loket untuk prefix nomor antrian (e.g. A, B, C)
    protected $fillable = [
        'name',
        'type',
        'description',
    ];

    // Relationship: satu loket memiliki banyak antrian
    public function antrians()
    {
        return $this->hasMany(Antrian::class);
    }
}
