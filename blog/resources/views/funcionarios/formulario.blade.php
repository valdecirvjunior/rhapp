@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informações do Funcionario
                    <a class="pull-right" href="{{ url('/funcionarios') }}">Lista</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    @if(Session::has('mensagem_sucesso'))
                        <div class="alert alert-success">{{ Session:: get('mensagem_sucesso')}} </div>
                    @endif



                    {!! Form::open(['url' => 'funcionarios/salvar', 'files' => true]) !!}
                        {!! Form::label('name', 'Nome') !!}
                        {!! Form::input('text', 'name', '', ['class' => 'form-control', 'autofocus', 'placeholder' => 'Nome']) !!}

                        {!! Form::label('idCargo', 'Cargo') !!}
                        {!! Form::select('idCargo', $cargos, '', ['class' => 'form-control', 'autofocus', 'placeholder' => 'Cargo']) !!}

                        {!! Form::label('idade', 'Idade') !!}
                        {!! Form::input('text', 'idade', '', ['class' => 'form-control', 'autofocus', 'placeholder' => 'Idade']) !!}

                        {!! Form::label('sexo', 'Sexo') !!}
                        {!! Form::input('text', 'sexo', '', ['class' => 'form-control', 'autofocus', 'placeholder' => 'Sexo']) !!}

                        {!! Form::label('endereco', 'Endereco') !!}
                        {!! Form::input('text', 'endereco', '', ['class' => 'form-control', 'autofocus', 'placeholder' => 'Endereco']) !!}
                    
                        {!! Form::label('avatar', 'Avatar') !!}<br>
                        {!! Form::file('avatar', array('class' => 'image')) !!}<br><br>

                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
