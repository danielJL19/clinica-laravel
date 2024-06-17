<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    protected $fillable = ['id','title', 'start_time','description','pacient_id','date_start','price'];
    use HasFactory;

    public function pacient(): BelongsTo
    {
        return $this->belongsTo(Pacient::class);
    }

}
