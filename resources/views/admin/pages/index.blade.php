@extends('adminlte::page')

@section('title', 'Páginas')

@section('content_header')
    <h1>
        Minhas Páginas
        <a href="{{ route('pages.create') }}" class="btn btn-sm btn-success">Novo Página</a>
    </h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th style="width:50px">ID</th>
                    <th>Title</th>
                    <th style="width:200px">Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($pages as $page)
                <tr>
                    <td>{{$page->id}}</td>
                    <td>{{$page->title}}</td>
                    <td>
                        <a href="{{ '/'.$page->slug }}" target="_blank" class="btn btn-sm btn-success">Ver</a>

                        <a href="{{ route('pages.edit', ['page'=>$page->id]) }}" class="btn btn-sm btn-info">Editar</a>
                        
                        <form class="d-inline" method="POST" action="{{ route('pages.destroy', ['page'=>$page->id]) }}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{ $pages->links() }}

@endsection