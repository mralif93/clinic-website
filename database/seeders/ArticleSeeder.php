<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Apa Yang Perlu Dilakukan Sebelum Membuat Keputusan Untuk Bercerai?',
                'slug' => 'what-to-do-before-deciding-to-divorce',
                'category' => 'relationship',
                'summary' => 'Perceraian adalah keputusan besar yang meninggalkan kesan emosi mendalam. Ketahui langkah refleksi dan bimbingan terapi sebelum membuat keputusan muktamad.',
                'content' => 'Keputusan untuk berpisah bukanlah perkara yang mudah. Sering kali, konflik perkahwinan berpunca daripada corak komunikasi yang terputus, jangkaan yang tidak dibincangkan, dan keletihan emosi yang berpanjangan. Menghadiri terapi pasangan membolehkan kedua-dua belah pihak meluahkan perasaan di ruang neutral tanpa penghakiman.',
                'author_name' => 'CL Adeera (Kaunselor Berdaftar)',
                'image_path' => 'media/services/divorce.avif',
                'read_time_minutes' => 5,
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Memahami Kecurangan Dalam Perhubungan & Proses Pemulihan Kepercayaan',
                'slug' => 'what-is-infidelity',
                'category' => 'relationship',
                'summary' => 'Kecurangan emosi mahupun fizikal merobek asas kepercayaan sesebuah ikatan perkahwinan. Bolehkah hubungan dipulihkan semula?',
                'content' => 'Kecurangan meninggalkan trauma emosi yang parah bagi pihak yang dikhianati. Proses pemulihan memerlukan ketelusan mutlak, kesediaan untuk mendengar kesakitan pasangan, dan bimbingan profesional untuk merungkai punca keretakan hubungan.',
                'author_name' => 'CP Tasha (Psikologis Klinikal)',
                'image_path' => 'media/services/infidelity.jpg',
                'read_time_minutes' => 6,
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Apakah Sebenarnya Kemurungan (Depression)? Kenali Tanda-Tandanya',
                'slug' => 'what-is-depression',
                'category' => 'mental_health',
                'summary' => 'Kemurungan bukan sekadar berasa sedih untuk beberapa hari. Ia adalah gangguan kesihatan mental yang mempengaruhi cara anda berfikir, merasa, dan berfungsi.',
                'content' => 'Simptom kemurungan klinikal merangkumi kelesuan kronik, insomnia atau terlebih tidur, rasa bersalah yang tidak berasas, dan hilang minat sepenuhnya terhadap perkara yang disukai. Bantuan psikoterapi seperti Terapi Tingkah Laku Kognitif (CBT) terbukti secara saintifik membantu pemulihan pesakit.',
                'author_name' => 'CP Naziah (Psikologis Klinikal)',
                'image_path' => 'media/services/Symptoms-of-depression.png',
                'read_time_minutes' => 4,
                'is_published' => true,
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => '"Tiada Siapa Yang Memahami Saya" — Mengapa Perasaan Ini Hadir?',
                'slug' => 'no-one-understands-me',
                'category' => 'mental_health',
                'summary' => 'Rasa terasing dan tidak difahami adalah salah satu beban emosi paling sunyi yang kerap dialami oleh individu di era moden.',
                'content' => 'Apabila kita merasakan tiada siapa yang mendengar, kecenderungan untuk memendam perasaan akan menjadi lebih tinggi. Ini boleh mencetuskan kebimbangan sosial dan rasa hampa. Melalui terapi individu, anda belajar membina semula hubungan yang sihat dengan diri sendiri dan orang sekeliling.',
                'author_name' => 'CP Andrea (Psikologis Klinikal)',
                'image_path' => 'media/services/Better-therapy-thumbnail.jpg',
                'read_time_minutes' => 4,
                'is_published' => true,
                'published_at' => now()->subDays(20),
            ],
        ];

        foreach ($articles as $a) {
            Article::updateOrCreate(['slug' => $a['slug']], $a);
        }
    }
}
