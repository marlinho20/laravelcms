@extends('adminlte::page')

@section('title', 'Configurações')

@section('content_header')
    <h1>Configurações</h1>
@endsection

@section('content')
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i>Ocorreu um erro.</h5>
            @foreach($errors->all() as $error)
                {{$error}}<br/>
            @endforeach    
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-check"></i>{{session('warning')}}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{route('settings.save')}}" method="POST" class="form-horizontal">
                @method('PUT')
                @csrf

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Título do Site</label>
                    <div class="col-sm-10"> 
                        <input type="text" name="title" value="{{ $settings['title'] }}" class="form-control" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sub-título do Site</label>
                    <div class="col-sm-10"> 
                        <input type="text" name="subtitle" value="{{ $settings['subtitle'] }}" class="form-control" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">E-mail para contato</label>
                    <div class="col-sm-10"> 
                        <input type="email" name="email" value="{{ $settings['email'] }}" class="form-control" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cor do Fundo</label>
                    <div class="col-sm-2"> 
                        <input type="color" name="bgcolor" value="{{ $settings['bgcolor'] }}" class="form-control" style="width:100px"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cor do Texto</label>
                    <div class="col-sm-2"> 
                        <input type="color" name="textcolor" value="{{ $settings['textcolor'] }}" class="form-control" style="width:100px"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"> 
                        <input type="submit"  value="Salvar" class="btn btn-success" />
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection