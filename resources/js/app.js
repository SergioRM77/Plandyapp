console.log('añadiendo JS');
function mostrarOcultarElem(nombreID){
    let contenedor = document.getElementById(nombreID)

    if(contenedor.style.display == "" || contenedor.style.display == "block") {
        contenedor.style.display = "none";
    }
    else {
        contenedor.style.display = "block";
    }
    
}
window.addEventListener("DOMContentLoaded", () => {
    const aside = document.getElementsByTagName('header')[0]
    aside.addEventListener('click', () => {
        mostrarOcultarElem('main-menu')
    })
})



