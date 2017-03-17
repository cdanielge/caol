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
