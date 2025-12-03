<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Activity;

class DashboardController extends Controller
{
    /**
     * Menampilkan Halaman Dashboard
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Get today's schedules from database
        $schedules = $user->schedules()
            ->today()
            ->orderBy('scheduled_time')
            ->get();

        // Get recent activities
        $recentActivities = $user->activities()
            ->orderBy('activity_date', 'desc')
            ->limit(5)
            ->get();

        // Get weekly stats
        $weeklyStats = [
            'calories' => $user->weekly_calories,
            'duration' => $user->weekly_duration,
            'activities' => $user->weekly_activities_count,
        ];

        // Get activity chart data for last 7 days
        $chartData = $this->getWeeklyChartData($user);

        // Get workout recommendations based on BMI and goal
        $recommendations = $this->getRecommendations($user);

        // Get food recommendations based on BMI
        $foodRecommendations = $this->getFoodRecommendations($user);

        // Get active reminders for today
        $reminders = $user->reminders()
            ->active()
            ->get()
            ->filter(fn($r) => $r->isActiveToday());

        return view('dashboard', compact(
            'user', 
            'schedules', 
            'recentActivities',
            'weeklyStats',
            'chartData',
            'recommendations',
            'foodRecommendations',
            'reminders'
        ));
    }

    /**
     * Demo Dashboard untuk Guest
     */
    public function demo()
    {
        // Create dummy user data for demo
        $user = (object) [
            'name' => 'Demo User',
            'email' => 'demo@fitkomove.com',
            'age' => 25,
            'gender' => 'Male',
            'job' => 'Software Developer',
            'height' => 175,
            'weight' => 70,
            'bmi' => 22.9,
            'bmi_category' => 'Normal',
            'bmi_color' => '#22c55e',
            'profile_photo_url' => null,
        ];

        // Dummy schedules
        $schedules = collect([
            (object) ['scheduled_time' => '08:00', 'title' => 'Lari Pagi', 'status' => 'completed', 'status_label' => 'Selesai', 'activity_type' => 'running'],
            (object) ['scheduled_time' => '17:00', 'title' => 'Gym Session', 'status' => 'pending', 'status_label' => 'Pending', 'activity_type' => 'workout'],
        ]);

        // Dummy recent activities
        $recentActivities = collect([
            (object) ['type' => 'running', 'type_label' => 'Lari', 'type_icon' => 'bi-person-walking', 'title' => 'Morning Run', 'activity_date' => now()->subDay(), 'duration_minutes' => 30, 'calories_burned' => 350, 'distance_km' => 5],
            (object) ['type' => 'workout', 'type_label' => 'Workout', 'type_icon' => 'bi-lightning', 'title' => 'Strength Training', 'activity_date' => now()->subDays(2), 'duration_minutes' => 45, 'calories_burned' => 280, 'distance_km' => null],
        ]);

        // Dummy weekly stats
        $weeklyStats = [
            'calories' => 1850,
            'duration' => 180,
            'activities' => 5,
        ];

        // Dummy chart data
        $chartData = [
            'labels' => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            'calories' => [320, 450, 280, 0, 400, 200, 200],
            'duration' => [30, 45, 25, 0, 40, 20, 20],
        ];

        // Dummy recommendations
        $recommendations = [
            ['title' => 'Cardio Blast', 'level' => 'Hard', 'duration' => '30 Min', 'type' => 'hiit', 'description' => 'High intensity cardio workout'],
            ['title' => 'Yoga Flow', 'level' => 'Easy', 'duration' => '45 Min', 'type' => 'yoga', 'description' => 'Relaxing yoga session'],
            ['title' => 'Strength Training', 'level' => 'Medium', 'duration' => '60 Min', 'type' => 'strength', 'description' => 'Build muscle and strength'],
        ];

        // Dummy food recommendations
        $foodRecommendations = [
            ['name' => 'Oatmeal dengan Buah', 'calories' => 350, 'type' => 'Sarapan', 'benefit' => 'Energi untuk aktivitas pagi'],
            ['name' => 'Salad Ayam Panggang', 'calories' => 450, 'type' => 'Makan Siang', 'benefit' => 'Protein tinggi, rendah lemak'],
            ['name' => 'Ikan Salmon + Sayuran', 'calories' => 500, 'type' => 'Makan Malam', 'benefit' => 'Omega-3 untuk recovery'],
        ];

        // Dummy reminders
        $reminders = collect([
            (object) ['title' => 'Waktu Olahraga!', 'type' => 'workout', 'type_icon' => 'bi-lightning', 'reminder_time' => '08:00', 'formatted_time' => '08:00'],
            (object) ['title' => 'Minum Air', 'type' => 'hydration', 'type_icon' => 'bi-droplet', 'reminder_time' => '10:00', 'formatted_time' => '10:00'],
        ]);

        $isDemo = true;

        return view('dashboard', compact(
            'user', 
            'schedules', 
            'recentActivities',
            'weeklyStats',
            'chartData',
            'recommendations',
            'foodRecommendations',
            'reminders',
            'isDemo'
        ));
    }

    /**
     * Get weekly chart data
     */
    private function getWeeklyChartData($user): array
    {
        $days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
        $startOfWeek = now()->startOfWeek();
        
        $calories = [];
        $duration = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $dayActivities = $user->activities()
                ->whereDate('activity_date', $date)
                ->get();
            
            $calories[] = $dayActivities->sum('calories_burned') ?? 0;
            $duration[] = $dayActivities->sum('duration_minutes') ?? 0;
        }

        return [
            'labels' => $days,
            'calories' => $calories,
            'duration' => $duration,
        ];
    }

    /**
     * Get workout recommendations based on user profile
     */
    private function getRecommendations($user): array
    {
        $bmiCategory = $user->bmi_category;
        $goal = $user->goal ?? 'maintain';

        $allRecommendations = [
            'underweight' => [
                ['title' => 'Strength Training', 'level' => 'Medium', 'duration' => '45 Min', 'type' => 'strength', 'description' => 'Bangun massa otot'],
                ['title' => 'Yoga Restorative', 'level' => 'Easy', 'duration' => '30 Min', 'type' => 'yoga', 'description' => 'Relaksasi dan fleksibilitas'],
                ['title' => 'Light Cardio', 'level' => 'Easy', 'duration' => '20 Min', 'type' => 'walking', 'description' => 'Jalan santai'],
            ],
            'normal' => [
                ['title' => 'HIIT Workout', 'level' => 'Hard', 'duration' => '30 Min', 'type' => 'hiit', 'description' => 'Bakar kalori maksimal'],
                ['title' => 'Running', 'level' => 'Medium', 'duration' => '45 Min', 'type' => 'running', 'description' => 'Tingkatkan stamina'],
                ['title' => 'Strength Training', 'level' => 'Medium', 'duration' => '60 Min', 'type' => 'strength', 'description' => 'Jaga kekuatan otot'],
            ],
            'overweight' => [
                ['title' => 'Cardio Blast', 'level' => 'Medium', 'duration' => '45 Min', 'type' => 'cycling', 'description' => 'Bakar lemak efektif'],
                ['title' => 'Swimming', 'level' => 'Medium', 'duration' => '30 Min', 'type' => 'swimming', 'description' => 'Low impact, high burn'],
                ['title' => 'Walking', 'level' => 'Easy', 'duration' => '60 Min', 'type' => 'walking', 'description' => 'Mulai dengan jalan kaki'],
            ],
            'obese' => [
                ['title' => 'Water Aerobics', 'level' => 'Easy', 'duration' => '30 Min', 'type' => 'swimming', 'description' => 'Aman untuk sendi'],
                ['title' => 'Chair Exercises', 'level' => 'Easy', 'duration' => '20 Min', 'type' => 'workout', 'description' => 'Latihan duduk'],
                ['title' => 'Gentle Walking', 'level' => 'Easy', 'duration' => '30 Min', 'type' => 'walking', 'description' => 'Mulai perlahan'],
            ],
        ];

        $category = strtolower($bmiCategory ?? 'normal');
        return $allRecommendations[$category] ?? $allRecommendations['normal'];
    }

    /**
     * Get food recommendations based on BMI
     */
    private function getFoodRecommendations($user): array
    {
        $bmiCategory = strtolower($user->bmi_category ?? 'normal');

        $recommendations = [
            'underweight' => [
                ['name' => 'Smoothie Protein + Pisang', 'calories' => 450, 'type' => 'Sarapan', 'benefit' => 'Tinggi kalori sehat'],
                ['name' => 'Nasi + Ayam + Telur', 'calories' => 650, 'type' => 'Makan Siang', 'benefit' => 'Karbohidrat dan protein'],
                ['name' => 'Pasta dengan Daging', 'calories' => 600, 'type' => 'Makan Malam', 'benefit' => 'Energi untuk recovery'],
                ['name' => 'Kacang-kacangan', 'calories' => 200, 'type' => 'Snack', 'benefit' => 'Lemak sehat'],
            ],
            'normal' => [
                ['name' => 'Oatmeal dengan Buah', 'calories' => 350, 'type' => 'Sarapan', 'benefit' => 'Energi stabil'],
                ['name' => 'Salad Ayam Panggang', 'calories' => 450, 'type' => 'Makan Siang', 'benefit' => 'Protein tinggi'],
                ['name' => 'Ikan Salmon + Sayuran', 'calories' => 500, 'type' => 'Makan Malam', 'benefit' => 'Omega-3'],
                ['name' => 'Greek Yogurt', 'calories' => 150, 'type' => 'Snack', 'benefit' => 'Probiotik'],
            ],
            'overweight' => [
                ['name' => 'Telur Rebus + Alpukat', 'calories' => 300, 'type' => 'Sarapan', 'benefit' => 'Rendah karbo'],
                ['name' => 'Sup Sayuran + Tahu', 'calories' => 250, 'type' => 'Makan Siang', 'benefit' => 'Rendah kalori'],
                ['name' => 'Ikan Panggang + Brokoli', 'calories' => 350, 'type' => 'Makan Malam', 'benefit' => 'Protein tanpa lemak'],
                ['name' => 'Buah Segar', 'calories' => 100, 'type' => 'Snack', 'benefit' => 'Serat tinggi'],
            ],
            'obese' => [
                ['name' => 'Smoothie Hijau', 'calories' => 200, 'type' => 'Sarapan', 'benefit' => 'Detox alami'],
                ['name' => 'Salad Sayuran Besar', 'calories' => 200, 'type' => 'Makan Siang', 'benefit' => 'Sangat rendah kalori'],
                ['name' => 'Sup Ayam Tanpa Kulit', 'calories' => 300, 'type' => 'Makan Malam', 'benefit' => 'Mengenyangkan'],
                ['name' => 'Mentimun/Wortel', 'calories' => 50, 'type' => 'Snack', 'benefit' => 'Hampir nol kalori'],
            ],
        ];

        return $recommendations[$bmiCategory] ?? $recommendations['normal'];
    }

    /**
     * Memproses Update Profile
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date|before:today',
            'age' => 'nullable|integer|min:1|max:120',
            'gender' => 'nullable|string|in:Male,Female',
            'job' => 'nullable|string|max:255',
            'height' => 'nullable|numeric|min:50|max:300',
            'weight' => 'nullable|numeric|min:20|max:500',
            'target_weight' => 'nullable|numeric|min:20|max:500',
            'goal' => 'nullable|string|in:lose,gain,maintain',
            'intensity_level' => 'nullable|string|in:low,medium,high',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $user->update($request->only([
            'name', 'birth_date', 'age', 'gender', 'job',
            'height', 'weight', 'target_weight', 'goal', 'intensity_level'
        ]));

        return redirect()->route('dashboard')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update profile photo
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Delete old photo if exists
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        // Store new photo
        $path = $request->file('photo')->store('profile-photos', 'public');
        $user->update(['profile_photo' => $path]);

        return redirect()->route('dashboard')->with('success', 'Foto profil berhasil diperbarui!');
    }
}