<?php
namespace Agileti\IOFinanceiro;

use DataTables;
use Dataview\IntranetOne\IOController;
use Agileti\IOFinanceiro\PlanoConta;
use Agileti\IOFinanceiro\PlanoContaRequest;
use Illuminate\Http\Response;

class PlanoContaController extends IOController
{

    public function __construct()
    {
        $this->service = 'PlanoConta';
    }

    public function index()
    {
        return view('PlanoConta::index');
    }

    function list() {
        $query = PlanoConta::select('*')->orderBy('created_at', 'desc')->get();
        
        return Datatables::of(collect($query))->make(true);
    }

    public function create(PlanoContaRequest $request)
    {
        $check = $this->__create($request);
        
        if (!$check['status']) {
            return response()->json(['errors' => $check['errors']], $check['code']);
        }
        
        $obj = new PlanoConta($request->all());
        $obj->save();

        return response()->json(['success' => true, 'data' => null]);
    }

    public function view($id)
    {
        $check = $this->__view();
        if (!$check['status']) {
            return response()->json(['errors' => $check['errors']], $check['code']);
        }

        $query = PlanoConta::select('plano_centro.*', 'cidades.cidade', 'cidades.uf')
            ->join('cidades', 'plano_centro.cidade_id', '=', 'cidades.id')
            ->where('plano_centro.id', $id)->get();

        return response()->json(['success' => true, 'data' => $query]);
    }

    public function update($id, PlanoContaRequest $request)
    {
        $check = $this->__update($request);
        if (!$check['status']) {
            return response()->json(['errors' => $check['errors']], $check['code']);
        }

        $_new = (object) $request->all();
        $_old = PlanoConta::find($id);
        $_old->tipo = $_new->tipo;
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

        $obj = PlanoConta::find($id);
        $obj = $obj->delete();
        return json_encode(['sts' => $obj]);
    }

    public function checkId($id)
    {
        return PlanoConta::select('razaosocial')->where('id', '=', $id)->get();
    }

    public function getCep($cep)
    {
    }

    public function getPlanoConta($query)
    {
        return json_encode(PlanoConta::select('razaosocial as n', 'cpf_cnpj as k')->where('razaosocial', 'like', "%$query")->get());
    }

    public function get_enum_values( $table, $field )
    {
        $type = PlanoConta::query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" )->row( 0 )->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }
}
