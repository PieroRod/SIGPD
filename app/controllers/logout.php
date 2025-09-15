<?php

session_unset(); //Libera la variable session
session_destroy(); //Destruye toda la data de la sesión
header("Location: index.php?ruta=inicio");
