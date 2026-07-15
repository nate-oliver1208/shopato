@extends('templates.base-template')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-warning text-center">
            <h4 class="card-title mb-0">Sobre o Shopato</h4>
        </div>

        <div class="card-body">
            <p>O <strong>Shopato</strong> é uma plataforma de compra e venda desenvolvida para facilitar a conexão entre vendedores e compradores de forma simples e divertida. Criado com fins acadêmicos, o Shopato simula uma experiência real de marketplace, permitindo que usuários cadastrem produtos, gerenciem seus perfis e interajam com a comunidade.</p>

              <p>Nossa identidade foi inspirada na leveza e acessibilidade de plataformas como Mercado Livre, mas com um toque bem-humorado que faz alusão ao nosso mascote: o pato!</p>

              <hr>

              <h4>Avaliações de usuários</h4>
              <ul class="list-unstyled">
                <li class="mb-3">
                  <i class="fas fa-user-circle text-warning"></i> <strong>Juliana M.</strong> — "O Shopato me surpreendeu! Consegui vender meu fone de ouvido em menos de dois dias. Super fácil de usar."
                </li>
                <li class="mb-3">
                  <i class="fas fa-user-circle text-warning"></i> <strong>Ricardo T.</strong> — "Achei um notebook seminovo com ótimo preço. Recomendo muito a plataforma."
                </li>
                <li class="mb-3">
                  <i class="fas fa-user-circle text-warning"></i> <strong>Camila D.</strong> — "Adorei a interface e o mascote. Tudo muito leve e intuitivo. Parabéns aos desenvolvedores!"
                </li>
              </ul>

              <hr>

            <h4 class="mt-4">Entre em contato:</h4>
            <p>
                <i class="fas fa-envelope"></i><strong> Email:</strong> suporte@shopato.com.br<br>
                <i class="fas fa-phone"></i><strong> Telefone:</strong> (11) 4002-8922<br>
                <i class="fas fa-map"></i><strong> Endereço:</strong> Rua dos Patos, nº 123 - Lagoa, SP - Brasil
            </p>

            <div class="mt-4 text-center">
                <a href="{{ route('index') }}" class="btn btn-primary">
                    <i class="fas fa-home"></i> Voltar para a página inicial
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
