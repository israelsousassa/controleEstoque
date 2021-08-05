@extends('layouts.app')

@section('content')
<div class="container">
    
<h1>Novo produto</h1>

@if(count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
           <li>{{ $error }}</li>
        @endforeach()
    </ul>
</div>
@endif

    
<form action="/produtos/adiciona" method="post">
    
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

    <div class="form-group ">
        <label>Nome</label>
        <input type="text" class="form-control" name="nome" value="{{ old('nome') }}">
    </div>
    <div class="form-group ">
        <label>Descricão</label>
        <input type="text" class="form-control" name="descricao" value="{{ old('descricao') }}">
    </div>
    <div class="form-group ">
        <label>Valor</label>
        <input type="text" class="form-control" name="valor" value="{{ old('valor') }}">
    </div>
    <div class="form-group ">
    <label>Quantidade</label>
    <input type="number" class="form-control" name="quantidade" value="{{ old('quantidade') }}">
    </div>
    <button type="submit" class="btn btn-primary btn-block ">Enviar</button>
</form>
</div>



 @stop