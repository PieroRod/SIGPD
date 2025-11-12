<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<main class="d-block d-sm-none">
    <div class="text-center">
        <button class="btn me-3"><a href="index.php?ruta=logout"><img src="assets/UI/salir.png" width="100px"></a></button>
        <button class="btn"><img src="assets/UI/sign in.png" width="100px"></button>
    </div>

    <?php
    $cantidad = $_SESSION['cantidad'] ?? 2;

    for ($i = 1; $i <= $cantidad; $i++):
    ?>

   <?php if (!empty($_SESSION['jugadores'][$i])): ?>
        <!-- Mostrar ficha con nombre y botón de logout -->
        <div class="d-flex justify-content-center">
            <p class="text-center mt-4 me-3" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 25px;">Jugador <?= $i ?>:</p>
            <p class="text-center mt-4" style="font-family: 'Berlin Sans FB Demi'; color: #53311bff; font-size: 25px;"> <?= $_SESSION['jugadores'][$i] ?></p>
        </div>
        <form class="mx-auto" action="index.php?ruta=logoutL" method="post">
            <input type="hidden" name="jugador" value="<?= $i ?>">
            <button class="mx-auto d-block btn" type="submit" style="position: relative; display: block;"><img src="assets/UI/cartelsintexto.png" width="150px"><span style="position: absolute; top: 30%; left: 22%; transform: translate(-50%, -50%) color: #750708; font-size: 17px; pointer-events: none; font-family: 'Berlin Sans FB Demi';">Cerrar sesión</span></button>
        </form>

    <?php else: ?>


        <p class="text-center mt-2" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 30px;">Jugador <?= $i ?></p>

    <div class="mx-auto" style="position: relative; width: 100%; max-width: 250px;">
    <img src="assets/UI/NombreYContra.png" alt="" style="display:block; width:100%; height:auto;">

    <form action="index.php?ruta=login" method="post">
        <input class="btn" type="text" name="usuario<?= $i ?>" onkeypress="soloLetrasYNumeros(event)" id="txtUsuario" style="position:absolute; top:7%; left:0; right:0; width:90%; max-width:227px; height:39px; margin:0 auto; font-family: 'Berlin Sans FB Demi'; font-size:15px; color:rgb(56,20,5);">

        <input class="btn" type="text" name="contrasena<?= $i ?>" onkeypress="soloLetrasYNumeros(event)" id="txtContrasena" style="position:absolute; top:41%; left:0; right:0; width:90%; max-width:227px; height:39px; margin:0 auto; font-family:'Berlin Sans FB Demi'; font-size:15px; color:rgb(56,20,5);">

        <div class="d-flex justify-content-center mt-1">
            <button type="submit" class="btn btn-sm" name="accion[<?= $i ?>]" value="login"><img src="assets/UI/ingresar.png" width="130"></button>
            <button type="submit" class="btn btn-sm" name="accion[<?= $i ?>]" value="invitado"><img src="assets/UI/invitado.png" width="130"></button>
        </div>
    </form>
    </div>
    <?php endif; ?>
    <?php endfor; ?>

    <button class="mt-2 mb-3 btn mx-auto d-block"><a href="index.php?ruta=tablero"><img src="assets/UI/iniciar_partida.png" width="230px"></a></button>
    </main>
    

<!--Tablet-->
<main class="d-none d-sm-block d-lg-none" style="height: 100vh;">
        <div class="text-center">
            <button class="btn mt-3 me-5"><a href="index.php?ruta=logout"><img src="assets/UI/salir.png" width="225px"></a></button>
            <button class="btn"><a href="index.php?ruta=registro"><img src="assets/UI/sign in.png" width="200px"></a></button>
        </div>
    <?php
    $cantidad = $_SESSION['cantidad'] ?? 2;
    for ($i = 1; $i <= $cantidad; $i++):
    ?>

    <?php if (!empty($_SESSION['jugadores'][$i])): ?>
        <!-- Mostrar ficha con nombre y botón de logout -->
        <div class="d-flex justify-content-center">
            <p class="text-center mt-4 me-3" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 40px;">Jugador <?= $i ?>:</p>
            <p class="text-center mt-4" style="font-family: 'Berlin Sans FB Demi'; color: #53311bff; font-size: 40px;"> <?= $_SESSION['jugadores'][$i] ?></p>
        </div>
        <form class="mx-auto" action="index.php?ruta=logoutL" method="post">
            <input type="hidden" name="jugador" value="<?= $i ?>">
            <button class="mx-auto d-block btn" type="submit" style="position: relative; display: block;"><img src="assets/UI/cartelsintexto.png" width="250px"><span style="position: absolute; top: 30%; left: 22%; transform: translate(-50%, -50%) color: #750708; font-size: 27px; pointer-events: none; font-family: 'Berlin Sans FB Demi';">Cerrar sesión</span></button>
        </form>

    <?php else: ?>

        <p class="text-center mt-4" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 50px;">Jugador <?= $i ?></p>

        <div class="mx-auto" style="position: relative; width: 100%; max-width: 400px;">
            <img src="assets/UI/NombreYContra.png" alt="" style="display:block; width:100%; height:auto;">

            <form action="index.php?ruta=login" method="post">
                <input class="btn" type="text" name="usuario<?= $i ?>" onkeypress="soloLetrasYNumeros(event)" id="txtUsuario" placeholder="Nombre"
                    style="position:absolute; top:7%; left:0; right:0; width:90%; max-width:360px; height:65px;
                            margin:0 auto; font-family:  'Berlin Sans FB Demi'; font-size:30px; color:rgb(56,20,5);">

                <input class="btn" type="text" name="contrasena<?= $i ?>" onkeypress="soloLetrasYNumeros(event)" id="txtContrasena" placeholder="Contraseña"
                    style="position:absolute; top:41%; left:0; right:0; width:90%; max-width:360px; height:65px;
                            margin:0 auto; font-family: 'Berlin Sans FB Demi'; font-size:30px; color:rgb(56,20,5);">

                <div class="d-flex justify-content-center mt-1">
                    <button type="submit" class="btn btn-sm" name="accion[<?= $i ?>]" value="login"><img src="assets/UI/ingresar.png" width="200"></button>
                    <button type="submit" class="btn btn-sm" name="accion[<?= $i ?>]" value="invitado"><img src="assets/UI/invitado.png" width="200"></button>
                </div>

            </form>
        </div>
        <?php endif; ?>
    <?php endfor; ?>
    <button class="mt-5 mb-3 btn mx-auto d-block"><a href="index.php?ruta=tablero"><img src="assets/UI/iniciar_partida.png" width="400px"></a></button>
</main>
    
<!--Escritorio-->
<main class="d-none d-lg-block" style="width: 100%; width: auto;">
        <?php
            $cantidad = $_SESSION['cantidad'] ?? 2;
            for ($i = 1; $i <= $cantidad; $i++):
                switch ($i) {
                    case 1:
                        $top = '21%';
                        $left = '25%';
                        break;
                    case 2:
                        $top = '21%';
                        $left = '75%';
                        break;
                    case 3:
                        $top = '62%';
                        $left = '25%';
                        break;
                    case 4:
                        $top = '62%';
                        $left = '75%';
                        break;
                    case 5:
                        $top = '45%';
                        $left = '50%';
                        break;
                    default:
                        $top = '0';
                        $left = '0';
                }
        ?>  
        <?php if (!empty($_SESSION['jugadores'][$i])): ?>
        <!-- Mostrar ficha con nombre y botón de logout -->
        <div style="position: absolute; top: <?= $top ?>; left: <?= $left ?>; transform: translate(-50%, -50%); width: 23vw;">
            <div class="d-flex justify-content-center">
                <p class="text-center mt-4 me-3" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 2vw;">Jugador <?= $i ?>:</p>
                <p class="text-center mt-4" style="font-family: 'Berlin Sans FB Demi'; color: #53311bff; font-size: 2vw;"> <?= $_SESSION['jugadores'][$i] ?></p>
            </div>
            <form class="mx-auto" action="index.php?ruta=logoutL" method="post">
                <input type="hidden" name="jugador" value="<?= $i ?>">
                <button class="mx-auto d-block btn" type="submit" style="position: relative; display: block; width: 70%;"><img src="assets/UI/cartelsintexto.png" style="width: 100%"><span style="position: absolute; top: 30%; left: 22%; transform: translate(-50%, -50%) color: #750708; font-size: 1.6vw; pointer-events: none; font-family: 'Berlin Sans FB Demi';">Cerrar sesión</span></button>
            </form>
        </div>

        <?php else: ?>

        <div style="position: absolute; top: <?= $top ?>; left: <?= $left ?>; transform: translate(-50%, -50%); width: 23vw;">
            <p class="text-center" style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 2vw;">Jugador <?= $i ?></p>

            <div style="position: relative; width: 100%;">
                <img src="assets/UI/NombreYContra.png" style="display:block; width: 100%;">

                <form action="index.php?ruta=login" method="post">
                    <input class="btn" onkeypress="soloLetrasYNumeros(event)" type="text" name="usuario<?= $i ?>" id="txtUsuario" maxlength="20" placeholder="Nombre"
                        style="position:absolute; top:7%; left: 4%; width:91%; height: 24%;
                                margin:0 auto; font-family:  'Berlin Sans FB Demi'; font-size:2vw; color:rgb(56,20,5);">

                    <input class="btn" onkeypress="soloLetrasYNumeros(event)" type="text" name="contrasena<?= $i ?>" id="txtContrasena" maxlength="20" placeholder="Contraseña"
                        style="position:absolute; top:43%; left: 4%; width:91%; height: 24%;
                                margin:0 auto; font-family: 'Berlin Sans FB Demi'; font-size:2vw; color:rgb(56,20,5);">

                    <div class="d-flex justify-content-center mt-1">
                        <button type="submit" class="btn btn-sm" name="accion[<?= $i ?>]" value="login" style="width: 50%;"><img src="assets/UI/ingresar.png" style="width: 100%;"></button>
                        <button type="submit" class="btn btn-sm" name="accion[<?= $i ?>]" value="invitado" style="width: 50%;"><img src="assets/UI/invitado.png" style="width: 100%;"></button>
                    </div>

                </form>
            </div>
        </div>
        <?php endif; ?>
        <?php endfor; ?>
        
        <div class="fixed-bottom position-relative; text-center" style="width: 100%; width: auto;">
            <button class="btn" style="position: absolute; left: 2%; top: 30%; width: 15%;"><a href="index.php?ruta=logout"><img src="assets/UI/salir.png" style="width: 100%;"></a></button>
            <button class="mb-2 btn" style="width: 30%;"><a href="index.php?ruta=tablero"><img src="assets/UI/iniciar_partida.png" style="width: 100%;"></a></button>
            <button class="btn" style="position: absolute; right: 3%; top: 25%; width: 15%;"><a href="index.php?ruta=registro"><img src="assets/UI/sign in.png" style="width: 100%;"></a></button>
        </div> 
    </main>

    <script src="js/sololetras.js"></script>
</body>
</html>