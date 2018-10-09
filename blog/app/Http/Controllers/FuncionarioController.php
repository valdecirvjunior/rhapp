<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Funcionario;
use App\Cargo;
use Image;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::get();
        return view('funcionarios.lista', ['funcionarios'=> $funcionarios]);
    }

    public function novo()
    {
        $cargos = Cargo::pluck('titulo', 'id')->toArray();
        return view('funcionarios.formulario', ['cargos'=>$cargos]);
    }

    public function salvar(Request $request)
    {
        $funcionario = new Funcionario();
        $request->all();
        $funcionario = $funcionario->create($request->all());
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            // $input['avatar'] = $avatar->getClientOriginalName(); 
            // $destinationPath = public_path('/uploads/avatars');
            // $avatar->move($destinationPath, $input['avatar']);
            // $funcionario->avatar = $input['avatar'];
            $filename = time() .'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save(public_path('/uploads/avatars/'.$filename));
            $funcionario->avatar = $filename;
            $funcionario->save();
        } 
        
        //$funcionario = $funcionario->create($request->all());

        \Session::flash("mensagem_sucesso", 'Funcionario cadastrado com sucesso!');
        return Redirect:: to('funcionarios/novo');
    }

}
