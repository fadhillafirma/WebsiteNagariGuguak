<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isSuperadmin()
    {
        return $this->role === 'superadmin';
    }

    public function isLembagaAdmin()
    {
        return $this->role === 'admin_lembaga';
    }

    // Relasi ke semua tabel
    public function publikasi()
    {
        return $this->hasMany(Publikasi::class);
    }

    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }

    public function jorong()
    {
        return $this->hasMany(Jorong::class);
    }

    public function demografiPekerjaan()
    {
        return $this->hasMany(DemografiPekerjaan::class);
    }

    public function demografiSekolah()
    {
        return $this->hasMany(DemografiSekolah::class);
    }

    public function demografiPendudukJorong()
    {
        return $this->hasMany(DemografiPendudukJorong::class);
    }

    public function lahanJenis()
    {
        return $this->hasMany(LahanJenis::class);
    }

    public function lembagas()
    {
        return $this->hasMany(Lembaga::class);
    }

    public function kalenders()
    {
        return $this->hasMany(Kalender::class);
    }
    public function potensis()
    {
        return $this->hasMany(Potensi::class);
    }


}
