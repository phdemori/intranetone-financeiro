@php
    use Dataview\IntranetOne\IntranetOneController;
    $servicesList = IntranetOneController::getServices();

    echo "<script>"
		."var servicesList = ".json_encode($servicesList).";"
		."</script>";
@endphp
<form action = '/admin/financeiro/create' id='default-form' method = 'post' class = 'form-fit'>
    @component('IntranetOne::io.components.wizard',[
      "_id" => "default-wizard",
      "_min_height"=>"435px",
      "_steps"=> [
          ["name" => "Dados Gerais", "view"=> "Financeiro::form-general"],
        ]
    ])
    @endcomponent
  </form>
