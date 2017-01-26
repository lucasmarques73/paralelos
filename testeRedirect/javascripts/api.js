$(document).ready(function() {

      $( "#btnSair" ).click(function() {
              localStorage.clear();
              window.location = 'index.html';
      });
      $( "#btnCancelar" ).click(function() {
              window.history.back();
      });
      $( "#btnVoltar" ).click(function() {
              window.history.back();
      });
      $( "#btnCadastrar" ).click(function() {
              window.location = 'cadastrar.html';
      });

});
