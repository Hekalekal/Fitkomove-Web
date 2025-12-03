<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of activities.
     */
    public function index()
    {
        $user = Auth::user();
        $activities = $user->activities()->orderBy('activity_date', 'desc')->paginate(10);
        
        return view('activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new activity.
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created activity.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:running,cycling,workout,swimming,walking,yoga,hiit,strength,other',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'activity_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'duration_minutes' => 'nullable|integer|min:1',
            'distance_km' => 'nullable|numeric|min:0',
            'calories_burned' => 'nullable|numeric|min:0',
            'pace' => 'nullable|string',
            'heart_rate_avg' => 'nullable|integer|min:40|max:220',
            'notes' => 'nullable|string',
        ]);

        $user = Auth::user();
        
        // Auto-calculate calories if not provided
        if (empty($validated['calories_burned']) && !empty($validated['duration_minutes'])) {
            $weight = $user->weight ?? 70;
            $validated['calories_burned'] = Activity::estimateCalories(
                $validated['type'],
                $validated['duration_minutes'],
                $weight
            );
        }

        $user->activities()->create($validated);

        return redirect()->route('activities.index')
            ->with('success', 'Aktivitas berhasil ditambahkan!');
    }

    /**
     * Display the specified activity.
     */
    public function show(Activity $activity)
    {
        $this->authorize('view', $activity);
        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the activity.
     */
    public function edit(Activity $activity)
    {
        $this->authorize('update', $activity);
        return view('activities.edit', compact('activity'));
    }

    /**
     * Update the specified activity.
     */
    public function update(Request $request, Activity $activity)
    {
        $this->authorize('update', $activity);

        $validated = $request->validate([
            'type' => 'required|string|in:running,cycling,workout,swimming,walking,yoga,hiit,strength,other',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'activity_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'duration_minutes' => 'nullable|integer|min:1',
            'distance_km' => 'nullable|numeric|min:0',
            'calories_burned' => 'nullable|numeric|min:0',
            'pace' => 'nullable|string',
            'heart_rate_avg' => 'nullable|integer|min:40|max:220',
            'notes' => 'nullable|string',
        ]);

        $activity->update($validated);

        return redirect()->route('activities.index')
            ->with('success', 'Aktivitas berhasil diperbarui!');
    }

    /**
     * Remove the specified activity.
     */
    public function destroy(Activity $activity)
    {
        $this->authorize('delete', $activity);
        
        $activity->delete();

        return redirect()->route('activities.index')
            ->with('success', 'Aktivitas berhasil dihapus!');
    }

    /**
     * Get activity data for charts (API endpoint)
     */
    public function chartData(Request $request)
    {
        $user = Auth::user();
        $period = $request->get('period', 'week'); // week or month

        if ($period === 'month') {
            $startDate = now()->startOfMonth();
            $endDate = now()->endOfMonth();
        } else {
            $startDate = now()->startOfWeek();
            $endDate = now()->endOfWeek();
        }

        $activities = $user->activities()
            ->whereBetween('activity_date', [$startDate, $endDate])
            ->selectRaw('activity_date, SUM(calories_burned) as total_calories, SUM(duration_minutes) as total_duration, COUNT(*) as count')
            ->groupBy('activity_date')
            ->orderBy('activity_date')
            ->get();

        return response()->json([
            'labels' => $activities->pluck('activity_date')->map(fn($d) => $d->format('d M')),
            'calories' => $activities->pluck('total_calories'),
            'duration' => $activities->pluck('total_duration'),
            'count' => $activities->pluck('count'),
        ]);
    }
}
