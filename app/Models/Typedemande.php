<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Typedemande extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * get demandes of typedemande
     */

    public function demandesType(): HasMany
    {
        return $this->hasMany(Demande::class);
    }
}
