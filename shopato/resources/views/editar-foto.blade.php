@extends('templates.base-template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-center">
                    <h4 class="card-title mb-0">Alterar Foto de Perfil</h4>
                </div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('erro'))
                        <div class="alert alert-danger">
                            {{ session('erro') }}
                        </div>
                    @endif

                    @php
                        $foto = '/imagens/usuarios/defaultuser.png';
                        foreach (['jpg', 'jpeg', 'png'] as $ext) {
                            if (file_exists(public_path("imagens/usuarios/usuario_" . Auth::id() . '.' . $ext))) {
                                $foto = "/imagens/usuarios/usuario_" . Auth::id() . '.' . $ext;
                                break;
                            }
                        }
                    @endphp

                    <div class="text-center mb-3">
                        <img src="{{ $foto }}" alt="Foto de Perfil" class="img-fluid rounded-circle" style="max-width: 150px;">
                        <p class="mt-2"><small>Foto atual</small></p>
                    </div>

                    <form method="POST" action="{{ route('profile.foto.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Nova foto de perfil (JPG/PNG, até 100KB, formato quadrado recomendado):</label>
                            <input type="file" name="foto" class="form-control-file" accept="image/png, image/jpeg, image/jpg" required>
                        </div>

                        <button type="submit" class="btn btn-warning btn-block">
                            <i class="fas fa-upload"></i> Enviar nova foto
                        </button>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="{{ route('profile') }}" class="text-secondary">
                            <i class="fas fa-arrow-left"></i> Voltar para o perfil
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
