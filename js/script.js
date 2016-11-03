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

    /* Registrar mapa nuevo en sistema */
    $("#opciones").on("click","#btn-login4", function(){
        //$('#btn-register').click(function() {
        /* Forma para registrar Modulos */

        var $elemento = $(this).parent().parent();
        //alert($elemento.attr('id'));


        var data = $elemento.serialize();

        //console.log(JSON.stringify(data));

        $.ajax({

            type : 'POST',
            url  : 'mapa_register.php',
            data : data,
            beforeSend: function()
            {
                $("#error4").fadeOut();
                $("#btn-login4").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Enviando ...');
            },
            success :  function(response)
            {
                //alert('entro');
                if(response=="ok"){

                    $("#btn-login4").html('<img src="imgs/ajax-loader2.gif" /> &nbsp; Iniciando ...');
                    $.ajax({
                        url:'mapas.php',
                        type:'GET',
                        error: function(xhr, error){
                            console.log(xhr); console.log(error);
                        },
                        success: function(data){

                            $('#opciones').html(data);
                        }
                    });

                    alert('Mapa registrado con Exito.');
                    //setTimeout(' window.location.href = "Home.php"; ',2500);
                }
                else{

                    $("#error4").fadeIn(1000, function(){
                        $("#error4").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-login4").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                    });
                }
            }
        });
        return false;
    });
    /* Fin registrar mapa */

    /* Eliminar mapa del sistema */
    $("#opciones").on("click",".borrar4", function() {
        console.log('entro2');
        var id = $(this).attr("id");
        var $element = $(this);

        $.ajax({
            url:'eliminarMapa.php?id='+id,
            type: "POST",
            data: "id="+id,
            success: function(response){
                //alert('Hola');
                //$element.parent().parent().remove();
                if(response.trim()=="ok") {
                    $element.parent().parent().remove();
                } else {

                    $("#error4").fadeIn(1000, function(){
                        $("#error4").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-login4").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                    });
                }
            },
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            }
        });
    });
    /* Fin Eliminar mapa del sistema */


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

        //console.log(JSON.stringify(data));

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
            url:'responsableMenu.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                //$('#menuAdmin').hide().html("<H1>Responsables</H1>").fadeIn('slow');
                if (data.trim()=='error') {
                    alert('No tiene permiso para acceder a este modulo.');

                }else {
                    $('#menuAdmin').hide().html(data).fadeIn('slow');
                    $('#opciones').fadeOut('slow');
                }

            }
        });
    });

    /* Acceder a registrar responsables */
    $("#menuAdmin").on("click","#crearRespons", function(){

        console.log('entro');
        $.ajax({
            url:'responsable.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                //alert(data);
                if (data.trim()=='error') {
                    alert('No tiene permiso para Registrar Responsables.');

                }else {
                    $('#opciones').hide().html(data).fadeIn('slow');
                }
            }
        });
    });
    /* Acceder a eliminar responsables */
    $("#menuAdmin").on("click","#eliminarRespons", function(){

        console.log('entro');
        $.ajax({
            url:'responsableEliminar.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                if (data.trim()=='error') {
                    alert('No tiene permiso para Eliminar Responsables.');

                }else {
                    $('#opciones').hide().html(data).fadeIn('slow');
                }
            }
        });
    });



    /* Registrar Responsable */
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
                if (response.trim()=='error') {
                    alert('No tiene permiso para registrar responsables.');

                }else {
                    if (response.trim() == "ok") {

                        $("#btn-loginResp").html('<img src="imgs/ajax-loader2.gif" /> &nbsp; Iniciando ...');
                        $.ajax({
                            url: 'responsable.php',
                            type: 'GET',
                            error: function (xhr, error) {
                                console.log(xhr);
                                console.log(error);
                            },
                            success: function (data) {

                                $('#opciones').html(data);
                            }
                        });

                        alert('Responsable registrado con Exito.');
                        //setTimeout(' window.location.href = "Home.php"; ',2500);
                    }
                    else {

                        $("#errorResp").fadeIn(1000, function () {
                            $("#errorResp").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                            $("#btn-loginResp").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                        });
                    }
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
                if (response.trim()=='error') {
                    alert('No tiene permiso para eliminar registros.');

                }else {
                    if (response.trim() == "ok") {
                        $element.parent().parent().remove();
                    } else {

                        $("#errorResp").fadeIn(1000, function () {
                            $("#errorResp").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                            $("#btn-loginResp").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                        });
                    }
                }
            },
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            }
        });
    });



    /* Acceder a Sucursal */
    $(".profile-usermenu #Sucursal").click(function() {
        $.ajax({
            url:'sucursalMenu.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                //$('#menuAdmin').hide().html("<H1>Sucursales</H1>").fadeIn('slow');
                if (data.trim()=='error') {
                    alert('No tiene permiso para acceder a este modulo.');

                }else {
                    $('#menuAdmin').hide().html(data).fadeIn('slow');
                    $('#opciones').fadeOut('slow');
                }

            }
        });
    });

    /* Acceder a eliminar Sucursal */
    $("#menuAdmin").on("click","#eliminarSucu", function(){

        console.log('entro');
        $.ajax({
            url:'sucursalEliminar.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                if (data.trim()=='error') {
                    alert('No tiene permiso para acceder a esta opción.');

                }else {
                    $('#opciones').hide().html(data).fadeIn('slow');
                }
            }
        });
    });

    /* Acceder a Crear Sucursal */
    $("#menuAdmin").on("click","#crearSucu", function(){

        console.log('entro');
        $.ajax({
            url:'sucursal.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                if (data.trim()=='error') {
                    alert('No tiene permiso para acceder a esta opción.');

                }else {
                    $('#opciones').hide().html(data).fadeIn('slow');
                }
            }
        });
    });



    /* Registrar Sucursal */
    $("#opciones").on("click","#btn-loginSucu", function(){
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
                $("#errorSucu").fadeOut();
                $("#btn-loginSucu").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Enviando ...');
            },
            error : function(response2) {

                $("#errorSucu").fadeIn(1000, function(){
                    $("#errorSucu").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response2+' !</div>');
                    $("#btn-loginSucu").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                });
            },
            success :  function(response)
            {
                //alert('entro');
                if(response.trim()=="ok"){

                    $("#btn-loginSucu").html('<img src="imgs/ajax-loader2.gif" /> &nbsp; Iniciando ...');
                    $.ajax({
                        url:'sucursal.php',
                        type:'GET',
                        error: function(xhr, error){
                            console.log(xhr); console.log(error);
                        },
                        success: function(data){

                            $('#opciones').html(data);
                        }
                    });

                    alert('Sucursal registrada con Exito.');
                    //setTimeout(' window.location.href = "Home.php"; ',2500);
                }
                else{

                    $("#errorSucu").fadeIn(1000, function(){
                        $("#errorSucu").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-loginSucu").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                    });
                }
            }
        });
        return false;
    });

    /* Borrar Sucursal */
    $("#opciones").on("click",".borrarSucursal", function() {
        console.log('entro2');
        var id = $(this).attr("id");
        var $element = $(this);

        $.ajax({
            url:'./conf/ejecutor.php?eliminarSucu='+id,
            type: "POST",
            data: "eliminarSucu="+id,
            success: function(response){
                //alert('Hola');
                if(response.trim()=="ok") {
                    $element.parent().parent().remove();
                } else {

                    $("#errorSucu").fadeIn(1000, function(){
                        $("#errorSucu").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-loginSucu").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                    });
                }
            },
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            }
        });
    });


    /* Acceder a Ubicacion */
    $(".profile-usermenu #Ubicacion").click(function() {
        $.ajax({
            url:'ubicacionMenu.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                //$('#menuAdmin').hide().html("<H1>Ubicacion</H1>").fadeIn('slow');
                if (data.trim()=='error') {
                    alert('No tiene permiso para acceder a este modulo.');

                }else {
                    $('#menuAdmin').hide().html(data).fadeIn('slow');
                    $('#opciones').fadeOut('slow');
                }

            }
        });
    });

    /* Acceder a Crear Ubicacion */
    $("#menuAdmin").on("click","#crearUbic", function(){

        console.log('entro');
        $.ajax({
            url:'ubicacion.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                if (data.trim()=='error') {
                    alert('No tiene permiso para acceder a este modulo.');

                }else {
                    $('#opciones').hide().html(data).fadeIn('slow');
                }
            }
        });
    });

    /* Acceder a Eliminar Ubicacion*/
    $("#menuAdmin").on("click","#eliminarUbic", function(){

        console.log('entro');
        $.ajax({
            url:'ubicacionEliminar.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                if (data.trim()=='error') {
                    alert('No tiene permiso para acceder a este modulo.');

                }else {
                    $('#opciones').hide().html(data).fadeIn('slow');
                }
            }
        });
    });



    /* Registrar Ubicacion */
    $("#opciones").on("click","#btn-loginUbic", function(){
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
                $("#errorUbic").fadeOut();
                $("#btn-loginUbic").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Enviando ...');
            },
            error : function(response2) {

                $("#errorUbic").fadeIn(1000, function(){
                    $("#errorUbic").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response2+' !</div>');
                    $("#btn-loginUbic").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                });
            },
            success :  function(response)
            {
                //alert('entro');
                if(response.trim()=="ok"){

                    $("#btn-loginUbic").html('<img src="imgs/ajax-loader2.gif" /> &nbsp; Iniciando ...');
                    $.ajax({
                        url:'ubicacion.php',
                        type:'GET',
                        error: function(xhr, error){
                            console.log(xhr); console.log(error);
                        },
                        success: function(data){

                            $('#opciones').html(data);
                        }
                    });

                    alert('Ubicación registrada con Exito.');
                    //setTimeout(' window.location.href = "Home.php"; ',2500);
                }
                else{

                    $("#errorUbic").fadeIn(1000, function(){
                        $("#errorUbic").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-loginUbic").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                    });
                }
            }
        });
        return false;
    });

    /* Borrar Ubicacion */
    $("#opciones").on("click",".borrarUbic", function() {
        console.log('entro2');
        var id = $(this).attr("id");
        var $element = $(this);

        $.ajax({
            url:'./conf/ejecutor.php?eliminarUbic='+id,
            type: "POST",
            data: "eliminarUbic="+id,
            success: function(response){
                //alert('Hola');
                if(response.trim()=="ok") {
                    $element.parent().parent().remove();
                } else {

                    $("#errorUbic").fadeIn(1000, function(){
                        $("#errorUbic").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-loginUbic").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                    });
                }
            },
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            }
        });
    });

    /* Al precionar el boton de Gestion de Activos llamar el menu de Activos */
    $(".profile-usermenu #Asignacion").click(function() {
        $.ajax({
            url:'activosMenu.php',
            type:'GET',
            success: function(data){
                //alert(data);
                if (data.trim()=='error') {
                    alert('No tiene permiso para acceder a este modulo.');

                }else {
                    $('.profile-content #menuAdmin').hide().html(data).fadeIn('slow');
                    $('.profile-content #opciones').fadeOut('slow');
                }

            }
        });

    });

    $("#menuAdmin").on("click","#activosGestion", function(){

        console.log('entro');
        $.ajax({
            url:'activos.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                if (data.trim()=='error') {
                    alert('No tiene permiso para acceder a esta opción.');

                }else {
                    $('#opciones').hide().html(data).fadeIn('slow');
                }
            }
        });
    });

    /* Acceder a activos*/
    /*  $(".profile-usermenu #Activos").click(function() {
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
     */
    /* Registrar Activo */
    $("#opciones").on("click","#btn-loginAct", function(){
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
                $("#errorAct").fadeOut();
                $("#btn-loginAct").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Enviando ...');
            },
            error : function(response2) {

                $("#errorAct").fadeIn(1000, function(){
                    $("#errorAct").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response2+' !</div>');
                    $("#btn-loginAct").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                });
            },
            success :  function(response)
            {
                //alert('entro');


                    if (response.trim()=='error') {
                        alert('No tiene permiso para registrar activos.');
                        $("#btn-loginAct").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                    }else {

                        if(response.trim()=="ok"){
                            $("#btn-loginAct").html('<img src="imgs/ajax-loader2.gif" /> &nbsp; Iniciando ...');
                            $.ajax({
                                url: 'activos.php',
                                type: 'GET',
                                error: function (xhr, error) {
                                    console.log(xhr);
                                    console.log(error);
                                },
                                success: function (data) {

                                    $('#opciones').html(data);
                                }
                            });

                            alert('Activo registrado con Exito.');
                        }
                        else{

                            $("#errorAct").fadeIn(1000, function(){
                                $("#errorAct").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                                $("#btn-loginAct").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                            });
                        }
                    }
                    //setTimeout(' window.location.href = "Home.php"; ',2500);

            }
        });
        return false;
    });

    /* Borrar Activo */
    $("#opciones").on("click",".borrarAct", function() {
        console.log('entro2');
        var id = $(this).attr("id");
        var $element = $(this);


            $.ajax({
                url: './conf/ejecutor.php?eliminarAct=' + id,
                type: "POST",
                data: "eliminarAct=" + id,
                success: function (response) {
                    //alert('Hola');
                    if (response.trim()=='error') {
                        alert('No tiene permiso para eliminar activos.');

                    }else {
                        if (response.trim() == "ok") {
                            $element.parent().parent().remove();
                        } else {

                            $("#errorAct").fadeIn(1000, function () {
                                $("#errorAct").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                                $("#btn-loginAct").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                            });
                        }
                    }
                },
                error: function (xhr, error) {
                    console.log(xhr);
                    console.log(error);
                }
            });

    });


    /* Modificar Activo */
    $("#opciones").on("click",".modifActivo", function() {
        console.log('entro2');
        var id = $(this).attr("id");
        var $element = $(this);
        var tiempoadq = "tiempoadq"+id;
        var tiempodepre = "tiempodepre"+id;
        var valor = "valor"+id;
        var ubic = "ubic"+id;
        
        //alert(tiempoadq);


        var data2 = {tiempoadq:$("#"+tiempoadq).val(),tiempodepre:$("#"+tiempodepre).val(),
         valor:$("#"+valor).val(),ubic:$("#"+ubic).val(),btnmodAct:'1'};

        //var data = data2.serialize();

        //console.log(JSON.stringify(data2));

        //alert($data);


            $.ajax({
                url: './conf/ejecutor.php?modificarAct=' + id,
                type: "POST",
                data: data2,
                success: function (response) {
                    if (response.trim()=='error') {
                        alert('No tiene permiso para modificar activos.');

                    }else {
                        //alert('Hola');
                        if (response.trim() == "ok") {
                            //$element.parent().parent().remove();
                            alert('Registro modificado con Exito.');
                        } else {
                            //alert('entro1');
                            $("#errorAct").fadeIn(1000, function () {
                                $("#errorAct").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                                $("#btn-loginAct").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                            });
                        }
                    }

                },
                error: function (xhr, error) {
                    alert('entro2');
                    console.log(xhr);
                    console.log(error);
                }
            });

    });
/*
    $("#opciones").on("click",".fechaadq", function() {
        var elemento = $(this);
        alert('cambio');

        $('.fechaadq').datepicker()
            .on("change", function (e) {
                alert("Date changed: ", e.target.value);
            });

    });
*/





    /* Ingresar a Asignar Activos*/
    $("#menuAdmin").on("click","#asignarGestion", function(){

        console.log('entro');
        $.ajax({
            url:'asignarActivo.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){

                $('#opciones').hide().html(data).fadeIn('slow');
            }
        });
    });

    /* Registrar Asignacion de Activo */
    $("#opciones").on("click","#btn-loginRela", function(){
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
                $("#errorRelacion").fadeOut();
                $("#btn-loginRela").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Enviando ...');
            },
            error : function(response2) {

                $("#errorRelacion").fadeIn(1000, function(){
                    $("#errorRelacion").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response2+' !</div>');
                    $("#btn-loginRela").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                });
            },
            success :  function(response)
            {
                //alert('entro');
                if (response.trim()=="error") {
                    alert('No tiene permisos para realizar asinacion de activos.');
                    $("#btn-loginRela").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                } else {
                    if(response.trim()=="ok"){

                        $("#btn-loginRela").html('<img src="imgs/ajax-loader2.gif" /> &nbsp; Iniciando ...');
                        $.ajax({
                            url:'asignarActivo.php',
                            type:'GET',
                            error: function(xhr, error){
                                console.log(xhr); console.log(error);
                            },
                            success: function(data){

                                $('#opciones').html(data);
                            }
                        });

                        alert('Activo registrado con Exito.');
                        //setTimeout(' window.location.href = "Home.php"; ',2500);
                    }
                    else{

                        $("#errorRelacion").fadeIn(1000, function(){
                            $("#errorRelacion").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                            $("#btn-loginRela").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                        });
                    }
                }
            }
        });
        return false;
    });


    /* Ingresar a Modificar Asignacion de Activos*/
    $("#menuAdmin").on("click","#modificarGestion", function(){

        console.log('entro');
        $.ajax({
            url:'modificarAsignacion.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){

                $('#opciones').hide().html(data).fadeIn('slow');
            }
        });
    });


    /* Filtrar Asignaciones por Responsable */
    $("#opciones").on("change",".filtros", function(){

        console.log('entro');
        //$('#opciones').hide().html(data).fadeIn('slow');

        var rows = $('#opciones #tableRelacion tr').each(function() {
            var row = $(this);
            var columns = row.children('td');
            //alert('entro');

            row.data('name-chars', [
                columns.eq(1).html(),
            ]);
            //console.log(row.data());
        });

        var char = $(this).val();
        //alert('entro');
        rows.each(function() {
            var row = $(this);
            var columns = row.children('td');
            var chars_to_match = row.data('name-chars');
            if($.inArray(char, chars_to_match) > -1) {

                columns.show();
            }
            else {
                columns.hide();
            }
        });
    });

    /* Filtrar Asignaciones por Sucursal */
    $("#opciones").on("change",".filtros2", function(){

        console.log('entro');
        //$('#opciones').hide().html(data).fadeIn('slow');

        var rows = $('#opciones #tableRelacion tr').each(function() {
            var row = $(this);
            var columns = row.children('td');
            //alert('entro');

            row.data('name-chars', [
                columns.eq(2).html(),
            ]);
            //console.log(row.data());
        });

        var char = $(this).val();
        //alert('entro');
        rows.each(function() {
            var row = $(this);
            var columns = row.children('td');
            var chars_to_match = row.data('name-chars');
            if($.inArray(char, chars_to_match) > -1) {

                columns.show();
            }
            else {
                columns.hide();
            }
        });

    });

    /* Filtrar Asignaciones por Ubicacion */
    $("#opciones").on("change",".filtros3", function(){

        console.log('entro');
        //$('#opciones').hide().html(data).fadeIn('slow');

        var rows = $('#opciones #tableRelacion tr').each(function() {
            var row = $(this);
            var columns = row.children('td');
            //alert('entro');

            row.data('name-chars', [
                columns.eq(3).html(),
            ]);
            //console.log(row.data());
        });

        var char = $(this).val();
        //alert('entro');
        rows.each(function() {
            var row = $(this);
            var columns = row.children('td');
            var chars_to_match = row.data('name-chars');
            if($.inArray(char, chars_to_match) > -1) {

                columns.show();
            }
            else {
                columns.hide();
            }
        });

    });


    /* Ingresar a eliminar Asignacion de Activos*/
    $("#menuAdmin").on("click","#eliminarGestion", function(){

        console.log('entro');
        $.ajax({
            url:'eliminarAsignacion.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){

                $('#opciones').hide().html(data).fadeIn('slow');
            }
        });
    });

    /* Borrar Asignacion de Activo */
    $("#opciones").on("click",".eliminAsignacion", function() {
        console.log('entro2');
        var id = $(this).attr("id");
        var $element = $(this);

        $.ajax({
            url:'./conf/ejecutor.php?eliminarAsig='+id,
            type: "POST",
            data: "eliminarAsig="+id,
            success: function(response){
                //alert('Hola');
                if (response.trim()=='error'){
                    alert('No esta autorizado para eliminar relaciones.');
                } else {

                    if (response.trim() == "ok") {
                        $element.parent().parent().remove();
                    } else {

                        $("#errorEliminarAsig").fadeIn(1000, function () {
                            $("#errorEliminarAsig").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                            // $("#btn-loginAct").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                        });
                    }
                }
            },
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            }
        });
    });


    /* Filtrar Responsable por Responsable */
    $("#opciones").on("change",".filtrosResp", function(){

        console.log('entro');
        //$('#opciones').hide().html(data).fadeIn('slow');

        var rows = $('#opciones #tablaResponsable tr').each(function() {
            var row = $(this);
            var columns = row.children('td');
            //alert('entro');

            row.data('name-chars', [
                columns.eq(0).html(),
            ]);
            //console.log(row.data());
        });

        var char = $(this).find('option:selected').text();
        //var char = $(this).val();
        //alert('entro');
        rows.each(function() {
            var row = $(this);
            var columns = row.children('td');
            var chars_to_match = row.data('name-chars');
            if($.inArray(char.trim(), chars_to_match) > -1) {

                columns.show();
            }
            else {
                columns.hide();
            }
        });
    });

    /* Filtrar Responsables por Ubicacion */
    $("#opciones").on("change",".filtrosResp2", function(){

        console.log('entro');
        //$('#opciones').hide().html(data).fadeIn('slow');

        var rows = $('#opciones #tablaResponsable tr').each(function() {
            var row = $(this);
            var columns = row.children('td');
            //alert('entro');

            row.data('name-chars', [
                columns.eq(2).html(),
            ]);
            //console.log(row.data());
        });

        var char = $(this).find('option:selected').text();
        //var char = $(this).val();
        //alert('entro');
        rows.each(function() {
            var row = $(this);
            var columns = row.children('td');
            var chars_to_match = row.data('name-chars');
            if($.inArray(char.trim(), chars_to_match) > -1) {

                columns.show();
            }
            else {
                columns.hide();
            }
        });

    });

    /* Filtrar Ubicacion por Ubicacion */
    $("#opciones").on("change",".filtrosUbic2", function(){

        console.log('entro');
        //$('#opciones').hide().html(data).fadeIn('slow');

        var rows = $('#opciones #tablaUbicacion tr').each(function() {
            var row = $(this);
            var columns = row.children('td');
            //alert('entro');

            row.data('name-chars', [
                columns.eq(0).html(),
            ]);
            //console.log(row.data());
        });

        var char = $(this).find('option:selected').text();
        //var char = $(this).val();
        //alert('entro');
        rows.each(function() {
            var row = $(this);
            var columns = row.children('td');
            var chars_to_match = row.data('name-chars');
            if($.inArray(char.trim(), chars_to_match) > -1) {

                columns.show();
            }
            else {
                columns.hide();
            }
        });

    });


    /* Filtrar Ubicacion por Sucursal */
    $("#opciones").on("change",".filtrosUbic", function(){

        console.log('entro');
        //$('#opciones').hide().html(data).fadeIn('slow');

        var rows = $('#opciones #tablaUbicacion tr').each(function() {
            var row = $(this);
            var columns = row.children('td');
            //alert('entro');

            row.data('name-chars', [
                columns.eq(1).html(),
            ]);
            //console.log(row.data());
        });

        var char = $(this).find('option:selected').text();
        //var char = $(this).val();
        //alert(char);
        rows.each(function() {
            var row = $(this);
            var columns = row.children('td');
            var chars_to_match = row.data('name-chars');
            //alert(chars_to_match);
            if($.inArray(char.trim(), chars_to_match) > -1) {

                columns.show();
            }
            else {
                columns.hide();
            }
        });

    });


    /* Filtrar Sucursal por Sucursal */
    $("#opciones").on("change",".filtrosSucu", function(){

        console.log('entro');
        //$('#opciones').hide().html(data).fadeIn('slow');

        var rows = $('#opciones #tablaSucursal tr').each(function() {
            var row = $(this);
            var columns = row.children('td');
            //alert('entro');

            row.data('name-chars', [
                columns.eq(1).html(),
            ]);
            //console.log(row.data());
        });

        var char = $(this).find('option:selected').text();
        //var char = $(this).val();
        //alert(char);
        rows.each(function() {
            var row = $(this);
            var columns = row.children('td');
            var chars_to_match = row.data('name-chars');
            //alert(chars_to_match);
            if($.inArray(char.trim(), chars_to_match) > -1) {

                columns.show();
            }
            else {
                columns.hide();
            }
        });

    });


    /* Acceder a menu de Categorias */
    $(".profile-usermenu #Categorias").click(function() {
        $.ajax({
            url:'categoriasMenu.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                //$('#menuAdmin').hide().html("<H1>Sucursales</H1>").fadeIn('slow');
                if (data.trim()=='error') {
                    alert('No tiene permiso para acceder a este modulo.');

                }else {
                    $('#menuAdmin').hide().html(data).fadeIn('slow');
                    $('#opciones').fadeOut('slow');
                }

            }
        });
    });
    // acceder a crear Categorias
    $("#menuAdmin").on("click","#crearCategoria", function(){

        console.log('entro');
        $.ajax({
            url:'categorias.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                $('#opciones').hide().html(data).fadeIn('slow');
            }
        });
    });

    /* Registrar Categorias */
    $("#opciones").on("click","#btn-loginCate", function(){
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
                $("#errorCate").fadeOut();
                $("#btn-loginCate").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Enviando ...');
            },
            error : function(response2) {

                $("#errorCate").fadeIn(1000, function(){
                    $("#errorCate").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response2+' !</div>');
                    $("#btn-loginCate").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                });
            },
            success :  function(response)
            {
                //alert('entro');
                if (response.trim()=="error") {
                    alert('No tiene permisos para crear Categorias.');
                    $("#btn-loginCate").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                } else {
                    if(response.trim()=="ok"){

                        $("#btn-loginCate").html('<img src="imgs/ajax-loader2.gif" /> &nbsp; Iniciando ...');
                        $.ajax({
                            url:'categorias.php',
                            type:'GET',
                            error: function(xhr, error){
                                console.log(xhr); console.log(error);
                            },
                            success: function(data){

                                $('#opciones').html(data);
                            }
                        });

                        alert('Categoria registrada con Exito.');
                        //setTimeout(' window.location.href = "Home.php"; ',2500);
                    }
                    else{

                        $("#errorCate").fadeIn(1000, function(){
                            $("#errorCate").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                            $("#btn-loginCate").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                        });
                    }
                }
            }
        });
        return false;
    });


    /* Borrar Categoria */
    $("#opciones").on("click",".borrarCateg", function() {
        console.log('entro2');
        var id = $(this).attr("id");
        var $element = $(this);


        $.ajax({
            url: './conf/ejecutor.php?eliminarCate=' + id,
            type: "POST",
            data: "eliminarCate=" + id,
            success: function (response) {
                //alert('Hola');
                if (response.trim()=='error') {
                    alert('No tiene permiso para eliminar Categorias.');

                }else {
                    if (response.trim() == "ok") {
                        $element.parent().parent().remove();
                    } else {

                        $("#errorCate").fadeIn(1000, function () {
                            $("#errorCate").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                            $("#btn-loginCate").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                        });
                    }
                }
            },
            error: function (xhr, error) {
                console.log(xhr);
                console.log(error);
            }
        });

    });


    // acceder a crear Sub Categorias
    $("#menuAdmin").on("click","#crearSubCategoria", function(){

        console.log('entro');
        $.ajax({
            url:'subcategorias.php',
            type:'GET',
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(data){
                $('#opciones').hide().html(data).fadeIn('slow');
            }
        });
    });

    /* Registrar Sub Categorias */
    $("#opciones").on("click","#btn-loginsCate", function(){
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
                $("#errorSubCate").fadeOut();
                $("#btn-loginsCate").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Enviando ...');
            },
            error : function(response2) {

                $("#errorSubCate").fadeIn(1000, function(){
                    $("#errorSubCate").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response2+' !</div>');
                    $("#btn-loginsCate").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                });
            },
            success :  function(response)
            {
                //alert('entro');
                if (response.trim()=="error") {
                    alert('No tiene permisos para crear Sub-Categorias.');
                    $("#btn-loginsCate").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                } else {
                    if(response.trim()=="ok"){

                        $("#btn-loginsCate").html('<img src="imgs/ajax-loader2.gif" /> &nbsp; Iniciando ...');
                        $.ajax({
                            url:'subcategorias.php',
                            type:'GET',
                            error: function(xhr, error){
                                console.log(xhr); console.log(error);
                            },
                            success: function(data){

                                $('#opciones').html(data);
                            }
                        });

                        alert('Sub-Categoria registrada con Exito.');
                        //setTimeout(' window.location.href = "Home.php"; ',2500);
                    }
                    else{

                        $("#errorSubCate").fadeIn(1000, function(){
                            $("#errorSubCate").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                            $("#btn-loginsCate").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                        });
                    }
                }
            }
        });
        return false;
    });



    /* Borrar Sub Categoria */
    $("#opciones").on("click",".borrarSubCateg", function() {
        console.log('entro2');
        var id = $(this).attr("id");
        var $element = $(this);


        $.ajax({
            url: './conf/ejecutor.php?eliminarsCate=' + id,
            type: "POST",
            data: "eliminarsCate=" + id,
            success: function (response) {
                //alert('Hola');
                if (response.trim()=='error') {
                    alert('No tiene permiso para eliminar Sub-Categorias.');

                }else {
                    if (response.trim() == "ok") {
                        $element.parent().parent().remove();
                    } else {

                        $("#errorSubCate").fadeIn(1000, function () {
                            $("#errorSubCate").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                            $("#btn-loginsCate").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                        });
                    }
                }
            },
            error: function (xhr, error) {
                console.log(xhr);
                console.log(error);
            }
        });

    });

    //detectar cambio de categoria en activos y actualizar combo de sub categorias
    $("#opciones").on("change","#categ", function() {
        console.log('entro2');
        var id = $(this).val();
        var $element = $(this);


        $.ajax({
            url: './conf/ejecutor.php?bCate=' + id,
            type: "POST",
            data: "bCate=" + id,
            success: function (response) {
                //alert('Hola');
                if (response.trim()=='error') {
                    alert('No ha seleccionado una categoria correcta.');

                }else {
                    if (response.trim() != "error") {
                        $('#subcateg').html(response);
                        //alert(response);
                    } else {

                        $("#errorAct").fadeIn(1000, function () {
                            $("#errorAct").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                            $("#btn-loginAct").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar');
                        });
                    }
                }
            },
            error: function (xhr, error) {
                console.log(xhr);
                console.log(error);
            }
        });

    });


    $("#opciones").on("click",".editongo", function(){
        console.log('entro cambio');
        var id = $(this).attr("id");
        var newpass = $('#newpass').val();

        $.ajax({
            url:'./conf/ejecutor.php',
            type:'GET',
            data:{
                newpass:newpass,
                modpass:'modificarpass',
                id:id
            },
            error: function(xhr, error){
                console.log(xhr); console.log(error);
            },
            success: function(response){
                //alert('entro');
                if(response.trim()=="ok"){

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
                    alert('Contraseña modificada con Exito.');
                    // $('#cambiodepass').show();
                    // $('#cambiodepass2').show();
                    //setTimeout(' window.location.href = "Home.php"; ',2500);
                }
                else{

                    $("#error2").fadeIn(1000, function(){
                        $("#error2").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');

                    });
                }
            }


        });

    });


    /* Al precionar el boton de Reportes llamar el menu de Reportes */
    $(".profile-usermenu #Reportes").click(function() {
        $.ajax({
            url:'reportesMenu.php',
            type:'GET',
            success: function(data){
                //alert(data);
                $('.profile-content #menuAdmin').hide().html(data).fadeIn('slow');
                $('.profile-content #opciones').fadeOut('slow');


            }
        });

    });


});




