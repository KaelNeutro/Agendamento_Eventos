<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8' />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <!-- Metodos para uso do Full Calendar --> 
  <link href='../fullcalendar/packages/core/main.css' rel='stylesheet' />
  <link href='../fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
  <link href='../fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
  <link href='../fullcalendar/packages/list/main.css' rel='stylesheet' />
  <script src='../fullcalendar/packages/core/main.js'></script>
  <script src='../fullcalendar/packages/interaction/main.js'></script>
  <script src='../fullcalendar/packages/daygrid/main.js'></script>
  <script src='../fullcalendar/packages/timegrid/main.js'></script>
  <script src='../fullcalendar/packages/list/main.js'></script>
  <script src='../fullcalendar/packages/core/locales/pt-br.js'></script> <!-- Linguagem Português -->

  <!--JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->



  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



  <!-- Funções add ao calendario -->
  <script src="../JS/funcao.js"></script>

  <!-- Personalização da página --> 
  <link rel="stylesheet" type="text/css" href="../CSS/estilo.css">

</head>
<body>

  <div id='calendar'></div>

  <!-- FORMULARIO PARA CADASTRA EVENTO CONFORME O DIA -->
  <div class="modal fade" id="cadEvento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cadastrar Evento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <span id="msg-cad"></span>
          <form id="addevent" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            <!-- Input TITULO DE EVENTO -->
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Título</label>
              <div class="col-sm-10">
                <input type="text" name="title" class="form-control " id="title" placeholder="Título do evento" required="">
                
                <div class="invalid-feedback">
                  Preenche o campo. Por favor!
                </div>
              </div>
            </div>  
            <!-- Input QUANTIDADE PESSOAS -->
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Número de pessoas</label>
              <div class="col-sm-10">
                <input type="number" name="qtd_pessoas" class="form-control" id="qtd_pessoas" placeholder="" min="1" required="">
                
                <div class="invalid-feedback">
                  Preenche o campo. Por favor!
                </div>
              </div>
            </div>
            <!-- Input QUANTIDADE DE ONIBUS  -->
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Quantidade de Onibus</label>
              <div class="col-sm-10">
                <input type="number" name="qtd_onibus" class="form-control" id="qtd_onibus" placeholder="" min="1" disabled="">
                
                <div class="invalid-feedback">
                  Preenche o campo. Por favor!
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tipos de eventos</label>
              <div class="col-sm-10">
                <select name="color" class="form-control" id="color" required="">
                  <option value="">Selecione</option>     
                  <option style="color:#FFD700;" value="#FFD700">Escola</option>
                  <option style="color:#0071c5;" value="#0071c5">Prefeitura</option>
                  <option style="color:#FF4500;" value="#FF4500">Show</option>
                  <option style="color:#8B4513;" value="#8B4513">Passeio</option> 
                  <option style="color:#1C1C1C;" value="#1C1C1C">Palestra</option>
                  <option style="color:#436EEE;" value="#436EEE">Ação Social</option>
                  <option style="color:#A020F0;" value="#A020F0">Outros</option>
                </select>
                
                <div class="invalid-feedback">
                  Preenche o campo. Por favor!
                </div>
              </div>
            </div>
            <!--  DATA E HORA DO EVENTOS -->
            <div  class="col-sm row">
              <div class="form-group col">
                <div class="form-group">
                  <label class="" for="start">Data início </label>
                  <input type="date" name="start" class="form-control" id="start"  disabled="">
                  
                <div class="invalid-feedback">
                  Preenche o campo. Por favor!
                </div>
                </div>
                <div class="form-group">
                  <label class="" for="start">Horario</label>
                  <input type="time" name="timestart" class=" form-control " required="">
                  
                <div class="invalid-feedback">
                  Preenche o campo. Por favor!
                </div>
                </div>
              </div>
              <div class="form-group col">
                <div class="form-group">
                  <label class="" for="end">Data fim</label>
                  <input type="date" name="end" class="form-control" id="end"  onkeypress="" required="">
                  
                <div class="invalid-feedback">
                  Preenche o campo. Por favor!
                </div>
                </div>
                <div class="form-group">
                  <label class="" for="start">Horario</label>
                  <input type="time" name="timeend" class=" form-control " required="">
                  
                <div class="invalid-feedback">
                  Preenche o campo. Por favor!
                </div>
                </div>
              </div>
            </div>
            <!-- ENDEREÇOS PARA AS PARTIDAS    -->     
            <div  class="col-sm row">
              <div class="form-group col">
                <div class="form-group">
                  <label class="" for="cepstart">CEP  </label>
                  <input type="text" name="cepstart" class="form-control" id="cepstart" required="">
                  <label id="labelcepstart"> Endereço </label>
                  
                <div class="invalid-feedback">
                  Preenche o campo. Por favor!
                </div>
                </div>
              </div>
              <div class="form-group col">
                <div class="form-group">
                  <label class="" for="cepend">CEP  </label>
                  <input type="text" name="cepend" class="form-control" id="cepend"  required="">
                  <label id="labelcepend"></label>
                  
                <div class="invalid-feedback">
                  Preenche o campo. Por favor!
                </div>
                </div>
              </div>
            </div>
            <div  class="col-sm row">

            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" name="CadEvent" id="CadEvent" value="CadEvent" class="btn btn-success">Cadastrar</button>                                    
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
