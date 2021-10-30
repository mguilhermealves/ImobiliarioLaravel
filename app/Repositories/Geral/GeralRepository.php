<?php
  namespace App\Repositories\Geral;

use Illuminate\Http\Request;
use App\Models\Geral;


class GeralRepository{


    static function getGeral(){
       return Geral::first();
    }

  }