<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContents extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'items', 'status', 'version'];


    protected $casts = [
        'items' => 'array',
        'status' => 'enum:active,inactive',
        'version' => 'integer',
    ];



    public function increaseVersion()
    {
        $this->version++;
        $this->save();
    }
}
