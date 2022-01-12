@extends('layouts.app')
@section('content')

<div class="container">
    <div class="mx-auto col-lg-12">
  <div class="d-flex justify-content-end">      
    <button type="button" class="btn btn-success " data-toggle="modal" data-target="#exampleModal">
      <ion-icon src="/icones/person-sharp.svg" class="icon-add-for"></ion-icon> Cadastrar fornecedor
    </button>
  </div>
</div><br>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
     
        <h5 class="modal-title" id="exampleModalLabel"> 
          <ion-icon src="/icones/person-sharp.svg" class="icon-modal"></ion-icon> 
          Cadastrar fornecedor
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/produtos/adiciona/fornecedor" method="post">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                
                <label>Nome</label>
                <ion-icon src="/icones/alert-circle-sharp.svg" class="icon-form" size="small"></ion-icon>
                <input type="text" class="form-control" name="nome" pattern="[A-Za-z]{1,20}" required >
                <small class="form-text text-muted">Insira o nome do fornecedor/distribuidor.</small>
                <label>Telefone</label>
                <input type="tel" class="form-control" name="telefone" pattern="[0-9]{8,11}" required >
                <small class="form-text text-muted">Insira o número do telefone do fornecedor/distribuidor.</small>
                <label>Email</label>
                <input type="email" class="form-control" name="email">
                <small class="form-text text-muted">Insira o e-mail do fornecedor/distribuidor.</small>
                <label>Endereço</label>
                <textarea class="form-control" name="endereco" pattern="[A-Za-z0-9]{1,100}" required ></textarea>
                <small class="form-text text-muted">Insira o endereço do fornecedor/distribuidor.</small>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                <input type="submit" class="btn btn-success" value="Cadastrar">
              </div>  
         </form>
      </div>
      
    </div>
  </div>
</div>

@if(count($fornecedor) <= 0)

        <div class="alert alert-danger">
            Você não tem nenhum fornecedor cadastro.
        </div>

@else
        <h4>
            <ion-icon class="icon-lista" src = "/icones/people-sharp.svg" > </ion-icon> 
            Fornecedores
        </h4><br>

      <table class="table text-center">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Telefone</th>
              <th scope="col">E-mail</th>
              <th scope="col">Endereço</th>
              <th scope="col">Alterar</th>
              <th scope="col">Remover</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($fornecedor as $f)
              <tr>
                <td >{{ $f->nome }}</td>
                <td>{{ $f->telefone }}</td>
                <td>{{ $f->email }}</td>
                <td>{{ $f->endereco }}</td>
                <td>
                  <a href="{{ action('FornecedorController@alterar', $f->id) }}">
                      <ion-icon src = "/icones/sync-outline.svg" size="small"></ion-icon>
                  </a> 
                </td>
                <td>
                  <a data-toggle="modal" data-target="#confirmacao">
                    <ion-icon src="/icones/trash-outline.svg" size="samll"></ion-icon>
                  </a>
                  
                </td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </div>

   
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
            Deseja remover o fornecedor?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <a href="{{ action('FornecedorController@remover', $f->id) }}">
                <button type="button" class="btn btn-danger">Remover</button>
              </a>
          </div>
        </div>
      </div>
    </div>
  
  @endif
@stop