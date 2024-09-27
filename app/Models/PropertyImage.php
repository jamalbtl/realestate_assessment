<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_path',
        'property_id',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
