<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pessoa extends Model
{
    protected $table = "pessoa";

    private $id,
        $nome,
        $nascimento,
        $genero,
        $pais_id;

    public static function get()
    {
        try {
            $query = "SELECT pes.*,p.nome AS pais,
            CASE WHEN pes.genero='1' THEN 'Masculino'
            WHEN pes.genero='2' THEN 'Feminino'
            ELSE 'Não informado' END AS genero
            FROM pessoa pes INNER JOIN pais p ON p.id = pes.pais_id
                WHERE pes.id != 0 ORDER BY pes.nome DESC;";
            $data = DB::connection()->select($query);
            return $data;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function set()
    {
        try {
            if ($this->getId()) {
                $data = DB::update(
                    'UPDATE pessoa SET nome = ?, nascimento = ?, genero = ?, pais_id = ? WHERE id = ?',
                    [$this->getNome(), $this->getNascimento(), $this->getGenero(), $this->getPais_id(), $this->getId()]
                );
                return $data;
            } else {
                $sql = "INSERT INTO pessoa (id,nome,nascimento,genero,pais_id)
                values (nextval('public.seq_pessoa'),'{$this->getNome()}','{$this->getNascimento()}',{$this->getGenero()},{$this->getPais_id()})";
                $data = DB::insert($sql);
                return $data;
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function del()
    {
        $sql = "DELETE FROM pessoa WHERE id = {$this->getId()};";
        $data = DB::delete($sql);
        return $data;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = filter_var($nome, FILTER_SANITIZE_STRING);
    }

    public function getNascimento()
    {
        return $this->nascimento;
    }

    public function setNascimento($nascimento)
    {
        $init = str_replace("/", "-", $nascimento);
        $init = date("Y-m-d", strtotime($init));
        $this->nascimento = $init;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    public function getPais_id()
    {
        return $this->pais_id;
    }

    public function setPais_id($pais_id)
    {
        $this->pais_id = filter_var($pais_id, FILTER_SANITIZE_NUMBER_INT);
    }
}
