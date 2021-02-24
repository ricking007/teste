<?php

namespace App\Http\Controllers;

use App\Pessoa;
use Illuminate\Http\Request;

use function GuzzleHttp\json_decode;

class PessoaController extends Controller
{

    public function index()
    {
        return view('pessoa/index', ['active' => 'pessoa', 'js' => ['pessoa/index', 'pessoa/form']]);
    }

    public function grid()
    {
        $pes = new Pessoa();
        $pessoas = $pes->get();
        return response($pessoas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = json_decode($request->models);
        if (!empty($form)) {
            $id =  $form[0]->id;
            $nome = mb_strtoupper($form[0]->nome, 'UTF-8');
            $init = str_replace("/", "-", $form[0]->nascimento);
            $nascimento = date("Y-m-d", strtotime($init));
            $genero = $form[0]->genero->id;
            $pais_id = $form[0]->pais_id;

            $pes = new Pessoa();
            $pes->setId($id);
            $pes->setNome($nome);
            $pes->setGenero($genero);
            $pes->setNascimento($nascimento);
            $pes->setPais_id($pais_id);

            $pes->set();

            return response($pes);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $form = json_decode($request->models);
        if (!empty($form)) {
            $id =  $form[0]->id;
            $nome = mb_strtoupper($form[0]->nome, 'UTF-8');
            $init = str_replace("/", "-", $form[0]->nascimento);
            $nascimento = date("Y-m-d", strtotime($init));

            if($nascimento > date("Y-m-d")){
                return response("A data de nascimento não pode ser maior que a data atual!");
                exit;
            }

            $pais_id = $form[0]->pais_id;

            $pes = new Pessoa();
            $pes->setId($id);
            $pes->setNome($nome);
            $pes->setNascimento($nascimento);
            $pes->setPais_id($pais_id);

            $pes->del();

            return response($pes);
        }

    }

    public function genero()
    {
        $generos = [
            array("id" => 1, "nome" => "Masculino"),
            array("id" => 2, "nome" => "Feminino"),
            array("id" => null, "nome" => "Não informado"),
        ];
        return response($generos);
    }
}
