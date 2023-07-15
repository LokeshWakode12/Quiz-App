<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'category',
        'option1',
        'option2',
        'option3',
        'option4',
        'answer',
    ];

    public $timestamps = false;
}
