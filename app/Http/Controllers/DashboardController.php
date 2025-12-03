<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $schedules = $user->schedules()->today()->orderBy('scheduled_time')->get();
        $recentActivities = $user->activities()->orderBy('activity_date', 'desc')->limit(5)->get();
        $weeklyStats = ['calories' => $user->weekly_calories, 'duration' => $user->weekly_duration, 'activities' => $user->weekly_activities_count];
        $chartData = $this->getWeeklyChartData($user);
        $recommendations = $this->getRecommendations($user);
        $foodRecommendations = $this->getFoodRecommendations($user);
        $reminders = $user->reminders()->active()->get()->filter(fn($r) => $r->isActiveToday());
        $calendarData = $this->getMonthlyCalendarData($user);

        return view('dashboard', compact('user', 'schedules', 'recentActivities', 'weeklyStats', 'chartData', 'recommendations', 'foodRecommendations', 'reminders', 'calendarData'));
    }

    public function demo()
    {
        $user = (object) ['name' => 'Demo User', 'email' => 'demo@fitkomove.com', 'age' => 25, 'gender' => 'Male', 'job' => 'Developer', 'height' => 175, 'weight' => 70, 'bmi' => 22.9, 'bmi_category' => 'Normal', 'bmi_color' => '#22c55e', 'profile_photo_url' => null];
        $schedules = collect([(object) ['scheduled_time' => '08:00', 'title' => 'Lari Pagi', 'status' => 'completed', 'status_label' => 'Selesai']]);
        $recentActivities = collect([(object) ['type' => 'running', 'type_label' => 'Lari', 'type_icon' => 'bi-person-walking', 'title' => 'Morning Run', 'activity_date' => now()->subDay(), 'duration_minutes' => 30, 'calories_burned' => 350]]);
        $weeklyStats = ['calories' => 1850, 'duration' => 180, 'activities' => 5];
        $chartData = ['labels' => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'], 'calories' => [320, 450, 280, 0, 400, 200, 200], 'duration' => [30, 45, 25, 0, 40, 20, 20]];
        $recommendations = [['title' => 'Cardio', 'level' => 'Hard', 'duration' => '30 Min', 'type' => 'hiit', 'description' => 'High intensity']];
        $foodRecommendations = [['name' => 'Oatmeal', 'calories' => 350, 'type' => 'Sarapan', 'benefit' => 'Energi']];
        $reminders = collect([(object) ['title' => 'Workout!', 'type' => 'workout', 'type_icon' => 'bi-lightning', 'formatted_time' => '08:00']]);
        $isDemo = true;
        return view('dashboard', compact('user', 'schedules', 'recentActivities', 'weeklyStats', 'chartData', 'recommendations', 'foodRecommendations', 'reminders', 'isDemo'));
    }

    private function getWeeklyChartData($user): array
    {
        $days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
        $startOfWeek = now()->startOfWeek();
        $calories = [];
        $duration = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $dayActivities = $user->activities()->whereDate('activity_date', $date)->get();
            $calories[] = $dayActivities->sum('calories_burned') ?? 0;
            $duration[] = $dayActivities->sum('duration_minutes') ?? 0;
        }
        return ['labels' => $days, 'calories' => $calories, 'duration' => $duration];
    }

    private function getRecommendations($user): array
    {
        $bmiCategory = strtolower($user->bmi_category ?? 'normal');
        $all = [
            'normal' => [['title' => 'HIIT Workout', 'level' => 'Hard', 'duration' => '30 Min', 'type' => 'hiit', 'description' => 'Bakar kalori'], ['title' => 'Running', 'level' => 'Medium', 'duration' => '45 Min', 'type' => 'running', 'description' => 'Stamina']],
            'overweight' => [['title' => 'Cardio', 'level' => 'Medium', 'duration' => '45 Min', 'type' => 'cycling', 'description' => 'Bakar lemak']],
        ];
        return $all[$bmiCategory] ?? $all['normal'];
    }

    private function getFoodRecommendations($user): array
    {
        return [
            ['name' => 'Oatmeal dengan Buah', 'calories' => 350, 'type' => 'Sarapan', 'benefit' => 'Energi stabil'],
            ['name' => 'Salad Ayam Panggang', 'calories' => 450, 'type' => 'Makan Siang', 'benefit' => 'Protein tinggi'],
            ['name' => 'Ikan Salmon + Sayuran', 'calories' => 500, 'type' => 'Makan Malam', 'benefit' => 'Omega-3'],
            ['name' => 'Greek Yogurt', 'calories' => 150, 'type' => 'Snack', 'benefit' => 'Probiotik'],
        ];
    }

    public function updateProfile(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255', 'birth_date' => 'nullable|date', 'age' => 'nullable|integer', 'gender' => 'nullable|in:Male,Female', 'job' => 'nullable|string', 'height' => 'nullable|numeric', 'weight' => 'nullable|numeric', 'target_weight' => 'nullable|numeric', 'goal' => 'nullable|in:lose,gain,maintain', 'intensity_level' => 'nullable|in:low,medium,high']);
        $user = Auth::user();
        $user->update($request->only(['name', 'birth_date', 'age', 'gender', 'job', 'height', 'weight', 'target_weight', 'goal', 'intensity_level']));
        return redirect()->route('dashboard')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate(['photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048']);
        $user = Auth::user();
        if ($user->profile_photo) { Storage::disk('public')->delete($user->profile_photo); }
        $path = $request->file('photo')->store('profile-photos', 'public');
        $user->update(['profile_photo' => $path]);
        return redirect()->route('dashboard')->with('success', 'Foto profil berhasil diperbarui!');
    }

    private function getMonthlyCalendarData($user): array
    {
        $now = now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        $daysInMonth = $now->daysInMonth;
        $firstDayOfWeek = $startOfMonth->dayOfWeek;

        $activities = $user->activities()->whereBetween('activity_date', [$startOfMonth, $endOfMonth])->get()->groupBy(fn($a) => $a->activity_date->format('Y-m-d'));
        $schedules = $user->schedules()->whereBetween('scheduled_date', [$startOfMonth, $endOfMonth])->get()->groupBy(fn($s) => $s->scheduled_date->format('Y-m-d'));
        $recommendedDays = $this->generateRecommendedDays($user, $startOfMonth, $endOfMonth);

        $days = [];
        for ($i = 0; $i < $firstDayOfWeek; $i++) { $days[] = ['day' => null, 'date' => null, 'isToday' => false, 'activities' => [], 'schedules' => [], 'recommended' => null]; }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = $startOfMonth->copy()->addDays($day - 1);
            $dateKey = $date->format('Y-m-d');
            $dayActivities = $activities->get($dateKey, collect());
            $daySchedules = $schedules->get($dateKey, collect());
            $days[] = [
                'day' => $day, 'date' => $dateKey, 'isToday' => $date->isToday(), 'isPast' => $date->isPast() && !$date->isToday(),
                'activities' => $dayActivities->map(fn($a) => ['type' => $a->type, 'title' => $a->title, 'calories' => $a->calories_burned, 'icon' => $a->type_icon])->toArray(),
                'schedules' => $daySchedules->map(fn($s) => ['title' => $s->title, 'status' => $s->status, 'time' => $s->formatted_time])->toArray(),
                'recommended' => $recommendedDays[$dateKey] ?? null, 'hasActivity' => $dayActivities->count() > 0, 'hasSchedule' => $daySchedules->count() > 0,
            ];
        }
        return ['month' => $now->format('F'), 'year' => $now->format('Y'), 'monthNum' => $now->month, 'days' => $days, 'weekdays' => ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab']];
    }

    private function generateRecommendedDays($user, $startOfMonth, $endOfMonth): array
    {
        $goal = $user->goal ?? 'maintain';
        $intensity = $user->intensity_level ?? 'medium';
        $workoutsPerWeek = match($intensity) { 'low' => 2, 'medium' => 4, 'high' => 6, default => 3 };
        $workoutTypes = match($goal) {
            'lose' => [['type' => 'cardio', 'name' => 'Cardio', 'icon' => 'bi-heart-pulse'], ['type' => 'hiit', 'name' => 'HIIT', 'icon' => 'bi-fire'], ['type' => 'strength', 'name' => 'Strength', 'icon' => 'bi-trophy']],
            'gain' => [['type' => 'strength', 'name' => 'Strength', 'icon' => 'bi-trophy'], ['type' => 'strength', 'name' => 'Upper Body', 'icon' => 'bi-person-arms-up'], ['type' => 'strength', 'name' => 'Lower Body', 'icon' => 'bi-person-walking']],
            default => [['type' => 'cardio', 'name' => 'Cardio', 'icon' => 'bi-heart-pulse'], ['type' => 'strength', 'name' => 'Strength', 'icon' => 'bi-trophy'], ['type' => 'yoga', 'name' => 'Yoga', 'icon' => 'bi-peace']],
        };
        $recommendations = [];
        $current = $startOfMonth->copy();
        $workoutIndex = 0;
        while ($current <= $endOfMonth) {
            $dayOfWeek = $current->dayOfWeek;
            $shouldWorkout = match($workoutsPerWeek) { 2 => in_array($dayOfWeek, [2, 5]), 3 => in_array($dayOfWeek, [1, 3, 5]), 4 => in_array($dayOfWeek, [1, 2, 4, 5]), 5 => in_array($dayOfWeek, [1, 2, 3, 4, 5]), 6 => in_array($dayOfWeek, [1, 2, 3, 4, 5, 6]), default => in_array($dayOfWeek, [1, 3, 5]) };
            if ($shouldWorkout) { $recommendations[$current->format('Y-m-d')] = $workoutTypes[$workoutIndex % count($workoutTypes)]; $workoutIndex++; }
            $current->addDay();
        }
        return $recommendations;
    }
}