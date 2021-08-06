<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lekarze extends Model
{
    use HasFactory;

    protected $table = 'lekarze';
    public $timestamps = false;

    protected $fillable = [
        'imie',
        'nazwisko'
    ];

    public function terminy()
    {
        return $this->hasMany(Terminy::class, 'lekarze_id');
    }
}
