@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Funcionarios
                    <a class="pull-right" href="{{ url('/funcionarios/novo') }}">Novo Funcionario</a>
                    <a class="pull-right" href="{{ url('/funcionarios/download') }}">Download</a>
                </div>

                <div class="card-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif -->

                    <table class="table">
                        <th>Avatar</th>
                        <th>Id</th>
                        <th>idCargo</th>
                        <th>Nome</th>
                        <th>Idade</th>
                        <th>Sexo</th>
                        <th>Endereco</th>
                        <tbody>
                            @foreach($funcionarios as $funcionario)
                            <tr>
                                <td><img src="/uploads/avatars/{{ $funcionario->avatar }}" style="width:50px; height: 50px"></td>
                                <td>{{ $funcionario->id }}</td>
                                <td>{{ $funcionario->idCargo }}</td>
                                <td>{{ $funcionario->name }}</td>
                                <td>{{ $funcionario->idade }}</td>
                                <td>{{ $funcionario->sexo }}</td>
                                <td>{{ $funcionario->endereco }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
