<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pendaftaran extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_lengkap',
        'email',
        'no_hp',
        'asal_sekolah',
        'pilihan_program_studi',
        'pesan',
        'dokumen',
        'status',
    ];

    public function getDokumenUrlAttribute(): ?string
    {
        if (! $this->dokumen) {
            return null;
        }

        if (str_starts_with($this->dokumen, 'http://') || str_starts_with($this->dokumen, 'https://')) {
            return $this->dokumen;
        }

        return Storage::disk('s3')->url($this->dokumen);
    }
}
