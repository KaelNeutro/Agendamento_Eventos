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
      $('#cadEvento #start').val(info.startStr.toLocaleString());
      $('#cadEvento #end').val(info.endStr.toLocaleString());
      $('#cadEvento').modal('show'); // mostrar janela modal para cadastra evento
    }
  });

  calendar.render();
});


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
$(document).ready( function() {
  var onibus = 0;

  jQuery('#qtd_pessoas').on('keyup',function(){

    var pessoas = jQuery('#qtd_pessoas').val();
    onibus = Math.ceil(pessoas/40);
    

    jQuery('#qtd_onibus').val(onibus);
  });
});


//PROCURAR ENDEREÇO VIA CEP

$(document).ready(function() {
  function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    $("#rua").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
    $("#ibge").val("");
    $("#labelcepstart").val("");
    $("#labelcepend").val("");
    $("#cepstart").val("");
    $("#cepend").val("");
  }

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
          $("#rua").val("...");
          $("#bairro").val("...");
          $("#cidade").val("...");
          $("#uf").val("...");
          $("#ibge").val("...");
          $("#labelcepstart").html("...");

          //Consulta o webservice viacep.com.br/
          $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

            if (!("erro" in dados)) {              //Atualiza os campos com os valores da consulta.
              $("#rua").val(dados.logradouro);
              $("#bairro").val(dados.bairro);
              $("#cidade").val(dados.localidade);
              $("#uf").val(dados.uf);
              $("#ibge").val(dados.ibge);

              
              ender = " " + dados.logradouro + ", " + dados.bairro + ", " + dados.localidade;
              alert("- ". ender);
              $("#labelcepstart").html(ender);
              } //end if.
              else {                                //CEP pesquisado não foi encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
              }
            });
        } //end if.
        else {//cep é inválido.
          limpa_formulário_cep();
          alert("Formato de CEP inválido.");
        }
      } //end if.
      else {//cep sem valor, limpa formulário.
        limpa_formulário_cep();
      }
    });
});
