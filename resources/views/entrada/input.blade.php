@extends('layouts.app')
@section('content')
    <div class="container">

    @if(empty($entrada))

    <div class="alert alert-danger" role="alert">
        Você não possui nenhum entrada de produto.
    </div>

    @else

        <h4>
            <ion-icon class=" icon-lista" src = "/icones/list-outline.svg"></ion-icon> 
                Entrada de produtos
        </h4>

        <div class="space-row"></div>
        
            <table class="table class='table  table-hover text-center table-borderless table-active rounded'">
                <thead>
                    <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Marca</th>
                        <th scope="col">Medida</th>
                    <th scope="col">Entrada no estoque</th>
                    <th scope="col">Qtde</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entrada as $e)
                    <tr>
                        <td >{{ $e->nome }}</td>
                        <td>{{ $e->marca }}</td>
                        <td>{{ $e->medida }}</td>
                        <td>{{ $e->num_estoque }}</td>
                        <td>{{ $e->qtde_produto }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
    </div>
    @endif
@stop