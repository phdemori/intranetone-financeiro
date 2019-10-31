<div class='row dt-filters-container'>
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label for='ft_search' class='bmd-label-static'><i class='ico ico-filter'></i> Palavra Chave</label>
            <input type='text' class='form-control form-control-lg' name='ft_search' id='ft_search' />
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class='row'>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for='ft_dtini' class='bmd-label-static'><i class='ico ico-filter'></i> Data Inicial</label>
                    <input type='text' name='ft_dtini' id='ft_dtini' class='form-control form-control-lg'>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for='ft_dtfim' class='bmd-label-static'><i class='ico ico-filter'></i> Data Final</label>
                    <input type='text' name='ft_dtfim' id='ft_dtfim' class='form-control form-control-lg'>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 col-sm-12">
        <div class="form-group">
            <label for='ft_forma_pgto' class='bmd-label-static'><i class='ico ico-filter'></i> Forma pgto</label>
            <select id='ft_forma_pgto' name='ft_forma_pgto' class='form-control form-control-lg'>
                <option value=''></option>
                <option value='BOLETO'>BOLETO</option>
                <option value='CARTÃO CRÉDITO'>CARTÃO CRÉDITO</option>
                <option value='CARTÃO DÉBITO'>CARTÃO DÉBITO</option>
                <option value='CHEQUE'>CHEQUE</option>
                <option value='DEPOSITO'>DEPOSITO</option>
                <option value='DINHEIRO'>DINHEIRO</option>
                <option value='PROMISSÓRIA'>PROMISSÓRIA</option>
            </select>
        </div>
    </div>
    <div class="col-md-2 col-sm-12">
        <div class="form-group">
            <label for='ft_parcial' class='bmd-label-static'><i class='ico ico-filter'></i> Parcial?</label>
            <select id='ft_parcial' name='ft_parcial' class='form-control form-control-lg'>
                <option value=''></option>
                <option value='S'>Sim</option>
                <option value='N'>Não</option>
            </select>
        </div>
    </div>
    <div class="col-md-2 col-sm-12">
        <div class="form-group">
            <label for='ft_status' class='bmd-label-static'><i class='ico ico-filter'></i> Status?</label>
            <select id='ft_status' name='ft_status' class='form-control form-control-lg'>
                <option value='0' selected>Em Aberto</option>
                <option value='1'>Quitado</option>
            </select>
        </div>
    </div>
</div>
@component('IntranetOne::io.components.datatable',[
"_id" => "default-table",
"_columns"=> [
["title" => "#"],
["title" => "Entidade"],
["title" => "Forma de Pagamento"],
["title" => "Vencimento"],
["title" => "Valor"],
["title" => "Parcela"],
["title" => "Parcial"],
["title" => "Ações"],
]
])
@endcomponent
