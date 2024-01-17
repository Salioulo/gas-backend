<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pays extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * get the demande
     */
    public function demandesPays(): HasMany
    {
        return $this->hasMany(Demande::class);
    }
}
