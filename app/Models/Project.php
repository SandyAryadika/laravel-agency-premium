<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // <--- PENTING: Import ini

class Project extends Model
{
    use HasFactory, SoftDeletes, HasUuids; // <--- PENTING: Tambahkan HasUuids disini

    // Karena Anda pakai UUID, pastikan $keyType didefinisikan (opsional di Laravel baru, tapi good practice)
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'client_id', // Pastikan kolom ini ada di migration jika dipakai
        'name',
        'description',
        'status',
        'start_date',
        'due_date',
        'budget',
        'meta_data',
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
        'meta_data' => 'array',
        'budget' => 'decimal:2',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Client (Jika ada)
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relasi ke Tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
