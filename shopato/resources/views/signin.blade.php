@extends('templates.base-template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-center">
                    <h4 class="card-title mb-0">Criar uma conta no Shopato</h4>
                </div>

                <div class="card-body">

                    @if (session('erro'))
                        <div class="alert alert-danger">{{ session('erro') }}</div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('signin.store') }}" enctype="multipart/form-data" id="formCadastro">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nome</label>
                                <input type="text" name="nome" class="form-control" maxlength="255" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Sobrenome</label>
                                <input type="text" name="sobrenome" class="form-control" maxlength="255" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" maxlength="255" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Senha</label>
                                <input type="password" name="senha" class="form-control" minlength="5" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>CPF</label>
                                <input type="text" name="cpf" id="cpf" class="form-control" pattern="\d{11}" title="Informe 11 dígitos" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>CEP</label>
                                <input type="text" name="cep" class="form-control" maxlength="9" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Rua</label>
                                <input type="text" name="rua" class="form-control" maxlength="255" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Bairro</label>
                                <input type="text" name="bairro" class="form-control" maxlength="255" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Cidade</label>
                                <input type="text" name="cidade" class="form-control" maxlength="255" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>UF</label>
                                <input type="text" name="uf" class="form-control" maxlength="2" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" name="telefone" id="telefone" class="form-control" pattern="\d{8,15}" title="Informe de 8 a 15 dígitos" required>
                        </div>

                        <div class="form-group">
                            <label>Foto de Perfil (opcional, JPG/PNG até 100KB)</label>
                            <input type="file" name="foto" id="foto" class="form-control-file" accept="image/png, image/jpeg, image/jpg">
                            <small id="fotoHelp" class="form-text text-muted"></small>
                        </div>

                        <button type="submit" class="btn btn-warning btn-block">
                            <i class="fas fa-user-plus"></i> Cadastrar
                        </button>
                    </form>

                    <div class="mt-3 text-center">
                        Já tem uma conta? <a href="{{ route('login') }}">
                            Entre aqui
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Validação JS --}}
<script>
document.getElementById('foto').addEventListener('change', function() {
    const file = this.files[0];
    const help = document.getElementById('fotoHelp');

    if (file && file.size > 100 * 1024) {
        help.textContent = "A imagem excede 100KB. Escolha outra.";
        this.value = '';
    } else {
        help.textContent = '';
    }
});

document.getElementById('formCadastro').addEventListener('submit', function(e) {
    const cpf = document.getElementById('cpf').value;
    const telefone = document.getElementById('telefone').value;

    if (!/^\d{11}$/.test(cpf)) {
        alert('O CPF deve conter exatamente 11 dígitos.');
        e.preventDefault();
        return;
    }

    if (!/^\d{8,15}$/.test(telefone)) {
        alert('O telefone deve conter entre 8 e 15 dígitos.');
        e.preventDefault();
        return;
    }
});
</script>
@endsection
