
function alertaPersonalizada(tipo, mensaje) {
  Swal.fire({
    position: "top-end",
    icon: tipo,
    title: mensaje,
    showConfirmButton: false,
    timer: 1500
  });
}

function eliminarRegistro(title, text, accion, url, table) {
  Swal.fire({
    title: title,
    text: text,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: accion
  }).then((result) => {
    if (result.isConfirmed) {
      const http = new XMLHttpRequest();

     
      http.open("GET", url, true);

      http.send();

      http.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertaPersonalizada(res.tipo, res.mensaje);
          if (res.tipo == 'success') {
            table.ajax.reload();
          }  
        }

      };

    }
  });
}
