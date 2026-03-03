<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pengumuman extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengumumans';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'tanggal',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Pengumuman $pengumuman) {
            $pengumuman->slug = static::generateUniqueSlug($pengumuman->judul);
        });

        static::updating(function (Pengumuman $pengumuman) {
            if ($pengumuman->isDirty('judul')) {
                $pengumuman->slug = static::generateUniqueSlug($pengumuman->judul, $pengumuman->id);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    private static function generateUniqueSlug(string $judul, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($judul);
        $baseSlug = $baseSlug !== '' ? $baseSlug : 'pengumuman';
        $slug = $baseSlug;
        $counter = 1;

        while (static::query()
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
