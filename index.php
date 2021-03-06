
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link rel="shortcut icon" href="imgs/favicon.ico">
    <style>
        body {
            background-color: #e9e9e9;
        }
        hr {
            display: block;
            height: 1px;
            border: 0;
            border-top: 1px solid #ccc;
            margin: 1em 0;
            padding: 0;
        }
    </style>


</head>
<body>
<div style="margin-top: 5%;" class="container">
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-2"></div>
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-8" >
            <img src="imgs/catemar.png" class="img-responsive" alt="logo de Catemar">
            <hr />
        </div>
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-2">

        </div>

    </div>
</div>

<div class="signin-form">

    <div class="container">

        <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-2"></div>
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-8" >
                <form class="form-signin" method="post" id="login-form" >

                    <h2 class="form-signin-heading">Entrar</h2>

                    <div id="error">
                        <!-- error will be shown here ! -->
                    </div>


                    <div class="form-group">
                        <input type="text" class="form-control" pattern="[\d]{9}" placeholder="Usuario"  name="user" id="user" maxlength="20" />
                        <span id="check-e"></span>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Contraseña" name="password" id="password" maxlength="100" title="Seis o mas Caracteres"/>

                    </div>

                    <hr />

                    <div class="form-group">
                        <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
                            <span class="glyphicon glyphicon-log-in"></span> &nbsp; Acceder
                        </button>
                    </div>

                </form>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-2"></div>
        </div>

    </div>

</div>
<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>

<script type="text/javascript" src="js/script.js"></script>

</body>
</html>
