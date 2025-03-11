@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Görevi Düzenle</h1>
    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Görev Adı</label>
            <input type="text" name="name" class="form-control" value="{{ $task->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Açıklama</label>
            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Güncelle</button>
    </form>
</div>
@endsection
