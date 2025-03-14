@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Yeni Görev Oluştur</h1>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Görev Adı</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Açıklama</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="assigned_to">Görev Atanacak Kullanıcı</label>
            <select name="assigned_to" class="form-control">
                <option value="">-- Kendinize veya başka birini seçin --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Oluştur</button>
    </form>
</div>
@endsection
