<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'idea',
        'status',
        'user_id',
        // Contraseña en texto plano, vida corta: se guarda en createUserAndProject()
        // para sobrevivir al cierre del modal, y se borra en approve() tras enviar el email.
        'temp_plain_password',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
