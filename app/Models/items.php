<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    use HasFactory;

     protected $table = 'items';
    protected $primaryKey = 'itemno';
    public $timestamps = false; // Because you don’t have created_at/updated_at

    protected $connection = 'dynamic'; // 👈 Dynamic connection name
}
