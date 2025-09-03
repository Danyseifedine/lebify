<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'developer_name',
        'url',
        'features',
        'icon',
        'description',
        'visibility',
        'status',
        'visitor_count',
        'codes'
    ];

    protected $casts = [
        'features' => 'array',
        'visitor_count' => 'integer',
        'codes' => 'array',
    ];


    public function generateIconColor()
    {
        $icons = ['primary', 'success', 'danger', 'warning', 'info'];
        return $icons[array_rand($icons)];
    }
}
