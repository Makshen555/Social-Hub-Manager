<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioPublicacion extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'day', 'hour'];
    protected $table = 'schedule_posts';
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}