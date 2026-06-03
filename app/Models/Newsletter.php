<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['subject', 'body', 'sent_at'])]
class Newsletter extends Model
{
    protected $cast = [
        'sent_at' => 'datetime'
    ];
}
