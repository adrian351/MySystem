// Mostrar contraseña oculta
function mostrarPassword(input_id, button_id, icono) {
  var pass = document.getElementById(input_id);
  if(pass.type == "password"){
    pass.type = "text";
    $('.'+icono).removeClass('fa fa-eye-slash').addClass('fa fa-eye');
  } else {
    pass.type = "password";
    $('.'+icono).removeClass('fa fa-eye').addClass('fa fa-eye-slash');
  }
}
// Fin (Mostrar contraseña oculta)

// Obtener el nombre del archivo seleccionado de un file
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
// Fin (Obtener el nombre del archivo seleccionado de un file)

// Mostrar archivo seleccionado de un file en un div
function visualizarImagen(archivo, id_visualizar_imagen) {
  document.getElementById(archivo).onchange = function(e) {
    // Creamos el objeto de la clase FileReader
    let reader = new FileReader();
    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
    reader.readAsDataURL(e.target.files[0]);
    // Le decimos que cuando este listo ejecute el código interno
    reader.onload = function(){
      let preview = document.getElementById(id_visualizar_imagen),
          image = document.createElement('img');
          image.width = 250;
          image.height = 150;
      image.src = reader.result;
      preview.innerHTML = '';
      preview.append(image);
    };
  };
}
// Fin (Mostrar archivo seleccionado de un file en un div)

// Alerta antes de editar algún registro
function check(b_id, f_name, tit, tex, typ, b_con, b_can, rev_bot){
  event.preventDefault();
  Swal.fire({
    title: tit,
    text: tex,
    type: typ,
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: b_con,
    cancelButtonText: b_can,
    reverseButtons: rev_bot,
  }).then((result) => {
    if (result.value) {
      checarBotonSubmit(b_id);
      document.getElementById(f_name).submit();
    }
  });
}
function checarBotonSubmit(id_btn) {
  document.getElementById(id_btn).value = "Espere un momento...";
  document.getElementById(id_btn).disabled = true;
  return true;
};
// Fin (Alerta antes de editar algún registro)

// Diseño del scrollbar
$("#div-tabla-scrollbar").overlayScrollbars({
    className       : "os-theme-dark",
    resize          : "both",
    sizeAutoCapable : true,
    paddingAbsolute : true,
    scrollbars : {
      clickScrolling : true
    }
  }).overlayScrollbars();
// Fin (Diseño del scrollbar)

// Diseño del scrollbar
$("#div-tabla-scrollbar2").overlayScrollbars({
  className       : "os-theme-dark",
  resize          : "both",
  sizeAutoCapable : true,
  paddingAbsolute : true,
  scrollbars : {
    clickScrolling : true
  }
}).overlayScrollbars();
// Fin (Diseño del scrollbar)

$("#div-tabla-scrollbar3").overlayScrollbars({
  className       : "os-theme-dark",
  resize          : "both",
  sizeAutoCapable : true,
  paddingAbsolute : true,
  scrollbars : {
    clickScrolling : true
  }
}).overlayScrollbars();

$("#div-tabla-scrollbar4").overlayScrollbars({
  className       : "os-theme-dark",
  resize          : "both",
  sizeAutoCapable : true,
  paddingAbsolute : true,
  scrollbars : {
    clickScrolling : true
  }
}).overlayScrollbars();
// Fin (Diseño del scrollbar)