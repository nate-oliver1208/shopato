@extends('templates.base-template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-center">
                        <h4 class="card-title mb-0">Entrar no Shopato</h4>
                    </div>
                    <div class="card-body">

                        @if (session('erro'))
                            <div class="alert alert-danger">
                                {{ session('erro') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.auth') }}">
                            @csrf

                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" required autofocus>
                            </div>

                            <div class="form-group">
                                <label>Senha:</label>
                                <input type="password" name="senha" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-warning btn-block">
                                <i class="fas fa-sign-in-alt"></i> Entrar
                            </button>
                        </form>

                        <div class="mt-3 text-center">
                            Não tem uma conta? <a href="{{ route('signin') }}">Cadastre-se aqui</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
