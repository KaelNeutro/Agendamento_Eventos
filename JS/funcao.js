document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {

    locale: 'pt-br',
    plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
    },

    //Selecionar o dia no calendario
    selectable: true,
    select: function(info){

      // alert('selected' + info.startStr + info.endStr);
      var ini = info.startStr.toLocaleString();
      var fim = info.endStr.toLocaleString();

      abreModal(ini,fim);
      // $('#cadEvento #start').val(info.startStr.toLocaleString());
      // $('#cadEvento #end').val(info.endStr.toLocaleString());
      // $('#cadEvento').modal('show'); // mostrar janela modal para cadastra evento

    }
  });

  calendar.render();
});



// Mostra o MODAL 
$(document).on('shown.bs.modal', '.modal', function () {
  $('.modal-backdrop').before($(this));
});
//função abri modal cadastro de eventos
var cont=-1;
function abreModal(ini,fim){
  cont=cont+1;
  var ndiv = "#cadEvento"+cont;
  var dados = {ini: ini, cont:cont};
  $.ajax({
    type: 'POST',
    url: 'modal_form.php',//Caminho do arquivo do seu modal
    data      : dados,
    dataType  : 'html', 
    error: function(xhr) {
      $("div#error").html('Erro ao passar variavel: ' + xhr.responseText);
    },
    success: function(data){              
      $('#form').html(data);
      // $('#cadEvento #start').val(ini);
      // $('#cadEvento #end').val(fim);
      $(ndiv).modal('show');
    }
  });
}

//VALIDAR FORMULARIOS COM BOOTSTRAP
(function() {
  'use strict';
  window.addEventListener('load', function() {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {
  form.addEventListener('submit', function(event) {
    if (form.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    }
    form.classList.add('was-validated');
  }, false);
}); 
}, false);
})();


//CALCULAR QUANTIDAdE DE ONIBUS
function onibus(){
 
    var onibus = 0;

    $('#qtd_pessoas').on('keyup',function(){

      var pessoas = $('#qtd_pessoas').val();
      onibus = Math.ceil(pessoas/40);


      $('#qtd_onibus').val(onibus);
      $('#viewqtd').html(onibus);
    });
 
}

//PROCURAR ENDEREÇO VIA CEP
function cep(){

  // function limpa_formulário_cep() {
  //   // Limpa valores do formulário de cep.
  //   $("#labelcepstart").val("");
  //   $("#labelcepend").val("");
  //   $("#cepstart").val("");
  //   $("#cepend").val("");
  // }

  //CEP START
  //Quando o campo cep perde o foco.
  $("#cepstart").blur(function() {

    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

      //Expressão regular para validar o CEP.
      var validacep = /^[0-9]{8}$/;
      var ender= "";

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

          //Preenche os campos com "..." enquanto consulta webservice.
          $("#labelcepstart").html("...");

          //Consulta o webservice viacep.com.br/
          $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

            if (!("erro" in dados)) {              //Atualiza os campos com os valores da consulta.
             ender = " " + dados.logradouro + ", " + dados.bairro + ", " + dados.localidade;

             $("#labelcepstart").html(ender);
              } //end if.
              else {                                //CEP pesquisado não foi encontrado.
                // limpa_formulário_cep();
                $("#labelcepstart").val("");

                $("#cepstart").val("");
                alert("CEP não encontrado.");
              }
            });
        } //end if.
        else {//cep é inválido.
          // limpa_formulário_cep();
          $("#labelcepstart").val("");

          $("#cepstart").val("");

          alert("Formato de CEP inválido.");
        }
      } //end if.
      else {//cep sem valor, limpa formulário.
        // limpa_formulário_cep();
        $("#labelcepstart").val("");

        $("#cepstart").val("");
      }
    });
    //CEP END
  //Quando o campo cep perde o foco.
  $("#cepend").blur(function() {

    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

      //Expressão regular para validar o CEP.
      var validacep = /^[0-9]{8}$/;
      var ender= "";

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

          //Preenche os campos com "..." enquanto consulta webservice.
          $("#labelcepend").html("...");

          //Consulta o webservice viacep.com.br/
          $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

            if (!("erro" in dados)) {              //Atualiza os campos com os valores da consulta.
             ender = " " + dados.logradouro + ", " + dados.bairro + ", " + dados.localidade;
             $("#labelcepend").html(ender);
              } //end if.
              else {                                //CEP pesquisado não foi encontrado.
                 // limpa_formulário_cep();

                 $("#labelcepend").val("");

                 $("#cepend").val("");
                 alert("CEP não encontrado.");
               }
             });
        } //end if.
        else {//cep é inválido.
          // limpa_formulário_cep();

          $("#labelcepend").val("");

          $("#cepend").val("");
          alert("Formato de CEP inválido.");
        }
      } //end if.
      else {//cep sem valor, limpa formulário.
        // limpa_formulário_cep();
        // limpa_formulário_cep();

        $("#labelcepend").val("");

        $("#cepend").val("");
      }
    });

}