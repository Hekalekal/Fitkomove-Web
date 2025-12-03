<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of reminders.
     */
    public function index()
    {
        $user = Auth::user();
        $reminders = $user->reminders()->orderBy('reminder_time')->get();
        
        return view('reminders.index', compact('reminders'));
    }

    /**
     * Show the form for creating a new reminder.
     */
    public function create()
    {
        return view('reminders.create');
    }

    /**
     * Store a newly created reminder.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'nullable|string',
            'type' => 'required|in:workout,rest,hydration,meal,custom',
            'reminder_time' => 'required|date_format:H:i',
            'days' => 'nullable|array',
            'days.*' => 'in:mon,tue,wed,thu,fri,sat,sun',
        ]);

        // Convert days array to comma-separated string
        if (isset($validated['days'])) {
            $validated['days'] = implode(',', $validated['days']);
        }

        $user = Auth::user();
        $user->reminders()->create($validated);

        return redirect()->route('reminders.index')
            ->with('success', 'Pengingat berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the reminder.
     */
    public function edit(Reminder $reminder)
    {
        $this->authorize('update', $reminder);
        return view('reminders.edit', compact('reminder'));
    }

    /**
     * Update the specified reminder.
     */
    public function update(Request $request, Reminder $reminder)
    {
        $this->authorize('update', $reminder);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'nullable|string',
            'type' => 'required|in:workout,rest,hydration,meal,custom',
            'reminder_time' => 'required|date_format:H:i',
            'days' => 'nullable|array',
            'days.*' => 'in:mon,tue,wed,thu,fri,sat,sun',
            'is_active' => 'boolean',
        ]);

        // Convert days array to comma-separated string
        if (isset($validated['days'])) {
            $validated['days'] = implode(',', $validated['days']);
        } else {
            $validated['days'] = null;
        }

        $reminder->update($validated);

        return redirect()->route('reminders.index')
            ->with('success', 'Pengingat berhasil diperbarui!');
    }

    /**
     * Remove the specified reminder.
     */
    public function destroy(Reminder $reminder)
    {
        $this->authorize('delete', $reminder);
        
        $reminder->delete();

        return redirect()->route('reminders.index')
            ->with('success', 'Pengingat berhasil dihapus!');
    }

    /**
     * Toggle reminder active status
     */
    public function toggle(Reminder $reminder)
    {
        $this->authorize('update', $reminder);
        
        $reminder->update(['is_active' => !$reminder->is_active]);

        $status = $reminder->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()
            ->with('success', "Pengingat berhasil {$status}!");
    }

    /**
     * Get active reminders for today (API endpoint for notifications)
     */
    public function todayReminders()
    {
        $user = Auth::user();
        $reminders = $user->reminders()
            ->active()
            ->get()
            ->filter(fn($r) => $r->isActiveToday())
            ->map(function($r) {
                return [
                    'id' => $r->id,
                    'title' => $r->title,
                    'message' => $r->message,
                    'type' => $r->type,
                    'type_icon' => $r->type_icon,
                    'type_label' => $r->type_label,
                    'reminder_time' => date('H:i', strtotime($r->reminder_time)),
                    'formatted_time' => $r->formatted_time,
                    'is_active' => $r->is_active,
                ];
            })
            ->values();

        return response()->json($reminders);
    }
}
