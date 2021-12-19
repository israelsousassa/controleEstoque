@extends('layouts.app')

@section('content')
<div class="container">

@if(count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
           <li>{{ $error }}</li>
        @endforeach()
    </ul>
</div>
@endif

@if(old('nome'))
    <div class="alert alert-success info text-center col-lg-8 mx-auto"> 
        O produto {{ old('nome') }} {{ old('marca') }} {{ old('medida') }}  foi <strong>adicionado</strong>.
    </div>
@endif

<form action="/produtos/adiciona" method="post">
    
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

    <div class="form-group mx-auto col-lg-8">
        <div class="novo">
            <ion-icon src="/icones/cube.svg" class="icon-add "></ion-icon>
            Novo produto
        </div>

        <label>Fornecedor</label>
        <select class="form-control" id="exampleFormControlSelect1" name='fornecedor'>
            <option selected>Selecione o fornecedor</option>
          @foreach ($fornecedor as $f)
            <option>{{ $f->nome }}</option>
          @endforeach
        </select>
        
        <label>Produto </label>
          <ion-icon src="/icones/alert-circle-sharp.svg" class="icon-form" size="small"></ion-icon>
        <select class="form-control"  name='nome' value="{{ old('nome') }}" required >
          
          <option selected>Cerveja</option>
          <option>Chope</option>
          <option>Bebidas mistas</option>
          <option>Energético</option>
          <option>Refrigerante</option>
          <option>Suco</option>
          <option>Isotônico</option>
          <option>Água</option>
          <option>Chá</option>
          <option>Cigarro</option>
          <option>Outro</option>
          
          
        </select>
    
        <label>Marca</label>
        <ion-icon src="/icones/alert-circle-sharp.svg" class="icon-form" size="small"></ion-icon>
        <input type="text" class="form-control" name="marca" value="{{ old('marca') }}" pattern="[A-Za-z]{3,15}"
         required>
        <small class="form-text text-muted">Informe a marca do produto.</small>

        <label>Medida</label>
        <input type="text" class="form-control" name="medida" value="{{ old('medida') }}"
         tabindex="3">
        <small class="form-text text-muted">Informe a medida de capacidade (se houver).</small>

        <label>Descrição</label>
        <input type="text" class="form-control" name="descricao" value="{{ old('descricao') }}"  tabindex="4" 
        pattern="[A-Za-z0-9]{25}">
        <small class="form-text text-muted">Informe a descrição do produto.</small>
    
        <label>Preço de custo (cx)</label>
        <input type="text" class="form-control" name="valcusto" value="{{ old('valcusto') }}"  tabindex="5">
        <small class="form-text text-muted">Informe o preço de custo da caixa.</small>


        <label>Unidade (cx)</label>
        <ion-icon src="/icones/alert-circle-sharp.svg" class="icon-form" size="small"></ion-icon>
        <input type="text" class="form-control" name="uncaixa" value="{{ old('uncaixa') }}" tabindex="6" 
         pattern="[0-9]{1,100}" required>
        <small class="form-text text-muted">Informe quantas unidades tem na caixa.</small>

        <label>Código de barra (cx)</label>
        <input type="text" class="form-control" name="codebarracx" value="{{ old('codebarracx') }}"
         pattern="[0-9]{5,13}" tabindex="7">
        <small class="form-text text-muted">Informe o código de barra da caixa.</small>

        <label>Código de barra (un)</label>
        <ion-icon src="/icones/alert-circle-sharp.svg" class="icon-form" size="small"></ion-icon>
        <input type="text" class="form-control" name="codebarra" value="{{ old('codebarra') }}"
        tabindex="8" pattern="[0-9]{5,13}" required>
        <small class="form-text text-muted">Informe o código de barra do produto.</small><br>

        <button type="submit" class="btn btn-success btn-block"  tabindex="9">Cadastrar</button>
    </div>
    
</form>
</div>



 @stop