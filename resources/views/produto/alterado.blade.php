@extends('layouts.app')

@section('content')

<form action="{{ action('ProdutoController@update', $p->id) }}" method="post">
    
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

    <div class="form-group mx-auto col-lg-8">
        <div class="novo">
            <ion-icon src="/icones/cube.svg" class="icon-add "></ion-icon>
            Atualizar produto
        </div>

        <label>Produto</label>
        <input type="text" class="form-control" name="nome" value="{{ $p->nome }}">

        <label>Marca</label>
        <input type="text" class="form-control" name="marca" value="{{ $p->marca }}"
         required>
  
        <label>Medida</label>
        <input type="text" class="form-control" name="medida" value="{{ $p->medida }}"
        ><br>
        
        <button type="submit" class="btn btn-success btn-block" >Atualizar</button>
    </div>
    
</form>

@stop