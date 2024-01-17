<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Universite extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * get the demande
     */
    public function etabByUniv(): HasMany
    {
        return $this->hasMany(Etablissement::class);
    }

    public function demandes(): HasMany
    {
        return $this->hasMany(Demande::class);
    }
}
