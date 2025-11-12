function soloLetrasYNumeros(event) {
    const char = event.key;
    const regex = /^[a-zA-Z0-9]$/; // letras y números

    // permitir teclas especiales (borrar, delete, flechas)
    if (
        event.key === "Backspace" ||
        event.key === "Delete" ||
        event.key === "ArrowLeft" ||
        event.key === "ArrowRight"
    ) {
        return true;
    }

    // bloquear todo lo que no coincida
    if (!regex.test(char)) {
        event.preventDefault();
    }
}

// document.addEventListener('DOMContentLoaded', function() {
//     for (let i = 1; i <= 3; i++) {
//         const inputU = document.getElementById('txtUsuario' + i);
//         inputU.addEventListener('keypress', function(event) {
//             const cantidad = inputU.value.length; console.log(cantidad  > 20);
//             if (cantidad > 20) {
//                 console.log("hola")
//                 event.preventDefault();
//             }
//         });
//     }

//     for (let i = 1; i <= 3; i++) {
//         const inputU = document.getElementById('txtContrasena' + i);
//         inputU.addEventListener('keypress', function(event) {
//             const cantidad = inputU.value.length; console.log(cantidad  > 20);
//             if (cantidad > 20) {
//                 console.log("hola")
//                 event.preventDefault();
//             }
//         });
//     }
// });


document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        for(let i = 1; i <= 3; i++) {
            const signinButton = document.getElementById('signin' + i);
            if (signinButton) {
                signinButton.click();
            }
        }
    }
});
