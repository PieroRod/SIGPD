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

        <!-- Escritorio -->
        <main class="d-none d-lg-block">
            <div style="position: relative; height: 73vh; width: 98vw;">
                <button class="btn btn-sm" style="position: absolute; width: 13%; top: 1%; left: 2%;"><a href="index.php?ruta=logout"><img src="assets/UI/salir.png" style="width: 100%;"></a></button>
                <div style="position: relative; width: 32.5%; height: auto; top: 10%; left: 15%">
                    <img style="position: relative; width:100%;" src="assets/UI/mejorespartidas.png">
                    <table style="position: absolute; left: 12%; top: 33%;">
                        <?php if (!empty($_SESSION['topPartidas'])): ?>
                            <?php foreach ($_SESSION['topPartidas'] as $partida): ?>
                                <tr>
                                <td style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 1.8vw; padding-right: 2.5vw; padding-bottom: 1.1vh"><?= htmlspecialchars(date('d/m/Y', strtotime($partida['creacion']))) ?></td>
                                <td style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 1.8vw; padding-right: 3vw; padding-bottom: 1.1vh"><?= htmlspecialchars(date('H:i:s', strtotime($partida['creacion']))) ?></td>
                                <td style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 1.8vw; padding-bottom: 1.1vh"><?= htmlspecialchars($partida['puntos_totales']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </table>
                </div>
                <div style="position: absolute; right: 15%; top: 30%;">
                    <p class="text-center" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 3vw;">Bienvenid@, <?= $_SESSION['jugador']?></p>
                    <p class="text-center mt-2" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 3vw;">Partidas jugadas: <?= $_SESSION['partidas']?></p>
                    <p class="text-center mt-2" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 3vw;">Puntos totales: <?= $_SESSION['puntos']?></p>
                </div>
            </div>
            <button id="boton" class="btn mx-auto d-block" onclick="cambiarContrasena()" style="display: block; width: 25vw;"><img src="assets/UI/cambiarcontra.png" style="width: 100%;"></button>

            <div id="cambiarcontra" class="mt-5" style="display: none; position: relative; ">
                <p class="text-center mt-5" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 4vw;">Cambiar contraseña</p>
                 <img class="mx-auto d-block" src="assets/UI/NombreYContra.png" alt="" style="display:block; width: 40vw;">

                    <form action="index.php?ruta=cambiarContrasena" method="post">
                        <input class="btn" type="text" name="nuevacontra" onkeypress="soloLetrasYNumeros(event)" maxlength="20" id="txtContrasena" placeholder="Nueva contraseña"
                            style="position:absolute; top: 25%; left:0; right:0; width: 37vw; height:90px;
                                    margin:0 auto; font-family:  'Berlin Sans FB Demi'; font-size:2.5vw; color:rgb(56,20,5);">

                        <input class="btn" type="text" name="confcontra" onkeypress="soloLetrasYNumeros(event)" maxlength="20" id="txtContrasena" placeholder="Confirmar contraseña"
                            style="position: absolute; top:54%; left:0; right:0; width: 37vw; height: 90px;
                                    margin:0 auto; font-family: 'Berlin Sans FB Demi'; font-size:2.5vw; color:rgb(56,20,5);">

                        <button type="submit" class="btn btn-sm mx-auto d-block mt-3 mb-5" style="width: 20vw"><img src="assets/UI/ingresar.png" style="width: 100%;"></button>
                    </form>
            </div>
        </main>

        <!--tablet-->
        <main class="d-none d-sm-block d-lg-none">
            <button class="btn btn-sm mx-auto d-block mt-3"><a href="index.php?ruta=inicio"><img src="assets/UI/salir.png" style="height: 8vh;"></a></button>                        
            <p class="text-center mt-5" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 6vh;">Bienvenid@, <?= $_SESSION['jugador']?></p>
            <p class="text-center mt-2" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 6vh;">Partidas jugadas: <?= $_SESSION['partidas']?></p>
            <p class="text-center mt-2" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 6vh;">Puntos totales: <?= $_SESSION['puntos']?></p>
            <div style="position: relative; height: 70vh;  width: auto;">
                <img class="mx-auto d-block" style="position: relative; height: 100%" src="assets/UI/mejorespartidas.png">
                <table style="position: absolute; left: 13%; top: 35%;">
                <?php if (!empty($_SESSION['topPartidas'])): ?>
                    <?php foreach ($_SESSION['topPartidas'] as $partida): ?>
                        <tr>                        
                            <td style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 4vh; padding-right: 8vh; padding-bottom: 1.1vh"><?= htmlspecialchars(date('d/m/Y', strtotime($partida['creacion']))) ?></td>
                            <td style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 4vh; padding-right: 8vh; padding-bottom: 1.1vh"><?= htmlspecialchars(date('H:i:s', strtotime($partida['creacion']))) ?></td>
                            <td style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 4vh; padding-bottom: 1.1vh"><?= htmlspecialchars($partida['puntos_totales']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </table>
            </div>
            <button id="botonT" class="btn mx-auto d-block mb-5" onclick="cambiarContrasenaT()" style="display: block; width: 50vh;"><img src="assets/UI/cambiarcontra.png" style="width: 100%;"></button>

            <div id="cambiarcontraT" class="mt-5" style="display: none; position: relative; ">
                <p class="text-center mt-5" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 6vh;">Cambiar contraseña</p>
                 <img class="mx-auto d-block" src="assets/UI/NombreYContra.png" alt="" style="display:block; width: 60vh;">

                    <form action="index.php?ruta=cambiarContrasena" method="post">
                        <input class="btn" type="text" name="nuevacontra" onkeypress="soloLetrasYNumeros(event)" maxlength="20" id="txtContrasena" placeholder="Nueva contraseña"
                            style="position:absolute; top: 25%; left:0; right:0; width: 55vh; height:90px;
                                    margin:0 auto; font-family:  'Berlin Sans FB Demi'; font-size:5vh; color:rgb(56,20,5);">

                        <input class="btn" type="text" name="confcontra" onkeypress="soloLetrasYNumeros(event)" maxlength="20" id="txtContrasena" placeholder="Confirmar contraseña"
                            style="position: absolute; top:52%; left:0; right:0; width: 55vh; height: 90px;
                                    margin:0 auto; font-family: 'Berlin Sans FB Demi'; font-size:5vh; color:rgb(56,20,5);">

                        <button type="submit" class="btn btn-sm mx-auto d-block mt-3 mb-5" style="width: 40vh"><img src="assets/UI/ingresar.png" style="width: 100%;"></button>
                    </form>
            </div>
        </main>

        <main class="d-block d-sm-none">
            <button class="btn btn-sm mx-auto d-block mt-3"><a href="index.php?ruta=inicio"><img src="assets/UI/salir.png" style="height: 8vh;"></a></button>                        
            <p class="text-center mt-5" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 6vh;">Bienvenid@, <?= $_SESSION['jugador']?></p>
            <p class="text-center mt-2" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 6vh;">Partidas jugadas: <?= $_SESSION['partidas']?></p>
            <p class="text-center mt-2" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 6vh;">Puntos totales: <?= $_SESSION['puntos']?></p>
            <div style="position: relative; height: 70vh;  width: auto;">
                <img class="mx-auto d-block" style="position: relative; height: 80%" src="assets/UI/mejorespartidas.png">
                <table style="position: absolute; left: 13%; top: 27%;">
                <?php if (!empty($_SESSION['topPartidas'])): ?>
                    <?php foreach ($_SESSION['topPartidas'] as $partida): ?>
                        <tr>                        
                            <td style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 3.5vh; padding-right: 4vh; padding-bottom: 0.6vh"><?= htmlspecialchars(date('d/m/Y', strtotime($partida['creacion']))) ?></td>
                            <td style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 3.5vh; padding-right: 4vh; padding-bottom: 0.6vh"><?= htmlspecialchars(date('H:i:s', strtotime($partida['creacion']))) ?></td>
                            <td style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 3.5vh; padding-bottom: 0.6vh"><?= htmlspecialchars($partida['puntos_totales']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </table>
            </div>
            <button id="botonC" class="btn mx-auto d-block mb-5" onclick="cambiarContrasenaC()" style="display: block; width: 50vh;"><img src="assets/UI/cambiarcontra.png" style="width: 100%;"></button>

            <div id="cambiarcontraC" class="mt-5" style="display: none; position: relative; ">
                <p class="text-center mt-5" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 6vh;">Cambiar contraseña</p>
                 <img class="mx-auto d-block" src="assets/UI/NombreYContra.png" alt="" style="display:block; width: 60vh;">

                    <form action="index.php?ruta=cambiarContrasena" method="post">
                        <input class="btn" type="text" name="nuevacontra" onkeypress="soloLetrasYNumeros(event)" maxlength="20" id="txtContrasena" placeholder="Nueva contraseña"
                            style="position:absolute; top: 25%; left:0; right:0; width: 55vh; height:45px;
                                    margin:0 auto; font-family:  'Berlin Sans FB Demi'; font-size:5vh; color:rgb(56,20,5);">

                        <input class="btn" type="text" name="confcontra" onkeypress="soloLetrasYNumeros(event)" maxlength="20" id="txtContrasena" placeholder="Confirmar contraseña"
                            style="position: absolute; top:52%; left:0; right:0; width: 55vh; height: 45px;
                                    margin:0 auto; font-family: 'Berlin Sans FB Demi'; font-size:5vh; color:rgb(56,20,5);">

                        <button type="submit" class="btn btn-sm mx-auto d-block mt-3 mb-5" style="width: 40vh"><img src="assets/UI/ingresar.png" style="width: 100%;"></button>
                    </form>
            </div>
        </main>
    </body>

    <script src="js/sololetras.js"></script>
    <script>
        function cambiarContrasena(){
            document.getElementById("cambiarcontra").style.display = "block";
            document.getElementById("boton").remove();
        }

        function cambiarContrasenaT(){
            document.getElementById("cambiarcontraT").style.display = "block";
            document.getElementById("botonT").remove();
        }

        function cambiarContrasenaC(){
            document.getElementById("cambiarcontraC").style.display = "block";
            document.getElementById("botonC").remove();
        }
    </script>
</html>
