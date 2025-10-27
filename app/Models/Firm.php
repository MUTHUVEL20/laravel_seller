<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    use HasFactory;

     protected $table = 'firms';
    protected $primaryKey = 'firmno';
    public $timestamps = false; // Because you don’t have created_at/updated_at

    protected $connection = 'dynamic'; // 👈 Dynamic connection name
}
