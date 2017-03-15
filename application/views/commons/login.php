<!-- 
* Copyright 2016 Carlos Eduardo Alfaro Orellana
-->
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Material Dark</title>
	
     <!-- Normalize CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>static/css/normalize.css">
    
     <!-- Materialize CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>static/css/materialize.min.css">
    
     <!-- Material Design Iconic Font CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>static/css/material-design-iconic-font.min.css">
    
    <!-- Malihu jQuery custom content scroller CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>static/css/jquery.mCustomScrollbar.css">
    
    <!-- Sweet Alert CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>static/css/sweetalert.css">
    
    <!-- MaterialDark CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>static/css/style.css">
</head>
<body class="font-cover" id="login">
    <div class="container-login center-align">
        <div style="margin:15px 0;">
            <i class="zmdi zmdi-account-circle zmdi-hc-5x"></i>
            <p>Inicia sesión con tu cuenta</p>   
        </div>
        <form action='<?= base_url() ?>login' method='post' accept-charset='UTF-8' role="form">
            <div class="input-field">
                <input id="user" type="text" class="validate" name="user" >
                <label for="user"><i class="zmdi zmdi-account"></i>&nbsp; Usuario</label>
            </div>
            <div class="input-field col s12">
                <input id="password" type="password" class="validate" name="password">
                <label for="password"><i class="zmdi zmdi-lock"></i>&nbsp; Contraseña</label>
            </div>
            <button class="waves-effect waves-teal btn-flat" type="submit">Ingresar &nbsp; <i class="zmdi zmdi-mail-send"></i> </button>
        </form>
        <div class="divider" style="margin: 20px 0;"></div>

    </div>
    
    <!-- Sweet Alert JS -->
    <script src="<?= base_url() ?>static/js/sweetalert.min.js"></script>
    
    <!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?= base_url() ?>static/js/jquery-2.2.0.min.js"><\/script>')</script>
    
    <!-- Materialize JS -->
	<script src="<?= base_url() ?>static/js/materialize.min.js"></script>
    
    <!-- Malihu jQuery custom content scroller JS -->
	<script src="<?= base_url() ?>static/js/jquery.mCustomScrollbar.concat.min.js"></script>
    
    <!-- MaterialDark JS -->
	<script src="<?= base_url() ?>static/js/main.js"></script>
</body>
</html>