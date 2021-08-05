@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="card-header">Painel - Produtos</div>

                    <div class="card-body">
                    
                        @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif 
                    
                        <div class="card-deck text-center">
                            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                <div class="card-header">Quantidade</div>
                                    <div class="card-body produtos"> 
                                        <h1> {{ DB::table('produtos')->sum('quantidade') }} </h1>
                                    </div>
                                </div>
                            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                                <div class="card-header">Valor total</div>
                                <div class="card-body produtos">
                                    <h1><?= DB::table('produtos')->sum('valor');?> Reais</h1>
                                    
                                </div>
                            </div>

                        
                        
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
