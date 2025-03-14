<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Kullanıcının oluşturduğu veya kendisine atanan tüm görevleri listeler
    public function index()
    {
        $userId = Auth::id();
        $tasks = Task::where('user_id', $userId)
                    ->orWhere('assigned_to', $userId)
                    ->latest()
                    ->get();
        return view('tasks.index', compact('tasks'));
    }

    // Yeni görev oluşturma formunu gösterir (atanabilecek kullanıcı listesini da gönderiyoruz)
    public function create()
    {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    // Yeni görevi veritabanına kaydeder
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|max:255',
            'assigned_to'  => 'nullable|exists:users,id',
        ]);

        // Görevi oluşturan kullanıcı, logged-in user’dır.
        Auth::user()->tasks()->create([
            'name'         => $request->name,
            'description'  => $request->description,
            'assigned_to'  => $request->assigned_to,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Görev başarıyla oluşturuldu.');
    }

    // Belirli görevin düzenleme formunu gösterir (sadece görev yaratıcısına izin veriyoruz)
    public function edit(Task $task)
    {
        if ($task->user_id != Auth::id()) {
            abort(403);
        }
        $users = User::all();
        return view('tasks.edit', compact('task', 'users'));
    }

    // Görevi günceller
    public function update(Request $request, Task $task)
    {
        if ($task->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name'         => 'required|max:255',
            'assigned_to'  => 'nullable|exists:users,id',
        ]);

        $task->update([
            'name'         => $request->name,
            'description'  => $request->description,
            'assigned_to'  => $request->assigned_to,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Görev güncellendi.');
    }

    // Görevi siler (sadece yaratıcısına izin verilir)
    public function destroy(Task $task)
    {
        if ($task->user_id != Auth::id()) {
            abort(403);
        }
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Görev silindi.');
    }

    // Görevi tamamlanmış olarak işaretler (görev yaratıcısı veya atanan kullanıcı tamamlayabilir)
    public function complete(Task $task)
    {
        $userId = Auth::id();
        if ($task->user_id != $userId && $task->assigned_to != $userId) {
            abort(403);
        }
        $task->update(['status' => 'completed']);
        return redirect()->route('tasks.index')->with('success', 'Görev tamamlandı.');
    }
}
