function disabledButton(control1) {
    control1.disabled = true;
}

function enableButton(control1) {
    control1.disabled = false;
}

function createResponseBlock(item) {
    const bloque0 = document.createElement("div");
    bloque0.classList.add("bloque0");

    const fields = [
        "nom_usu", "tit_pos", "tex_pos", "fec_pos", "can_pos", 
        "ema_usu", "con_usu", 
        "tex_res", "fec_res", "ide_res", "ide_usu", "ide_pos"
    ];

    fields.forEach(field => {
        if (item[field] !== undefined) {
            const div = document.createElement("div");
            div.classList.add("bloque1");
            div.textContent = item[field];
            bloque0.appendChild(div);
        }
    });

    return bloque0;
}

function createResponseBlockWithLink(item, linkKey, baseUrl, urlParam) {
    const bloque0 = document.createElement("div");
    bloque0.classList.add("bloque0");

    const fields = [
        "nom_usu", "tit_pos", "tex_pos", "fec_pos", "can_pos", 
        "ema_usu", "con_usu", 
        "tex_res", "fec_res", "ide_res", "ide_usu", "ide_pos" 
    ];

    fields.forEach(field => {
        if (item[field] !== undefined) {
            const div = document.createElement("div");
            div.classList.add("bloque1");

            if (field === linkKey) {
                const link = document.createElement("a");
                link.href = `${baseUrl}?${urlParam}=${item[field]}`;
                link.textContent = item[field];
                link.classList.add("enlaceRespuesta");
                div.appendChild(link);
            } else {
                div.textContent = item[field];
            }

            bloque0.appendChild(div);
        }
    });

    return bloque0;
}

async function makeFetchFormRequest(method, url, form) {
    const formData1 = new FormData(form);

    try {
        console.log("FORMULARIO: ", form);
        console.log("method: " + method);
        console.log("URL: " + url);

        const response = await fetch(url, {
            method: method,
            body: formData1,
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }

        return await response.json();
    } catch (error) {
        throw new Error(`Captura del error: ${error.message}`);
    }
}

async function fetchMainConsulta() {
    const controllerUrl = "Controllers/mainConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    try {
        const response = await fetch(controllerUrl, {
            method: 'GET',
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlockWithLink(
                {
                    nom_usu: "Autor",
                    tit_pos: "Título",
                    fec_pos: "Fecha",
                    can_pos: "Respuestas",
                    ide_pos: "IR"
                }
            );
            header.classList.add("negrita");
            divResponse.appendChild(header);
            dataConsulta.forEach(item => {
                console.log("Item completo:", item);
            
                const row = createResponseBlockWithLink(
                    item,
                    'ide_pos',
                    'respuestas.php',
                    'ide_pos'
                );
                divResponse.appendChild(row);
                row.dataset.ide_pos = item.ide_pos;
            
                const eliminarBtn = document.createElement('button');
                eliminarBtn.textContent = 'X';
                eliminarBtn.classList.add('eliminar-btn');
                eliminarBtn.style.display = 'flex';
                
                eliminarBtn.addEventListener('click', function() {
                    eliminarFilaPost(item.ide_pos);
                });
            
                const modificarBtn = document.createElement('button');
                modificarBtn.innerHTML = '✏️';
                modificarBtn.classList.add('modificar-btn');
                modificarBtn.style.display = 'flex';

                modificarBtn.addEventListener('click', function() {
                    editarPost(item.ide_pos, item.tit_pos, item.tex_pos);
                });
            
                row.insertBefore(modificarBtn, row.firstChild);
                row.insertBefore(eliminarBtn, row.firstChild);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

function editarPost(ide_pos, tit_pos, tex_pos) {
    const nuevoTitulo = prompt("Edita el título:", tit_pos);
    const nuevoTexto = prompt("Edita el contenido:", tex_pos);

    if (nuevoTitulo !== null && nuevoTexto !== null) {
        fetch("Controllers/editarPostController.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `ide_pos=${ide_pos}&tit_pos=${encodeURIComponent(nuevoTitulo)}&tex_pos=${encodeURIComponent(nuevoTexto)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert("Post actualizado correctamente.");
                location.reload();
            } else {
                alert("Error al actualizar: " + data.message);
            }
        })
        .catch(error => console.error("Error en la actualización:", error));
    }
}

async function eliminarFilaPost(ide_pos) {
    alert("Eliminando el post con ide_pos:"+ ide_pos);

    const controllerUrl = "Controllers/eliminarPostController.php";

    try {
        const response = await fetch(controllerUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ ide_pos: ide_pos }),
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }

        const data = await response.json();
        console.log("Respuesta del servidor:", data);

        if (data.status === "success") {
            alert(data.message);
            fetchMainConsulta();
        } else {
            alert(data.message);
        }
    } catch (error) {
        console.error("Error al eliminar el post:", error.message);
        alert('No se pudo eliminar el post.');
    }
}
async function fetchRespuestasConsulta() {
    const controllerUrl = "Controllers/respuestasConsulta1Controller.php";
    const divResponse = document.getElementById("contenedor2");

    const idNumInvInput = document.getElementById("ide_pos");
    const idNumInvValue = idNumInvInput ? idNumInvInput.value : 0;

    try {
        const response = await fetch(`${controllerUrl}?ide_pos=${encodeURIComponent(idNumInvValue)}`, {
            method: 'GET',
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                nom_usu: "Autor",
                tex_res: "Descripcion",
                fec_res: "Fecha respuesta",
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}
async function fetchPostRespuestasConsulta() {
    const controllerUrl = "Controllers/respuestasConsulta2Controller.php";
    const divResponse = document.getElementById("contenedorPostRespuesta");

    const idNumInvInput = document.getElementById("ide_pos");
    const idNumInvValue = idNumInvInput ? idNumInvInput.value : 0;

    try {
        const response = await fetch(`${controllerUrl}?ide_pos=${encodeURIComponent(idNumInvValue)}`, {
            method: 'GET',
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }
        const dataConsulta = await response.json();
        divResponse.innerHTML = '';

        if (dataConsulta.length > 0) {
            const header = createResponseBlock({
                nom_usu: "Autor del Post",
                tit_pos: "Titulo",
                tex_pos: "Descripcion",
            });
            header.classList.add("negrita");
            divResponse.appendChild(header);

            dataConsulta.forEach(item => {
                const row = createResponseBlock(item);
                divResponse.appendChild(row);
            });
        } else {
            divResponse.textContent = 'No hay datos disponibles.';
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error.message);
        divResponse.textContent = 'No se pudieron cargar los datos.';
    }
}

async function eliminarFilaEscandallo(ide_pos) {
    alert("Intentando eliminar el post con ide_pos:", ide_pos);
    const controllerUrl = "Controllers/eliminarPostController.php";
    const divResponse = document.getElementById("contenedor2");

    try {
        const response = await fetch(controllerUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ ide_pos: ide_pos }),
        });

        if (!response.ok) {
            throw new Error(`Error de red: ${response.statusText}`);
        }

        const data = await response.json();
        console.log("Respuesta del servidor:", data);

        if (data.status === "success") {
            alert(data.message);
            fetchMainConsulta();
        } else {
            alert(data.message);
        }
    } catch (error) {
        console.error("Error al eliminar el post:", error.message);
        alert('No se pudo eliminar el post.');
    }
}

document.addEventListener("DOMContentLoaded", function() {
    // Inserción de Usuario (REGISTRO)
    const formUsuario = document.getElementById("formularioUsuario");
    if (formUsuario) {
        const buttonUsuario = document.getElementById("botonAñadirUsuario");
        const controllerUsuario = "Controllers/registroInsercion1Controller.php";
        const divResponse = document.getElementById("divRespuesta");

        formUsuario.addEventListener("submit", function(event) {
            event.preventDefault();
            buttonUsuario.disabled = true;

            if (!validateFormUsuario()) {
                buttonUsuario.disabled = false;
                return;
            }

            makeFetchFormRequest('POST', controllerUsuario, formUsuario)
                .then(response => {
                    divResponse.textContent = response.status === "success" ? "Usuario: " + response.message : "Usuario: " + (response.message || 'Error desconocido.');
                    if (response.status === "success") formUsuario.reset();
                })
                .catch(error => {
                    console.error("Error en la inserción del Usuario:", error.message);
                    divResponse.textContent = 'Usuario: No se pudo realizar la inserción.';
                })
                .finally(() => {
                    buttonUsuario.disabled = false;
                });
        });
    }

    // Inserción de NUEVO POST (tema)
    const formPost = document.getElementById("formularioPost");
    if (formPost) {
        const buttonPost = document.getElementById("botonAñadirPost");
        const controllerPost = "Controllers/postInsercion1Controller.php";
        const divResponse = document.getElementById("divRespuesta");

        formPost.addEventListener("submit", function(event) {
            event.preventDefault();
            buttonPost.disabled = true;

            makeFetchFormRequest('POST', controllerPost, formPost)
                .then(response => {
                    divResponse.textContent = response.status === "success" ? "Post: " + response.message : "Post: " + (response.message || 'Error desconocido.');
                    if (response.status === "success") formPost.reset();
                })
                .catch(error => {
                    console.error("Error en la inserción del Post:", error.message);
                    divResponse.textContent = 'Post: No se pudo realizar la inserción.';
                })
                .finally(() => {
                    buttonPost.disabled = false;
                });
        });
    }

    // Inserción de NUEVO RESPUESTA (tema)
    const formRespuesta = document.getElementById("formularioRespuesta");
    if (formRespuesta) {
        const buttonRespuesta = document.getElementById("botonAñadirRespuesta");
        const controllerRespuesta = "Controllers/respuestasInsercion1Controller.php";
        const divResponse = document.getElementById("divRespuesta");

        formRespuesta.addEventListener("submit", function(event) {
            event.preventDefault();
            buttonRespuesta.disabled = true;

            makeFetchFormRequest('POST', controllerRespuesta, formRespuesta)
                .then(response => {
                    divResponse.textContent = response.status === "success" ? "Respuesta: " + response.message : "Respuesta: " + (response.message || 'Error desconocido.');
                    if (response.status === "success") formRespuesta.reset();
                })
                .catch(error => {
                    console.error("Error en la inserción del Respuesta:", error.message);
                    divResponse.textContent = 'Respuesta: No se pudo realizar la inserción.';
                })
                .finally(() => {
                    buttonRespuesta.disabled = false;
                    fetchRespuestasConsulta();
                    fetchPostRespuestasConsulta();
                });
        });
    }

    if (window.location.href.includes("main.php")) {
        fetchMainConsulta();
    }

    if (window.location.href.includes("respuestas.php")) {
        fetchRespuestasConsulta();
        fetchPostRespuestasConsulta();
    }
});

document.getElementById('formularioUsuario').addEventListener('submit', function(event) {
    if (!validateFormUsuario()) {
        event.preventDefault();
    }
});

function validateFormUsuario() {
    let isValid = true;

    // Validación del nombre de usuario
    const username = document.getElementById('nom_usu');
    const usernameError = document.getElementById('nom_usuError');
    if (username && usernameError) {
        const usernameValue = username.value;
        const usernameRegex = /^[A-Za-z0-9!@#$%^&*(),.?":{}|<>]{5,20}$/;

        if (!usernameRegex.test(usernameValue) || /^\d/.test(usernameValue)) {
            usernameError.textContent = 'El nombre de usuario debe tener entre 5 y 20 caracteres y no comenzar con un número.';
            usernameError.classList.add('error');
            username.style.borderColor = 'red';
            isValid = false;
        } else {
            usernameError.textContent = '';
            usernameError.classList.remove('error');
            username.style.borderColor = '';
        }
    }

    // Validación del correo electrónico
    const email = document.getElementById('ema_usu');
    const emailError = document.getElementById('ema_usuError');
    if (email && emailError) {
        const emailValue = email.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(emailValue)) {
            emailError.textContent = 'Por favor, introduzca un email válido.';
            emailError.classList.add('error');
            email.style.borderColor = 'red';
            isValid = false;
        } else {
            emailError.textContent = '';
            emailError.classList.remove('error');
            email.style.borderColor = '';
        }
    }

    // Validación de la contraseña
    const password = document.getElementById('con_usu');
    const passwordError = document.getElementById('con_usuError');
    if (password && passwordError) {
        const passwordValue = password.value;
        const passwordRegex = /^(?=.*\d)[A-Za-z\d]{5,20}$/;

        if (!passwordRegex.test(passwordValue)) {
            passwordError.textContent = 'La contraseña debe tener entre 5 y 20 caracteres y contener al menos un número.';
            passwordError.classList.add('error');
            password.style.borderColor = 'red';
            isValid = false;
        } else {
            passwordError.textContent = '';
            passwordError.classList.remove('error');
            password.style.borderColor = '';
        }
    }

    return isValid;
}