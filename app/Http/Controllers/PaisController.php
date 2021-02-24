<?php

namespace App\Http\Controllers;

use App\Pais;

class PaisController extends Controller
{
    public function index()
    {
        $paises = Pais::orderBy('nome')->get();
        return response($paises);
    }
}
