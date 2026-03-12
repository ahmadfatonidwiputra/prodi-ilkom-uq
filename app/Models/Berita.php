<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar',
    ];

    public function getGambarUrlAttribute(): ?string
    {
        if (! $this->gambar) {
            return null;
        }

        if (str_starts_with($this->gambar, 'http://') || str_starts_with($this->gambar, 'https://')) {
            return $this->gambar;
        }

        return Storage::disk('s3')->url($this->gambar);
    }

    protected static function booted(): void
    {
        static::creating(function (Berita $berita) {
            $berita->slug = static::generateUniqueSlug($berita->judul);
        });

        static::updating(function (Berita $berita) {
            if ($berita->isDirty('judul')) {
                $berita->slug = static::generateUniqueSlug($berita->judul, $berita->id);
            }
        });
    }

    private static function generateUniqueSlug(string $judul, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($judul);
        $baseSlug = $baseSlug !== '' ? $baseSlug : 'berita';
        $slug = $baseSlug;
        $counter = 1;

        while (static::query()
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()
        ) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
