<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CargosController extends Controller
{
    public function index()
    {
        $cargos = Cargo::get();
        return view('cargos.lista', ['cargos'=> $cargos]);
    }

    public function novo()
    {
        return view('cargos.formulario');
    }

    public function salvar(Request $request)
    {
        $cargo = new Cargo();
        $cargo = $cargo->create($request->all());

        \Session::flash("mensagem_sucesso", 'Cargo cadastrado com sucesso!');
        return Redirect:: to('cargos/novo');
    }

}
