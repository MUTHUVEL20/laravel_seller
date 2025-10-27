<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slrprofile extends Model
{
    use HasFactory;

    public $timestamps = false;

    // ✅ Allow mass assignment for these fields
    protected $fillable = [
        'sellerid',
        'address1',
        'address2',
        'landmark',
        'city',
        'state',
        'countryid',
        'primarycontact',
        'postalcode',
        'mobileno',
        'websiteurl',
        'businesscategory',
        'businessindustry',
        'locationlink',
        'taxname',
        'keywords',
        'description',
        'estdYear',
        'sonotify',
    ];

    protected $primaryKey = 'sellerid';

}
