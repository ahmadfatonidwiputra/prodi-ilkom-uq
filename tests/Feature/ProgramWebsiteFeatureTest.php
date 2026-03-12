<?php

namespace Tests\Feature;

use App\Http\Controllers\Admin\SiteContentController as AdminSiteContentController;
use App\Models\Dosen;
use App\Models\Kurikulum;
use App\Models\Pendaftaran;
use App\Models\PrestasiMahasiswa;
use App\Models\SiteContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProgramWebsiteFeatureTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('s3');

        $this->admin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@example.test',
        ]);
    }

    public function test_public_pages_can_be_rendered(): void
    {
        $pages = [
            '/',
            '/tentang-prodi/profil-program-studi',
            '/tentang-prodi/visi-misi',
            '/tentang-prodi/profil-lulusan',
            '/tentang-prodi/profesi-profil-lulusan',
            '/tentang-prodi/struktur-organisasi',
            '/kurikulum/matakuliah',
            '/kurikulum/rps',
            '/kurikulum/jadwal-kuliah',
            '/dosen',
            '/fasilitas/lab-pemrograman',
            '/fasilitas/lab-jaringan-komputer',
            '/fasilitas/ruang-kelas',
            '/fasilitas/perpustakaan',
            '/fasilitas/coding-learn',
            '/prestasi-mahasiswa',
            '/hmps/profil',
            '/hmps/struktur-organisasi',
            '/hmps/program-kerja',
            '/hmps/kegiatan',
            '/hmps/rekruitment',
            '/pendaftaran',
        ];

        foreach ($pages as $page) {
            $this->get($page)->assertOk();
        }
    }

    public function test_dashboard_route_requires_auth_and_loads_correctly(): void
    {
        $this->get('/admin/dashboard')->assertRedirect('/login');

        $this->actingAs($this->admin)
            ->get('/admin/dashboard')
            ->assertOk()
            ->assertSee('Ringkasan aktivitas website');
    }

    public function test_tentang_prodi_content_can_be_crud_and_displayed(): void
    {
        $textSections = [
            'tentang-profil-program-studi' => '/tentang-prodi/profil-program-studi',
            'tentang-visi-misi' => '/tentang-prodi/visi-misi',
            'tentang-profil-lulusan' => '/tentang-prodi/profil-lulusan',
            'tentang-profesi-profil-lulusan' => '/tentang-prodi/profesi-profil-lulusan',
        ];

        foreach ($textSections as $section => $publicUrl) {
            $this->updateSection($section, [
                'title' => 'Title '.$section,
                'body' => '<p>Konten '.$section.'</p>',
            ]);

            $sectionKey = AdminSiteContentController::sections()[$section]['key'];

            $this->assertDatabaseHas('site_contents', [
                'key' => $sectionKey,
                'title' => 'Title '.$section,
            ]);

            $this->get($publicUrl)->assertOk()->assertSee('Title '.$section);
        }

        $image = UploadedFile::fake()->image('struktur.jpg');

        $this->updateSection('tentang-struktur-organisasi', [
            'title' => 'Struktur Organisasi Prodi',
            'image_path' => $image,
        ]);

        $content = SiteContent::query()->where('key', 'tentang_struktur_organisasi')->firstOrFail();

        $this->assertNotNull($content->image_path);
        Storage::disk('s3')->assertExists($content->image_path);

        $this->get('/tentang-prodi/struktur-organisasi')
            ->assertOk()
            ->assertSee('Struktur Organisasi Prodi');
    }

    public function test_kurikulum_crud_and_document_upload_work(): void
    {
        $createResponse = $this->actingAs($this->admin)->post(route('admin.kurikulum.store'), [
            'kode_mk' => 'TRPL101',
            'nama_mk' => 'Pemrograman Web',
            'semester' => 3,
            'sks' => 3,
            'kategori' => 'Wajib',
            'deskripsi' => 'Mata kuliah web dasar',
        ]);

        $createResponse->assertRedirect(route('admin.kurikulum.index'));

        $kurikulum = Kurikulum::query()->where('kode_mk', 'TRPL101')->firstOrFail();

        $this->actingAs($this->admin)->put(route('admin.kurikulum.update', $kurikulum), [
            'kode_mk' => 'TRPL101',
            'nama_mk' => 'Pemrograman Web Lanjut',
            'semester' => 4,
            'sks' => 3,
            'kategori' => 'Wajib',
            'deskripsi' => 'Mata kuliah web lanjut',
        ])->assertRedirect(route('admin.kurikulum.index'));

        $this->assertDatabaseHas('kurikulums', [
            'id' => $kurikulum->id,
            'nama_mk' => 'Pemrograman Web Lanjut',
            'semester' => 4,
        ]);

        $rpsFile = UploadedFile::fake()->create('rps.pdf', 120, 'application/pdf');
        $jadwalFile = UploadedFile::fake()->create('jadwal.pdf', 120, 'application/pdf');

        $this->updateSection('kurikulum-rps', [
            'title' => 'RPS TRPL',
            'body' => 'Dokumen RPS terbaru',
            'file_path' => $rpsFile,
        ]);

        $this->updateSection('kurikulum-jadwal-kuliah', [
            'title' => 'Jadwal Kuliah TRPL',
            'body' => 'Dokumen jadwal terbaru',
            'file_path' => $jadwalFile,
        ]);

        $rpsContent = SiteContent::query()->where('key', 'kurikulum_rps')->firstOrFail();
        $jadwalContent = SiteContent::query()->where('key', 'kurikulum_jadwal_kuliah')->firstOrFail();

        Storage::disk('s3')->assertExists($rpsContent->file_path);
        Storage::disk('s3')->assertExists($jadwalContent->file_path);

        $this->get('/kurikulum/rps')->assertOk()->assertSee('Unduh Dokumen');
        $this->get('/kurikulum/jadwal-kuliah')->assertOk()->assertSee('Unduh Dokumen');

        $this->actingAs($this->admin)->delete(route('admin.kurikulum.destroy', $kurikulum))
            ->assertRedirect(route('admin.kurikulum.index'));

        $this->assertDatabaseMissing('kurikulums', ['id' => $kurikulum->id]);
    }

    public function test_dosen_crud_with_photo_and_public_display(): void
    {
        $foto = UploadedFile::fake()->image('dosen.jpg');

        $this->actingAs($this->admin)->post(route('admin.dosen.store'), [
            'nama' => 'Dr. Ahmad',
            'nidn' => '0123456789',
            'jabatan' => 'Dosen Tetap',
            'jabatan_fungsional' => 'Lektor',
            'bidang_keahlian' => 'Web Engineering',
            'foto' => $foto,
        ])->assertRedirect(route('admin.dosen.index'));

        $dosen = Dosen::query()->where('nidn', '0123456789')->firstOrFail();

        Storage::disk('s3')->assertExists($dosen->foto);

        $this->get('/dosen')->assertOk()->assertSee('Dr. Ahmad')->assertSee('Web Engineering');

        $this->actingAs($this->admin)->put(route('admin.dosen.update', $dosen), [
            'nama' => 'Dr. Ahmad Updated',
            'nidn' => '0123456789',
            'jabatan' => 'Koordinator',
            'jabatan_fungsional' => 'Lektor Kepala',
            'bidang_keahlian' => 'Cloud Computing',
        ])->assertRedirect(route('admin.dosen.index'));

        $this->assertDatabaseHas('dosens', [
            'id' => $dosen->id,
            'nama' => 'Dr. Ahmad Updated',
            'bidang_keahlian' => 'Cloud Computing',
        ]);

        $this->actingAs($this->admin)->delete(route('admin.dosen.destroy', $dosen))
            ->assertRedirect(route('admin.dosen.index'));

        $this->assertDatabaseMissing('dosens', ['id' => $dosen->id]);
    }

    public function test_fasilitas_sections_can_upload_image_and_display(): void
    {
        $sections = [
            'fasilitas-lab-pemrograman' => '/fasilitas/lab-pemrograman',
            'fasilitas-lab-jaringan-komputer' => '/fasilitas/lab-jaringan-komputer',
            'fasilitas-ruang-kelas' => '/fasilitas/ruang-kelas',
            'fasilitas-perpustakaan' => '/fasilitas/perpustakaan',
            'fasilitas-coding-learn' => '/fasilitas/coding-learn',
        ];

        foreach ($sections as $section => $publicUrl) {
            $this->updateSection($section, [
                'title' => 'Fasilitas '.$section,
                'body' => 'Deskripsi fasilitas '.$section,
                'image_path' => UploadedFile::fake()->image($section.'.jpg'),
            ]);

            $content = SiteContent::query()->where('key', AdminSiteContentController::sections()[$section]['key'])->firstOrFail();
            Storage::disk('s3')->assertExists($content->image_path);

            $this->get($publicUrl)->assertOk()->assertSee('Fasilitas '.$section);
        }
    }

    public function test_prestasi_mahasiswa_crud_with_image_and_public_display(): void
    {
        $this->actingAs($this->admin)->post(route('admin.prestasi.store'), [
            'judul_prestasi' => 'Juara 1 Hackathon',
            'nama_mahasiswa' => 'Nadia',
            'tahun' => date('Y'),
            'deskripsi' => 'Kompetisi tingkat nasional',
            'gambar' => UploadedFile::fake()->image('prestasi.jpg'),
        ])->assertRedirect(route('admin.prestasi.index'));

        $prestasi = PrestasiMahasiswa::query()->where('judul_prestasi', 'Juara 1 Hackathon')->firstOrFail();

        Storage::disk('s3')->assertExists($prestasi->gambar);

        $this->get('/prestasi-mahasiswa')->assertOk()->assertSee('Juara 1 Hackathon')->assertSee('Nadia');

        $this->actingAs($this->admin)->put(route('admin.prestasi.update', $prestasi), [
            'judul_prestasi' => 'Juara 1 Hackathon Updated',
            'nama_mahasiswa' => 'Nadia',
            'tahun' => date('Y'),
            'deskripsi' => 'Deskripsi update',
        ])->assertRedirect(route('admin.prestasi.index'));

        $this->assertDatabaseHas('prestasi_mahasiswas', [
            'id' => $prestasi->id,
            'judul_prestasi' => 'Juara 1 Hackathon Updated',
        ]);

        $this->actingAs($this->admin)->delete(route('admin.prestasi.destroy', $prestasi))
            ->assertRedirect(route('admin.prestasi.index'));

        $this->assertDatabaseMissing('prestasi_mahasiswas', ['id' => $prestasi->id]);
    }

    public function test_hmps_sections_can_be_updated_and_displayed(): void
    {
        $textSections = [
            'hmps-profil' => '/hmps/profil',
            'hmps-program-kerja' => '/hmps/program-kerja',
        ];

        foreach ($textSections as $section => $publicUrl) {
            $this->updateSection($section, [
                'title' => 'HMPS '.$section,
                'body' => '<p>Konten HMPS '.$section.'</p>',
            ]);

            $this->get($publicUrl)->assertOk()->assertSee('HMPS '.$section);
        }

        $imageSections = [
            'hmps-struktur-organisasi' => '/hmps/struktur-organisasi',
            'hmps-kegiatan' => '/hmps/kegiatan',
            'hmps-rekruitment' => '/hmps/rekruitment',
        ];

        foreach ($imageSections as $section => $publicUrl) {
            $this->updateSection($section, [
                'title' => 'HMPS '.$section,
                'body' => 'Deskripsi HMPS',
                'image_path' => UploadedFile::fake()->image($section.'.jpg'),
            ]);

            $content = SiteContent::query()->where('key', AdminSiteContentController::sections()[$section]['key'])->firstOrFail();
            Storage::disk('s3')->assertExists($content->image_path);

            $this->get($publicUrl)->assertOk()->assertSee('HMPS '.$section);
        }
    }

    public function test_pendaftaran_banner_form_validation_and_submission_work(): void
    {
        $this->updateSection('pendaftaran-banner', [
            'title' => 'Banner Pendaftaran 2026',
            'image_path' => UploadedFile::fake()->image('banner.jpg'),
        ]);

        $banner = SiteContent::query()->where('key', 'pendaftaran_banner')->firstOrFail();
        Storage::disk('s3')->assertExists($banner->image_path);

        $this->get('/pendaftaran')->assertOk()->assertSee('Formulir Pendaftaran');

        $this->post('/pendaftaran', [
            'nama_lengkap' => '',
            'email' => '',
            'no_hp' => '',
            'asal_sekolah' => 'SMK 1 Mataram',
            'pilihan_program_studi' => '',
        ])->assertSessionHasErrors([
            'nama_lengkap',
            'email',
            'no_hp',
            'pilihan_program_studi',
        ]);

        $submitResponse = $this->post('/pendaftaran', [
            'nama_lengkap' => 'Calon Mahasiswa',
            'email' => 'calon@example.test',
            'no_hp' => '081234567890',
            'asal_sekolah' => 'SMK 1 Mataram',
            'pilihan_program_studi' => 'D4 Teknologi Rekayasa Perangkat Lunak',
            'pesan' => 'Mohon info jadwal tes masuk.',
            'dokumen' => UploadedFile::fake()->create('rapor.pdf', 200, 'application/pdf'),
        ]);

        $submitResponse->assertRedirect();
        $submitResponse->assertSessionHas('success');

        $this->assertDatabaseHas('pendaftarans', [
            'email' => 'calon@example.test',
            'status' => 'pending',
        ]);

        $pendaftaran = Pendaftaran::query()->where('email', 'calon@example.test')->firstOrFail();
        Storage::disk('s3')->assertExists($pendaftaran->dokumen);

        $this->actingAs($this->admin)->get(route('admin.pendaftaran.index'))->assertOk();
        $this->actingAs($this->admin)->get(route('admin.pendaftaran.export'))->assertOk();
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function updateSection(string $section, array $payload): void
    {
        $response = $this->actingAs($this->admin)
            ->from(route('admin.site-content.edit', $section))
            ->put(route('admin.site-content.update', $section), $payload);

        $response->assertRedirect(route('admin.site-content.edit', $section));
        $response->assertSessionHas('success');
    }
}
