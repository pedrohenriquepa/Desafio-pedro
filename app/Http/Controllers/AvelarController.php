<?php

namespace App\Http\Controllers;

use App\Models\Avelar;
use Illuminate\Http\Request;

class AvelarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dados=Avelar::all();
        return view('avelar.index', compact('dados'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validação do formulário
    $request->validate([
        'nome' => 'required|string|max:255',
        'idade' => 'required|integer|min:1|max:99',
        'cep' => 'required|string|max:9',
        'cidade' => 'required|string|max:255',
        'estado' => 'required|string|max:2',
        'rua' => 'nullable|string|max:255',
        'bairro' => 'nullable|string|max:255',
        'ensino_medio' => 'nullable|boolean',
        'sexo' => 'required|string|max:20',
        'salario' => 'required|string',
        'anexo.*' => 'required|file|mimes:jpeg,png,jpg,pdf|max:10240',
    ]);

    // Processamento dos dados
    $dados = new Avelar;
    $dados->nome = $request->input('nome');
    $dados->idade = $request->input('idade');
    $dados->cep = $request->input('cep');
    $dados->cidade = $request->input('cidade');
    $dados->estado = $request->input('estado');
    $dados->rua = $request->input('rua');
    $dados->bairro = $request->input('bairro');
    $dados->ensino_medio = $request->input('ensino_medio');
    $dados->sexo = $request->input('sexo');

    // Converte salário para float
    $salario = str_replace(['.', ','], ['', '.'], $request->salario);
    $dados->salario = floatval($salario);

    // Processa os anexos
    $anexosSalvos = [];

    if ($request->hasFile('anexo')) {
        foreach ($request->file('anexo') as $file) {
            if ($file->isValid()) {
                $nomeArquivo = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/storage'), $nomeArquivo);
                $anexosSalvos[] = $nomeArquivo;
            }
        }
    }

    // Armazena os nomes dos arquivos em JSON
    $dados->anexo = json_encode($anexosSalvos);

    // Salva os dados no banco
    $dados->save();

    return redirect()->back();
}

    
    /**
     * Display the specified resource.
     */
    public function show(Avelar $avelar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Avelar $avelar)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $dados = Avelar::find($id);
    
    $dados->nome = $request->input('nome');
    $dados->idade = $request->input('idade');
    $dados->cep = $request->input('cep');
    $dados->cidade = $request->input('cidade');
    $dados->estado = $request->input('estado');
    $dados->rua = $request->input('rua');
    $dados->bairro = $request->input('bairro');
    $dados->ensino_medio = $request->input('ensino_medio');
    $dados->sexo = $request->input('sexo');

    // Tratamento do salário
    $salario = str_replace(['.', ','], ['', '.'], $request->salario);
    $dados->salario = floatval($salario);

    // Tratamento dos anexos
    if ($request->hasFile('anexo')) {
        $arquivos = $request->file('anexo');
        $nomesArquivos = [];

        foreach ($arquivos as $arquivo) {
            if ($arquivo->isValid()) {
                $nome = uniqid() . '_' . $arquivo->getClientOriginalName();
                $arquivo->move(public_path('assets/storage'), $nome);
                $nomesArquivos[] = $nome;
            }
        }

        $dados->anexo = json_encode($nomesArquivos);
    }

    $dados->update();

    return redirect()->back();
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dados=Avelar::find($id);
        $dados ->delete();
        return redirect()->back();
    }
}
