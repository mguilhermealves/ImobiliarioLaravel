<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $guarded = [];

    public $title = 'Newsletter';
    public $update = false;
    public $hasOrder = false;
    public $hasForm = false;
    public $listagem = [
      'email',
    ];
}
