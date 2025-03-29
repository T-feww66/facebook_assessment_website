<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;  // Import Notifiable
use Illuminate\Database\Eloquent\Factories\HasFactory;  // Import HasFactory

class NguoiDung extends Authenticatable
{
    use HasFactory, Notifiable;  // Sử dụng HasFactory và Notifiable

    protected $table = 'users';
    protected $primaryKey = "id";
}
