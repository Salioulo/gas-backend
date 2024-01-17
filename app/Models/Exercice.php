<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exercice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function demandes(): HasMany
    {
        return $this->hasMany(Demande::class);
    }

}
