<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status', 'user_id', 'assigned_to'];

    // Görevi oluşturan kullanıcı ilişkisi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Görevin atandığı kullanıcı ilişkisi
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
