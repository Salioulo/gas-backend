<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Etablissement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function universite(): BelongsTo
    {
        return $this->BelongsTo(Universite::class);
    }

      /**
     * get the demande
     */
    public function specialites(): HasMany
    {
        return $this->hasMany(Specialite::class);
    }

    /**
     * get the demande
     */
    public function demandes(): HasMany
    {
        return $this->hasMany(Demande::class);
    }

    /**
     * @return BelongsTo
     */
    public function specialite(): BelongsTo
    {
        return $this->BelongsTo(Specialite::class);
    }
}
