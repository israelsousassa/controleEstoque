@extends('layouts.app')

@section('content')

<form action="/produto/fornecedor/update" method="post">
    
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

    <div class="form-group mx-auto col-lg-8">
        <div class="novo">
            <ion-icon src="/icones/cube.svg" class="icon-add "></ion-icon>
            Atualizar fornecedor
        </div>

        <label>ID</label>
        <input type="number" class="form-control" name="id" value="{{ $a->id }}" readonly>

        <label>Nome</label>
        <input type="text" class="form-control" name="nome" value="{{ $a->nome }}">

        <label>E-mail</label>
        <input type="text" class="form-control" name="email" value="{{ $a->email }}"
         required>
  
        <label>Endereço</label>
        <input type="text" class="form-control" name="endereco" value="{{ $a->endereco }}">
        <br>
        
        <button type="submit" class="btn btn-success btn-block">Atualizar</button>
    </div>
    
</form>

@stop