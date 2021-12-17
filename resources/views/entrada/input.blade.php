@extends('layouts.app')
@section('content')
    <div class="container">
        <h4>
            <ion-icon class=" icon-lista" src = "/icones/list-outline.svg" > </ion-icon> 
                Entrada de produtos
        </h4>

        <div class="space-row"></div>

        @if(empty($entrada))
            <div class="alert alert-secondary text-center" role="alert">
                <h5>Lista sem <b>produtos</b>!</h5>
            </div>
        @else
            <table class="table class='table  table-hover text-center table-borderless table-active rounded'">
                <thead>
                    <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Marca</th>
                        <th scope="col">Medida</th>
                    <th scope="col">Venda</th>
                    <th scope="col">Qtde</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entrada as $e)
                    <tr>
                        <td >{{ $e->nome }}</td>
                        <td>{{ $e->marca }}</td>
                        <td>{{ $e->medida }}</td>
                        <td>{{ $e->num_venda }}</td>
                        <td>{{ $e->qtde_venda }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@stop