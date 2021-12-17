    @extends('layouts.app')

    @section('content')
    <div class="container">
    <div class="row">
        <div class="col-sm-8">
                    @if(!empty($produto))     
                        <div class="alert alert-danger info text-center">  
                            <p> 
                                {{ $produto['qtdeun'] }} {{ $produto['unorcx'] }} {{ $produto['nome'] }} {{ $produto['marca'] }} {{ $produto['medida'] }} 
                                foi <b> removido(a)</b>!
                            </p>
                        </div>
                    @endif
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body ">
                    <form action="/produtos/remover" method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                    <div class="text-center add">
                            <ion-icon src="/icones/remove-circle-outline.svg" class="icon-add"></ion-icon> Saída
                    </div>
                    <label>Qtde</label>
                    <input type="number" class="form-control" name="qtdeun" value="1" tabindex="3" accesskey="x">
                    <label>Código de barra</label>
                    <input type="text" class="form-control" name="code" value="" autofocus tabindex="4"   accesskey="c" required ><br>
                    <button type="submit" class="btn btn-danger btn-block" tabindex="5">Remover</button><br>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>  

        
    @stop
    