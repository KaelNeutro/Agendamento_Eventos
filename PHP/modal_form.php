  <?php 

          include_once 'conexao.php';

          $ini = $_POST['ini'];
          $cont = $_POST['cont'];
  ?>

  <div class="modal fade" id="cadEvento<?php echo $cont;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <?php

          $sql = "SELECT * FROM `onibus` WHERE `data`= '$ini' and `qtd_dis`>= 1";
          $query = mysqli_query($con,$sql);

          $val = mysqli_num_rows($query);

          if ($val === 0) {
          # code...
        ?>
          <div class="modal-header">
            <h5 class="modal-title">Alerta! Data: <?php echo "$ini"; ?></h5>
            <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <h5>
            <div class="modal-body">
              <p>Nesta data não há disponibilidade de ônibus!</p>
            </div>
          </h5>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        <?php
          } else { //Abrindo o formulário de cadastro de eventos
        ?>
            <!-- FORMULARIO PARA CADASTRA EVENTO CONFORME O DIA -->
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Evento - Data: <?php echo "$ini"; ?></h5>
                    <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <span id="msg-cad"></span>
                    <form id="addevent" method="POST" enctype="multipart/form-data" action="cad_event.php" class="needs-validation" novalidate>
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
                        <label class="col-sm-2 col-form-label">Número</label>
                        <div class="col-sm-10">
                          <input type="number" name="qtd_pessoas" class="form-control" id="qtd_pessoas" placeholder="Número de pessoas" min="1" onkeypress="onibus()" required="">                
                          <div class="invalid-feedback">
                            Preenche o campo. Por favor!
                          </div>
                        </div>
                      </div>
                      <!-- Input QUANTIDADE DE ONIBUS  -->
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Quantidade</label>
                        <div class="col-sm-10"> 
                          <input type="hidden" name="qtd_onibus"  id="qtd_onibus" placeholder="">
                          <label id="viewqtd" class="form-control" for="qtd_onibus">Quantidade de Onibus</label>
                          <!-- <input type="number" class="form-control" id="qtd_onibus" placeholder="" min="1" disabled=""> -->                
                          <div class="invalid-feedback">
                            Preenche o campo. Por favor!
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tipos</label>
                        <div class="col-sm-10">
                          <select name="color" class="form-control" id="color" required="">
                            <option value="">Tipos de eventos</option>     
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
                      <div class="form-group row">
                        <label for="desc" class="col-sm-2 col-form-label"> Descrição do Evento</label>
                        <div class="col-sm-10">
                          <textarea name="desc" id="desc" class="form-control" required=""></textarea>
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
                            <input type="date"  class="form-control" id="start" value="<?php echo $ini; ?>" disabled="">
                            <input type="hidden" name="start" class="form-control" id="start" value="<?php echo $ini; ?>" >
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
                            <input type="text" name="cepstart" class="form-control col" id="cepstart" onkeypress="cep()" required="">
                            <label id="labelcepstart" class=""></label>                  
                            <div class="invalid-feedback">
                              Preenche o campo. Por favor!
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="" for="nr01">Numero/Complemento </label>                  
                            <input type="text" name="nr01" id="nr01" class="form-control col" required="">
                            <div class="invalid-feedback">
                              Preenche o campo. Por favor!
                            </div>
                          </div>
                        </div>
                        <div class="form-group col">
                          <div class="form-group">
                            <label class="" for="cepend">CEP  </label>
                            <input type="text" name="cepend" class="form-control" id="cepend" onkeypress="cep()"  >
                            <label id="labelcepend"></label>                  
                          </div>
                          <div class="form-group">
                            <label class="" for="nr02">Numero/Complemento </label>                  
                            <input type="text" name="nr02" id="nr02" class="form-control col" >
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
            <?php 
              } //Fechando o Else
            ?>
    </div>
  </div>
</div>
<?php $i++; ?>
