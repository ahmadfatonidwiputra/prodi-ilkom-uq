<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Fasilitas;
use App\Models\Kurikulum;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use App\Models\ProfilProdi;
use Illuminate\Database\Seeder;

class ProgramDataSeeder extends Seeder
{
    /**
     * Seed basic content for frontend and admin dashboard.
     */
    public function run(): void
    {
        ProfilProdi::updateOrCreate(
            ['id' => 1],
            [
                'tentang' => 'Program Studi D4 Teknologi Rekayasa Perangkat Lunak UNBIM berfokus pada pengembangan perangkat lunak, sistem cerdas, dan teknologi terapan berbasis kebutuhan industri.',
                'visi' => 'Menjadi program studi unggul di bidang komputasi terapan yang berdaya saing nasional.',
                'misi' => "1. Menyelenggarakan pendidikan berkualitas berbasis proyek.\n2. Mengembangkan riset terapan di bidang komputer.\n3. Menguatkan kolaborasi dengan dunia industri.",
            ]
        );

        $dosenData = [
            ['nama' => 'Dr. Ahmad Sukarta, S.Kom., M.Kom.', 'nidn' => '120001001', 'jabatan' => 'Ketua Prodi', 'jabatan_fungsional' => 'Lektor Kepala'],
            ['nama' => 'Rina Maharani, S.Kom., M.T.', 'nidn' => '120001002', 'jabatan' => 'Dosen Tetap', 'jabatan_fungsional' => 'Lektor'],
            ['nama' => 'Fajar Hidayat, S.Kom., M.Kom.', 'nidn' => '120001003', 'jabatan' => 'Dosen Tetap', 'jabatan_fungsional' => 'Asisten Ahli'],
        ];

        foreach ($dosenData as $dosen) {
            Dosen::firstOrCreate(['nidn' => $dosen['nidn']], $dosen);
        }

        $fasilitasData = [
            ['nama' => 'Kurikulum Berbasis Industri', 'ikon' => 'bi-journal-code', 'deskripsi' => 'Materi pembelajaran disusun sesuai kebutuhan dunia kerja digital.', 'urutan' => 1],
            ['nama' => 'Fasilitas Modern & Lab Lengkap', 'ikon' => 'bi-pc-display-horizontal', 'deskripsi' => 'Didukung lab komputer, internet cepat, dan perangkat pembelajaran terkini.', 'urutan' => 2],
            ['nama' => 'Dosen Praktisi Berkualitas', 'ikon' => 'bi-person-workspace', 'deskripsi' => 'Dosen berpengalaman akademik dan industri, fokus pada project-based learning.', 'urutan' => 3],
            ['nama' => 'Peluang Karir Luas', 'ikon' => 'bi-graph-up-arrow', 'deskripsi' => 'Lulusan siap berkarir sebagai programmer, analyst, dan software engineer.', 'urutan' => 4],
        ];

        foreach ($fasilitasData as $fasilitas) {
            Fasilitas::firstOrCreate(['nama' => $fasilitas['nama']], $fasilitas);
        }

        $kurikulumData = [
            ['kode_mk' => 'IF101', 'nama_mk' => 'Algoritma dan Pemrograman', 'semester' => 1, 'sks' => 3, 'kategori' => 'Wajib'],
            ['kode_mk' => 'IF202', 'nama_mk' => 'Basis Data', 'semester' => 2, 'sks' => 3, 'kategori' => 'Wajib'],
            ['kode_mk' => 'IF305', 'nama_mk' => 'Rekayasa Perangkat Lunak', 'semester' => 3, 'sks' => 3, 'kategori' => 'Wajib'],
            ['kode_mk' => 'IF407', 'nama_mk' => 'Pengembangan Web Lanjut', 'semester' => 4, 'sks' => 3, 'kategori' => 'Praktikum'],
        ];

        foreach ($kurikulumData as $kurikulum) {
            Kurikulum::firstOrCreate(['kode_mk' => $kurikulum['kode_mk']], $kurikulum + ['deskripsi' => null]);
        }

        $mahasiswaData = [
            ['nama' => 'Naila Putri', 'nim' => '2201001', 'angkatan' => 2022, 'konsentrasi' => 'Software Engineering', 'prestasi' => 'Juara 2 Lomba UI/UX', 'status_aktif' => true],
            ['nama' => 'Rizky Pratama', 'nim' => '2301002', 'angkatan' => 2023, 'konsentrasi' => 'Data Science', 'prestasi' => null, 'status_aktif' => true],
            ['nama' => 'Dewi Anggraini', 'nim' => '2401003', 'angkatan' => 2024, 'konsentrasi' => 'Web Development', 'prestasi' => 'Finalis Hackathon Nasional', 'status_aktif' => true],
        ];

        foreach ($mahasiswaData as $mahasiswa) {
            Mahasiswa::firstOrCreate(['nim' => $mahasiswa['nim']], $mahasiswa);
        }

        Pendaftaran::firstOrCreate(
            ['email' => 'calonmahasiswa@contoh.com'],
            [
                'nama_lengkap' => 'Calon Mahasiswa UNBIM',
                'no_hp' => '08123456789',
                'asal_sekolah' => 'SMA Negeri 1 Praya',
                'pesan' => 'Tertarik bergabung pada jalur reguler.',
                'status' => 'pending',
            ]
        );
    }
}
