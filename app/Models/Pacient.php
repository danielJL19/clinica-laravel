<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pacient extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name','age','phone'];
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
