

(function ($) {
    "use strict";



  
  
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    //Carga ruta del archivo al file
    $('#file_1').on('change',function(){
        $('#inputval').text( $(this).val());
    });

})(jQuery);

//Permite el ingreso de solo letras en un campo
function sololetras(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46";
    tecla_especial = false
    for(var i in especiales){
        if(key == especiales[i]){
            tecla_especial = true;
            break;
        }
    }
    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}
//Permite el ingreso de solo numeros en un campo
function solonumeros(e) {
    key= e.keyCode || e.which;
    teclado= String.fromCharCode(key);
    numeros= "0123456789"; 
    especiales="8-37-38-46"; 
    teclado_especial=false;
    for (var i in especiales) {
        if(key==especiales[i]){
            teclado_especial=true;
        }
    }
    if (numeros.indexOf(teclado)==-1 &&  !teclado_especial) {
        return false;
    }
}

enviando = false; //Obligaremos a entrar el if en el primer submit
    
function checkSubmit() {
    if (!enviando) {
        enviando= true;
        return true;
    } 
    else {
        //Si llega hasta aca significa que pulsaron 2 veces el boton submit
        alert("El formulario ya se esta enviando");
        return false;
    }
}