#!/bin/bash

function menuUsuario() {
    local opc=0
    while ((opc != 3)); do  
        clear
        echo ":::::Bienvenido al menú de usuarios:::::"
	echo "* * * * * * * * * * * * * * * * * * * *"
	echo " "
        echo "1. Alta usuario"
	echo "-----------------------"
        echo "2. Baja usuario"
	echo "-----------------------"
        echo "3. Volver al menú principal"
        read -p "Ingresar opción: " opc

        case $opc in
            1) altaUsuario ;;
            2) bajaUsuario ;;
            3) return ;; 
            *) echo "Opción no válida"
               read -p "Presione ENTER para continuar" ;;
        esac
    done
}

function altaUsuario() {
    clear
    read -p "Ingrese el nombre del usuario: " usuario
    read -p "Ingrese el directorio de home: " directorio

    if grep -q "^$usuario:" /etc/passwd; then
        echo "El usuario $usuario ya existe"
    else
        useradd -d "/home/$directorio" -m -s /bin/bash "$usuario"
        echo "$usuario:$usuario" | chpasswd
        chage -d 0 "$usuario"
        echo "Se ha creado el usuario $usuario en /home/$directorio con contraseña temporal '$usuario'"
    fi

    read -p "Presione ENTER para continuar"
}

function bajaUsuario() {
    clear
    read -p "Ingrese el nombre del usuario a eliminar: " usuario
    read -p "¿Deseas borrar también el directorio de home? (y/n): " caso

    if [[ $caso == "y" ]]; then
        userdel -r "$usuario"
        echo "Se ha eliminado el usuario $usuario y su directorio home"
    elif [[ $caso == "no" ]]; then
        userdel "$usuario"
        echo "Se ha elminado el usuario $usuario"
    else
        echo "Se canceló la baja de usuario por un error en la opción ingresada"
    fi

    read -p "Presione ENTER para continuar"
}

function menuGrupo() {
    local opc=0
    while ((opc != 3)); do  
        clear
        echo ":::::Bienvenido al menú de grupos:::::"
	echo "* * * * * * * * * * * * * * * * * * * *"
	echo ""
        echo "1. Alta grupo"
	echo "-----------------------"
        echo "2. Baja grupo"
	echo "-----------------------"
        echo "3. Volver al menú principal"
        read -p "Ingresar opción: " opc

        case $opc in
            1) altaGrupo ;;
            2) bajaGrupo ;;
            3) return ;;
            *) echo "Opción no válida"
               read -p "Presione ENTER para continuar" ;;
        esac
    done
}

function altaGrupo() {
	read -p "Ingrese el nombre del grupo: " grupo
	if [[ -z "$grupo" ]]; then
    		groupadd "$grupo"
    		echo "Nombre de grupo no válido"
	else
		groupadd "$grupo"
		echo "Se ha creado el grupo $grupo"
	fi
	read -p "Presione ENTER para continuar"
}

function bajaGrupo() {
	read -p "Ingrese el nombre del grupo: " grupo
	if [[ -z "$grupo" ]]; then
    		sudo groupdel "$grupo"
    		echo "Nombre de grupo no válido"
	else
		groupadd "$grupo"
		echo "Se ha creado el grupo $grupo"
	fi
	read -p "Presione ENTER para continuar"
}


