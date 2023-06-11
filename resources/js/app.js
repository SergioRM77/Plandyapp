// localStorage.setItem('test', 1);
console.log('añadiendo JS');
// alert( sessionStorage.getItem('test') ); 
const aside = document.getElementById('mostrar-ocultar-sidebar')

const mainMenu = document.getElementById('main-menu')


function mostrarOcultarElem(nombreID){
    let contenedor = document.getElementById(nombreID)

    if(contenedor.style.display == "" || contenedor.style.display == "block") {
        contenedor.style.display = "none";
    }
    else {
        contenedor.style.display = "block";
    }
    
}

function cambiarSimbolDesplegable(desplegableID){
    let desplegable = document.getElementById(desplegableID)

    if(desplegable.className == "" || desplegable.className == "triangulo_der") {
        desplegable.className = "triangulo_inf";
    }
    else {
        desplegable.className = "triangulo_der";
    }
    
}
window.addEventListener("DOMContentLoaded", () => {
    
    aside.addEventListener('click', () => {
        if (mainMenu.classList.contains("hover:w-52")) {
            mainMenu.classList.remove("hover:w-52");
            aside.innerHTML = "Menu Expandir"
        }else{
            mainMenu.classList.add('hover:w-52')
            aside.innerHTML = "Menu Ocultar"
        }

    })
})

window.addEventListener("DOMContentLoaded", () => {
    const participantes = document.getElementById('participantes')
    participantes.addEventListener('click', () => {
        mostrarOcultarElem('lista-participantes')
        cambiarSimbolDesplegable('desplegable-participante')
    })
})

window.addEventListener("DOMContentLoaded", () => {
    const gastos = document.getElementById('gastos')
    gastos.addEventListener('click', () => {
        mostrarOcultarElem('lista-gastos')
        cambiarSimbolDesplegable('desplegable-gastos')
    })
})

window.addEventListener("DOMContentLoaded", () => {
    const gastosPresu = document.getElementById('gastos-presu')
    gastosPresu.addEventListener('click', () => {
        mostrarOcultarElem('lista-gastos-presu')
        cambiarSimbolDesplegable('desplegable-gastos-presu')
    })
})

window.addEventListener("DOMContentLoaded", () => {
    const actividades = document.getElementById('actividades')
    actividades.addEventListener('click', () => {
        mostrarOcultarElem('lista-actividades')
        cambiarSimbolDesplegable('desplegable-actividades')
    })
})

window.addEventListener("DOMContentLoaded", () => {
    const cuentas = document.getElementById('cuentas')
    cuentas.addEventListener('click', () => {
        mostrarOcultarElem('datos-cuentas')
        cambiarSimbolDesplegable('desplegable-cuentas')
    })
})
window.addEventListener("DOMContentLoaded", () => {
    const desgloseGastos = document.getElementById('desglose-gastos')
    desgloseGastos.addEventListener('click', () => {
        mostrarOcultarElem('lista-desglose-gastos')
        cambiarSimbolDesplegable('desplegable-desglose-gastos')
    })
})
