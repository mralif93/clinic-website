<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Practitioner;
use App\Models\ScreenerResponse;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 0. Seed Default Admin User
        User::updateOrCreate(
            ['email' => 'admin@sakeenahmedicare.net'],
            [
                'name' => 'Pentadbir Sakeenah',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        $practitioners = [
            [
                'name' => 'CP Tasha',
                'slug' => 'cp-tasha',
                'title' => 'Clinical Psychologist',
                'registration_number' => 'MAHPC(CP)0082',
                'bio' => 'Berpengalaman luas dalam membantu kanak-kanak, remaja dan dewasa dengan isu kebimbangan (anxiety), kemurungan dan trauma emosi.',
                'specialties' => ['Anxiety & Depression', 'Child & Adolescent', 'Trauma Therapy'],
                'languages' => ['Bahasa Melayu', 'English'],
                'photo_path' => 'media/team/SKMED-PROFILE_02-1.png',
                'sort_order' => 1,
            ],
            [
                'name' => 'CP Naziah',
                'slug' => 'cp-naziah',
                'title' => 'Clinical Psychologist',
                'registration_number' => 'MAHPC(CP)0095',
                'bio' => 'Pengkhususan dalam penilaian diagnostik neurodiversiti (ADHD & Autisme) serta terapi tingkah laku kognitif (CBT).',
                'specialties' => ['ADHD & Autism Assessment', 'CBT', 'Stress Management'],
                'languages' => ['Bahasa Melayu', 'English'],
                'photo_path' => 'media/team/SKMED-PROFILE_02-2.png',
                'sort_order' => 2,
            ],
            [
                'name' => 'CL Adeera',
                'slug' => 'counsellor-adeera',
                'title' => 'Registered Counselor',
                'registration_number' => 'KB09112 / PA08740',
                'bio' => 'Kaunselor berdaftar dengan kepakaran terapi pasangan, komunikasi perkahwinan, dan pengurusan konflik keluarga.',
                'specialties' => ['Couple Therapy', 'Marriage & Family', 'Personal Growth'],
                'languages' => ['Bahasa Melayu', 'English'],
                'photo_path' => 'media/team/SKMED-PROFILE_02-3.png',
                'sort_order' => 3,
            ],
            [
                'name' => 'CP Andrea',
                'slug' => 'cp-andrea',
                'title' => 'Clinical Psychologist',
                'registration_number' => 'MAHPC(CP)0104',
                'bio' => 'Pakar dalam pengurusan emosi dewasa, burnout kerjaya, dan terapi penerimaan komitmen (ACT).',
                'specialties' => ['Adult Psychotherapy', 'Workplace Burnout', 'ACT'],
                'languages' => ['English', 'Bahasa Melayu'],
                'photo_path' => 'media/team/SKMED-PROFILE_02-4.png',
                'sort_order' => 4,
            ],
            [
                'name' => 'CP Qistina',
                'slug' => 'cp-qistina',
                'title' => 'Clinical Psychologist',
                'registration_number' => 'MAHPC(CP)0118',
                'bio' => 'Fokus pada kesihatan mental wanita, krisis identiti, dan kaunseling berduka (grief & loss).',
                'specialties' => ['Grief & Loss', 'Women Mental Health', 'Mindfulness'],
                'languages' => ['Bahasa Melayu', 'English'],
                'photo_path' => 'media/team/Qistina-removebg-preview.png',
                'sort_order' => 5,
            ],
            [
                'name' => 'CL Sha\'ari',
                'slug' => 'counselor-shaari',
                'title' => 'Registered Counselor',
                'registration_number' => 'KB08221 / PA07812',
                'bio' => 'Kaunselor berpengalaman dalam bimbingan motivasi remaja, isu ketagihan tingkah laku, dan perhubungan kekeluargaan.',
                'specialties' => ['Teen Counseling', 'Family Dynamics', 'Career Guidance'],
                'languages' => ['Bahasa Melayu', 'English'],
                'photo_path' => 'media/team/SKMED-PROFILE_02-6.png',
                'sort_order' => 6,
            ],
        ];

        foreach ($practitioners as $p) {
            Practitioner::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // 2. Seed Services
        $services = [
            [
                'name' => 'Penilaian Diagnostik Psikologi (Diagnostic Assessment)',
                'slug' => 'diagnostic-assessment',
                'category' => 'assessment',
                'summary' => 'Penilaian komprehensif bagi ADHD, Spektrum Autisme (ASD), Ujian IQ, dan penilaian kelewatan perkembangan anak.',
                'description' => 'Penilaian diagnostik melibatkan temu bual klinikal, instrumen ujian standard antarabangsa, dan laporan psikologi rasmi yang diiktiraf bagi kegunaan sekolah, perubatan atau sokongan OKU.',
                'target_audience' => 'Kanak-kanak, Remaja & Dewasa',
                'price' => 1200.00,
                'deposit_amount' => 150.00,
                'duration_minutes' => 120,
                'image_path' => 'media/services/Better-therapy-thumbnail.jpg',
                'allows_online' => false,
                'allows_in_person' => true,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Psikoterapi Individu (Individual Psychotherapy)',
                'slug' => 'individual-psychotherapy',
                'category' => 'psychotherapy',
                'summary' => 'Sesi bimbingan 1-ke-1 secara peribadi dan sulit untuk mengatasi kebimbangan, kemurungan, stres melampau, dan trauma.',
                'description' => 'Ruang selamat dan sulit bersama psikologis klinikal bertauliah untuk memahami corak pemikiran, menguruskan emosi, dan membina daya tahan psikologi yang kukuh.',
                'target_audience' => 'Remaja & Dewasa',
                'price' => 200.00,
                'deposit_amount' => 50.00,
                'duration_minutes' => 60,
                'image_path' => 'media/services/Therapy-Moment_-High-Five-Connection.png',
                'allows_online' => true,
                'allows_in_person' => true,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Terapi Pasangan & Perkahwinan (Couple Therapy)',
                'slug' => 'couple-therapy',
                'category' => 'psychotherapy',
                'summary' => 'Membantu pasangan membaiki komunikasi, memulihkan kepercayaan susulan konflik atau kecurangan, dan mengukuhkan ikatan perkahwinan.',
                'description' => 'Sesi terapi neutral dan membimbing pasangan untuk memahami perspektif pasangan masing-masing serta mencari penyelesaian harmoni.',
                'target_audience' => 'Pasangan & Suami Isteri',
                'price' => 280.00,
                'deposit_amount' => 70.00,
                'duration_minutes' => 75,
                'image_path' => 'media/services/divorce.avif',
                'allows_online' => true,
                'allows_in_person' => true,
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Terapi Pertuturan & Carakerja Kanak-Kanak (Speech & OT)',
                'slug' => 'speech-occupational-therapy',
                'category' => 'child_therapy',
                'summary' => 'Intervensi awal untuk perkembangan pertuturan (speech delay), sensori integrasi, dan kemahiran motor halus kanak-kanak.',
                'description' => 'Dijalankan oleh terapis terlatih dengan bilik sensori dan permainan interaktif di premis kami di Cyberjaya.',
                'target_audience' => 'Kanak-kanak (Umur 2 - 12 tahun)',
                'price' => 180.00,
                'deposit_amount' => 50.00,
                'duration_minutes' => 60,
                'image_path' => 'media/services/IMG_1483.jpeg',
                'allows_online' => false,
                'allows_in_person' => true,
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Program Bantuan Pekerja & Korporat (EAP & Corporate Wellness)',
                'slug' => 'employee-assistance-programme',
                'category' => 'corporate',
                'summary' => 'Sesi kaunseling sulit pekerja, saringan kesihatan mental syarikat, serta bengkel pengurusan stres dan kepimpinan empati.',
                'description' => 'Membantu organisasi memupuk budaya kerja yang sihat, mengurangkan ketidakhadiran kerja (absenteeism), dan memperkasa produktiviti pasukan.',
                'target_audience' => 'Syarikat, Agensi & Pasukan Kerja',
                'price' => 0.00,
                'deposit_amount' => 0.00,
                'duration_minutes' => 180,
                'image_path' => 'media/services/Walk-for-Wellness-A-Fundraiser-for-Mental-Health-Awareness.png',
                'allows_online' => true,
                'allows_in_person' => true,
                'is_featured' => false,
                'sort_order' => 5,
            ],
        ];

        foreach ($services as $s) {
            Service::updateOrCreate(['slug' => $s['slug']], $s);
        }

        // 3. Seed Articles (Hab Psikoedukasi)
        $this->call(ArticleSeeder::class);

        // 4. Seed Contoh Rekod Tempahan & Ujian Saringan untuk Pengujian Admin
        $defaultService = Service::where('slug', 'individual-psychotherapy')->first();
        $defaultPractitioner = Practitioner::where('slug', 'cp-tasha')->first();

        if ($defaultService && Appointment::count() === 0) {
            Appointment::create([
                'booking_code' => 'SKM-DEMO01',
                'service_id' => $defaultService->id,
                'practitioner_id' => $defaultPractitioner?->id,
                'client_name' => 'Ahmad Daniel',
                'client_email' => 'daniel@example.com',
                'client_phone' => '0123456789',
                'client_age' => 29,
                'reason_for_visit' => 'Mengalami keletihan emosi dan burnout di tempat kerja.',
                'session_mode' => 'in_person',
                'appointment_date' => now()->addDays(2)->format('Y-m-d'),
                'appointment_time' => '10:00 AM',
                'status' => 'pending',
                'total_amount' => $defaultService->price,
                'deposit_amount' => $defaultService->deposit_amount,
                'payment_status' => 'pending',
            ]);

            Appointment::create([
                'booking_code' => 'SKM-DEMO02',
                'service_id' => $defaultService->id,
                'practitioner_id' => $defaultPractitioner?->id,
                'client_name' => 'Nurul Ain',
                'client_email' => 'nurul@example.com',
                'client_phone' => '0139876543',
                'client_age' => 34,
                'reason_for_visit' => 'Ingin mendapatkan panduan terapi kebimbangan (anxiety).',
                'session_mode' => 'online',
                'appointment_date' => now()->addDays(3)->format('Y-m-d'),
                'appointment_time' => '02:00 PM',
                'status' => 'confirmed',
                'total_amount' => $defaultService->price,
                'deposit_amount' => $defaultService->deposit_amount,
                'payment_status' => 'paid',
                'meeting_url' => 'https://meet.google.com/skm-demo-meet',
                'admin_notes' => 'Deposit disahkan masuk melalui FPX Toyyibpay.',
            ]);
        }

        if (ScreenerResponse::count() === 0) {
            ScreenerResponse::create([
                'screener_type' => 'dass21',
                'client_name' => 'Ahmad Daniel',
                'client_phone' => '0123456789',
                'client_email' => 'daniel@example.com',
                'depression_score' => 12,
                'depression_severity' => 'Ringan',
                'anxiety_score' => 16,
                'anxiety_severity' => 'Teruk',
                'stress_score' => 18,
                'stress_severity' => 'Ringan',
                'answers' => [
                    1 => 2, 2 => 2, 3 => 1, 4 => 2, 5 => 1, 6 => 2, 7 => 2,
                    8 => 2, 9 => 2, 10 => 1, 11 => 1, 12 => 2, 13 => 1, 14 => 1,
                    15 => 2, 16 => 1, 17 => 1, 18 => 1, 19 => 2, 20 => 2, 21 => 1,
                ],
            ]);
        }
    }
}
