<?php

namespace App\Models\POP;

use App\Models\POP;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutineCheck extends Model
{
    use HasFactory;

    protected $guarded = [];

    //To cast attachment into array data type
    protected $casts = [
        'attachments' => 'array',
    ];

    public function pop()
    {
        return $this->belongsTo(POP::class);
    }
}
