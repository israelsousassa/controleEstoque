    @extends('layouts.app')
    @section('content')
        
    @if(empty($produtos))
        <div class="alert alert-danger">
            Você não tem nenhum produto cadastro.
        </div>
    @else
    <div class="container">
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
                            <ion-icon src = "/icones/search-outline.svg"></ion-icon> 
                        </a>
                    </td>
                    <td>
                        <a href="{{ action('ProdutoController@remove', $p->id) }}">
                            <ion-icon src = "/icones/trash-outline.svg"></ion-icon>
                        </a>
                    </td>
                    <td>
                        <a href="{{ action('ProdutoController@altera', $p->id) }}">
                            <ion-icon src = "/icones/sync-outline.svg"></ion-icon>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        
    @endif
    
    <div class="space-row"></div>
    
    <h4>
        <ion-icon class=" icon-lista" src = "/icones/list-outline.svg" > </ion-icon> 
        Entrada de produtos
    </h4><br>
    
    <?php
    
        $sql = DB::select('SELECT distinct nome,marca, medida FROM tb_entrada');
        $decode = json_decode(json_encode($sql),true);

        if(empty($decode)){
            echo '<div class="alert alert-secondary text-center" role="alert">';
                echo '<h5>Lista entrada sem <b>produtos</b>!</h5>';
            echo '</div>';
        }else{
   
        for ($x=0; $x <  1; $x++) { 
            $sql = DB::select('SELECT nome,medida,marca, count(marca) as num_venda, sum(qtde) as qtde_venda from tb_entrada 
            group by nome,medida,marca order by qtde_venda desc',[$decode[$x]['nome'],$decode[$x]['marca']]);
            $decode = json_decode(json_encode($sql),true);

  
    echo "<table class='table  table-hover text-center table-borderless table-active rounded'>";

    echo "<tr>";
    
        echo "<th>Produto</th>";
        echo "<th>Marca</th>";
        echo "<th>Medida</th>";
        echo "<th>Entrada</th>";
        echo "<th>Qtde </th>";
    echo "</tr>";
       foreach ($decode as $value) {
            echo "<tr>";
            echo "<td>" . $value['nome']. "</td>";
            echo "<td>". $value['marca']."</td> ";
            echo "<td>". $value['medida'] . "</td>";
            echo "<td>" . $value['num_venda'] . "</td>";
            echo "<td>" . $value['qtde_venda'] ."</td>";
            echo "</tr>";
       }
    
    echo "</table>";
        }
    }
    ?>

<div class="space-row"></div>
    
    <h4>
        <ion-icon class=" icon-lista" src = "/icones/list-outline.svg" > </ion-icon> 
        Saída de produtos
    </h4><br>
    
    <?php
    
        $sql = DB::select('SELECT distinct nome,marca, medida FROM tb_saida');
        $decode = json_decode(json_encode($sql),true);

        if(empty($decode)){
            echo '<div class="alert alert-secondary text-center" role="alert">';
                echo '<h5>Lista saída sem <b>produtos</b>!</h5>';
            echo '</div>';
        }else{
   
        for ($x=0; $x <  1; $x++) { 
            $sql = DB::select('SELECT nome,medida,marca, count(marca) as num_venda, sum(qtde) as qtde_venda from tb_saida 
            group by nome,medida,marca order by qtde_venda desc',[$decode[$x]['nome'],$decode[$x]['marca']]);
            $decode = json_decode(json_encode($sql),true);

  
    echo "<table class='table  table-hover text-center table-borderless table-active rounded'>";

    echo "<tr>";
    
        echo "<th>Produto</th>";
        echo "<th>Marca</th>";
        echo "<th>Medida</th>";
        echo "<th>Saída</th>";
        echo "<th>Qtde </th>";
    echo "</tr>";
       foreach ($decode as $value) {
            echo "<tr>";
            echo "<td>" . $value['nome']. "</td>";
            echo "<td>". $value['marca']."</td> ";
            echo "<td>". $value['medida'] . "</td>";
            echo "<td>" . $value['num_venda'] . "</td>";
            echo "<td>" . $value['qtde_venda'] ."</td>";
            echo "</tr>";
       }
    
    echo "</table>";
        }
    }
    ?>

 


    </div>


   

                   
@stop
    