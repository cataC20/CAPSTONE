// FORMULARIO
const btnNuevo = document.querySelector('#btnNuevo');
const modalRegistro = document.querySelector('#modalRegistro');
const modal = modalRegistro ? new bootstrap.Modal(modalRegistro) : null;

// ARCHIVOS
const btnNuevoArchivo = document.querySelector('#btnNuevoArchivo');
const modalArchivo = document.querySelector('#modalArchivo');
const modal2 = modalArchivo ? new bootstrap.Modal(modalArchivo) : null;
const frmArchivo = document.querySelector('#frmArchivo');
const archivo = document.querySelector('#archivo');

// CARPETAS
const carpetas = document.querySelectorAll('.carpetas');
const btnNuevaCarpeta = document.querySelector('#btnNuevaCarpeta');
const modalCarpeta = document.querySelector('#modalCarpeta');
const modal1 = modalCarpeta ? new bootstrap.Modal(modalCarpeta) : null;
const frmCarpeta = document.querySelector('#frmCarpeta');

// COMPARTIR
const compartir = document.querySelectorAll('.compartir');
const modalCompartir = document.querySelector('#modalCompartir');
const modal3 = modalCompartir ? new bootstrap.Modal(modalCompartir) : null;
const id_carpeta = document.querySelector('#id_carpeta');
const btnSubir = document.querySelector('#btnSubir');
const btnVer = document.querySelector('#btnVer');

const modalUsuario = document.querySelector('#modalUsuario');
const modalUser = modalUsuario ? new bootstrap.Modal(modalUsuario) : null;
const id_archivo = document.querySelector('#id_archivo');

document.addEventListener('DOMContentLoaded', function () {
    if (btnNuevo) {
        btnNuevo.addEventListener('click', function () {
            if (modal) modal.show();
        });
    }

    if (btnNuevaCarpeta) {
        btnNuevaCarpeta.addEventListener('click', function () {
            if (modal) modal.hide();
            if (modal1) modal1.show();
        });
    }

    if (btnNuevoArchivo) {
        btnNuevoArchivo.addEventListener('click', function () {
            if (modal) modal.hide();
            if (modal2) modal2.show();
            if (archivo) archivo.click();
        });
    }

    if (frmCarpeta) {
        frmCarpeta.addEventListener('submit', function (e) {
            e.preventDefault();
            if (frmCarpeta.nombre.value == '') {
                alertaPersonalizada('warning', 'El nombre de la carpeta no puede estar vacío');
            } else {
                const data = new FormData(frmCarpeta);
                const http = new XMLHttpRequest();
                const url = base_url + 'files/crearcarpeta';
                http.open("POST", url, true);
                http.send(data);
                http.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        const res = JSON.parse(this.responseText);
                        alertaPersonalizada(res.tipo, res.mensaje);
                        if (res.tipo == 'success') {
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        }
                    }
                }
            }
        });
    }

    if (archivo) {
        archivo.addEventListener('change', function (e) {
            console.log(e.target.files[0]);
            const data = new FormData(frmArchivo);
            data.append('id_carpeta', id_carpeta.value);
            data.append('archivo', archivo.files[0]);
            const http = new XMLHttpRequest();
            const url = base_url + 'files/subirarchivo';
            http.open("POST", url, true);
            http.send(data);
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(e.target.files[0]);
                    const res = JSON.parse(this.responseText);
                    alertaPersonalizada(res.tipo, res.mensaje);
                    if (res.tipo == 'success') {
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    }
                }
            }
        });
    }

    carpetas.forEach(carpeta => {
        carpeta.addEventListener('click', function (e) {
            if (id_carpeta) {
                id_carpeta.value = e.target.id;
                if (modal3) modal3.show();
            }
        });
    });

    if (btnSubir) {
        btnSubir.addEventListener('click', function () {
            if (modal3) modal3.hide();
            if (archivo) archivo.click();
        });
    }

    if (btnVer) {
        btnVer.addEventListener('click', function () {
            if (id_carpeta) {
                window.location = base_url + 'files/ver/' + id_carpeta.value;
            }
    
        });
    }

    $(".js-example-basic-multiple-limit").select2({
        maximumSelectionLength: 2
    });

    compartir.forEach(enlace => {
        enlace.addEventListener('click', function (e) {
            compartirArchivo(e.target.id);
        });
    });
});

function compartirArchivo(id) {
    if (id_archivo) {
        id_archivo.value = id;
    }
    if (modalUser) modalUser.show();
}
