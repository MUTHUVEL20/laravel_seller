<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seller extends Model
{
    use HasFactory;


       // Disable timestamps if your table doesn't have created_at and updated_at
    public $timestamps = false;

       // ✅ Tell Laravel the primary key column name
    protected $primaryKey = 'sellerid';

    // Define fillable fields
    protected $fillable = [
        'sellername',
        'mailid',
        'adminpw',
    ];

    // Hide password when returning JSON
    protected $hidden = [
        'adminpw',
    ];
}
