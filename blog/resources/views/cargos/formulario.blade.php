@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informações de Cargos
                    <a class="pull-right" href="{{ url('/cargos') }}">Lista</a>
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



                    {!! Form::open(['url' => 'cargos/salvar']) !!}
                        {!! Form::label('titulo', 'Titulo') !!}
                        {!! Form::input('text', 'titulo', '', ['class' => 'form-control', 'autofocus', 'placeholder' => 'Titulo']) !!}
                    
                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
