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
      $('#cadEvento #start').val(info.start.toLocaleString());
      $('#cadEvento #end').val(info.end.toLocaleString());
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


//CALCULAR QUANTIDAE DE ONIBUS
$(document).ready( function() {
  var onibus = 0;

  jQuery('#qtd_pessoas').on('keyup',function(){

    var pessoas = jQuery('#qtd_pessoas').val();
    onibus = Math.ceil(pessoas/40);
    

    jQuery('#qtd_onibus').val(onibus);
  });
});