<?php
namespace Agileti\IOFinanceiro;

use DataTables;
use Dataview\IntranetOne\IOController;
use Agileti\IOFinanceiro\Financeiro;
use Agileti\IOFinanceiro\FinanceiroRequest;
use Illuminate\Http\Response;

class FinanceiroController extends IOController
{

    public function __construct()
    {
        $this->service = 'financeiro';
    }

    public function index()
    {
        return view('Financeiro::index');
    }

    function list() {
        $query = Financeiro::select('entidades.cpf_cnpj', 'entidades.nome_fantasia', 'entidades.email', 'cidades.cidade', 'cidades.uf', 'contratos.codigo', 'financeiros.*')
        ->join('entidades', 'financeiros.entidade_id', '=', 'entidades.id')
        ->join('cidades', 'entidades.cidade_id', '=', 'cidades.id')
        ->join('contratos', 'financeiros.contrato_id', '=', 'contratos.id')
        ->orderBy('created_at', 'desc')->get();

        return Datatables::of(collect($query))->make(true);
    }

    public function create(FinanceiroRequest $request)
    {
        $check = $this->__create($request);

        if (!$check['status']) {
            return response()->json(['errors' => $check['errors']], $check['code']);
        }

        $obj = new Financeiro($request->all());
        $obj->save();

        return response()->json(['success' => true, 'data' => null]);
    }

    public function view($id)
    {
        $check = $this->__view();
        if (!$check['status']) {
            return response()->json(['errors' => $check['errors']], $check['code']);
        }

        $query = Financeiro::select('financeiro.*', 'cidades.cidade', 'cidades.uf')
            ->join('cidades', 'financeiro.cidade_id', '=', 'cidades.id')
            ->where('financeiro.id', $id)->get();

        return response()->json(['success' => true, 'data' => $query]);
    }

    public function update($id, FinanceiroRequest $request)
    {
        $check = $this->__update($request);
        if (!$check['status']) {
            return response()->json(['errors' => $check['errors']], $check['code']);
        }

        $_new = (object) $request->all();
        $_old = Financeiro::find($id);
        //$_old->tipo = $_new->tipo;
        $_old->condominio_id = $_new->condominio_id;
        $_old->razaosocial = $_new->razaosocial;
        $_old->nome_fantasia = $_new->nome_fantasia;
        $_old->insc_estadual = $_new->insc_estadual;
        $_old->responsavel = $_new->responsavel;
        $_old->rg = $_new->rg;
        $_old->sexo = $_new->sexo;
        $_old->estado_civil = $_new->estado_civil;
        $_old->nacionalidade = $_new->nacionalidade;
        $_old->profissao = $_new->profissao;
        $_old->dt_nascimento = $_new->dt_nascimento;
        $_old->telefone1 = $_new->telefone1;
        $_old->telefone2 = $_new->telefone2;
        $_old->celular1 = $_new->celular1;
        $_old->celular2 = $_new->celular2;
        $_old->email = $_new->email;
        $_old->cep = $_new->cep;
        $_old->logradouro = $_new->logradouro;
        $_old->numero = $_new->numero;
        $_old->complemento = $_new->complemento;
        $_old->bairro = $_new->bairro;
        $_old->cidade_id = $_new->cidade_id;
        $_old->observacao = $_new->observacao;

        $_old->save();
        return response()->json(['success' => $_old->save()]);
    }

    public function delete($id)
    {
        $check = $this->__delete();
        if (!$check['status']) {
            return response()->json(['errors' => $check['errors']], $check['code']);
        }

        $obj = Financeiro::find($id);
        $obj = $obj->delete();
        return json_encode(['sts' => $obj]);
    }

    public function checkId($id)
    {
        return Financeiro::select('razaosocial')->where('id', '=', $id)->get();
    }

    public function cidadesMigration()
    {
        $json = File::get("js/data/cidades.json");
        $data = json_decode($json, true);
        $r = "";
        foreach ($data as $obj) {
            $r .= $obj['id'];
        }
        return $r;
    }

    public function getFinanceiro($query)
    {
        return json_encode(Financeiro::select('razaosocial as n', 'cpf_cnpj as k')->where('razaosocial', 'like', "%$query")->get());
    }

}
