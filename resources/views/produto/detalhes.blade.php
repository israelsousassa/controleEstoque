@extends('layouts.app')

@section('content')


<div class="container">

        <h4>
            <ion-icon class=" icon-lista" src = "/icones/list-outline.svg" ></ion-icon> 
                Detalhes
        </h4>

        <div class="space-row"></div>

<table class="table  table-hover text-center table-borderless table-success rounded">
    <tr>
        <th>#</th>
        <th>Produto</th>
        <th>Marca</th>
        <th>Medida</th>
        <th>Descrição</th>
        <th>Qtde unidade (cx)</th>
        <th>Valor custo</th>
        <th>Qtde (cx)</th>
        <th>Qtde (un)</th>
        <th>Código de barra (un)</th>
        <th>Código de barra (cx)</th>
    </tr>
    <tr class="{{$p->qtdeun <= 10 ? 'table-danger' : '' }}">
        <td>{{ $p->id }}</td>
        <td>{{ $p->nome }}</td>
        <td>{{ $p->marca }}</td>
        <td>{{ $p->medida }}</td>
        <td>{{ $p->descricao}}</td>
        <td>{{ $p->uncaixa }}</td>
        <td>{{ $p->valcusto}}</td>
        <td>{{ $p->qtdecx }}</td>
        <td>{{ $p->qtdeun }}</td>
        <td>{{ $p->codebarra }}</td>
        <td>{{ $p->codebarracx }}</td>
    </tr>
</table>
</div>

@stop