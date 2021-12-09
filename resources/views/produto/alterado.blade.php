@extends('layouts.app')

@section('content')

<form action="/produtos/update" method="post">
    
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

    <div class="form-group mx-auto col-lg-8">
        <div class="novo">
            <ion-icon src="/icones/cube.svg" class="icon-add "></ion-icon>
            Atualizar produto
        </div>

        <label>ID</label>
        <input type="text" class="form-control" name="id" value="{{ $p->id }}" readonly>

        <label>Produto</label>
        <input type="text" class="form-control" name="nome" value="{{ $p->nome }}">

        <label>Marca</label>
        <input type="text" class="form-control" name="marca" value="{{ $p->marca }}"
         tabindex="2" required>
  
        <label>Medida</label>
        <input type="text" class="form-control" name="medida" value="{{ $p->medida }}"
         tabindex="3"><br>
        
        <button type="submit" class="btn btn-success btn-block"  tabindex="9">Atualizar</button>
    </div>
    
</form>

@stop