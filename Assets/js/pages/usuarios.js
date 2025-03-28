const frm = document.querySelector('#frmUsuarios');
const btnNuevo = document.querySelector('#btnNuevo');

const modalUsuario = document.querySelector('#modalUsuario');
const myModal = new bootstrap.Modal(modalUsuario);

let tblUsuarios; 

document.addEventListener('DOMContentLoaded', function () {
    // Inicialización de DataTable
    tblUsuarios = $('#tblUsuarios').DataTable({ 
        ajax: {
            url: base_url + 'usuarios/listar',
            dataSrc: ""
        },
        columns: [
           { data: 'acciones' },
           { data: 'id' },
           { data: 'nombre' },
           { data: 'apellido' },
           { data: 'username' },
           { data: 'telefono' },
           { data: 'perfil' },
           { data: 'fecha' },
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json',
        },
        responsive: true
    }); 

    // Al hacer clic en "Nuevo" se muestra el modal para agregar un usuario
    btnNuevo.addEventListener('click', function () {
        // Si existe un campo oculto para id de usuario (por ejemplo, para edición), se limpia
        if (frm.id_usuario) {
            frm.id_usuario.value = '';
        }
        // Reinicia el formulario (corrigiendo el error de "rest" a "reset")
        frm.reset();
        // Asegúrate de que el campo de contraseña no esté en solo lectura
        frm.password.removeAttribute('readonly');
        myModal.show();
    });

    // Envío del formulario para registrar o editar usuario vía AJAX
    frm.addEventListener('submit', function (e) {
        e.preventDefault();
        if (
            frm.nombre.value == '' ||
            frm.apellido.value == '' ||
            frm.username.value == '' ||
            frm.telefono.value == '' ||
            frm.password.value == '' ||
            frm.rol.value == ''
        ) {
            alertaPersonalizada('warning', 'Todos los campos son obligatorios');
        } else {
            const data = new FormData(frm);
            const http = new XMLHttpRequest();
            // Se utiliza base_url para formar la URL completa
            const url = base_url + "usuarios/registrar";
            http.open("POST", url, true);
            http.send(data);
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertaPersonalizada(res.tipo, res.mensaje);
                    if (res.tipo == 'success') {
                        frm.reset();
                        myModal.hide();
                        // Recargar la tabla para ver el nuevo registro
                        tblUsuarios.ajax.reload();
                    }
                }
            };
        }
    });
});

// Función para eliminar un usuario
function eliminar(id) {
    const url = base_url + 'usuarios/delete/' + id;
    console.log('URL generada:', url); // Verifica que la URL sea correcta
    eliminarRegistro(
        'Esta seguro de eliminar',
        'El usuario se eliminara permanentemente',
        'Si, eliminar',
        url,
        tblUsuarios
    );
}

// Función para editar un usuario
function editar(id) {
    const http = new XMLHttpRequest();
    const url = base_url + 'usuarios/editar/' + id;
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            // Si existe un campo oculto para id de usuario, se asigna el valor
            if (frm.id_usuario) {
                frm.id_usuario.value = res.id;
            }
            frm.nombre.value = res.nombre;
            frm.apellido.value = res.apellido;
            frm.username.value = res.username;
            frm.telefono.value = res.telefono;
            // Para edición, se muestra un valor por defecto en la contraseña y se bloquea su modificación
            frm.password.value = '000000000000';
            frm.password.setAttribute('readonly', 'readonly');
            frm.rol.value = res.rol;
            myModal.show();
        }
    };
}
