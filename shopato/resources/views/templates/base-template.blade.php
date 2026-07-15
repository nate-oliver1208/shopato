<!DOCTYPE html>
<html lang="pt-br">
    @include('templates.cabecalho')

    @yield('header')
    @yield('search')
    @yield('content')

    @include('templates.rodape')
</html>