<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Tüm görevleri listeler (sadece giriş yapmış kullanıcının görevleri)
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $tasks = Auth::user()->tasks()->latest()->get();
        return view('tasks.index', compact('tasks'));
    }


    // Yeni görev oluşturma formunu gösterir
    public function create()
    {
        return view('tasks.create');
    }

    // Yeni görevi veritabanına kaydeder
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        Auth::user()->tasks()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Görev başarıyla oluşturuldu.');
    }

    // Belirli görevin düzenleme formunu gösterir
    public function edit(Task $task)
    {
        // Yetkisiz erişimi engelle
        if ($task->user_id != Auth::id()) {
            abort(403);
        }
        return view('tasks.edit', compact('task'));
    }

    // Görevi günceller
    public function update(Request $request, Task $task)
    {
        if ($task->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|max:255',
        ]);

        $task->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Görev güncellendi.');
    }

    // Görevi siler
    public function destroy(Task $task)
    {
        if ($task->user_id != Auth::id()) {
            abort(403);
        }
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Görev silindi.');
    }

    // Görevi tamamlanmış olarak işaretler
    public function complete(Task $task)
    {
        if ($task->user_id != Auth::id()) {
            abort(403);
        }
        $task->update(['status' => 'completed']);
        return redirect()->route('tasks.index')->with('success', 'Görev tamamlandı.');
    }
}
