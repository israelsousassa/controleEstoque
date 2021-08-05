    @extends('layouts.app')

    @section('content')
        
            @if(empty($produtos))
                <div class="alert alert-danger">
                    Você não tem nenhum produto cadastro.
                </div>
            @else
            <div class="container">



                <h1>Listagem de produtos</h1>
                <table class="table table-striped table-bordered table-hover">
            
            @foreach ($produtos as $p)
                <tr class="{{$p->quantidade<=1 ? 'table-danger' : '' }}">
                    <td>{{$p->nome}}</td>
                    <td>{{$p->valor}}</td>
                    <td>{{$p->descricao}}</td>
                    <td>{{$p->quantidade}}</td>
                    <td>
                        <a href="{{ action('ProdutoController@mostra', $p->id) }}">
                            <ion-icon name="search-outline"></ion-icon> 
                        </a>
                    </td>
                    <td>
                        <a href="{{ action('ProdutoController@remove', $p->id) }}">
                            <ion-icon name="trash-outline"></ion-icon>
                        </a>
                    </td>
                    <td>
                        <a href="{{ action('ProdutoController@altera', $p->id) }}">
                            <ion-icon name="sync-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        @endif
        <h4>
            <span class="float-right badge bg-danger text-light">
                um ou menos itens no estoque
            </span>
        </h4>
        @if(old('nome'))
            <div class="alert alert-success info">
                <strong>Sucesso!</strong> 
                O produto {{ old('nome') }} foi adicionado.
            </div>
</div>
        @endif    
    @stop
    