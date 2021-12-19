@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-8">

            @if(!empty($produto))     
                <div class="alert alert-success info text-center">  
                   <p> 
                       {{ $produto['qtdeun'] }} {{ $produto['unorcx'] }} {{ $produto['nome'] }} {{ $produto['marca'] }} {{ $produto['medida'] }} 
                       foi <b> adicionado(a)</b>!
                   </p>
                </div>
            @endif
      
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body ">
                    <form action="/produtos/inseri" method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                    <div class="text-center add">
                            <ion-icon src="/icones/add-circle-outline.svg" class="icon-add"></ion-icon> Entrada
                    </div>
                    <label>Qtde</label>
                    <input type="number" class="form-control" name="qtdeun" value="1{{ old('qtdeun') }}" >
                    <label>Código de barra</label>
                    <input type="number" class="form-control" name="code" autofocus required ><br>
                    <button type="submit" class="btn btn-success btn-block">Adicionar</button><br>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</div>


@stop