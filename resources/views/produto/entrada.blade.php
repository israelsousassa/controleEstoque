@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-8">
                    @if(old('code'))
                         <?php
                                $codecx =  DB::select('SELECT codebarracx FROM tb_produtos WHERE codebarracx=?',[old('code')]);
                                $sql = DB::select('SELECT * FROM tb_produtos WHERE codebarra = ? OR codebarracx = ?',
                                [old('code'),old('code')]);
                                $decode = json_decode(json_encode($sql),true);
                                if(empty($codecx)){

                                    $insert = DB::insert('INSERT INTO tb_entrada(
                                    nome,
                                    marca,
                                    medida,
                                    qtde
                                    ) values(?,?,?,?)',
                                [
                                    $decode[0]['nome'],
                                    $decode[0]['marca'],
                                    $decode[0]['medida'],
                                    old('qtdeun')
                                ]);
                                    
                                    echo '<div class="alert alert-success info text-center">';
                                    
                                    echo  old('qtdeun') . ' ' . $decode[0]['nome'] . ' ' . $decode[0]['marca'] 
                                    . ' ' . $decode[0]['medida'] . ' foi <b>adicionado(a)</b>!';

                                    echo '</div>';
                                    
                                }else{
                                    $result = old('qtdeun') * $decode[0]['uncaixa']; 
                                    $insert = DB::insert('INSERT INTO tb_entrada(
                                        nome,
                                        marca,
                                        medida,
                                        qtde
                                        ) values(?,?,?,?)',
                                    [
                                        $decode[0]['nome'],
                                        $decode[0]['marca'],
                                        $decode[0]['medida'],
                                        $result
                                    ]);
                                    $result = $decode[0]['uncaixa'] * old('qtdeun');

                                    echo  '<div class="alert alert-success info text-center">';
                                    
                                    echo  old('qtdeun') . ' ' . 'caixa de ' . $decode[0]['nome'] . ' ' . $decode[0]['marca'] 
                                    . ' ' . $decode[0]['medida'] . ' com ' . $result .' unidades foi <b>adicionado(a)</b>!';

                                    echo '</div>';
                                    

                                }
                            ?>
                    @endif
                  
                    
                    <?php
                        
                       
                    ?> 
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
                    <input type="number" class="form-control" name="qtdeun" value="1" tabindex="3" accesskey="x">
                    <label>Código de barra</label>
                    <input type="text" class="form-control" name="code" value="" autofocus tabindex="4"   accesskey="c" required ><br>
                    <button type="submit" class="btn btn-success btn-block" tabindex="5">Adicionar</button><br>
                    </form>
                </div>
            </div>
        </div>
    </div>  
          
               
</div>


@stop