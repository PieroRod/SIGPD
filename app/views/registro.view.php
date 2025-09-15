<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Partida</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            @font-face {
            font-family: "Berlin Sans FB Demi";
            src: url("assets/BerlinSansFBDemi.ttf") format("truetype");
            }
        </style>
    </head>
    <body>
        <?php if(!empty($error)) echo "<script>alert('$error');</script>"; ?>
        
        <div class="d-none d-sm-block d-lg-none">
            <button class="btn btn-sm mx-auto d-block mt-5"><a href="index.php?ruta=inicio"><img src="assets/UI/salir.png" width="300px"></a></button>
            <p class="text-center mt-5" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 50px;">Registrarse</p>

            <div class="mx-auto" style="position: relative; width: 100%; max-width: 600px;">
                <img src="assets/UI/NombreYContra.png" alt="" style="display:block; width:100%; height:auto;">

                <form action="index.php?ruta=signin" method="post">
                    <input class="btn" type="text" name="usuario" id="txtUsuario" placeholder="Nombre"
                        style="position:absolute; top:7%; left:0; right:0; width:90%; max-width:550px; height:90px;
                                margin:0 auto; font-family:  'Berlin Sans FB Demi'; font-size:40px; color:rgb(56,20,5);">

                    <input class="btn" type="text" name="contrasena" id="txtContrasena" placeholder="Contraseña"
                        style="position:absolute; top:36%; left:0; right:0; width:90%; max-width:550px; height:90px;
                                margin:0 auto; font-family: 'Berlin Sans FB Demi'; font-size:40px; color:rgb(56,20,5);">

                    <button type="submit" class="btn btn-sm mx-auto d-block mt-5" id="signin"><img src="assets/UI/ingresar.png" width="400"></button>
                </form>
            </div>
        </div>
    </body>
</html>