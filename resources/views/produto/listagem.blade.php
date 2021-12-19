    @extends('layouts.app')
    @section('content')
    
    <div class="container">
    @if(count($produtos) <= 0)
        <div class="alert alert-danger">
            Você não tem nenhum produto cadastro.
        </div>
    @else
        <h4>
            <ion-icon class=" icon-lista" src = "/icones/list-outline.svg" > </ion-icon> 
           Estoque de produtos
        </h4>
        <ion-icon class=" icon-item text-danger" src = "/icones/square-sharp.svg" > </ion-icon>
            <span class="badge"><h6><b>dez ou menos produtos no estoque</b></h6></span>
        
        <table class="table  table-hover text-center table-borderless table-success rounded">
            <th>#</th>
            <th>Produto</th>
            <th>Marca</th>
            <th>Medida</th>
            <th>Qtde</th>
            <th>Detalhe</th>
            <th>Excluir</th>
            <th>Alterar</th>
            
            @foreach ($produtos as $p)
                <tr class="{{$p->qtdeun <= 10 ? 'table-danger' : '' }}">
                    <th >{{ $p->id }}</th>
                    <td>{{ $p->nome }}</td>
                    <td>{{ $p->marca }}</td>
                    <td>{{ $p->medida }}</td>
                    <td>{{ $p->qtdeun }}</td>
                    <td>
                        <a href="{{ action('ProdutoController@mostra', $p->id) }}">
                            <ion-icon src = "/icones/search-outline.svg" size="small"></ion-icon> 
                        </a>
                    </td>
                    <td>
                        <a data-toggle="modal" data-target="#confirmacao">
                            <ion-icon src = "/icones/trash-outline.svg" size="small>"></ion-icon>
                        </a>
                    </td>
                    <td>
                        <a href="{{ action('ProdutoController@altera', $p->id) }}">
                            <ion-icon src = "/icones/sync-outline.svg" size="small"></ion-icon>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
         <!-- modal -->
            <div class="modal fade" id="confirmacao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    Deseja remover o produto?
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="{{ action('ProdutoController@remove', $p->id) }}">
                        <button type="button" class="btn btn-danger">Remover</button>
                    </a>
                </div>
                </div>
            </div>
            </div>
       
    @endif
    
    </div>
             
@stop
    