@extends('templates.base-template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-center">
                    <h4 class="card-title mb-0">Publicar novo anúncio</h4>
                </div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('erro'))
                        <div class="alert alert-danger">{{ session('erro') }}</div>
                    @endif

                    <form method="POST" action="{{ route('anunciar.store') }}" enctype="multipart/form-data" id="formAnuncio">
                        @csrf

                        <div class="form-group">
                            <label>Título:</label>
                            <input type="text" name="titulo" class="form-control" maxlength="255" required>
                        </div>

                        <div class="form-group">
                            <label>Descrição:</label>
                            <textarea name="descricao" class="form-control" rows="4" maxlength="255" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Preço (R$):</label>
                            <input type="number" name="preco" class="form-control" step="0.01" min="0" required>
                        </div>

                        <hr>
                        <h5>Imagens do Produto</h5>

                        <div class="form-group">
                            <label>Imagem 1 (JPG/PNG até 100KB):</label>
                            <input type="file" name="imagem1" id="imagem1" class="form-control-file" accept="image/png, image/jpeg, image/jpg" required>
                            <small id="helpImagem1" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label>Imagem 2 (JPG/PNG até 100KB):</label>
                            <input type="file" name="imagem2" id="imagem2" class="form-control-file" accept="image/png, image/jpeg, image/jpg" required>
                            <small id="helpImagem2" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label>Imagem 3 (JPG/PNG até 100KB):</label>
                            <input type="file" name="imagem3" id="imagem3" class="form-control-file" accept="image/png, image/jpeg, image/jpg" required>
                            <small id="helpImagem3" class="form-text text-muted"></small>
                        </div>

                        <button type="submit" class="btn btn-warning btn-block">
                            <i class="fas fa-upload"></i> Publicar Anúncio
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

{{-- Validação com JavaScript --}}
<script>
function validarImagem(inputId, helpId) {
    const input = document.getElementById(inputId);
    const help = document.getElementById(helpId);
    const file = input.files[0];

    if (file) {
        if (file.size > 100 * 1024) {
            help.textContent = "A imagem excede 100KB. Escolha outra.";
            input.value = '';
            return false;
        } else {
            help.textContent = '';
        }
    }
    return true;
}

document.getElementById('imagem1').addEventListener('change', () => validarImagem('imagem1', 'helpImagem1'));
document.getElementById('imagem2').addEventListener('change', () => validarImagem('imagem2', 'helpImagem2'));
document.getElementById('imagem3').addEventListener('change', () => validarImagem('imagem3', 'helpImagem3'));

document.getElementById('formAnuncio').addEventListener('submit', function(e) {
    const valid1 = validarImagem('imagem1', 'helpImagem1');
    const valid2 = validarImagem('imagem2', 'helpImagem2');
    const valid3 = validarImagem('imagem3', 'helpImagem3');

    if (!valid1 || !valid2 || !valid3) {
        e.preventDefault();
        alert('Corrija os erros nas imagens antes de continuar.');
        return;
    }

    const preco = parseFloat(document.querySelector('input[name="preco"]').value);
    if (isNaN(preco) || preco < 0) {
        alert('Informe um preço válido (maior ou igual a zero).');
        e.preventDefault();
    }
});
</script>
@endsection
