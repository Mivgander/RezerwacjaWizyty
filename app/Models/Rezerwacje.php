<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rezerwacje extends Model
{
    use HasFactory;

    protected $table = 'rezerwacje';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'powod_rezerwacji',
        'terminy_id'
    ];

    public function terminy()
    {
        return $this->belongsTo(Terminy::class);
    }
}
