<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialite extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

     /**
     * @return BelongsTo
     */
    public function etablissements(): BelongsTo
    {
        return $this->BelongsTo(Etablissement::class);
    }

    /**
     * get the demanSpe
     */
    public function demandeSpecialite(): HasMany
    {
        return $this->hasMany(Demande::class);
    }
    /**
     * get the demandeNiveau
     */
    public function demandeNiveau(): HasMany
    {
        return $this->hasMany(Demande::class);
    }
}
