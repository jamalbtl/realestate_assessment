<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'location',
    ];

    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'property_id');
    }
}
