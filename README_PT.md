# Shopato - Plataforma de E-commerce de Usados

*Leia isto em outros idiomas: [English 🇺🇸](README.md)*

O **Shopato** é um marketplace de comércio eletrônico focado na compra e venda de produtos usados (estilo OLX), com identidade visual inspirada no Mercado Livre e Shopee. A plataforma simula um ambiente completo onde usuários comuns podem criar contas, publicar anúncios detalhados com imagens de seus produtos e realizar compras simuladas através de um carrinho virtual interativo.

Este projeto foi desenvolvido como requisito avaliativo para a disciplina de **Desenvolvimento Full-Stack**, no primeiro semestre de 2025, no curso de **Bacharelado em Engenharia da Computação** do **Instituto Federal de São Paulo (IFSP) - Campus Guarulhos**.

### [Página Inicial da Loja]

<img width="800" alt="Captura de tela 2026-07-15 165834" src="https://github.com/user-attachments/assets/71490dc4-cb7c-4dca-8724-d6ff6a1a4499" />

---

### [Perfil / Seus Anúncios]

<img width="800" alt="Captura de tela 2026-07-15 165948" src="https://github.com/user-attachments/assets/24f7c16c-df05-4147-bbfa-8a5575c9412b" />

---

### [Detalhes do Anúncio]

<img width="800" alt="Captura de tela 2026-07-15 170038" src="https://github.com/user-attachments/assets/71d80214-2303-4f27-b933-7a0cfcb8f10b" />

---

### [Seu Carrinho]

<img width="800" alt="Captura de tela 2026-07-15 170110" src="https://github.com/user-attachments/assets/c4925082-2d9c-4930-a1ca-64a60cc3c690" />

---

## A Jornada de Evolução: Do PHP Procedural ao Laravel MVC

O maior diferencial técnico deste projeto está na sua arquitetura. O desenvolvimento foi dividido em duas fases distintas, simulando um cenário real de modernização de software legada:

1.  **Fase Inicial (Legado):** O sistema foi construído inicialmente em PHP puro (procedural), utilizando uma arquitetura baseada em páginas isoladas e acesso direto ao banco de dados.
2.  **Fase de Migração:** Toda a aplicação foi migrada para o framework **Laravel**. O código foi completamente refatorado e reorganizado sob o padrão **MVC (Model-View-Controller)**, utilizando rotas centralizadas, controllers especializados, componentes Blade reutilizáveis e ORM para manipulação do banco de dados de forma segura.

---

## Tecnologias e Ferramentas Utilizadas

*   **Linguagem de Programação:** PHP.
*   **Framework Backend:** Laravel.
*   **Banco de Dados Relacional:** MariaDB / phpMyAdmin.
*   **Frontend & Interface:**
    *   Blade Templates (Sistema de templates nativo do Laravel).
    *   Template Base AdminLTE (com customização inspirada nas cores amarelo e branco do Mercado Livre).
    *   Bootstrap (Layout responsivo).
    *   HTML5, CSS3 e JavaScript (Manipulações dinâmicas no cliente).
    *   Font Awesome (Biblioteca de ícones).
*   **Ferramenta de Desenvolvimento:** VS Code.

---

## Principais Funcionalidades da Aplicação

*   **Autenticação Nativa:** Registro de usuários, controle de login/logout e persistência segura de sessão utilizando o ecossistema nativo do Laravel.
*   **Gerenciamento de Perfil:** Página dedicada do usuário exibindo dados cadastrais, quantidade de itens anunciados, lista de anúncios ativos e opção de alteração de foto de perfil.
*   **Sistema de Anúncios Dinâmicos:** Criação de anúncios contendo título, descrição detalhada, preço e upload de até 3 imagens do produto. Cada anúncio possui uma página pública com galeria de fotos, informações de contato do vendedor e seletor de quantidade para compra.
*   **Lojas Personalizadas:** Cada vendedor cadastrado possui uma página pública de "loja", exibindo sua localização, foto de perfil e vitrine contendo todos os seus produtos anunciados.
*   **Carrinho de Compras:** Adição de itens ao carrinho, ajuste de quantidade desejada com atualização automática de subtotal e valor total, além de opção para remoção de itens.
*   **Página Institucional:** Seção "Sobre" contendo o propósito acadêmico do projeto, descrição do fluxo e avaliações fictícias de usuários.

---

## Segurança e Validação de Dados

A aplicação implementa validações robustas em duas camadas para blindar o sistema de falhas e vulnerabilidades:
1.  **Camada do Cliente (Frontend):** Validações rápidas em formulários utilizando atributos nativos do HTML5 e scripts em JavaScript para melhorar a experiência do usuário (UX).
2.  **Camada do Servidor (Backend):** Validação rígida de tipos de arquivos (uploads de imagens), campos obrigatórios e sanitização de dados de entrada através do validador integrado do Laravel, garantindo a integridade e segurança contra injeções de dados.

---

## Como Executar o Projeto Localmente

Siga as etapas abaixo para configurar o ambiente e rodar o projeto na sua máquina:

1.  **Preparar o Ambiente de Servidor Local:**
    *   Certifique-se de ter o **XAMPP** (ou ambiente similar com suporte a PHP e MariaDB/MySQL) instalado e com os serviços de Apache e MySQL ativos.
2.  **Posicionar os Arquivos:**
    *   Mova ou clone a pasta `shopato` para o diretório de publicação do seu servidor local (ex: `C:\xampp\htdocs\` no Windows).
3.  **Configurar o Banco de Dados:**
    *   Acesse o gerenciador do banco de dados (como o phpMyAdmin) e crie uma nova base de dados.
    *   Importe o arquivo de banco de dados `duck.sql` fornecido junto ao projeto para estruturar as tabelas e dados iniciais.
4.  **Ajustar as Variáveis de Ambiente:**
    *   Na pasta raiz do projeto, configure o arquivo `.env` com as credenciais de conexão do seu banco de dados local (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
5.  **Rodar a Aplicação:**
    *   Abra o terminal dentro da pasta `shopato` e execute o comando:
        ```bash
        php artisan serve
        ```
    *   Acesse o endereço indicado no terminal (geralmente `http://127.0.0.1:8000`) no seu navegador.

---

## Credenciais Homologadas para Testes Rápidos

Para explorar a plataforma como um usuário já cadastrado sem a necessidade de criar uma nova conta, utilize o seguinte acesso homologado:

*   **E-mail:** `email@gmail.com`
*   **Senha:** `senha`

---

## Informações Acadêmicas e Autores

Projeto prático desenvolvido para consolidação de conceitos em engenharia de software e desenvolvimento web full-stack.

*   **Professor Orientador:** Reginaldo do Prado.
*   **Autor (Aluno):**
    *   Nathan Iglesias Gomes de Oliveira
