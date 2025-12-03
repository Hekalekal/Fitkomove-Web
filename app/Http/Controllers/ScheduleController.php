<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of schedules.
     */
    public function index()
    {
        $user = Auth::user();
        $schedules = $user->schedules()->upcoming()->paginate(10);
        
        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new schedule.
     */
    public function create()
    {
        return view('schedules.create');
    }

    /**
     * Store a newly created schedule.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'activity_type' => 'required|string|in:running,cycling,workout,swimming,walking,yoga,hiit,strength,other',
            'scheduled_date' => 'required|date|after_or_equal:today',
            'scheduled_time' => 'required|date_format:H:i',
            'duration_minutes' => 'nullable|integer|min:1',
            'notes' => 'nullable|string',
            'is_recurring' => 'boolean',
            'recurring_days' => 'nullable|string',
        ]);

        $user = Auth::user();
        $user->schedules()->create($validated);

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the schedule.
     */
    public function edit(Schedule $schedule)
    {
        $this->authorize('update', $schedule);
        return view('schedules.edit', compact('schedule'));
    }

    /**
     * Update the specified schedule.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $this->authorize('update', $schedule);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'activity_type' => 'required|string|in:running,cycling,workout,swimming,walking,yoga,hiit,strength,other',
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required|date_format:H:i',
            'duration_minutes' => 'nullable|integer|min:1',
            'notes' => 'nullable|string',
            'status' => 'nullable|in:pending,completed,skipped',
            'is_recurring' => 'boolean',
            'recurring_days' => 'nullable|string',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Remove the specified schedule.
     */
    public function destroy(Schedule $schedule)
    {
        $this->authorize('delete', $schedule);
        
        $schedule->delete();

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal berhasil dihapus!');
    }

    /**
     * Mark schedule as completed
     */
    public function complete(Schedule $schedule)
    {
        $this->authorize('update', $schedule);
        
        $schedule->update(['status' => 'completed']);

        return redirect()->back()
            ->with('success', 'Jadwal ditandai selesai!');
    }

    /**
     * Mark schedule as skipped
     */
    public function skip(Schedule $schedule)
    {
        $this->authorize('update', $schedule);
        
        $schedule->update(['status' => 'skipped']);

        return redirect()->back()
            ->with('success', 'Jadwal dilewati.');
    }
}
