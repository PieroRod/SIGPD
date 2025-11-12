<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FlowerDraft</title>
        <link rel="icon" type="image/png" href="assets/UI/logo.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            @font-face {
            font-family: "Berlin Sans FB Demi";
            src: url("assets/BerlinSansFBDemi.ttf") format("truetype");
            }
        </style>
    </head>
    <body style="background-image: url(assets/UI/fondo_inicio.png); background-repeat: no-repeat; background-size: cover;">
            
        <?php if(!empty($error)) echo "<script>alert('$error');</script>"; ?>
        
        <!--Celular-->
        <!--region-->
        <div class="d-block d-sm-none" style="height: 98vh;">
            <button class="btn btn-sm mx-auto d-block mt-2"><a href="index.php?ruta=inicio"><img src="assets/UI/salir.png" width="120px"></a></button>
            <p class="text-center mt-2" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 30px;">Inicia sesion</p>

            <div class="mx-auto" style="position: relative; width: 100%; max-width: 400px;">
                <img src="assets/UI/NombreYContra.png" alt="" style="display:block; width:100%; height:auto;">

                <form action="index.php?ruta=loginL" method="post">
                    <input class="btn" type="text" name="usuario" id="txtUsuario1" onkeypress="soloLetrasYNumeros(event)" maxlength="20" placeholder="Nombre"
                        style="position:absolute; top:3%; left:0; right:0; width:90%; max-width:400px; height:60px;
                                margin:0 auto; font-family:  'Berlin Sans FB Demi'; font-size:27px; color:rgb(56,20,5);">

                    <input class="btn" type="text" name="contrasena" id="txtContrasena1" onkeypress="soloLetrasYNumeros(event)" maxlength="20" placeholder="Contraseña"
                        style="position:absolute; top:33%; left:0; right:0; width:90%; max-width:400px; height:60px;
                                margin:0 auto; font-family: 'Berlin Sans FB Demi'; font-size:27px; color:rgb(56,20,5);">

                    <button type="submit" class="btn btn-sm mx-auto d-block mt-3" id="signinCel"><img src="assets/UI/ingresar.png" width="200"></button>
                </form>
            </div>
        </div>
        <!--#region-->

        <!--Tablet-->
        <main class="d-none d-sm-block d-lg-none" style="height: 95vh;">
            <button class="btn btn-sm mx-auto d-block mt-5"><a href="index.php?ruta=inicio"><img src="assets/UI/salir.png" width="300px"></a></button>
            <p class="text-center mt-5" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 50px;">Inicia Sesion</p>

            <div class="mx-auto" style="position: relative; width: 100%; max-width: 600px;">
                <img src="assets/UI/NombreYContra.png" alt="" style="display:block; width:100%; height:auto;">

                <form action="index.php?ruta=loginL" method="post">
                    <input class="btn" type="text" name="usuario" id="txtUsuario2" onkeypress="soloLetrasYNumeros(event)" maxlength="20" placeholder="Nombre"
                        style="position:absolute; top:7%; left:0; right:0; width:90%; max-width:550px; height:90px;
                                margin:0 auto; font-family:  'Berlin Sans FB Demi'; font-size:40px; color:rgb(56,20,5);">

                    <input class="btn" type="text" name="contrasena" id="txtContrasena2" onkeypress="soloLetrasYNumeros(event)" maxlength="20" placeholder="Contraseña"
                        style="position:absolute; top:36%; left:0; right:0; width:90%; max-width:550px; height:90px;
                                margin:0 auto; font-family: 'Berlin Sans FB Demi'; font-size:40px; color:rgb(56,20,5);">

                    <button type="submit" class="btn btn-sm mx-auto d-block mt-5" id="signinTab"><img src="assets/UI/ingresar.png" width="400"></button>
                </form>
            </div>
        </main>

        <!--Desktop-->
        <div class="d-none d-lg-block">
            <div class="position-relative text-center" style="width: 100%; width: auto; height: 10vh;">
                <button class="btn" style="position: absolute; left: 2%; width: 20%;"><a href="index.php?ruta=inicio"><img src="assets/UI/salir.png" style="width: 100%;"></a></button>
                <p class="text-center mt-3" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 4vw;">Inicia sesion</p>

                <div class="mx-auto mt-5" style="position: relative; width: 40%;" style="position: absolute; left: 2%;">
                    <img src="assets/UI/NombreYContra.png" alt="" style="display:block; width:100%; height:auto;">

                    <form action="index.php?ruta=loginL" method="post">
                        <input class="btn" type="text" name="usuario" onkeypress="soloLetrasYNumeros(event)" maxlength="20" id="txtUsuario3" placeholder="Nombre"
                            style="position:absolute; top:6%; left:0; right:0; width:90%; max-width:550px; height:90px;
                                    margin:0 auto; font-family:  'Berlin Sans FB Demi'; font-size:2.5vw; color:rgb(56,20,5);">

                        <input class="btn" type="text" name="contrasena" onkeypress="soloLetrasYNumeros(event)" maxlength="20" id="txtContrasena3" placeholder="Contraseña"
                            style="position:absolute; top:34%; left:0; right:0; width:90%; max-width:550px; height:90px;
                                    margin:0 auto; font-family: 'Berlin Sans FB Demi'; font-size:2.5vw; color:rgb(56,20,5);">

                        <button type="submit" class="btn btn-sm mx-auto d-block mt-5" id="signinCom"><img src="assets/UI/ingresar.png" style="width: 30vw;"></button>
                    </form>
                </div>
            </div>
        </div>

            
        <script src="js/sololetras.js"></script>
    </body>
</html>
    </body>
</html>
