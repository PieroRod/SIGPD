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
    <body style="background-image: url(assets/UI/fondo_juego.png); background-repeat: no-repeat; background-size: cover;">

        <!--Escritorio-->
        <!-- #region -->
        <main class="d-none d-lg-block position-relative" style="width: 100%; max-width: auto; height: 100vh; overflow: hidden;">

            <button class="btn" onclick="salir()"><a href="index.php?ruta=logout"><img src="assets/UI/salir.png" style="position: absolute; left: 3% ; height: 8%; top: 1%;" alt="salir"></a></button>

            <div class="flex-column" style="position: absolute; left: 5%; top: 10%; height: 89%; width: auto;">
                <img src="assets/UI/flores_sin.png" style="position: relative; height: 100%;">
                <div class="card" style="position: absolute; height: 14%; width: auto; left: 16%; top: 3.2%; background: transparent;" id="rosa">  
                    <img class="card-image" src="assets/fichas/fichas full render/rosa.png" style="height: 100%">
                </div>
                <div class="card" style="position: absolute; height: 15%; width: auto; left: 16%; top: 18%; background: transparent;" id="girasol">  
                    <img class="card-image" src="assets/fichas/fichas full render/girasol.png" style="height: 100%">
                </div>
                <div class="card" style="position: absolute; height: 14.5%; width: auto; left: 16%; top: 34%; background: transparent;" id="margarita">  
                    <img class="card-image" src="assets/fichas/fichas full render/margarita.png" style="height: 100%">
                </div>
                <div class="card" style="position: absolute;  height: 14%; width: auto; left: 20%; top: 49.5%; background: transparent;" id="tulipan">  
                    <img class="card-image" src="assets/fichas/fichas full render/tulipan.png" style="height: 100%">
                </div>
                <div class="card" style="position: absolute; height: 15%; width: auto; left: 16%; top: 64.5%; background: transparent;" id="diente de leon">  
                    <img class="card-image" src="assets/fichas/fichas full render/diente de leon.png" style="height: 100%">
                </div>
                <div class="card" style="position: absolute; height: 15%; width: auto; left: 29%; top: 80%; background: transparent;" id="hoja">  
                    <img class="card-image" src="assets/fichas/fichas full render/hoja.png" style="height: 100%">
                </div>
            </div>

            <img src="assets/UI/Restric.png" style="position: absolute; left: 18%; height: 20%;">
            <p style="position: absolute; left: 19.3%; top: 5%; font-size: 1.5vw; width: 30%; font-family: 'Berlin Sans FB Demi'; color: #750708; text-align: center;" id="restriccion"></p>

            <img src="assets/tablero.png" style="position: absolute; left: 18%; top: 22%; height: 75%;">
            <!--Areas de colocacion de cartas-->
            <!--#region-->
            <div class="game-board" style="position: absolute; left: 19%; top: 20%; height: 19%; width: 14%;" id="similitud"></div>
            <div class="game-board" style="position: absolute; left: 39%; top: 6%; height: 21%; width: 8%;" id="rey"></div>
            <div class="game-board" style="position: absolute; left: 20%; top: 4%; height: 18%; width: 11%;" id="trio"></div>
            <div class="game-board" style="position: absolute; left: 37.5%; top: -9%; height: 17%; width: 13%;" id="indiferencia"></div>
            <div class="game-board" style="position: absolute; left: 21.4%; top: -10%; height: 21%; width: 10%;" id="parejas"></div>
            <div class="game-board" style="position: absolute; left: 40.5%; top: -25%; height: 18%; width: 7%;" id="solitario"></div>
            <div class="game-board" style="position: absolute; left: 32.5%; top: -41%; height: 21%; width: 7%;" id="basura"></div>

            <div style="position: absolute; right: 21%; top: 4%; width: 25%;">
                <div style="position: relative; display: flex; justify-content: center; align-items: center; width: 100%;">

                    <img class="img-fluid" src="assets/UI/tabla_jugadores0.png" style="display: block;">
                    <?php for ($i = 1; $i <= ($_SESSION['cantidad'] ?? 2); $i++):
                        switch ($i) {
                            case 1:
                                $top = '22';
                                break;
                            case 2:
                                $top = '38';
                                break;
                            case 3:
                                $top = '54';
                                break;
                            case 4:
                                $top = '70';
                                break;
                            case 5:
                                $top = '86';
                                break;
                        }
                    ?>
                    <p style="position: absolute; top: <?= $top?>%; left: 9%; font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 25px;"><?= $_SESSION['jugadores'][$i] ?></p>
                    <button onclick="abrirDadoCompu(<?= $i ?>)" class="btn" style="position: absolute; top: <?= $top - 4?>%; left: 70%; width: 23.8%; height: 14.5%;"><img id="imgdado<?= $i ?>Compu" src="assets/UI/dadodefault.png" style="height: 100%;"></button>                      
                    <?php endfor; ?>
                </div>
            </div>

            <button class="btn" onclick="verificarRonda()"><img src="assets/UI/continuar.png" style="position: absolute; bottom: 5%; right: 24.5%; height: 10%;" alt="continuar"></button>

            <button class="btn btn-sm" onclick="mostrarReglamentoCompu()"><img src="assets/UI/reglamen.png" style="position: absolute; top: 16%; right: 5%; height: 27%;" alt="reglamento"></button>
            <button class="btn" onclick="mostrarAyudaCompu()"><img src="assets/UI/ayuda.png" style="position: absolute; top: 55%; right: 5%; height: 27%;" alt="ayuda"></button>            

            <div id="dadoCompu" style="background-color: rgba(0,0,0,0.8); display: none; top: 0; left: 0; right: 0; bottom: 0; position: fixed; justify-content: center; align-items: center; flex-direction: column;">
                    <img class="mx-auto d-block" src="assets/UI/Restric.png" style="position: absolute; width: 35%; top: 0%;">
                    <p style="position: absolute; top: 8%; font-size: 30px; font-family: 'Berlin Sans FB Demi'; color: #750708;" id="jugadorDado"></p>
                    <div class="mt-5" style="position: relative; display: inline-block;">
                        
                        <img class="img-fluid mx-auto d-block mt-5" src="assets/UI/caras dado.png" style="width: 35%">

                        <button onclick="cambiarDadoCompu(1)" class="btn" style="position: absolute; top: 20%; left: 34.7%; width: 9.5%; height: 35%;"></button>
                        <button onclick="cambiarDadoCompu(2)" class="btn" style="position: absolute; top: 58%; left: 34.7%; width: 9.5%; height: 35%;"></button>
                        <button onclick="cambiarDadoCompu(3)" class="btn" style="position: absolute; top: 20%; left: 45%; width: 9.5%; height: 35%;"></button>
                        <button onclick="cambiarDadoCompu(4)" class="btn" style="position: absolute; top: 58%; left: 45.1%; width: 9.5%; height: 35%;"></button>
                        <button onclick="cambiarDadoCompu(5)" class="btn" style="position: absolute; top: 20%; left: 55.7%; width: 9.5%; height: 35%;"></button>
                        <button onclick="cambiarDadoCompu(6)" class="btn" style="position: absolute; top: 58%; left: 55.7%; width: 9.5%; height: 35%;"></button>
                    </div>

                    <button class="btn btn-sm mt-3" onclick="cerrarDadoCompu()"><img src="assets/UI/aceptar.png" width="320px"></button>
            </div>

            <div id="reglamentoCompu" style="background-color: rgba(0,0,0,0.8); display: none; top: 0; left: 0; right: 0; bottom: 0; position: fixed; justify-content: center; align-items: center; flex-direction: column;">

                <!-- <button class="mb-1 btn btn-sm" onclick="cerrarReglamentoCompu()" style="width: 10%;"><img src="assets/UI/salir.png" style="width: 100%"></button> -->

                <div style="position: relative; display: flex; justify-content: center; align-items: center; width: 60vw; height: 100vh;">

                    <!-- <img class="img-fluid" src="assets/UI/reglamento_fondo.png" style="position: relative; width: 100%; height: auto; display: block;"> -->
                    
                    <img id="reglamentoPaginaCompu" src="assets/UI/recintopc.png" style="position: absolute; top: 0%; width: 100%;">

                    <!-- Botón izquierda -->
                    <button class="btn btn-sm" onclick="cambiarPagCompu(-1)" style="position: absolute; left: -15%; top: 50%; transform: translateY(-50%); width: 10%;"><img src="assets/UI/act_izq.png" style="width: 100%"></button>

                    <!-- Botón derecha -->
                    <button class="btn btn-sm" onclick="cambiarPagCompu(1)" style="position: absolute; right: -15%; top: 50%; transform: translateY(-50%); width: 10%;"><img src="assets/UI/act_der.png" style="width: 100%"></button>
                </div>

                <button class="btn btn-sm" onclick="cerrarReglamentoCompu()" style="width: 15%;"><img src="assets/UI/salir.png" style="width: 100%"></button>
            </div>

            <div id="ayudaCompu" style="background-color: rgba(0,0,0,0.8); display: none; top: 0; left: 0; right: 0; bottom: 0; position: fixed; justify-content: center; align-items: center; flex-direction: column;">

                <!-- <button class="mb-1 btn btn-sm" onclick="cerrarReglamentoCompu()" style="width: 10%;"><img src="assets/UI/salir.png" style="width: 100%"></button> -->

                <div style="position: relative; display: flex; justify-content: center; align-items: center; width: 60vw; height: 100vh;">

                    <!-- <img class="img-fluid" src="assets/UI/reglamento_fondo.png" style="position: relative; width: 100%; height: auto; display: block;"> -->
                    
                    <img id="ayudaPaginaCompu" src="assets/UI/ayuda1.png" style="position: absolute; top: 3%; width: 75%;">

                    <!-- Botón izquierda -->
                    <button class="btn btn-sm" onclick="cambiarPagAyudaCompu(-1)" style="position: absolute; left: -15%; top: 50%; transform: translateY(-50%); width: 10%;"><img src="assets/UI/act_izq.png" style="width: 100%"></button>

                    <!-- Botón derecha -->
                    <button class="btn btn-sm" onclick="cambiarPagAyudaCompu(1)" style="position: absolute; right: -15%; top: 50%; transform: translateY(-50%); width: 10%;"><img src="assets/UI/act_der.png" style="width: 100%"></button>
                </div>

                <button class="btn btn-sm" onclick="cerrarAyudaCompu()" style="width: 15%;"><img src="assets/UI/salir.png" style="width: 100%"></button>
            </div>

        </main>
        <!-- #endregion -->

         <!--Tablet-->
        <!-- #region -->
        <main class="d-none d-sm-block d-lg-none">
            <button class="btn btn-sm mx-auto d-block"><a href="index.php?ruta=logout"><img src="assets/UI/salir.png" height="60px" alt="salir"></a></button>

            <!--Fichas-->
            <div style="position: relative; height: auto; width: 100%;">
                <img class="img-fluid my-1" src="assets/UI/floresCELU.png" style="width: 100%; height: auto; display: block;">
                <div class="card-row">
                    <!--fondo FloresCELU con position relative y las cards con position absolute para que esten dentro del fondo, con valores en porsentajes para que se adapten al tamano-->
                    <div class="card" data-id="c1" draggable="true" style="position: absolute; top: 21%; left: 4.5%; width: 13%; height: 60%; background-color: transparent;">&nbsp;</div>
                    <div class="card" data-id="c2" draggable="true" style="position: absolute; top: 21%; left: 19.5%; width: 13%; height: 60%; background-color: transparent;">&nbsp;</div>
                    <div class="card" data-id="c3" draggable="true" style="position: absolute; top: 21%; left: 34.5%; width: 13%; height: 60%; background-color: transparent;">&nbsp;</div>
                    <div class="card" data-id="c4" draggable="true" style="position: absolute; top: 21%; left: 49.5%; width: 13%; height: 60%; background-color: transparent;">&nbsp;</div>
                    <div class="card" data-id="c5" draggable="true" style="position: absolute; top: 21%; left: 65%; width: 13%; height: 60%; background-color: transparent;">&nbsp;</div>
                    <div class="card" data-id="c6" draggable="true" style="position: absolute; top: 21%; left: 80.5%; width: 13%; height: 60%; background-color: transparent;">&nbsp;</div>
                </div>
            </div>

            <img class="mt-1 img-fluid mx-auto d-block" src="assets/tablero.png" style="display: block; width: 100%; height: auto;">

            <img class="img-fluid" src="assets/UI/Restric.png" style="width: 100%; height: auto; display: block;">

            <div class="col text-center">
                    <button class="btn btn-sm mt-2" onclick="mostrarReglamento('Tablet')"><img src="assets/UI/reglamen.png" width="100px" alt="reglamento"></button>
                    <button class="btn btn-sm mt-2" onclick="mostrarJugadores('Tablet')"><img src="assets/UI/jugadoresCELU.png" width="300px" alt="jugadores"></button>
                    <button class="btn btn-sm mt-2"><img src="assets/UI/ayuda.png" width="100px" alt="ayuda"></button>
            </div>

            <button class="btn btn-sm mx-auto d-block my-1" onclick="salir()"><a href="index.php?ruta=finpartida"><img src="assets/UI/continuar.png" height="80px" alt="continuar"></a></button>

            <!--jugadores-->
            <div id="jugadoresTablet" style="background-color: rgba(0,0,0,0.8); display: none; position: fixed; justify-content: center; align-items: center; flex-direction: column; top: 0; left: 0; right: 0; bottom: 0;">
                
                <div style="position: relative; display: flex; justify-content: center; align-items: center; width: 100%; max-width: 550px;">

                    <img class="img-fluid" src="assets/UI/tabla_jugadores0.png" width="550px" style="display: block;">
                    <?php for ($i = 1; $i <= ($_SESSION['cantidad'] ?? 2); $i++):
                        switch ($i) {
                            case 1:
                                $top = '22';
                                break;
                            case 2:
                                $top = '38';
                                break;
                            case 3:
                                $top = '54';
                                break;
                            case 4:
                                $top = '70';
                                break;
                            case 5:
                                $top = '86';
                                break;
                        }
                    ?>
                    <p style="position: absolute; top: <?= $top?>%; left: 9%; font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 4vh;"><?= $_SESSION['jugadores'][$i] ?></p>
                    <button onclick="abrirDado(<?= $i ?>)" class="btn" style="position: absolute; top: <?= $top - 4?>%; left: 70%; width: 23.8%; height: 14.5%;"><img id="imgdado<?= $i ?>Tablet" src="assets/UI/dadodefault.png" style="height: 100%;"></button>                      
                    <?php endfor; ?>

                </div>

                <button class="btn btn-sm mt-3" onclick="cerrarJugadores()"><img src="assets/UI/aceptar.png" width="330px"></button>

                <!--Elegir restrinccion de dado-->
                <div id="dadoTablet" style="background-color: rgba(0,0,0,0.8); display: none; top: 0; left: 0; right: 0; bottom: 0; position: fixed; justify-content: center; align-items: center; flex-direction: column;">
                    <div style="position: relative; display: inline-block;">
                        <img class="img-fluid" src="assets/UI/Restric.png" style="width: 100%; max-width: 500px;">
                        <p style="position: absolute; top: 30%; left: 15%; font-size: 40px; font-family: 'Berlin Sans FB Demi'; color: #750708;">Jugador 1 tiro el dado</p>
                    </div>

                    <div style="position: relative; display: inline-block;">
                        <img class="img-fluid mt-1" src="assets/UI/caras dadoCELU.png" style="width: 100%; max-width: 520px;">

                        <button onclick="cambiarDado(1)" class="btn btn-sm" style="position: absolute; top: 55px; left: 45px; width: 210px; height: 215px;"></button>
                        <button onclick="cambiarDado(2)" class="btn btn-sm" style="position: absolute; top: 55px; left: 270px; width: 210px; height: 215px;"></button>
                        <button onclick="cambiarDado(3)" class="btn btn-sm" style="position: absolute; top: 287px; left: 45px; width: 210px; height: 215px;"></button>
                        <button onclick="cambiarDado(4)" class="btn btn-sm" style="position: absolute; top: 287px; left: 270px; width: 210px; height: 215px;"></button>
                        <button onclick="cambiarDado(5)" class="btn btn-sm" style="position: absolute; top: 520px; left: 45px; width: 210px; height: 215px;"></button>
                        <button onclick="cambiarDado(6)" class="btn btn-sm" style="position: absolute; top: 520px; left: 270px; width: 210px; height: 215px;"></button>
                    </div>

                    <button class="btn btn-sm mt-3" onclick="cerrarDado()"><img src="assets/UI/aceptar.png" width="320px"></button>
                </div>
            </div>

            <!--reglamento-->
            <div id="reglamentoTablet" style="background-color: rgba(0,0,0,0.8); display: none; top: 0; left: 0; right: 0; bottom: 0; position: fixed; justify-content: center; align-items: center; flex-direction: column;">


                <div style="position: relative; display: flex; justify-content: center; align-items: center; height: 100vh;">

                    <img class="img-fluid" id="reglamentoPagina" src="assets/UI/recintos 1.png" style="width: 70%; height: auto; display: block;">

                    <!-- Botón izquierda -->
                    <button class="btn btn-sm" onclick="cambiarPag(-1)" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%);"><img src="assets/UI/act_izq.png" style="width: 10vw;"></button>

                    <!-- Botón derecha -->
                    <button class="btn btn-sm" onclick="cambiarPag(1)" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"><img src="assets/UI/act_der.png" style="width: 10vw;"></button>
                </div>
                <button class="mb-2 btn btn-sm" onclick="cerrarReglamento()"><img src="assets/UI/salir.png" width="200px"></button>
            </div>
        </main>
        <!-- #endregion -->

        <!-- Celular -->
        <!-- #region -->
        <main class="d-block d-sm-none">
        <button class="btn btn-sm mx-auto d-block"><a href="index.php?ruta=logout"><img src="assets/UI/salir.png" height="30px" alt="salir"></a></button>

            <!--Fichas-->
            <div style="position: relative; height: auto; width: 100%;">
                <img class="img-fluid my-1" src="assets/UI/floresCELU.png" style="width: 100%; height: auto; display: block;">
                <div class="card-row">
                    <!--fondo FloresCELU con position relative y las cards con position absolute para que esten dentro del fondo, con valores en porsentajes para que se adapten al tamano-->
                    <div class="card" data-id="c1" draggable="true" style="position: absolute; top: 21%; left: 4.5%; width: 13%; height: 60%; background-color: transparent;">&nbsp;</div>
                    <div class="card" data-id="c2" draggable="true" style="position: absolute; top: 21%; left: 19.5%; width: 13%; height: 60%; background-color: transparent;">&nbsp;</div>
                    <div class="card" data-id="c3" draggable="true" style="position: absolute; top: 21%; left: 34.5%; width: 13%; height: 60%; background-color: transparent;">&nbsp;</div>
                    <div class="card" data-id="c4" draggable="true" style="position: absolute; top: 21%; left: 49.5%; width: 13%; height: 60%; background-color: transparent;">&nbsp;</div>
                    <div class="card" data-id="c5" draggable="true" style="position: absolute; top: 21%; left: 65%; width: 13%; height: 60%; background-color: transparent;">&nbsp;</div>
                    <div class="card" data-id="c6" draggable="true" style="position: absolute; top: 21%; left: 80.5%; width: 13%; height: 60%; background-color: transparent;">&nbsp;</div>
                </div>
            </div>

            <img class="mt-1 img-fluid mx-auto d-block" src="assets/tablero.png" style="display: block; width: 100%; height: auto;">

            <img class="img-fluid" src="assets/UI/Restric.png" style="width: 100%; height: auto; display: block;">

            <div class="col text-center">
                    <button class="btn btn-sm mt-2" onclick="mostrarReglamento('Celu')"><img src="assets/UI/reglamen.png" width="50px" alt="reglamento"></button>
                    <button class="btn btn-sm mt-2" onclick="mostrarJugadores('Celu')"><img src="assets/UI/jugadoresCELU.png" width="155px" alt="jugadores"></button>
                    <button class="btn btn-sm mt-2"><img src="assets/UI/ayuda.png" width="50px" alt="ayuda"></button>
            </div>

            <button class="btn btn-sm mx-auto d-block my-1"><a href="index.php?ruta=resultados"><img src="assets/UI/continuar.png" height="40px" alt="continuar"></a></button>

            <!--jugadores-->
            <div id="jugadoresCelu" style="background-color: rgba(0,0,0,0.8); display: none; position: fixed; justify-content: center; align-items: center; flex-direction: column; top: 0; left: 0; right: 0; bottom: 0;">
                
                <div style="position: relative; display: flex; justify-content: center; align-items: center; width: 100%; max-width: 280px;">

                    <img class="img-fluid" src="assets/UI/tabla_jugadores0.png" width="550px" style="display: block;">
                    <?php for ($i = 1; $i <= ($_SESSION['cantidad'] ?? 2); $i++):
                        switch ($i) {
                            case 1:
                                $top = '22';
                                break;
                            case 2:
                                $top = '38';
                                break;
                            case 3:
                                $top = '54';
                                break;
                            case 4:
                                $top = '70';
                                break;
                            case 5:
                                $top = '86';
                                break;
                        }
                    ?>
                    <p style="position: absolute; top: <?= $top?>%; left: 9%; font-family: 'Berlin Sans FB Demi'; color: #750708; font-size: 4vh;"><?= $_SESSION['jugadores'][$i] ?></p>
                    <button onclick="abrirDado(<?= $i ?>)" class="btn" style="position: absolute; top: <?= $top - 4?>%; left: 70%; width: 23.8%; height: 14.5%;"><img id="imgdado<?= $i ?>Celu" src="assets/UI/dadodefault.png" style="height: 100%;"></button>                      
                    <?php endfor; ?>

                </div>

                <button class="btn btn-sm mt-3" onclick="cerrarJugadores()"><img src="assets/UI/aceptar.png" width="210px"></button>

                <!--Elegir restrinccion de dado-->
                <div id="dadoCelu" style="background-color: rgba(0,0,0,0.8); display: none; top: 0; left: 0; right: 0; bottom: 0; position: fixed; justify-content: center; align-items: center; flex-direction: column;">
                    <div style="position: relative; display: inline-block;">
                        <img class="img-fluid" src="assets/UI/Restric.png" style="width: 100%; max-width: 250px;">
                        <p style="position: absolute; top: 30%; left: 10%; font-size: 22px; font-family: 'Berlin Sans FB Demi'; color: #750708;">Jugador 1 tiro el dado</p>
                    </div>

                    <div style="position: relative; display: inline-block;">
                        <img class="img-fluid mt-1" src="assets/UI/caras dadoCELU.png" style="width: 100%; max-width: 250px;">

                        <button onclick="cambiarDado(1)" class="btn" style="position: absolute; top: 30px; left: 21px; width: 100px; height: 100px;"></button>
                        <button onclick="cambiarDado(2)" class="btn" style="position: absolute; top: 30px; left: 130px; width: 100px; height: 100px;"></button>
                        <button onclick="cambiarDado(3)" class="btn" style="position: absolute; top: 142px; left: 21px; width: 100px; height: 100px;"></button>
                        <button onclick="cambiarDado(4)" class="btn" style="position: absolute; top: 142px; left: 130px; width: 100px; height: 100px;"></button>
                        <button onclick="cambiarDado(5)" class="btn" style="position: absolute; top: 255px; left: 21px; width: 100px; height: 100px;"></button>
                        <button onclick="cambiarDado(6)" class="btn" style="position: absolute; top: 255px; left: 130px; width: 100px; height: 100px;"></button>
                    </div>

                    <button class="btn btn-sm mt-3" onclick="cerrarDado()"><img src="assets/UI/aceptar.png" width="200px"></button>
                </div>
            </div>

            <!--reglamento-->
            <div id="reglamentoCelu" style="background-color: rgba(0,0,0,0.8); display: none; top: 0; left: 0; right: 0; bottom: 0; position: fixed; justify-content: center; align-items: center; flex-direction: column;">

                <button class="mb-2 btn btn-sm" onclick="cerrarReglamento()"><img src="assets/UI/salir.png" width="190px"></button>

                <div style="position: relative; display: flex; justify-content: center; align-items: center; width: 100%; max-width: 900px;">

                    <img class="img-fluid" src="assets/UI/reglamento_fondo.png" 
                        style="width: 100%; height: auto; display: block;">

                    <!-- Botón izquierda -->
                    <button class="btn btn-sm" style="position: absolute; left: 2px; top: 50%; transform: translateY(-50%);"><img src="assets/UI/act_izq.png" width="40px"></button>

                    <!-- Botón derecha -->
                    <button class="btn btn-sm" style="position: absolute; right: 2px; top: 50%; transform: translateY(-50%);"><img src="assets/UI/act_der.png" width="40px"></button>
                </div>
            </div>
        </main>
        <!-- #endregion -->
        
        <!--celular y tablet-->
        <script>
            let jugador = 0;
            let modo = "";

            function mostrarJugadores(version) {
                modo = version; // se establece la variable modo segun la version
                document.getElementById("jugadores" + modo).style.display = "flex"; // se muestra el contenedor de jugadores correspondiente
            }

            function cerrarJugadores() {
                document.getElementById("jugadores" + modo).style.display = "none";
            }

            function abrirDado(x){
                console.log("Modo actual:", modo);
                document.getElementById("dado" + modo).style.display = "flex";
                jugador = x;
                
                for(let o = 1; o <= 6; o++){
                    restricciones[o] = false
                }
            }            

            function cerrarDado(){
                    document.getElementById("dado" + modo).style.display = "none";
            }

            function mostrarReglamento(version){
                modo = version;
                document.getElementById("reglamento" + modo).style.display = "flex";
            }

            function cerrarReglamento(){
                document.getElementById("reglamento" + modo).style.display = "none";
            }

            function cambiarDado(restriccion){
                const caras = ["madera", "rocoso", "no planta", "rosa", "caja registradora", "estacionamiento"];

                for (let i = 1; i <= <?= $_SESSION['cantidad']?>; i++) { // se resetean todas las imagenes de los dados
                    document.getElementById(`imgdado${i}` + modo).src = "assets/UI/dadodefault.png";
                }

                document.getElementById(`imgdado${jugador}` + modo).src = "assets/CARAS DADO/" + caras[restriccion - 1]+".png"; // se cambia la imagen del dado del jugador correspondiente
                document.getElementById("dado" + modo).style.display = "none";
                console.log("ola");

                if (jugador > 1){
                    restricciones[restriccion] = true;                
                }

                dado = true;
            }

            function cambiarPag(x){
                pagina = pagina + x;

                if (pagina > 5){
                    pagina = 1;
                }

                if (pagina < 1){
                    pagina = 5
                }

                switch(pagina){
                    case 1:
                        document.getElementById("reglamentoPagina").src = "assets/UI/recintos 1.png";
                        break;
                    case 2:
                        document.getElementById("reglamentoPagina").src = "assets/UI/recintos_2.png";
                        break;
                    case 3:
                        document.getElementById("reglamentoPagina").src = "assets/UI/tablero.png";
                        break;
                    case 4:
                        document.getElementById("reglamentoPagina").src = "assets/UI/dado.png";
                        break;
                    case 5:
                        document.getElementById("reglamentoPagina").src = "assets/UI/final_partida.png";
                    break;
                    default:
                        document.getElementById("reglamentoPagina").src = "assets/UI/recintos 1 .png";
                        break;
                }       
            }
        </script>

        <!--computadora-->
        <script>
            let pagina = 1;
            let restricciones = {};
            let dado = false;
            let puntos = 0;

            function cambiarPagCompu(x){
                pagina = pagina + x;

                if (pagina > 4){
                    pagina = 1;
                }

                if (pagina < 1){
                    pagina = 4;
                }

                switch(pagina){
                    case 1:
                        document.getElementById("reglamentoPaginaCompu").src = "assets/UI/recintopc.png";
                        break;
                    case 2:
                        document.getElementById("reglamentoPaginaCompu").src = "assets/UI/tableropc.png";
                        break;
                    case 3:
                        document.getElementById("reglamentoPaginaCompu").src = "assets/UI/dadopc.png";
                        break;
                    case 4:
                        document.getElementById("reglamentoPaginaCompu").src = "assets/UI/finalpc.png";
                        break;
                    default:
                        document.getElementById("reglamentoPaginaCompu").src = "assets/UI/recintopc.png";
                        break;
                }       
            }

            for(let o = 1; o <= 6; o++){
                restricciones[o] = false
            }
            // 1 = madera, 2 = rocoso, 3 = no planta, 4 = no rosa, 5 = caja registradora, 6 = estacionamiento

            function verificarRonda(){
                if(jugada){
                    jugada = false;
                    if (ronda > 11){ // despues de 12 turnos (2 rondas de 6 turnos) se termina la partida
                        const coso = document.getElementById('rey');
                        const flor = coso.getElementsByClassName('card');
                        if (flor.length > 0){
                            const id = flor[0].id;
                            if(confirm("Presiona aceptar si eres el jugador con mas "+ id)){
                                puntos += 7;
                                console.log(puntos);
                            }
                        }
                        const form = document.createElement("form");
                        form.method = "POST";
                        form.action = "index.php?ruta=finpartida";

                        const input = document.createElement("input");
                        input.type = "hidden";
                        input.name = "puntos";
                        input.value = puntos;

                        localStorage.clear();
                        form.appendChild(input);
                        document.body.appendChild(form);
                        form.submit();
                        //window.location.href = "index.php?ruta=resultados";                        
                    }else{
                        ronda++;
                        dado = false;
                        document.getElementById("restriccion").innerText = "Jugada realizada, turno " + ronda;
                        guardarEstado();
                        for (let i = 1; i <= <?= $_SESSION['cantidad']?>; i++) { // se resetean todas las imagenes de los dados
                            document.getElementById(`imgdado${i}Compu`).src = "assets/UI/dadodefault.png";
                        }
                        console.log(puntos);
                    }
                }else{
                    $restriccion = "Debe completar su jugada antes de continuar";
                    document.getElementById("restriccion").innerText = $restriccion;
                    
                }
            }

            let jugadorCompu = 0;

            function salir(){
                localStroage.clear();
            }

            function abrirDadoCompu(x){
                document.getElementById("dadoCompu").style.display = "flex";
                jugadorCompu = x;
                const jugadores = <?= json_encode($_SESSION['jugadores']) ?>;
                document.getElementById("jugadorDado").textContent = jugadores[jugadorCompu]+" tiró el dado";
                for(let o = 1; o <= 6; o++){
                    restricciones[o] = false
                }
            }

            function cambiarDadoCompu(restriccion){
                const caras = ["madera", "rocoso", "no planta", "rosa", "caja registradora", "estacionamiento"];

                for (let i = 1; i <= <?= $_SESSION['cantidad']?>; i++) { // se resetean todas las imagenes de los dados
                    document.getElementById(`imgdado${i}Compu`).src = "assets/UI/dadodefault.png";
                }

                document.getElementById(`imgdado${jugadorCompu}Compu`).src = "assets/CARAS DADO/" + caras[restriccion - 1]+".png"; // se cambia la imagen del dado del jugador correspondiente
                document.getElementById("dadoCompu").style.display = "none";

                if (jugadorCompu > 1){
                    restricciones[restriccion] = true;                
                }

                dado = true;
            }

            function cerrarDadoCompu(){
                    document.getElementById("dadoCompu").style.display = "none";
            }

            function mostrarReglamentoCompu(){
                document.getElementById("reglamentoCompu").style.display = "flex";
            }

            function cerrarReglamentoCompu(){
                document.getElementById("reglamentoCompu").style.display = "none";
            }

            function mostrarAyudaCompu(){
                document.getElementById("ayudaCompu").style.display = "flex";
            }

            function cerrarAyudaCompu(){
                document.getElementById("ayudaCompu").style.display = "none";
            }

            function cambiarPagAyudaCompu(x){
                pagina = pagina + x;

                if (pagina > 3){
                    pagina = 1;
                }

                if (pagina < 1){
                    pagina = 3
                }

                switch(pagina){
                    case 1:
                        document.getElementById("ayudaPaginaCompu").src = "assets/UI/ayuda1.png";
                        document.getElementById("ayudaPaginaCompu").style = "position: absolute; position: absolute; top: 3%; width: 75%;";
                        break;
                    case 2:
                        document.getElementById("ayudaPaginaCompu").src = "assets/UI/ayuda2.png";
                        document.getElementById("ayudaPaginaCompu").style = "position: absolute; top: 10%; width: 110%;";
                        break;
                    case 3:
                        document.getElementById("ayudaPaginaCompu").src = "assets/UI/ayuda3.jpg";
                        document.getElementById("ayudaPaginaCompu").style = "position: absolute; top: 10%; width: 100%;";
                        break;
                    default:
                        document.getElementById("ayudaPaginaCompu").src = "assets/UI/ayuda1.png";
                        document.getElementById("ayudaPaginaCompu").style = "position: absolute; position: absolute; top: 3%; width: 75%;";
                        break;
                }       
            }
        </script>
        <script src="js/tablero.js"></script>
    </body>
</html>

