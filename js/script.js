/**
 * Created by daniel on 10/2/2016.
 */
$('document').ready(function()
{
    /* Validar Formulario de Login */
    $("#login-form").validate({
        rules:
        {
            password: {
                required: true
            },
            user: {
                required: true
                //email: true
            }
        },
        messages:
        {
            password:{
                required: "Ingresar Contraseña"
            },
            user: "Ingrese su Usuario."
        },
        submitHandler: submitForm
    });
    /* validation */

    /* Verificar datos de Formulario */
    function submitForm()
    {
        var data = $("#login-form").serialize();

        $.ajax({

            type : 'POST',
            url  : 'login_process.php',
            data : data,
            beforeSend: function()
            {
                $("#error").fadeOut();
                $("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Enviando ...');
            },
            success :  function(response)
            {
                if(response=="ok"){

                    $("#btn-login").html('<img src="imgs/ajax-loader2.gif" /> &nbsp; Iniciando ...');
                    setTimeout(' window.location.href = "Home.php"; ',2500);
                }
                else{

                    $("#error").fadeIn(1000, function(){
                        $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Entrar');
                    });
                }
            }
        });
        return false;
    }
    /* login submit */

    /* Desaparecer mensaje emergente en tiempo determinado*/
    $("#bienvenido").delay(2000).fadeOut('Slow');

    /* Al precionar el boton de administrador llamar el menu de administrador */
    $("#Administrar").click(function() {
        $.ajax({
            url:'adminMenu.php',
            type:'GET',
            success: function(data){
                //alert(data);
                $('.profile-content #menuAdmin').hide().html(data).fadeIn('slow');
                $('.profile-content #opciones').fadeOut('slow');

            }
        });

    });



    /* Configuracion de enlaces para salir del sistema*/
    $(".profile-usermenu li #Salir").click(function() {
        setTimeout(window.location.href="Logout.php",5000);
    });
    $("#Salir").click(function() {
        setTimeout(window.location.href="Logout.php",5000);
    });



    /* resaltar opcion del menu izquierdo seleccionada */
    $(".profile-usermenu li").hover(function() {
        $(this).addClass("active");
    }, function() {
        $(this).removeClass("active");
    });



    /* Mostrar Pantalla para crear usuario */
    $("#menuAdmin").on("click","#usuario", function(){


        console.log('entro');
        $.ajax({
            url:'crearUsuario.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){

                $('#opciones').hide().html(data).fadeIn('slow');
            }
        });

    });

    /* Registrar Tipos de Usuario */
    $("#menuAdmin").on("click","#tipos", function(){

        console.log('entro');
        $.ajax({
            url:'tipoUsuario.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){

                $('#opciones').hide().html(data).fadeIn('slow');
            }
        });
    });

    /* Registrar Tipos de Usuario */
    $("#menuAdmin").on("click","#modulos", function(){

        console.log('entro');
        $.ajax({
            url:'modulos.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){

                $('#opciones').hide().html(data).fadeIn('slow');
            }
        });
    });
    /* Registrar Mapas de Usuario */
    $("#menuAdmin").on("click","#mapas", function(){

        console.log('entro');
        $.ajax({
            url:'mapas.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){

                $('#opciones').hide().html(data).fadeIn('slow');
            }
        });
    });



    /* Eliminar usuario del sistema */
    $("#opciones").on("click",".borrar", function() {
        console.log('entro2');
        var id = $(this).attr("id");
        var $element = $(this);

        $.ajax({
            url:'eliminarUsuario.php?id='+id,
            type: "POST",
            data: "id="+id,
            success: function(response){
                //alert('Hola');
                //$element.parent().parent().remove();
                if(response.trim()=="ok") {
                    $element.parent().parent().remove();
                } else {

                    $("#error2").fadeIn(1000, function(){
                        $("#error2").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-loginUsuario").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                    });
                }
            },
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            }
        });
    });

    /* Borrar Tipos de Usuario */
    $("#opciones").on("click",".borrar2", function() {
        console.log('entro2');
        var id = $(this).attr("id");
        var $element = $(this);

        $.ajax({
            url:'eliminarTipo.php?id='+id,
            type: "POST",
            data: "id="+id,
            success: function(response){
                //alert('Hola');
                if(response=="ok") {
                    $element.parent().parent().remove();
                } else {

                    $("#error2").fadeIn(1000, function(){
                        $("#error2").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                    });
                }
            },
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            }
        });
    });

    /* Borrar Modulos */
    $("#opciones").on("click",".borrar3", function() {
        console.log('entro2');
        var id = $(this).attr("id");
        var $element = $(this);

        $.ajax({
            url:'eliminarModulo.php?id='+id,
            type: "POST",
            data: "id="+id,
            success: function(response){
                //alert('Hola');
                if(response=="ok") {
                    $element.parent().parent().remove();
                } else {

                    $("#error3").fadeIn(1000, function(){
                        $("#error3").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-login3").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                    });
                }
            },
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            }
        });
    });

    /* Registrar usuario nuevo en sistema */
    $("#opciones").on("submit","#registrar-usuario", function(event){
    //$('#btn-register').click(function() {
        /* Forma para registrar Usuario */

        event.preventDefault();

        var formData = new FormData($(this)[0]);

        console.log(formData);

        $.ajax({

            type : 'POST',
            url  : 'register_process.php',
            //dataType: "JSON",
            data : formData,
            encType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function()
            {
                $("#error2").fadeOut();
                $("#btn-loginUsuario").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Enviando ...');
            },
            success :  function(response)
            {


                if(response=="ok"){

                    $("#btn-loginUsuario").html('<img src="imgs/ajax-loader2.gif" /> &nbsp; Iniciando ...');
                    $.ajax({
                        url:'crearUsuario.php',
                        type:'GET',
                        error: function(xhr, error){
                            console.log(xhr); console.log(error);
                        },
                        success: function(data){

                            $('#opciones').html(data);
                        }
                    });

                    alert('Usuario registrado con Exito.');
                    //setTimeout(' window.location.href = "Home.php"; ',2500);
                }
                else{

                    $("#error2").fadeIn(1000, function(){
                        $("#error2").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-loginUsuario").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                    });
                }
            },
            error : function(response2) {

                $("#error2").fadeIn(1000, function(){
                    $("#error2").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response2+' !</div>');
                    $("#btn-loginUsuario").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                });
            }
        });
        return false;
    });


    /* Registrar tipos de usuario nuevo en sistema */
    $("#opciones").on("click","#btn-login2", function(){
        //$('#btn-register').click(function() {
        /* Forma para registrar Tipo de Usuario */

        var $elemento = $(this).parent().parent();
        //alert($elemento.attr('id'));
        var data = $elemento.serialize();

        $.ajax({

            type : 'POST',
            url  : 'tipo_register.php',
            data : data,
            beforeSend: function()
            {
                $("#error2").fadeOut();
                $("#btn-login2").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Enviando ...');
            },
            success :  function(response)
            {
                //alert('entro');
                if(response=="ok"){

                    $("#btn-login2").html('<img src="imgs/ajax-loader2.gif" /> &nbsp; Iniciando ...');
                    $.ajax({
                        url:'tipoUsuario.php',
                        type:'GET',
                        error: function(xhr, error){
                            console.log(xhr); console.log(error);
                        },
                        success: function(data){

                            $('#opciones').html(data);
                        }
                    });

                    alert('Tipo de Usuario registrado con Exito.');
                    //setTimeout(' window.location.href = "Home.php"; ',2500);
                }
                else{

                    $("#error2").fadeIn(1000, function(){
                        $("#error2").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-login2").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                    });
                }
            }
        });
        return false;
    });

    /* Registrar modulo nuevo en sistema */
    $("#opciones").on("click","#btn-login3", function(){
        //$('#btn-register').click(function() {
        /* Forma para registrar Modulos */

        var $elemento = $(this).parent().parent();
        //alert($elemento.attr('id'));
        var data = $elemento.serialize();

        $.ajax({

            type : 'POST',
            url  : 'modulo_register.php',
            data : data,
            beforeSend: function()
            {
                $("#error3").fadeOut();
                $("#btn-login3").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Enviando ...');
            },
            success :  function(response)
            {
                //alert('entro');
                if(response=="ok"){

                    $("#btn-login3").html('<img src="imgs/ajax-loader2.gif" /> &nbsp; Iniciando ...');
                    $.ajax({
                        url:'modulos.php',
                        type:'GET',
                        error: function(xhr, error){
                            console.log(xhr); console.log(error);
                        },
                        success: function(data){

                            $('#opciones').html(data);
                        }
                    });

                    alert('Modulo registrado con Exito.');
                    //setTimeout(' window.location.href = "Home.php"; ',2500);
                }
                else{

                    $("#error3").fadeIn(1000, function(){
                        $("#error3").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-login3").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                    });
                }
            }
        });
        return false;
    });
    
    $(".profile-usermenu #Inicio").click(function() {
        $.ajax({
            url:'Home.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(){
                $('#menuAdmin').fadeOut('slow');
                $('#opciones').fadeOut('slow');

            }
        });
    });

    /* Acceder a responsables */
    $(".profile-usermenu #Responsable").click(function() {
        $.ajax({
            url:'responsable.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                $('#menuAdmin').hide().html("<H1>Responsables</H1>").fadeIn('slow');
                $('#opciones').hide().html(data).fadeIn('slow');;

            }
        });
    });

    $("#opciones").on("click","#btn-loginResp", function(){
        //$('#btn-register').click(function() {
        /* Forma para registrar Responsables */

        var $elemento = $(this).parent().parent();
        //alert($elemento.attr('id'));
        var data = $elemento.serialize();

        $.ajax({

            type : 'POST',
            url  : './conf/ejecutor.php',
            data : data,
            beforeSend: function()
            {
                $("#errorResp").fadeOut();
                $("#btn-loginResp").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Enviando ...');
            },
            error : function(response2) {

                $("#errorResp").fadeIn(1000, function(){
                    $("#errorResp").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response2+' !</div>');
                    $("#btn-loginResp").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                });
            },
            success :  function(response)
            {
                //alert('entro');
                if(response.trim()=="ok"){

                    $("#btn-loginResp").html('<img src="imgs/ajax-loader2.gif" /> &nbsp; Iniciando ...');
                    $.ajax({
                        url:'responsable.php',
                        type:'GET',
                        error: function(xhr, error){
                            console.log(xhr); console.log(error);
                        },
                        success: function(data){

                            $('#opciones').html(data);
                        }
                    });

                    alert('Responsable registrado con Exito.');
                    //setTimeout(' window.location.href = "Home.php"; ',2500);
                }
                else{

                    $("#errorResp").fadeIn(1000, function(){
                        $("#errorResp").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-loginResp").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                    });
                }
            }
        });
        return false;
    });

    /* Borrar Responsable */
    $("#opciones").on("click",".borrarResp", function() {
        console.log('entro2');
        var id = $(this).attr("id");
        var $element = $(this);

        $.ajax({
            url:'./conf/ejecutor.php?eliminarResp='+id,
            type: "POST",
            data: "eliminarResp="+id,
            success: function(response){
                //alert('Hola');
                if(response.trim()=="ok") {
                    $element.parent().parent().remove();
                } else {

                    $("#errorResp").fadeIn(1000, function(){
                        $("#errorResp").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-loginResp").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                    });
                }
            },
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            }
        });
    });




    $(".profile-usermenu #Sucursal").click(function() {
        $.ajax({
            url:'sucursal.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                $('#menuAdmin').hide().html("<H1>Sucursales</H1>").fadeIn('slow');
                $('#opciones').hide().html(data).fadeIn('slow');;

            }
        });
    });

    $(".profile-usermenu #Ubicacion").click(function() {
        $.ajax({
            url:'ubicacion.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                $('#menuAdmin').hide().html("<H1>Ubicacion</H1>").fadeIn('slow');
                $('#opciones').hide().html(data).fadeIn('slow');;

            }
        });
    });


    $(".profile-usermenu #Activos").click(function() {
        $.ajax({
            url:'activos.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                $('#menuAdmin').hide().html("<H1>Registro de Activos</H1>").fadeIn('slow');
                $('#opciones').hide().html(data).fadeIn('slow');;

            }
        });
    });

});