<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SiteContentController extends Controller
{
    /**
     * Config for all static pages managed from admin.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function sections(): array
    {
        return [
            'tentang-profil-program-studi' => [
                'title' => 'Profil Program Studi',
                'key' => 'tentang_profil_program_studi',
                'allow_body' => true,
                'rich_text' => true,
                'allow_image' => false,
                'allow_file' => false,
                'file_mimes' => '',
            ],
            'tentang-visi-misi' => [
                'title' => 'Visi Misi',
                'key' => 'tentang_visi_misi',
                'allow_body' => true,
                'rich_text' => true,
                'allow_image' => false,
                'allow_file' => false,
                'file_mimes' => '',
            ],
            'tentang-profil-lulusan' => [
                'title' => 'Profil Lulusan',
                'key' => 'tentang_profil_lulusan',
                'allow_body' => true,
                'rich_text' => true,
                'allow_image' => false,
                'allow_file' => false,
                'file_mimes' => '',
            ],
            'tentang-profesi-profil-lulusan' => [
                'title' => 'Profesi Profil Lulusan',
                'key' => 'tentang_profesi_profil_lulusan',
                'allow_body' => true,
                'rich_text' => true,
                'allow_image' => false,
                'allow_file' => false,
                'file_mimes' => '',
            ],
            'tentang-struktur-organisasi' => [
                'title' => 'Struktur Organisasi',
                'key' => 'tentang_struktur_organisasi',
                'allow_body' => false,
                'allow_image' => true,
                'allow_file' => false,
                'file_mimes' => '',
            ],
            'kurikulum-rps' => [
                'title' => 'RPS',
                'key' => 'kurikulum_rps',
                'allow_body' => true,
                'allow_image' => false,
                'allow_file' => true,
                'file_mimes' => 'pdf,doc,docx',
            ],
            'kurikulum-jadwal-kuliah' => [
                'title' => 'Jadwal Kuliah',
                'key' => 'kurikulum_jadwal_kuliah',
                'allow_body' => true,
                'allow_image' => false,
                'allow_file' => true,
                'file_mimes' => 'pdf',
            ],
            'fasilitas-lab-pemrograman' => [
                'title' => 'Lab Pemrograman',
                'key' => 'fasilitas_lab_pemrograman',
                'allow_body' => true,
                'allow_image' => true,
                'allow_file' => false,
                'file_mimes' => '',
            ],
            'fasilitas-lab-jaringan-komputer' => [
                'title' => 'Lab Jaringan Komputer',
                'key' => 'fasilitas_lab_jaringan_komputer',
                'allow_body' => true,
                'allow_image' => true,
                'allow_file' => false,
                'file_mimes' => '',
            ],
            'fasilitas-ruang-kelas' => [
                'title' => 'Ruang Kelas',
                'key' => 'fasilitas_ruang_kelas',
                'allow_body' => true,
                'allow_image' => true,
                'allow_file' => false,
                'file_mimes' => '',
            ],
            'fasilitas-perpustakaan' => [
                'title' => 'Perpustakaan',
                'key' => 'fasilitas_perpustakaan',
                'allow_body' => true,
                'allow_image' => true,
                'allow_file' => false,
                'file_mimes' => '',
            ],
            'fasilitas-coding-learn' => [
                'title' => 'Coding Learn',
                'key' => 'fasilitas_coding_learn',
                'allow_body' => true,
                'allow_image' => true,
                'allow_file' => false,
                'file_mimes' => '',
            ],
            'hmps-profil' => [
                'title' => 'Profil HMPS',
                'key' => 'hmps_profil',
                'allow_body' => true,
                'allow_image' => false,
                'allow_file' => false,
                'file_mimes' => '',
            ],
            'hmps-struktur-organisasi' => [
                'title' => 'Struktur Organisasi HMPS',
                'key' => 'hmps_struktur_organisasi',
                'allow_body' => false,
                'allow_image' => true,
                'allow_file' => false,
                'file_mimes' => '',
            ],
            'hmps-program-kerja' => [
                'title' => 'Program Kerja HMPS',
                'key' => 'hmps_program_kerja',
                'allow_body' => true,
                'allow_image' => false,
                'allow_file' => false,
                'file_mimes' => '',
            ],
            'hmps-kegiatan' => [
                'title' => 'Kegiatan HMPS',
                'key' => 'hmps_kegiatan',
                'allow_body' => true,
                'allow_image' => true,
                'allow_file' => false,
                'file_mimes' => '',
            ],
            'hmps-rekruitment' => [
                'title' => 'Rekruitment HMPS',
                'key' => 'hmps_rekruitment',
                'allow_body' => true,
                'allow_image' => true,
                'allow_file' => false,
                'file_mimes' => '',
            ],
            'pendaftaran-banner' => [
                'title' => 'Banner Pendaftaran',
                'key' => 'pendaftaran_banner',
                'allow_body' => false,
                'allow_image' => true,
                'allow_file' => false,
                'file_mimes' => '',
            ],
        ];
    }

    public function edit(string $section): View
    {
        $this->ensureTableExists();
        $config = $this->getSectionConfig($section);

        $content = SiteContent::firstOrCreate(
            ['key' => $config['key']],
            [
                'title' => $config['title'],
                'body' => null,
                'image_path' => null,
                'file_path' => null,
            ]
        );

        return view('admin.site-content.edit', compact('content', 'config', 'section'));
    }

    public function update(Request $request, string $section): RedirectResponse
    {
        $this->ensureTableExists();
        $config = $this->getSectionConfig($section);
        $content = SiteContent::firstOrCreate(
            ['key' => $config['key']],
            [
                'title' => $config['title'],
                'body' => null,
                'image_path' => null,
                'file_path' => null,
            ]
        );

        $rules = [
            'title' => ['required', 'string', 'max:255'],
        ];

        if ($config['allow_body']) {
            $rules['body'] = ['nullable', 'string'];
        }

        if ($config['allow_image']) {
            $rules['image_path'] = ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'];
        }

        if ($config['allow_file']) {
            $rules['file_path'] = ['nullable', 'file', 'mimes:'.$config['file_mimes'], 'max:10240'];
        }

        $validated = $request->validate($rules);

        $payload = [
            'title' => $validated['title'],
        ];

        if ($config['allow_body']) {
            $payload['body'] = $this->sanitizeBody(
                $validated['body'] ?? null,
                (bool) ($config['rich_text'] ?? false)
            );
        }

        if ($config['allow_image'] && $request->hasFile('image_path')) {
            if ($content->image_path && Storage::disk('s3')->exists($content->image_path)) {
                Storage::disk('s3')->delete($content->image_path);
            }

            $payload['image_path'] = $request->file('image_path')->store('site-contents/images', 's3');
        }

        if ($config['allow_file'] && $request->hasFile('file_path')) {
            if ($content->file_path && Storage::disk('s3')->exists($content->file_path)) {
                Storage::disk('s3')->delete($content->file_path);
            }

            $payload['file_path'] = $request->file('file_path')->store('site-contents/files', 's3');
        }

        $content->update($payload);

        return redirect()->route('admin.site-content.edit', $section)->with('success', 'Konten berhasil diperbarui.');
    }

    /**
     * @return array<string, mixed>
     */
    private function getSectionConfig(string $section): array
    {
        $config = static::sections()[$section] ?? null;

        abort_unless($config, 404);

        return $config;
    }

    private function ensureTableExists(): void
    {
        abort_unless(
            Schema::hasTable('site_contents'),
            500,
            'Tabel site_contents belum tersedia. Jalankan migration terlebih dahulu.'
        );
    }

    private function sanitizeBody(?string $body, bool $allowRichText): ?string
    {
        if ($body === null) {
            return null;
        }

        if (! $allowRichText) {
            $plain = trim(strip_tags($body));

            return $plain !== '' ? nl2br(e($plain)) : null;
        }

        // Rich text content is edited only by authenticated admin.
        // Keep formatting tags/attributes, but strip dangerous scripts and JS handlers.
        $clean = trim($body);
        $clean = preg_replace('#<script\b[^>]*>(.*?)</script>#is', '', $clean) ?? $clean;
        $clean = preg_replace('#<style\b[^>]*>(.*?)</style>#is', '', $clean) ?? $clean;
        $clean = preg_replace('/\s+on\w+\s*=\s*(".*?"|\'.*?\'|[^\s>]+)/i', '', $clean) ?? $clean;
        $clean = preg_replace('/href\s*=\s*"javascript:[^"]*"/i', 'href="#"', $clean) ?? $clean;
        $clean = preg_replace('/href\s*=\s*\'javascript:[^\']*\'/i', "href='#'", $clean) ?? $clean;

        return trim($clean) !== '' ? $clean : null;
    }
}
