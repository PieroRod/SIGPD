let jugada = false;
let solitaria = false;
let fichsol;
let arraysol = [];
let numsol = 0;
let nose = false;
let ronda = 1;
let rosaBonus = {
    similitud: false,
    rey: false,
    trio: false,
    indiferencia: false,
    parejas: false,
    solitario: false
};

function guardarEstado() {
    const estadoTablero = {};
    document.querySelectorAll(".game-board").forEach(board => {
        const fichas = [];
        board.querySelectorAll(".card").forEach(card => {
            fichas.push({
                id: card.id,
                src: card.querySelector(".card-image").src,
                top: card.style.top,
                left: card.style.left,
                height: card.style.height,
                transform: card.style.transform || ""
            });
        });
        estadoTablero[board.id] = fichas;
    });

    const estadoJuego = {
        jugada,
        solitaria,
        fichsol,
        arraysol,
        numsol,
        nose,
        rosaBonus,
        puntos,
        restricciones,
        ronda,
        estadoTablero,
    };

    localStorage.setItem("estadoJuego", JSON.stringify(estadoJuego));
}

function cargarEstado() {
    const guardado = localStorage.getItem("estadoJuego");
    if (guardado) {
        const e = JSON.parse(guardado);

        jugada = e.jugada;
        solitaria = e.solitaria;
        fichsol = e.fichsol;
        arraysol = e.arraysol;
        numsol = e.numsol;
        nose = e.nose;
        rosaBonus = e.rosaBonus;
        puntos = e.puntos;
        restricciones = e.restricciones;
        ronda = e.ronda;

        Object.keys(e.estadoTablero).forEach(idTablero => {
            const tablero = document.getElementById(idTablero);
            e.estadoTablero[idTablero].forEach(ficha => {
                const card = document.createElement("div");
                card.classList.add("card");
                card.style.position = "absolute";
                card.style.background = "transparent";
                card.style.width = "auto";
                card.id = ficha.id;
                card.style.top = ficha.top;
                card.style.left = ficha.left;
                card.style.height = ficha.height;
                if (ficha.transform) card.style.transform = ficha.transform;

                const img = document.createElement("img");
                img.src = ficha.src;
                img.alt = ficha.id;
                img.classList.add("card-image");
                img.style.height = "100%";
                card.appendChild(img);

                tablero.appendChild(card);
            });
        });
    }
}

document.addEventListener("DOMContentLoaded", () => {
                cargarEstado();
                const cards = document.querySelectorAll(".card");
                const gameBoard = document.querySelectorAll(".game-board");

                // 1. Hacer cada card arrastrable
                cards.forEach(card => {
                    card.setAttribute("draggable", true);

                    card.addEventListener("dragstart", (e) => {
                        // Guardamos info de la card
                        const flor = card.id;

                        e.dataTransfer.setData("text/plain", JSON.stringify({
                            name: flor,
                            img: card.querySelector(".card-image").src,
                        }));
                     });
                });

                // 2. Permitir drop
                    gameBoard.forEach(board => {
                        board.addEventListener("dragover", e => e.preventDefault());
                        board.addEventListener("drop", e => {
                            e.preventDefault();
                            if (dado === false){
                                restriccion = "Debe seleccionar una restriccion del dado primero";
                                document.getElementById("restriccion").innerText = restriccion;
                                return;
                            }

                            if (jugada){
                                restriccion = "Ya haz realizado tu jugada";
                                document.getElementById("restriccion").innerText = restriccion;
                                return;
                            }

                            const data = JSON.parse(e.dataTransfer.getData("text/plain"));

                            if (solitaria === true && (data.name === fichsol) && board.id !== "basura"){   // advertencia si poner una ficha del mismo tipo que la que hay en solitaria
                                restriccion = "Esa flor se encuentra en la Maceta solitaria, si la colocas, perderas sus puntos";
                                document.getElementById("restriccion").innerText = restriccion;
                                solitaria = false;
                                puntos -= 7;
                                return;
                            }

                                const newCard = document.createElement("div");
                                newCard.classList.add("card");
                                newCard.style.position = "absolute";
                                newCard.style.background = "transparent";
                                newCard.style.width = "auto";
                                newCard.id = data.name;

                                const img = document.createElement("img");
                                img.src = data.img;
                                img.style.height = "100%";
                                img.alt = data.name;
                                img.classList.add("card-image");

                                const ficha = data.name;

                                switch (board.id) {
                                    case "similitud":
                                        newCard.style.height = "35%";
                                        const boardsimi = document.getElementById("similitud");
                                        const fichasimi = boardsimi.getElementsByClassName("card");
                                        const cantidadsimi = fichasimi.length;

                                        if (cantidadsimi != 0){
                                            const ultimafichas = fichasimi[cantidadsimi - 1];
                                            if (ultimafichas.id != ficha){
                                                restriccion = "Todas las fichas deben ser iguales en similitud";
                                                document.getElementById("restriccion").innerText = restriccion;
                                                return; // si la ultima es diferente hace return
                                            }
                                        }

                                        if (restricciones[2] === true){ // restriccion de roca
                                            restriccion = "Solo puedes colocar fichas en la zona de roca";
                                            document.getElementById("restriccion").innerText = restriccion;
                                            return;
                                        }

                                        if (restricciones[6] === true){ // restriccion de estacionamiento
                                            restriccion = "Solo puedes colocar fichas en la zona de estacionamiento";
                                            document.getElementById("restriccion").innerText = restriccion;
                                            return;
                                        }

                                        if (restricciones[3] === true){ // restriccion no plantas
                                            if(cantidadsimi > 0){
                                                restriccion = "No puedes colocar fichas donde ya hay fichas";
                                                document.getElementById("restriccion").innerText = restriccion;
                                                return;
                                            }
                                        }

                                        if (restricciones[4] === true){ // restriccion no rosas
                                            if (cantidadsimi > 0){
                                                for (let i = 0; i < cantidadsimi; i++){
                                                    if (fichasimi[i].id === "rosa"){
                                                        restriccion = "No puedes colocar fichas donde hay rosas";
                                                        document.getElementById("restriccion").innerText = restriccion;
                                                        return;
                                                    }
                                                }
                                            }
                                        }

                                            switch (cantidadsimi){
                                                case 0:
                                                    puntos += 2;
                                                    newCard.style.top = "5%";
                                                    newCard.style.left = "0%";
                                                    break;
                                                case 1:
                                                    puntos += 2;
                                                    newCard.style.top = "40%";
                                                    newCard.style.left = "15%";
                                                    break;
                                                case 2:
                                                    puntos += 4;
                                                    newCard.style.top = "5%";
                                                    newCard.style.left = "33%";
                                                    break;
                                                case 3:
                                                    puntos += 4;
                                                    newCard.style.top = "40%";
                                                    newCard.style.left = "50%";
                                                    break;
                                                case 4:
                                                    puntos += 6;
                                                    newCard.style.top = "5%";
                                                    newCard.style.left = "65%";
                                                    break;
                                                case 5:
                                                    puntos += 6;
                                                    newCard.style.top = "40%";
                                                    newCard.style.left = "80%";
                                                    break;
                                                default:
                                                    return; // No agregar más fichas si ya hay 6
                                            }
                                            break;                          
                                    case "rey":
                                        const boardrey = document.getElementById("rey");
                                        const fichasrey = boardrey.getElementsByClassName("card").length;
                                        
                                        if (restricciones[2] === true){ // restriccion de rocoso
                                            restriccion = "Solo puedes colocar fichas en la zona de roca";
                                            document.getElementById("restriccion").innerText = restriccion;
                                            return;
                                        }

                                        if (restricciones[5] === true){ // restriccion de caja registradora
                                            restriccion = "Solo puedes colocar fichas en la zona de caja registradora";
                                            document.getElementById("restriccion").innerText = restriccion;
                                            return;
                                        }

                                        if (fichasrey === 0){
                                            newCard.style.height = "100%";
                                            newCard.style.top = "10%";
                                            newCard.style.left = "50%";
                                            newCard.style.transform = "translate(-50%, -50%) scale(0.5)";
                                        }else {
                                            return; // No agregar más fichas si ya hay 1
                                        }
                                        break;
                                    case "trio":
                                        newCard.style.height = "40%";
                                        const boardtrio = document.getElementById("trio");
                                        const fichastrio = boardtrio.getElementsByClassName("card");
                                        const cantidadtrio = fichastrio.length;


                                        if (restricciones[2] === true){ // restriccion de roca
                                            restriccion = "Solo puedes colocar fichas en la zona de roca";
                                            document.getElementById("restriccion").innerText = restriccion;
                                            return;
                                        }

                                        if (restricciones[6] === true){ // restriccion de estacionamiento
                                            restriccion = "Solo puedes colocar fichas en la zona de estacionamiento";
                                            document.getElementById("restriccion").innerText = restriccion;
                                            return;
                                        }

                                        if (restricciones[3] === true){ // restriccion no plantas
                                            if(cantidadtrio > 0){
                                                restriccion = "No puedes colocar fichas donde ya hay fichas";
                                                document.getElementById("restriccion").innerText = restriccion;
                                                return;
                                            }
                                        }

                                        if (restricciones[4] === true){ // restriccion no rosas
                                            if (cantidadtrio > 0){
                                                for (let i = 0; i < cantidadtrio; i++){
                                                    if (fichastrio[i].id === "rosa"){
                                                        restriccion = "No puedes colocar fichas donde hay rosas";
                                                        document.getElementById("restriccion").innerText = restriccion;
                                                        return;
                                                    }
                                                }
                                            }
                                        }

                                        switch (cantidadtrio){
                                            case 0:
                                                newCard.style.top = "0%";
                                                newCard.style.left = "15%";
                                                break;
                                            case 1:
                                                newCard.style.top = "29%";
                                                newCard.style.left = "37%";
                                                break;
                                            case 2:
                                                puntos += 7;
                                                newCard.style.top = "-10%";
                                                newCard.style.left = "50%";
                                                break;
                                            default:
                                                return; // no agregar más fichas si ya hay 3
                                        }
                                        break;
                                    case "indiferencia":
                                        newCard.style.height = "35%";
                                        const boardind = document.getElementById("indiferencia");
                                        const fichasind = boardind.getElementsByClassName("card");
                                        const cantidadind = fichasind.length;

                                        if (cantidadind != 0){
                                        for (let i = 0; i < cantidadind; i++) {
                                                if (fichasind[i].id === ficha) {
                                                    restriccion = "Todas las fichas deben ser distintas en indiferencia";
                                                    document.getElementById("restriccion").innerText = restriccion;
                                                    return; // No agregar si alguna ficha es diferente
                                                }
                                            }
                                        }

                                        if (restricciones[3] === true){ // restriccion no plantas
                                            if(cantidadind > 0){
                                                restriccion = "No puedes colocar fichas donde ya hay fichas";
                                                document.getElementById("restriccion").innerText = restriccion;
                                                return;
                                            }
                                        }

                                        if (restricciones[4] === true){ // restriccion no rosas
                                            if (cantidadind > 0){
                                                for (let i = 0; i < cantidadind; i++){
                                                    if (fichasind[i].id === "rosa"){
                                                        restriccion = "No puedes colocar fichas donde hay rosas";
                                                        document.getElementById("restriccion").innerText = restriccion;
                                                        return;
                                                    }
                                                }
                                            }
                                        }

                                        if (restricciones[1] === true){ // restriccion de madera
                                            restriccion = "Solo puedes colocar fichas en la zona de madera";
                                            document.getElementById("restriccion").innerText = restriccion;
                                            return;
                                        }

                                        if (restricciones[5] === true){ // restriccion de caja registradora
                                            restriccion = "No puedes colocar fichas en la zona de caja registradora";
                                            document.getElementById("restriccion").innerText = restriccion;
                                            return;
                                        }

                                        switch (cantidadind){
                                            case 0:
                                                puntos += 1;
                                                newCard.style.top = "5%";
                                                newCard.style.left = "0%";
                                                break;
                                            case 1:
                                                puntos += 2;
                                                newCard.style.top = "40%";
                                                newCard.style.left = "15%";
                                                break;
                                            case 2:
                                                puntos += 3;
                                                newCard.style.top = "5%";
                                                newCard.style.left = "30%";
                                                break;
                                            case 3:
                                                puntos += 4;
                                                newCard.style.top = "40%";
                                                newCard.style.left = "47%";
                                                break;
                                            case 4:
                                                puntos += 5;
                                                newCard.style.top = "5%";
                                                newCard.style.left = "60%";
                                                break;
                                            case 5:
                                                puntos += 6;
                                                newCard.style.top = "40%";
                                                newCard.style.left = "75%";
                                                break;
                                            default:
                                                return; // No agregar más fichas si ya hay 6
                                        }
                                        break;
                                    case "parejas":
                                        newCard.style.height = "25%";
                                        const boardpar = document.getElementById("parejas");
                                        const fichaspar = boardpar.getElementsByClassName("card");
                                        const cantidadpar = fichaspar.length;
                                        
                                        if (restricciones[3] === true){ // restriccion no plantas
                                            if(cantidadpar > 0){
                                                restriccion = "No puedes colocar fichas donde ya hay fichas";
                                                document.getElementById("restriccion").innerText = restriccion;
                                                return;
                                            }
                                        }

                                        if (restricciones[6] === true){ // restriccion de estacionamiento
                                            restriccion = "Solo puedes colocar fichas en la zona de estacionamiento";
                                            document.getElementById("restriccion").innerText = restriccion;
                                            return;
                                        }

                                        if (restricciones[1] === true){ // restriccion de madera
                                            restriccion = "Solo puedes colocar fichas en la zona de madera";
                                            document.getElementById("restriccion").innerText = restriccion;
                                            return;
                                        }

                                        if (restricciones[4] === true){ // restriccion no rosas
                                            if (cantidadpar > 0){
                                                for (let i = 0; i < cantidadpar; i++){
                                                    if (fichaspar[i].id === "rosa"){
                                                        restriccion = "No puedes colocar fichas donde hay rosas";
                                                        document.getElementById("restriccion").innerText = restriccion;
                                                        return;
                                                    }
                                                }
                                            }
                                        }

                                        let fichasig = 1;
                                        for (let i = 0; i <= cantidadpar-1; i++){
                                            if (fichaspar[i].id === ficha){
                                                fichasig += 1;
                                            }
                                        }

                                        if (fichasig % 2 === 0){
                                            puntos += 5;
                                        }

                                        switch (cantidadpar){
                                            case 0:
                                                newCard.style.top = "15%";
                                                newCard.style.left = "0%";
                                                break;
                                            case 1:
                                                newCard.style.top = "15%";
                                                newCard.style.left = "25%";
                                                break;
                                            case 2:
                                                newCard.style.top = "15%";
                                                newCard.style.left = "50%";
                                                break;
                                            case 3:
                                                newCard.style.top = "15%";
                                                newCard.style.left = "75%";
                                                break;
                                            case 4:
                                                newCard.style.top = "40%";
                                                newCard.style.left = "0%";
                                                break;
                                            case 5:
                                                newCard.style.top = "40%";
                                                newCard.style.left = "25%";
                                                break;
                                            case 6:
                                                newCard.style.top = "40%";
                                                newCard.style.left = "50%";
                                                break;
                                            case 7:
                                                newCard.style.top = "40%";
                                                newCard.style.left = "75%";
                                                break;
                                            case 8:
                                                newCard.style.top = "65%";
                                                newCard.style.left = "0%";
                                                break;
                                            case 9:
                                                newCard.style.top = "65%";
                                                newCard.style.left = "25%";
                                                break;
                                            case 10:
                                                newCard.style.top = "65%";
                                                newCard.style.left = "50%";
                                                break;
                                            case 11:
                                                newCard.style.top = "65%";
                                                newCard.style.left = "75%";
                                                break;
                                            default:
                                                return; 
                                        }
                                        break;
                                    case "solitario":
                                        const boardsol = document.getElementById("solitario");
                                        const fichassol = boardsol.getElementsByClassName("card");
                                        const cantidadsol = fichassol.length;

                                        if (restricciones[1] === true){ // restriccion de madera
                                            restriccion = "Solo puedes colocar fichas en la zona de madera";
                                            document.getElementById("restriccion").innerText = restriccion;
                                            return;
                                        }

                                        if (restricciones[6] === true){ // restriccion de caja registradora
                                            restriccion = "Solo puedes colocar fichas en la zona de caja registradora";
                                            document.getElementById("restriccion").innerText = restriccion;
                                            return;
                                        }

                                        if (cantidadsol === 0){
                                            newCard.style.height = "100%";
                                            newCard.style.top = "20%";
                                            newCard.style.left = "50%";
                                            newCard.style.transform = "translate(-50%, -50%) scale(0.5)";

                                            if (nose === false){ // advertencia si vas a poner una ficha que ya hay en otro recinto
                                                for (let i = 0; i < arraysol.length; i++){
                                                    if (arraysol[i] === ficha){
                                                        restriccion = "Esa flor se encuentra en otro recinto, si la colocas en la Maceta solitaria no ganaras sus puntos";
                                                        document.getElementById("restriccion").innerText = restriccion;
                                                        nose = true;
                                                        return;
                                                    }
                                                }
                                            }

                                            solitaria = true;
                                            fichsol = ficha;
                                            if (nose === false){
                                                puntos += 7;
                                            }
                                        }else {
                                            return; // No agregar más fichas si ya hay 1
                                        }
                                        break;
                                    case "basura":
                                        const left = Math.random() * 80 + 10; // Posición aleatoria entre 10% y 90%
                                        const top = Math.random() * 60 + 20;  // Posición aleatoria entre 20% y 80%
                                        puntos += 1;
                                        newCard.style.height = "40%";   
                                        newCard.style.top = top + "%";
                                        newCard.style.left = left + "%";
                                        newCard.style.transform = "translate(-50%, -50%)";
                                }

                                newCard.appendChild(img);
                                board.appendChild(newCard);
                                jugada = true;
                                restriccion = "";
                                if (board.id !== "basura") {
                                    arraysol[numsol] = ficha;
                                    numsol += 1;
                                    if (ficha === 'rosa' && rosaBonus[board.id] === false) {
                                        puntos += 1;
                                        rosaBonus[board.id] = true;
                                    }
                                }
                                nose = false;
                                document.getElementById("restriccion").innerText = restriccion;
                                guardarEstado();

                        });
                        board.style.position = "relative";
                    });
            });