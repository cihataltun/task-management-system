@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Görevlerim</h1>
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Yeni Görev Ekle</a>
    <table class="table">
        <thead>
            <tr>
                <th>Görev Adı</th>
                <th>Açıklama</th>
                <th>Durum</th>
                <th>Atayan Kullanıcı</th>
                <th>Atanan Kullanıcı</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->name }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ ucfirst($task->status) }}</td>
                <!-- Görevi oluşturan kullanıcı -->
                <td>
                    @if($task->user)
                        {{ $task->user->name }}
                    @else
                        {{ 'Bilinmiyor' }}
                    @endif
                </td>
                <!-- Görev atanan kullanıcı -->
                <td>
                    @if($task->assignedUser)
                        {{ $task->assignedUser->name }}
                    @else
                        {{ Auth::user()->name }}
                    @endif
                </td>
                <td>
                    @if($task->user_id == Auth::id())
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm">Düzenle</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                        </form>
                    @endif
                    @if($task->status != 'completed' && ( $task->user_id == Auth::id() || $task->assigned_to == Auth::id()))
                        <form action="{{ route('tasks.complete', $task) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Tamamla</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
