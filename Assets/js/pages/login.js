const frm = document.querySelector('#formulario');
const username = document.querySelector('#username');
const password = document.querySelector('#password');

document.addEventListener('DOMContentLoaded', function () {
    frm.addEventListener('submit', function (e) {
        e.preventDefault();
        if (username.value === '' && password.value === '') {
            alertaPersonalizada('warning', 'Todos los campos son obligatorios');
        } else {
            const data = new FormData(frm);
            const http = new XMLHttpRequest();

            const url = base_url + 'home/validar';
            // Agregar logs para verificar los datos
            console.log('username:', username.value);
            console.log('password:', password.value);
            
            http.open("POST", url, true);

            http.send(data);

            http.onreadystatechange = function () {

                if (this.readyState == 4 && this.status == 200) {

                    const res = JSON.parse(this.responseText);
                    alertaPersonalizada(res.tipo, res.mensaje);
                    if (res.tipo == 'success') {
                        let timerInterval
                        Swal.fire({
                            title: res.mensaje,
                            html: 'Serás redirigido en <b></b> segundos.',
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.href = base_url + 'admin';
                            }
                        })

                    }
                }

            };

        }
    });
});