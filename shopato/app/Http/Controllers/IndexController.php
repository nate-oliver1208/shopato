<?php
    namespace App\Http\Controllers;

    use App\Models\Anuncio;
    use Illuminate\Http\Request;

    class IndexController extends Controller
    {
        public function index(Request $request)
        {
            $anuncios = Anuncio::orderBy('criado_em', 'desc')->take(6)->get();
            return view('index', compact('anuncios'));
        }
    }