<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitScreenerRequest;
use App\Models\ScreenerResponse;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ScreenerController extends Controller
{
    /**
     * DASS-21 Standard 21 Questions in Bahasa Melayu.
     */
    public const QUESTIONS = [
        1 => ['text' => 'Saya dapati sukar untuk bertenang atau relaks.', 'scale' => 'stress'],
        2 => ['text' => 'Saya sedar mulut saya terasa kering.', 'scale' => 'anxiety'],
        3 => ['text' => 'Saya langsung tidak dapat merasai perasaan positif.', 'scale' => 'depression'],
        4 => ['text' => 'Saya mengalami kesukaran bernafas (cth: bernafas laju tanpa senaman fizikal).', 'scale' => 'anxiety'],
        5 => ['text' => 'Saya berasa sukar untuk bersemangat memulakan sesuatu.', 'scale' => 'depression'],
        6 => ['text' => 'Saya cenderung untuk bertindak balas secara berlebihan terhadap sesuatu situasi.', 'scale' => 'stress'],
        7 => ['text' => 'Saya berasa gementar (cth: anggota badan bergegar tanpa sebab fizikal).', 'scale' => 'anxiety'],
        8 => ['text' => 'Saya rasa saya menggunakan banyak tenaga kerana terlalu risau.', 'scale' => 'stress'],
        9 => ['text' => 'Saya bimbang akan situasi di mana saya mungkin panik dan memalukan diri sendiri.', 'scale' => 'anxiety'],
        10 => ['text' => 'Saya rasa tiada apa-apa yang dapat saya harapkan lagi.', 'scale' => 'depression'],
        11 => ['text' => 'Saya dapati diri saya mudah gelisah atau resah.', 'scale' => 'stress'],
        12 => ['text' => 'Saya dapati sukar untuk berehat.', 'scale' => 'stress'],
        13 => ['text' => 'Saya berasa sedih dan muram.', 'scale' => 'depression'],
        14 => ['text' => 'Saya tidak bertolak ansur dengan perkara yang menghalang saya daripada meneruskan tugas.', 'scale' => 'stress'],
        15 => ['text' => 'Saya berasa seperti hendak panik.', 'scale' => 'anxiety'],
        16 => ['text' => 'Saya tidak bersemangat dengan apa-apa pun.', 'scale' => 'depression'],
        17 => ['text' => 'Saya rasa diri saya tidak berharga sebagai seorang manusia.', 'scale' => 'depression'],
        18 => ['text' => 'Saya dapati diri saya mudah tersinggung atau sensitif.', 'scale' => 'stress'],
        19 => ['text' => 'Saya sedar degupan jantung saya pantas walaupun tidak melakukan aktiviti berat.', 'scale' => 'anxiety'],
        20 => ['text' => 'Saya berasa takut tanpa sebab yang munasabah.', 'scale' => 'anxiety'],
        21 => ['text' => 'Saya rasa hidup ini tidak bermakna.', 'scale' => 'depression'],
    ];

    public function index(): View
    {
        return view('pages.screener.index', [
            'questions' => self::QUESTIONS,
        ]);
    }

    public function store(SubmitScreenerRequest $request): RedirectResponse
    {
        $answers = $request->validated('q');

        // Calculate scores for DASS-21 (Sum x 2 to align with DASS-42 norms)
        $rawDepression = 0;
        $rawAnxiety = 0;
        $rawStress = 0;

        foreach ($answers as $qId => $val) {
            $scale = self::QUESTIONS[(int) $qId]['scale'] ?? null;
            if ($scale === 'depression') {
                $rawDepression += (int) $val;
            } elseif ($scale === 'anxiety') {
                $rawAnxiety += (int) $val;
            } elseif ($scale === 'stress') {
                $rawStress += (int) $val;
            }
        }

        $depressionScore = $rawDepression * 2;
        $anxietyScore = $rawAnxiety * 2;
        $stressScore = $rawStress * 2;

        $depressionSeverity = $this->getSeverity('depression', $depressionScore);
        $anxietySeverity = $this->getSeverity('anxiety', $anxietyScore);
        $stressSeverity = $this->getSeverity('stress', $stressScore);

        $response = ScreenerResponse::create([
            'screener_type' => 'dass21',
            'session_id' => session()->getId(),
            'client_name' => $request->validated('client_name'),
            'client_email' => $request->validated('client_email'),
            'client_phone' => $request->validated('client_phone'),
            'depression_score' => $depressionScore,
            'depression_severity' => $depressionSeverity,
            'anxiety_score' => $anxietyScore,
            'anxiety_severity' => $anxietySeverity,
            'stress_score' => $stressScore,
            'stress_severity' => $stressSeverity,
            'answers' => $answers,
        ]);

        return redirect()->route('screener.result', ['id' => $response->id]);
    }

    public function result(int $id): View
    {
        $response = ScreenerResponse::findOrFail($id);
        $services = Service::where('is_active', true)->where('is_featured', true)->get();

        return view('pages.screener.result', [
            'screener' => $response,
            'services' => $services,
        ]);
    }

    private function getSeverity(string $scale, int $score): string
    {
        return match ($scale) {
            'depression' => match (true) {
                $score <= 9 => 'Normal',
                $score <= 13 => 'Ringan',
                $score <= 20 => 'Sederhana',
                $score <= 27 => 'Teruk',
                default => 'Sangat Teruk',
            },
            'anxiety' => match (true) {
                $score <= 7 => 'Normal',
                $score <= 9 => 'Ringan',
                $score <= 14 => 'Sederhana',
                $score <= 19 => 'Teruk',
                default => 'Sangat Teruk',
            },
            'stress' => match (true) {
                $score <= 14 => 'Normal',
                $score <= 18 => 'Ringan',
                $score <= 25 => 'Sederhana',
                $score <= 33 => 'Teruk',
                default => 'Sangat Teruk',
            },
            default => 'Normal',
        };
    }
}
