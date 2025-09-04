<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', auth()->user()->id);

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Sort by due date
        $orderBy = $request->get('order_by', 'created_at');
        $orderDirection = $request->get('order_direction', 'asc');
        
        if ($orderBy === 'due_date') {
            // Put null dates at the end
            $query->orderByRaw('due_date IS NULL, due_date ' . $orderDirection);
        } else {
            $query->orderBy($orderBy, $orderDirection);
        }

        $tasks = $query->get();

        // Get all available statuses for filter dropdown
        $statuses = [
            Task::STATUS_TODO,
            Task::STATUS_IN_PROGRESS,
            Task::STATUS_DONE
        ];

        return view('tasks.index', compact('tasks', 'statuses'));
    }

    public function create()
    {
        $statuses = [
            Task::STATUS_TODO,
            Task::STATUS_IN_PROGRESS,
            Task::STATUS_DONE
        ];

        return view('tasks.create', compact('statuses'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'nullable|string|in:' . implode(',', [Task::STATUS_TODO, Task::STATUS_IN_PROGRESS, Task::STATUS_DONE]),
            'due_date' => 'nullable|date|after_or_equal:today',
            ], [
                'title.required' => 'Judul tugas wajib diisi.',
                'title.max' => 'Judul tugas tidak boleh lebih dari 255 karakter.',
                'status.in' => 'Status yang dipilih tidak valid.',
                'due_date.date' => 'Format tanggal batas waktu tidak valid.',
                'due_date.after_or_equal' => 'Batas waktu tidak boleh kurang dari hari ini.',
            ]);

            Task::create([
                'user_id' => auth()->user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status ?: Task::STATUS_TODO, // Default to To-Do if not set
                'due_date' => $request->due_date,
            ]);

            return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dibuat!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal membuat tugas: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $task = Task::where('user_id', auth()->user()->id)->findOrFail($id);
        
        $statuses = [
            Task::STATUS_TODO,
            Task::STATUS_IN_PROGRESS,
            Task::STATUS_DONE
        ];

        return view('tasks.update', compact('task', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'nullable|string|in:' . implode(',', [Task::STATUS_TODO, Task::STATUS_IN_PROGRESS, Task::STATUS_DONE]),
                'due_date' => 'nullable|date',
            ], [
                'title.required' => 'Judul tugas wajib diisi.',
                'title.max' => 'Judul tugas tidak boleh lebih dari 255 karakter.',
                'status.in' => 'Status yang dipilih tidak valid.',
                'due_date.date' => 'Format tanggal batas waktu tidak valid.',
            ]);

            $task = Task::where('user_id', auth()->user()->id)->findOrFail($id);
            $task->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status ?: Task::STATUS_TODO,
                'due_date' => $request->due_date,
            ]);

            return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui tugas: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $task = Task::where('user_id', auth()->user()->id)->findOrFail($id);
            $task->delete();

            return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus tugas: ' . $e->getMessage()]);
        }
    }
}
