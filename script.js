let estudiantes = [
    { nombre: "Maria", apellido: "Mora Perez", nota: 90 },
    { nombre: "Pedro", apellido: "Sibaja Lopez", nota: 60 },
    { nombre: "Marco", apellido: "Rojas Castro", nota: 78 }
];

function mostrarEstudiantes() {
    let tabla = document.getElementById("tablaEstudiantes");
    tabla.innerHTML = "";

    estudiantes.forEach(function(estudiante) {
        let claseNota = "";

        if (estudiante.nota >= 80) {
            claseNota = "notaAlta";
        } else if (estudiante.nota < 65) {
            claseNota = "notaBaja";
        }

        tabla.innerHTML += `
            <tr>
                <td>${estudiante.nombre}</td>
                <td>${estudiante.apellido}</td>
                <td class="${claseNota}">${estudiante.nota}</td>
            </tr>
        `;
    });

    mostrarResumen();
}

function agregarEstudiante() {
    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellido").value;
    let nota = Number(document.getElementById("nota").value);
    let mensaje = document.getElementById("mensaje");

    if (nombre === "" || apellido === "" || document.getElementById("nota").value === "") {
        mensaje.innerHTML = "Todos los campos son obligatorios.";
        return;
    }

    if (nota < 0 || nota > 100) {
        mensaje.innerHTML = "La nota debe estar entre 0 y 100.";
        return;
    }

    estudiantes.push({
        nombre: nombre,
        apellido: apellido,
        nota: nota
    });

    mensaje.innerHTML = "Estudiante agregado correctamente.";

    document.getElementById("nombre").value = "";
    document.getElementById("apellido").value = "";
    document.getElementById("nota").value = "";

    mostrarEstudiantes();
}

function mostrarResumen() {
    let mayor = estudiantes[0];
    let menor = estudiantes[0];
    let suma = 0;

    estudiantes.forEach(function(estudiante) {
        if (estudiante.nota > mayor.nota) {
            mayor = estudiante;
        }

        if (estudiante.nota < menor.nota) {
            menor = estudiante;
        }

        suma = suma + estudiante.nota;
    });

    let promedio = suma / estudiantes.length;

    document.getElementById("resumen").innerHTML =
        "Estudiante con mayor nota: " + mayor.nombre + " " + mayor.apellido + " (" + mayor.nota + ")" + "<br>" +
        "Promedio de notas: " + promedio.toFixed(2) + "<br>" +
        "Nota más baja: " + menor.nombre + " " + menor.apellido + " (" + menor.nota + ")";
}

mostrarEstudiantes();