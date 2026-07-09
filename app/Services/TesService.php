<?php

namespace App\Services;

use App\Models\HasilTes;
use Illuminate\Support\Facades\Auth;

class TesService
{
    public function getSoalBigFive(): array
    {
        return [
            ['dimensi'=>'O','reverse'=>false,'teks'=>'Saya punya imajinasi yang kaya'],
            ['dimensi'=>'O','reverse'=>false,'teks'=>'Saya tertarik dengan ide-ide abstrak'],
            ['dimensi'=>'O','reverse'=>false,'teks'=>'Saya punya banyak ide kreatif'],
            ['dimensi'=>'O','reverse'=>false,'teks'=>'Saya cepat memahami hal-hal baru'],
            ['dimensi'=>'O','reverse'=>false,'teks'=>'Saya suka mempelajari hal-hal rumit'],
            ['dimensi'=>'O','reverse'=>true, 'teks'=>'Saya tidak tertarik dengan ide-ide abstrak'],
            ['dimensi'=>'O','reverse'=>true, 'teks'=>'Saya tidak suka seni'],
            ['dimensi'=>'O','reverse'=>true, 'teks'=>'Saya sulit memahami konsep abstrak'],
            ['dimensi'=>'O','reverse'=>true, 'teks'=>'Saya tidak punya imajinasi yang baik'],
            ['dimensi'=>'O','reverse'=>true, 'teks'=>'Saya menghindari diskusi filosofis'],

            ['dimensi'=>'C','reverse'=>false,'teks'=>'Saya selalu siap dan mempersiapkan segala sesuatu dengan matang'],
            ['dimensi'=>'C','reverse'=>false,'teks'=>'Saya memperhatikan detail dengan teliti'],
            ['dimensi'=>'C','reverse'=>false,'teks'=>'Saya menyelesaikan tugas dengan segera'],
            ['dimensi'=>'C','reverse'=>false,'teks'=>'Saya menyukai keteraturan'],
            ['dimensi'=>'C','reverse'=>false,'teks'=>'Saya menjalankan rencana sesuai jadwal'],
            ['dimensi'=>'C','reverse'=>true, 'teks'=>'Saya sering meninggalkan barang berantakan'],
            ['dimensi'=>'C','reverse'=>true, 'teks'=>'Saya sering melupakan untuk mengembalikan barang ke tempatnya'],
            ['dimensi'=>'C','reverse'=>true, 'teks'=>'Saya menunda-nunda pekerjaan'],
            ['dimensi'=>'C','reverse'=>true, 'teks'=>'Saya sering lalai dalam tugas'],
            ['dimensi'=>'C','reverse'=>true, 'teks'=>'Saya sulit memulai pekerjaan'],

            ['dimensi'=>'E','reverse'=>false,'teks'=>'Saya adalah jiwa dari sebuah pesta atau kumpul-kumpul'],
            ['dimensi'=>'E','reverse'=>false,'teks'=>'Saya tidak kesulitan untuk memulai obrolan dengan orang baru'],
            ['dimensi'=>'E','reverse'=>false,'teks'=>'Saya merasa nyaman berada di tengah keramaian'],
            ['dimensi'=>'E','reverse'=>false,'teks'=>'Saya memulai percakapan duluan'],
            ['dimensi'=>'E','reverse'=>false,'teks'=>'Saya senang menjadi pusat perhatian'],
            ['dimensi'=>'E','reverse'=>true, 'teks'=>'Saya berbicara seperlunya saja'],
            ['dimensi'=>'E','reverse'=>true, 'teks'=>'Saya lebih suka berada di belakang layar'],
            ['dimensi'=>'E','reverse'=>true, 'teks'=>'Saya tidak punya banyak hal untuk dibicarakan'],
            ['dimensi'=>'E','reverse'=>true, 'teks'=>'Saya canggung saat bertemu orang baru'],
            ['dimensi'=>'E','reverse'=>true, 'teks'=>'Saya cenderung pendiam saat berkumpul'],

            ['dimensi'=>'A','reverse'=>false,'teks'=>'Saya peduli dengan perasaan orang lain'],
            ['dimensi'=>'A','reverse'=>false,'teks'=>'Saya merasakan emosi orang lain dengan baik'],
            ['dimensi'=>'A','reverse'=>false,'teks'=>'Saya punya kata-kata yang lembut untuk semua orang'],
            ['dimensi'=>'A','reverse'=>false,'teks'=>'Saya percaya dengan apa yang dikatakan orang lain'],
            ['dimensi'=>'A','reverse'=>false,'teks'=>'Saya senang membantu orang lain'],
            ['dimensi'=>'A','reverse'=>true, 'teks'=>'Saya tidak terlalu tertarik dengan masalah orang lain'],
            ['dimensi'=>'A','reverse'=>true, 'teks'=>'Saya merasa tidak nyaman berada di sekitar orang lain'],
            ['dimensi'=>'A','reverse'=>true, 'teks'=>'Saya menghina atau meremehkan orang lain'],
            ['dimensi'=>'A','reverse'=>true, 'teks'=>'Saya tidak peduli perasaan orang lain'],
            ['dimensi'=>'A','reverse'=>true, 'teks'=>'Saya jarang membantu orang yang tidak saya kenal'],

            ['dimensi'=>'N','reverse'=>false,'teks'=>'Saya mudah merasa stres'],
            ['dimensi'=>'N','reverse'=>false,'teks'=>'Saya sering khawatir dengan banyak hal'],
            ['dimensi'=>'N','reverse'=>false,'teks'=>'Saya mudah marah'],
            ['dimensi'=>'N','reverse'=>false,'teks'=>'Saya sering merasa sedih tanpa alasan jelas'],
            ['dimensi'=>'N','reverse'=>false,'teks'=>'Mood saya sering berubah-ubah'],
            ['dimensi'=>'N','reverse'=>true, 'teks'=>'Saya jarang merasa sedih'],
            ['dimensi'=>'N','reverse'=>true, 'teks'=>'Saya jarang merasa tertekan'],
            ['dimensi'=>'N','reverse'=>true, 'teks'=>'Saya santai dalam menghadapi kebanyakan situasi'],
            ['dimensi'=>'N','reverse'=>true, 'teks'=>'Saya jarang merasa khawatir'],
            ['dimensi'=>'N','reverse'=>true, 'teks'=>'Saya cenderung tenang dalam tekanan'],
        ];
    }

    public function getSoalLogika(): array
    {
        return [
            ['teks'=>'1, 2, 4, 7, 11, 16, 22, ... ?','opsi'=>['26','28','29','30'],'jawaban'=>'29'],
            ['teks'=>'3, 6, 12, 24, 48, ... ?','opsi'=>['72','84','96','108'],'jawaban'=>'96'],
            ['teks'=>'100, 95, 85, 70, 50, ... ?','opsi'=>['20','25','30','35'],'jawaban'=>'25'],
            ['teks'=>'2, 5, 11, 23, 47, ... ?','opsi'=>['91','93','95','97'],'jawaban'=>'95'],
            ['teks'=>'5, 6, 9, 14, 21, 30, ... ?','opsi'=>['39','40','41','42'],'jawaban'=>'41'],
            ['teks'=>'Toko buka 8 jam sehari. Karyawan istirahat 1,5 jam. Berapa % waktu efektif?','opsi'=>['75%','81.25%','85%','87.5%'],'jawaban'=>'81.25%'],
            ['teks'=>'Budi beli baju diskon 20% seharga Rp80.000. Berapa harga asli baju?','opsi'=>['Rp96.000','Rp100.000','Rp104.000','Rp120.000'],'jawaban'=>'Rp100.000'],
            ['teks'=>'Jika 5 orang menyelesaikan pekerjaan dalam 4 hari, berapa hari untuk 10 orang?','opsi'=>['1 hari','2 hari','3 hari','8 hari'],'jawaban'=>'2 hari'],
            ['teks'=>'Andi berkendara 60 km/jam selama 2,5 jam. Berapa jarak ditempuh?','opsi'=>['120 km','130 km','150 km','180 km'],'jawaban'=>'150 km'],
            ['teks'=>'Harga barang naik dari Rp10.000 ke Rp12.500. Berapa persen kenaikannya?','opsi'=>['15%','20%','25%','30%'],'jawaban'=>'25%'],
            ['teks'=>'Pena : Menulis = Pisau : ...','opsi'=>['Memotong','Makan','Dapur','Logam'],'jawaban'=>'Memotong'],
            ['teks'=>'Semua pegawai tetap mendapat tunjangan. Budi mendapat tunjangan. Maka...','opsi'=>['Budi pegawai tetap','Budi belum pasti pegawai tetap','Budi bukan pegawai tetap','Budi karyawan kontrak'],'jawaban'=>'Budi belum pasti pegawai tetap'],
            ['teks'=>'Mobil : Bensin = Manusia : ...','opsi'=>['Mobil','Makanan','Bernapas','Jalan'],'jawaban'=>'Makanan'],
            ['teks'=>'Semua bunga indah. Sebagian bunga berwarna merah. Maka...','opsi'=>['Semua bunga merah','Sebagian bunga indah dan merah','Bunga merah pasti indah','Semua yang indah adalah bunga'],'jawaban'=>'Sebagian bunga indah dan merah'],
            ['teks'=>'Mata : Melihat = Telinga : ...','opsi'=>['Bunyi','Mendengar','Suara','Kepala'],'jawaban'=>'Mendengar'],
            ['teks'=>'Anda baru masuk kerja dan belum paham tugas. Apa yang dilakukan?','opsi'=>['Diam menunggu instruksi','Tanya rekan atau atasan','Mengerjakan sebisanya','Mencari tugas sendiri'],'jawaban'=>'Tanya rekan atau atasan'],
            ['teks'=>'Rekan kerja melakukan kesalahan merugikan. Apa yang Anda lakukan?','opsi'=>['Diam saja','Langsung lapor atasan','Tegur rekan dan ajak perbaiki','Membiarkannya saja'],'jawaban'=>'Tegur rekan dan ajak perbaiki'],
            ['teks'=>'Diberi 3 tugas deadline sama. Cara mengatasinya?','opsi'=>['Kerjakan acak','Prioritas berdasarkan urgensi','Minta perpanjangan deadline','Kerjakan satu per satu'],'jawaban'=>'Prioritas berdasarkan urgensi'],
            ['teks'=>'Atasan memberikan instruksi yang menurut Anda kurang efisien. Apa tindakan Anda?','opsi'=>['Protes langsung','Kerjakan sesuai instruksi','Sampaikan saran secara sopan','Abaikan instruksi'],'jawaban'=>'Sampaikan saran secara sopan'],
            ['teks'=>'Anda melakukan kesalahan kerja. Apa sikap Anda?','opsi'=>['Menyalahkan orang lain','Menyembunyikan kesalahan','Mengakui dan memperbaikinya','Panik'],'jawaban'=>'Mengakui dan memperbaikinya'],
        ];
    }

    public function hitungDanSimpanHasil(array $inputData): HasilTes
    {
        $kandidat    = Auth::guard('kandidat')->user();
        $soalBigFive = $this->getSoalBigFive();
        $soalLogika  = $this->getSoalLogika();

        // Hitung skor Big Five
        $skor = ['O' => 0, 'C' => 0, 'E' => 0, 'A' => 0, 'N' => 0];
        foreach ($soalBigFive as $i => $soal) {
            $nilai = (int) $inputData["bf_{$i}"];
            $skor[$soal['dimensi']] += $soal['reverse'] ? (6 - $nilai) : $nilai;
        }

        // Hitung skor logika
        $skorLogika = 0;
        foreach ($soalLogika as $i => $soal) {
            if ($inputData["lg_{$i}"] === $soal['jawaban']) {
                $skorLogika++;
            }
        }

        // Kategori per dimensi
        $namaDepan = explode(' ', $kandidat->nama)[0];
        $kat = [];
        $desk = [];
        foreach (['O','C','E','A','N'] as $d) {
            $kat[$d]  = $this->getKategori($skor[$d]);
            $desk[$d] = $this->getDeskripsi($d, $kat[$d], $namaDepan);
        }

        // Simpan ke database
        $hasil = HasilTes::create([
            'nama'         => $kandidat->nama,
            'posisi'       => $kandidat->posisi,
            'tanggal'      => now()->toDateString(),
            'skor_o'       => $skor['O'],
            'skor_c'       => $skor['C'],
            'skor_e'       => $skor['E'],
            'skor_a'       => $skor['A'],
            'skor_n'       => $skor['N'],
            'skor_logika'  => $skorLogika,
            'kat_o'        => $kat['O'],
            'kat_c'        => $kat['C'],
            'kat_e'        => $kat['E'],
            'kat_a'        => $kat['A'],
            'kat_n'        => $kat['N'],
            'kat_logika'   => $this->getKategoriLogika($skorLogika),
            'desk_o'       => $desk['O'],
            'desk_c'       => $desk['C'],
            'desk_e'       => $desk['E'],
            'desk_a'       => $desk['A'],
            'desk_n'       => $desk['N'],
            'jawaban_detail' => $inputData,
        ]);

        // Update status kandidat sudah tes
        $kandidat->sudah_tes = true;
        $kandidat->save();

        return $hasil;
    }

    private function getKategori(int $skor): string
    {
        if ($skor < 24) return 'Rendah';
        if ($skor <= 36) return 'Sedang';
        return 'Tinggi';
    }

    private function getKategoriLogika(int $skor): string
    {
        if ($skor >= 16) return 'Baik';
        if ($skor >= 10) return 'Cukup';
        return 'Kurang';
    }

    private function getDeskripsi(string $dimensi, string $kategori, string $namaDepan): string
    {
        $deskripsi = [
            'O' => [
                'Tinggi' => "$namaDepan tergolong tinggi di dimensi ini: kreatif, terbuka terhadap ide dan hal baru, suka belajar hal kompleks. Cocok untuk peran yang butuh inovasi dan pemikiran out-of-the-box.",
                'Sedang' => "$namaDepan tergolong sedang di dimensi ini: cukup terbuka terhadap hal baru namun tetap nyaman dengan cara kerja yang sudah ada. Bisa beradaptasi dengan perubahan secara bertahap.",
                'Rendah' => "$namaDepan tergolong rendah di dimensi ini: lebih suka cara kerja yang sudah terbukti dan konsisten, kurang tertarik pada hal abstrak atau baru. Cocok untuk peran yang butuh kepatuhan SOP ketat.",
            ],
            'C' => [
                'Tinggi' => "$namaDepan tergolong tinggi di dimensi ini: sangat disiplin, teliti, terorganisir, dan bisa diandalkan menyelesaikan tugas tepat waktu. Cocok untuk posisi yang butuh akurasi tinggi seperti QC atau admin produksi.",
                'Sedang' => "$namaDepan tergolong sedang di dimensi ini: cukup disiplin namun sesekali bisa kurang terorganisir. Perlu pengingat atau pengawasan ringan untuk hasil optimal.",
                'Rendah' => "$namaDepan tergolong rendah di dimensi ini: cenderung kurang teratur dan mudah menunda pekerjaan. Butuh pengawasan dan struktur kerja yang jelas dari atasan.",
            ],
            'E' => [
                'Tinggi' => "$namaDepan tergolong tinggi di dimensi ini: energik, senang bersosialisasi, dan nyaman menjadi pusat perhatian. Cocok untuk posisi yang banyak interaksi seperti sales, customer service, atau frontliner.",
                'Sedang' => "$namaDepan tergolong sedang di dimensi ini: bisa beradaptasi baik di lingkungan ramai maupun saat kerja sendiri. Fleksibel dalam berbagai situasi sosial.",
                'Rendah' => "$namaDepan tergolong rendah di dimensi ini: lebih suka bekerja mandiri dan fokus, kurang nyaman di keramaian. Cocok untuk posisi analitis atau yang minim interaksi sosial intens seperti laboratorium atau produksi.",
            ],
            'A' => [
                'Tinggi' => "$namaDepan tergolong tinggi di dimensi ini: kooperatif, empatik, dan suka membantu rekan kerja. Mudah dipercaya dalam tim dan cocok untuk peran yang butuh kerja sama tim erat.",
                'Sedang' => "$namaDepan tergolong sedang di dimensi ini: cukup bisa bekerja sama dalam tim namun tetap punya batasan dan pendapat sendiri. Seimbang antara kebutuhan tim dan diri sendiri.",
                'Rendah' => "$namaDepan tergolong rendah di dimensi ini: cenderung lebih kompetitif atau individualis, kurang peka terhadap perasaan orang lain. Perlu digali lebih lanjut saat interview soal kemampuan kerja tim.",
            ],
            'N' => [
                'Tinggi' => "$namaDepan tergolong tinggi di dimensi ini: cenderung mudah stres, cemas, atau emosinya naik-turun (lebih mudah marah atau tersinggung). Kurang cocok untuk posisi dengan tekanan atau deadline tinggi tanpa dukungan yang memadai.",
                'Sedang' => "$namaDepan tergolong sedang di dimensi ini: cukup stabil secara emosi, sesekali bisa merasa tertekan namun umumnya bisa mengatasi situasi dengan baik.",
                'Rendah' => "$namaDepan tergolong rendah di dimensi ini: tenang, stabil secara emosi, dan tidak mudah panik bahkan di bawah tekanan. Cocok untuk posisi dengan deadline ketat atau situasi high-pressure.",
            ],
        ];

        return $deskripsi[$dimensi][$kategori];
    }
}
