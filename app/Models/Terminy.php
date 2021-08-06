<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terminy extends Model
{
    use HasFactory;

    protected $table = 'terminy';
    public $timestamps = false;

    protected $fillable = [
        'data',
        'godzina',
        'status',
        'lekarze_id'
    ];

    public function lekarze()
    {
        return $this->belongsTo(Lekarze::class);
    }

    public function rezerwacje()
    {
        return $this->hasOne(Rezerwacje::class, 'terminy_id');
    }
}
