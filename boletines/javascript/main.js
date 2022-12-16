console.log("Hola desde un archivo externo de Javascript");

// DOM
let links = document.querySelectorAll("a"); //Asi se declara una variable en js querySelector te selecciona solo uno, el primero, de los elementos

links.forEach(function(link){
    console.log(link);
})

console.log(links); //Para imprimir en pantalla

let celdas = document.querySelectorAll("td"); 

celdas.forEach(function(td){
    td.addEventListener('click',function(){
        console.log(this);
    })
});

//Obtener los elementos de la clase .close

let cierre = document.querySelectorAll(".close"); 

//Recorrerlos

cierre.forEach(function(close){

    //Agregar un evento click a cada uno de ellos

    close.addEventListener('click',function(ev){
        ev.preventDefault();
        let content = document.querySelector('.content');

        //Quitarle las clases de animacion que ya tiene
        content.classList.remove("animate__animated");
        content.classList.remove("animate__backInDown");
        //Agregar clases para animar su salida
        content.classList.add("animate__animated");
        content.classList.add("animate__fadeOutUp");
        //Añadirle un tiempo antes de que realize la acción tras la animación de salida
        setTimeout(function(){
            location.href = "../index.html";
        },600);
        //setInterval
        return false;
    })
});
