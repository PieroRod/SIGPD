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


        <!--Escritorio-->
        <!-- #region -->
        <main class="d-none d-lg-block">
            <p class="mt-3 text-center" style="font-size: 60px; font-family: 'Berlin Sans FB Demi'; color: #750708;">Obtuviste <?= $_POST['puntos'] ?> puntos</p>            
            <div style="position: relative; width: 50%; height: auto; transform: translateX(50%);">
                <img src="assets/UI/ranking.png" style="position: relative; width: 100%;">
                <table style="position: absolute; right: 53%; top: 25%;">
                    <?php if (!empty($_SESSION['puntosLocal'])): ?>
                        <?php foreach ($_SESSION['puntosLocal'] as $local): ?>
                                <tr>
                                <td style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 2.3vw; padding-bottom: 0.75vh"><?= $local['nombre'] ?></td>
                                <td style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 1.5vw; padding-left: 7.5vw; padding-bottom: 0.75vh"><?= $local['total_puntos'] ?></td>
                                </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
                <table style="position: absolute; right: 7%; top: 25%;">
                    <?php if (!empty($_SESSION['puntosGlobal'])): ?>
                        <?php foreach ($_SESSION['puntosGlobal'] as $global): ?>
                                <tr>
                                <td style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 2.3vw; padding-bottom: 0.75vh"><?= $global['nombre'] ?></td>
                                <td style="font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 1.5vw; padding-left: 7vw; padding-bottom: 0.75vh"><?= $global['total_puntos'] ?></td>
                                </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
            <div style="position: relative; width: 100%; max-width: auto;">
                <button class="btn btn-sm"><a href="index.php?ruta=logout"><img src="assets/UI/Volver_inicio.png" style="position: absolute; left: 27%; width: 20%; top: 40%;"></a></button>
                <button class="btn btn-sm"><a href="index.php?ruta=config"><img src="assets/UI/reiniciar_partida.png" style="position: absolute; right: 27%; width: 20%; top: 40%;"></a></button>
            </div>

        </main>
        <!--#endregion-->

        <!--Tablet-->
        <!-- #region -->
        <main class="d-none d-sm-block d-lg-none" style="height: 95vh;">
            <p class="mt-5 text-center" style="font-size: 60px; font-family: 'Berlin Sans FB Demi'; color: #750708;">Obtuviste 24 puntos</p>
            
            <div class="d-flex justify-content-center mt-5">
                <div class="px-4 py-2" style="position: relative; display: inline-block;">
                    <div id="localTablet" style="display: flex"> <!--Ranking Local-->
                        <img class="img-fluid" src="assets/UI/rank_localCEL.png" width="530px">
                    </div>
                    <div id="globalTablet" style="display: none"> <!--Ranking Global-->
                        <img class="img-fluid" src="assets/UI/rank_globalCEL.png" width="530px">
                    </div>

                    <button onclick="cambiaraLocal('Tablet')" class="btn btn-sm" style="position: absolute; top: 0; left: 0;"><img id="izquierdaTablet" src="assets/UI/ianc_izq.png" width="90px"></button>
                    <button onclick="cambiaraGlobal('Tablet')" class="btn btn-sm" style="position: absolute; top: 0; left: 470px;"><img id="derechaTablet" src="assets/UI/act_der.png" width="90px"></button>
                </div>
                
            </div>
            
            <button class="btn btn-sm mx-auto d-block mt-3"><a href="index.php?ruta=logout"><img src="assets/UI/Volver_inicio.png" width="300px"></a></button>
            <button class="btn btn-sm mx-auto d-block mt-2"><a href="index.php?ruta=config"><img src="assets/UI/reiniciar_partida.png" width="300px"></a></button>
        </main>
        <!-- #endregion -->

        <!--Celular-->
        <!-- #region -->
        <main class="d-block d-sm-none" style="height: 98vh;">
            <p class="mt-3 text-center" style="font-size: 5vw; font-family: 'Berlin Sans FB Demi'; color: #750708;">Partida sin funcionamiento.</p>
            
            <div class="d-flex justify-content-center">
                <div class="px-2" style="position: relative; display: inline-block;">
                    <div id="localCel" style="display: flex"> <!--Ranking Local-->
                        <img class="img-fluid" src="assets/UI/rank_localCEL.png" width="280px">
                    </div>
                    <div id="globalCel" style="display: none"> <!--Ranking Global-->
                        <img class="img-fluid" src="assets/UI/rank_globalCEL.png" width="280px">
                    </div>

                    <button onclick="cambiaraLocal()" class="btn btn-sm" style="position: absolute; top: 0; left: 0;"><img id="izquierdaCel" src="assets/UI/ianc_izq.png" width="40px"></button>
                    <button onclick="cambiaraGlobal()" class="btn btn-sm" style="position: absolute; top: 0; left: 243px;"><img id="derechaCel" src="assets/UI/act_der.png" width="40px"></button>
                </div>
                
            </div>
            
            <button class="btn btn-sm mx-auto d-block mt-3"><a href="index.php?ruta=logout"><img src="assets/UI/Volver_inicio.png" width="150px"></a></button>
            <button class="btn btn-sm mx-auto d-block mt-2"><a href="index.php?ruta=config"><img src="assets/UI/reiniciar_partida.png" width="150px"></a></button>
        </main>
        <!-- #endregion -->

         <script>
            let derecha = 1;
            let modo = '';

            function cambiaraGlobal(version){
                modo = version;
                if (derecha == 1){
                    document.getElementById("global"+ modo).style.display = "flex";
                    document.getElementById("local"+ modo).style.display = "none";

                    document.getElementById("izquierda"+ modo).src = "assets/UI/act_izq.png";
                    document.getElementById("derecha" + modo).src = "assets/UI/inac_der.png";

                    derecha = 0;
                }
            }

            function cambiaraLocal(version){
                modo = version;
                if (derecha == 0){
                    document.getElementById("global"+ modo).style.display = "none";
                    document.getElementById("local"+ modo).style.display = "flex";

                    document.getElementById("izquierda"+ modo).src = "assets/UI/ianc_izq.png";
                    document.getElementById("derecha"+ modo).src = "assets/UI/act_der.png";

                    derecha = 1;
                }

            }
        </script>
    </body>
</html>