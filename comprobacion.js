function login(event){
    var bien = true;
    var msg = "Tienes que escribir algo en los campos:";
    if(document.getElementById("user").value == ""  || comprobarEspacioBlanco(document.getElementById("user").value)){
        bien = false;
        msg += " Usuario\n";
    }

    if(document.getElementById("pass").value == "" || comprobarEspacioBlanco(document.getElementById("pass").value)){
        bien = false;
        msg += " Contraseña\n";
    }

    if(bien == false){
        alert(msg);
        event.preventDefault();
    }
}

function registro(event){
    var bien = true;
    var msg = "Tienes que escribir algo en los campos:\n";

    var nombre = document.getElementById("name").value;
    if(nombre == "" || nombre.length < 3 || nombre.length > 15 || empiezanumero(nombre) || asci(nombre)){
        bien = false;
        msg += " Nombre\n";
    }

    var contrasena = document.getElementById("password").value;
    if(contrasena == "" || contrasena.length < 6 || contrasena.length > 15 || asciguion(contrasena) || minimos(contrasena)){
        bien = false;
        msg += " Contraseña\n";
    }

    var repetir = document.getElementById("password2").value;
    if(repetir != contrasena || repetir == ""){
        bien = false;
        msg += " Repetir Contraseña\n";
    }

    var email = document.getElementById("email").value;
    if(email.includes("@")){
        const separacion = email.split("@");
        if(separacion[0] > 64 || separacion[0] < 1 || separacion[1] < 1 || separacion[1] > 255){
            malemail();
        }
        else{
            if(asciemail(separacion[0]) || puntos(separacion[0])){
                malemail();
            }
            else{
                var sub = separacion[1].split(".");
                if(largosubdominio(sub) || subasci(sub) || empiezaguion(sub)){
                    malemail();
                }
            }
        }
    }
    else{
        malemail();
    }

    var sexo = document.getElementById("sexo").value;
    if(sexo == ""){
        bien = false;
        msg += " Sexo\n";
    }

    var fecha = document.getElementById("birthday").value;
    if(fecha == ""){
        malfecha();
    }
    else{
        const fechas = fecha.split("/");
        if(fechas.length != 3){
            malfecha();
        }
        else{
            if(fechas[0].length != 2 || fechas[1].length != 2 || fechas[2].length != 4){
                malfecha();
            }
            else{
                if((fechas[0] > 0 && fechas[0] < 32) && (fechas[1] > 0 && fechas[1] < 13) && (fechas[2] < 2023)){
                    var fechabuena = new Date(fechas[2], fechas[1]-1, fechas[0]);
                    const hoy = new Date(Date.now());
                    var year = hoy.getFullYear() - fechabuena.getFullYear();
                    if(year < 18){
                        malfecha();
                    }
                    else{
                        if(year == 18){
                            var mes = hoy.getMonth() - fechabuena.getMonth();
                            if(mes >= 0){
                                if(mes == 0){
                                    var day = hoy.getDate() - fechabuena.getDate();
                                    if(day >= 0){
                                        console.log("Mayor de 18");
                                    }
                                    else{
                                        malfecha();
                                    }
                                }    
                            }
                            else{
                                malfecha();
                            }
                        }
                    }
                }
                else{
                    malfecha();
                }
            }
        }
    }

    if(bien == false){
        alert(msg);
        event.preventDefault();
    }

    function malfecha(){
        bien = false;
        msg += " Fecha de nacimiento. Con formato dd/mm/yyyy\n";
    }
    
    function malemail(){
        bien = false;
        msg += " Email\n";
    }
}

function comprobarEspacioBlanco(cadena){
    var bien = false;

    for(i=0; i<cadena.length;i++){
        if(cadena[i] == " "){
            bien = true;
        }
        else{
            bien = false;
            break;
        }
    }

    return bien;
}

function empiezanumero(cadena){
    var bien = false;
    var numeros = [0,1,2,3,4,5,6,7,8,9];

    for (i=0; i<numeros.length;i++){
        if(cadena[0] == numeros[i]){
            bien = true;
            break;
        }
    }

    return bien;
}

function asci(cadena){
    var bien = true;
    
    for(i=0; i<cadena.length;i++){
        let asciivalue = cadena[i].charCodeAt(0);  
        if((asciivalue > 64 && asciivalue < 91) || (asciivalue > 96 && asciivalue < 123) || (asciivalue > 47 && asciivalue < 58)){
            bien = false;
        }
        else{
            bien = true;
            break;
        }
    }

    return bien;
}

function asciguion(cadena){
    var bien = true;
    
    for(i=0; i<cadena.length;i++){
        let asciivalue = cadena[i].charCodeAt(0);  
        if((asciivalue > 64 && asciivalue < 91) || (asciivalue > 96 && asciivalue < 123) || (asciivalue > 47 && asciivalue < 58) || asciivalue == 45 || asciivalue == 95){
            bien = false;
        }
        else{
            bien = true;
            break;
        }
    }

    return bien;
}

function minimos(cadena){
    var bien = true;
    var min = 0;
    var may = 0;
    var num = 0;

    for(i=0; i<cadena.length;i++){
        let asciivalue = cadena[i].charCodeAt(0);  
        if(asciivalue > 64 && asciivalue < 91){
            may = 1;
            break;
        }
    }

    for(i=0; i<cadena.length;i++){
        let asciivalue = cadena[i].charCodeAt(0);  
        if(asciivalue > 96 && asciivalue < 123){
            min = 1;
            break;
        }
    }

    for(i=0; i<cadena.length;i++){
        let asciivalue = cadena[i].charCodeAt(0);  
        if(asciivalue > 47 && asciivalue < 58){
            num = 1;
            break;
        }
    }

    if(min == 1 && may == 1 && num == 1){
        bien = false;
    }

    return bien;
}

function asciemail(cadena){
    var bien = true;
    
    for(i=0; i<cadena.length;i++){
        let asciivalue = cadena[i].charCodeAt(0);  
        if((asciivalue > 64 && asciivalue < 91) || (asciivalue > 93 && asciivalue < 127) || (asciivalue > 44 && asciivalue < 58) || asciivalue == 63 || asciivalue == 61 || asciivalue == 42 || asciivalue == 43 || asciivalue == 33 || (asciivalue > 34 && asciivalue < 40)){
            bien = false;
        }
        else{
            bien = true;
            break;
        }
    }

    return bien;
}

function puntos(cadena){
    var bien = false;

    if(cadena[0] == "." || cadena[cadena.length-1] == "."){
        bien = true;
    }
    else{
        var seguido = 0;
        for(i=0;i<cadena.length && seguido != 2;i++){
            if(cadena[i] == "."){
                seguido++;
            }
            else{
                seguido = 0;
            }

            if(seguido == 2){
                bien = true;
            }
        }
    }

    return bien;
}

function largosubdominio(vector){
    var bien = false

    for(i=0;i<vector.length;i++){
        if(vector[i].length > 63){
            bien = true;
            break;
        }
    }

    return bien;
}

function subasci(vector){
    var bien = true;

    for(i=0;i<vector.length;i++){
        for(j=0;j<vector[i].length;j++){
            var palabra = vector[i];
            let asciivalue = palabra[j].charCodeAt(0);  
            if((asciivalue > 64 && asciivalue < 91) || (asciivalue > 96 && asciivalue < 123) || (asciivalue > 47 && asciivalue < 58) || asciivalue == 45 || asciivalue == 95){
                bien = false;
            }
            else{
                bien = true;
                break;
            }
        }
        if(bien == true){
            break;
        }
    }

    return bien;
}

function empiezaguion(vector){
    var bien = true;

    for(i=0;i<vector.length;i++){
        console.log(vector[i]);
        var palabra = vector[i];
        if(palabra[0] == "-" || palabra[palabra.length-1] == "-"){
            bien = true;
            break;
        }
        else{
            bien = false;
        }
    }

    return bien;
}

function load() {
    document.getElementById("login").addEventListener("submit", login);
    document.getElementById("registro").addEventListener("submit", registro);
}

function crearTabla(){
    let tabla = document.createElement('table');
    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');
    var titulo = tabla.createCaption();

    tabla.appendChild(thead);
    tabla.appendChild(tbody);

    document.getElementById('body').appendChild(tabla);
    
    titulo.textContent = "Tabla tarifas álbum";
    //CABEZA TABLA
    for(f=1; f<18; f++){
        let fila = document.createElement('tr');
        if(f==1){
            for(c=1; c<5; c++){
                let columna = document.createElement('th');
                let textCelda = document.createTextNode("");
                if(c==3){
                    textCelda = document.createTextNode("Blanco y Negro");
                    columna.colSpan = 2;
                }
                if(c==4){
                    textCelda = document.createTextNode("Color");
                    columna.colSpan = 2;
                }
                columna.appendChild(textCelda);
                fila.appendChild(columna);
                thead.appendChild(fila);
                
            }
        }
        else{
            if(f==2){
                for(c=1; c<7; c++){
                    let columna = document.createElement('th');
                    let textCelda = document.createTextNode("");
                    if(c==1){
                        textCelda = document.createTextNode("Número de Páginas");
                    }
                    if(c==2){
                        textCelda = document.createTextNode("Número de fotos");
                    }
                    if(c==3||c==5){
                        textCelda = document.createTextNode("150-300 dpi");
                    }
                    if(c==4||c==6){
                        textCelda = document.createTextNode("450-900 dpi");
                    }
                    columna.appendChild(textCelda);
                    fila.appendChild(columna);
                    thead.appendChild(fila);
                }
            }
            else{
                //COSTES DE LA TABLA
                if(f<7){ //PAGINAS DE 1 A 4
                    for(c=1; c<7; c++){
                        let columna = document.createElement('td');
                        let textCelda = document.createTextNode("");
                        if(c==1){
                            var numPags = f-2;
                            textCelda = document.createTextNode(numPags);
                        }
                        if(c==2){
                            var numFotos = numPags*3;
                            textCelda = document.createTextNode(numFotos);
                        }
                        if(c==3){
                            var costeBN = numPags*0.1;
                            coste2decimales = costeBN.toFixed(2);
                            textCelda = document.createTextNode(coste2decimales);
                        }
                        if(c==4){
                            costeBN +=  numFotos*0.02;
                            coste2decimales = costeBN.toFixed(2);
                            textCelda = document.createTextNode(coste2decimales);
                        }
                        if(c==5){
                            var costeC = numPags*0.1;
                            costeC += numFotos*0.05;
                            coste2decimales = costeC.toFixed(2);
                            textCelda = document.createTextNode(coste2decimales);
                        }
                        if(c==6){
                            costeC += numFotos*0.02;
                            coste2decimales = costeC.toFixed(2);
                            textCelda = document.createTextNode(coste2decimales);
                        }
                        columna.appendChild(textCelda);
                        fila.appendChild(columna);
                        tbody.appendChild(fila);
                    }
                } 
                else{
                    if(f<14){// PAGINAS DE 5 A 11
                        for(c=1; c<7; c++){
                            let columna = document.createElement('td');
                            let textCelda = document.createTextNode("");
                            if(c==1){
                                var numPags = f-2;
                                textCelda = document.createTextNode(numPags);
                            }
                            if(c==2){
                                var numFotos = numPags*3;
                                textCelda = document.createTextNode(numFotos);
                            }
                            if(c==3){
                                var costeBN = 4*0.1 + (numPags-4)*0.08;
                                coste2decimales = costeBN.toFixed(2);
                                textCelda = document.createTextNode(coste2decimales);
                            }
                            if(c==4){
                                costeBN +=  numFotos*0.02;
                                coste2decimales = costeBN.toFixed(2);
                                textCelda = document.createTextNode(coste2decimales);
                            }
                            if(c==5){
                                var costeC = 4*0.1 + (numPags-4)*0.08;
                                costeC += numFotos*0.05;
                                coste2decimales = costeC.toFixed(2);
                                textCelda = document.createTextNode(coste2decimales);
                            }
                            if(c==6){
                                costeC += numFotos*0.02;
                                coste2decimales = costeC.toFixed(2);
                                textCelda = document.createTextNode(coste2decimales);
                            }
                            columna.appendChild(textCelda);
                            fila.appendChild(columna);
                            tbody.appendChild(fila);
                        }
                    }
                    else{//PAGINAS DE 12 A 15
                        for(c=1; c<7; c++){
                            let columna = document.createElement('td');
                            let textCelda = document.createTextNode("");
                            if(c==1){
                                var numPags = f-2;
                                textCelda = document.createTextNode(numPags);
                            }
                            if(c==2){
                                var numFotos = numPags*3;
                                textCelda = document.createTextNode(numFotos);
                            }
                            if(c==3){
                                var costeBN = 4*0.1 + 7*0.08 + (numPags-11)*0.07;
                                coste2decimales = costeBN.toFixed(2);
                                textCelda = document.createTextNode(coste2decimales);
                            }
                            if(c==4){
                                costeBN +=  numFotos*0.02;
                                coste2decimales = costeBN.toFixed(2);
                                textCelda = document.createTextNode(coste2decimales);
                            }
                            if(c==5){
                                var costeC = 4*0.1 + 7*0.08 + (numPags-11)*0.07;
                                costeC += numFotos*0.05;
                                coste2decimales = costeC.toFixed(2);
                                textCelda = document.createTextNode(coste2decimales);
                            }
                            if(c==6){
                                costeC += numFotos*0.02;
                                coste2decimales = costeC.toFixed(2);
                                textCelda = document.createTextNode(coste2decimales);
                            }
                            columna.appendChild(textCelda);
                            fila.appendChild(columna);
                            tbody.appendChild(fila);
                        }
                    }
                }
            }
        }
    }
}
    
document.addEventListener("DOMContentLoaded", load, false);