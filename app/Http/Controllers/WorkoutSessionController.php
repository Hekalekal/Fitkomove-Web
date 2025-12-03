<?php

namespace App\Http\Controllers;

use App\Models\WorkoutSession;
use App\Models\WorkoutExercise;
use App\Models\WorkoutSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutSessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of workout sessions.
     */
    public function index()
    {
        $user = Auth::user();
        $sessions = $user->workoutSessions()
            ->with('exercises.sets')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('workouts.index', compact('sessions', 'user'));
    }

    /**
     * Show the form for creating a new workout session.
     */
    public function create()
    {
        return view('workouts.create');
    }

    /**
     * Store a newly created workout session.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $session = Auth::user()->workoutSessions()->create([
            'name' => $request->name,
            'notes' => $request->notes,
            'started_at' => now(),
        ]);

        return redirect()->route('workouts.track', $session)
            ->with('success', 'Sesi latihan dimulai!');
    }

    /**
     * Display the workout tracking interface.
     */
    public function track(WorkoutSession $workout)
    {
        $this->authorize('view', $workout);
        
        $workout->load('exercises.sets');
        
        return view('workouts.track', compact('workout'));
    }

    /**
     * Add exercise to workout session.
     */
    public function addExercise(Request $request, WorkoutSession $workout)
    {
        $this->authorize('update', $workout);

        $request->validate([
            'exercise_name' => 'required|string|max:255',
        ]);

        $order = $workout->exercises()->count();

        $exercise = $workout->exercises()->create([
            'exercise_name' => $request->exercise_name,
            'order' => $order,
        ]);

        // Create first set automatically
        $exercise->sets()->create([
            'set_number' => 1,
            'reps' => null,
            'weight' => null,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'exercise' => $exercise->load('sets'),
            ]);
        }

        return back()->with('success', 'Latihan ditambahkan!');
    }

    /**
     * Add set to exercise.
     */
    public function addSet(Request $request, WorkoutExercise $exercise)
    {
        $workout = $exercise->workoutSession;
        $this->authorize('update', $workout);

        $setNumber = $exercise->sets()->count() + 1;

        $set = $exercise->sets()->create([
            'set_number' => $setNumber,
            'reps' => null,
            'weight' => null,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'set' => $set,
            ]);
        }

        return back();
    }

    /**
     * Update set data.
     */
    public function updateSet(Request $request, WorkoutSet $set)
    {
        $workout = $set->exercise->workoutSession;
        $this->authorize('update', $workout);

        $set->update([
            'reps' => $request->reps,
            'weight' => $request->weight,
            'weight_unit' => $request->weight_unit ?? 'kg',
            'rest_seconds' => $request->rest_seconds,
            'is_completed' => $request->has('is_completed') || $request->input('is_completed'),
            'notes' => $request->notes,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'set' => $set,
            ]);
        }

        return back();
    }

    /**
     * Delete a set.
     */
    public function deleteSet(WorkoutSet $set)
    {
        $workout = $set->exercise->workoutSession;
        $this->authorize('update', $workout);

        $set->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back();
    }

    /**
     * Delete an exercise.
     */
    public function deleteExercise(WorkoutExercise $exercise)
    {
        $workout = $exercise->workoutSession;
        $this->authorize('update', $workout);

        $exercise->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back();
    }

    /**
     * Finish workout session.
     */
    public function finish(WorkoutSession $workout)
    {
        $this->authorize('update', $workout);

        $endTime = now();
        $startTime = $workout->started_at;
        
        // Calculate duration - ensure it's always positive
        $durationSeconds = abs($endTime->diffInSeconds($startTime));

        $workout->update([
            'ended_at' => $endTime,
            'total_duration_seconds' => $durationSeconds,
        ]);

        // Update user streak
        Auth::user()->updateStreak();

        return redirect()->route('workouts.show', $workout)
            ->with('success', 'Sesi latihan selesai! Streak Anda telah diperbarui.');
    }

    /**
     * Display the specified workout session.
     */
    public function show(WorkoutSession $workout)
    {
        $this->authorize('view', $workout);
        
        $workout->load('exercises.sets');
        
        return view('workouts.show', compact('workout'));
    }

    /**
     * Remove the specified workout session.
     */
    public function destroy(WorkoutSession $workout)
    {
        $this->authorize('delete', $workout);

        $workout->delete();

        return redirect()->route('workouts.index')
            ->with('success', 'Sesi latihan dihapus!');
    }
}
