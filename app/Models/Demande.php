<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Demande extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function pays(): BelongsTo
    {
        return $this->BelongsTo(Pays::class);
    }

    /**
     * get typedemande of demande
     */
    public function typedemande(): BelongsTo
    {
        return $this->BelongsTo(Typedemande::class);
    }


    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    /**
     * @return BelongsTo
     */
    public function universites(): BelongsTo
    {
        return $this->BelongsTo(Universite::class);
    }

    /**
     * @return BelongsTo
     */
    public function exercices(): BelongsTo
    {
        return $this->BelongsTo(Exercice::class);
    }

    /**
     * @return BelongsTo
     */
    public function etablissements(): BelongsTo
    {
        return $this->BelongsTo(Etablissement::class);
    }

    /**
     * @return BelongsTo
     */
    public function specialite(): BelongsTo
    {
        return $this->BelongsTo(Specialite::class);
    }
    /**
     * @return BelongsTo
     */
    public function niveau(): BelongsTo
    {
        return $this->BelongsTo(Niveau::class);
    }
}
