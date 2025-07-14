#!/bin/bash

if [ $EUID -eq 0 ]; then 

    source ./gestiones.sh

    opc=0

    while [ "$opc" != 3 ]; do
        clear 

        echo ":::::::::::Usuarios y Grupos:::::::::::"
	echo "* * * * * * * * * * * * * * * * * * * *"
	echo " "
        echo "1. Gestión de usuarios"
	echo "---------------------"
        echo "2. Gestión de grupos"
	echo "---------------------"
        echo "3. Salir"
	echo "---------------------"
        read -p "Elija una opción: " opc

        case $opc in 
            1) menuUsuario ;;
            2) menuGrupo ;;
            3) echo "Saliendo..."
               read -p "Presione ENTER para salir" ;;
            *) echo "Opción no válida"
               read -p "Presione ENTER para continuar" ;;
        esac
    done
else
    echo "(!!) Se requieren privilegios de superusuario (!!)"
fi
