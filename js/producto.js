function cargarDatos() {
  cargarProducto();
  cargarProducto_carrito();
  cargar_carrito_venta();
  cargarVenta();
}

/* jQUERY  */
$(document).ready(function() {
  /* lEVANTAR LAS FUNCIONES PARA MOSTRAR LOS DATOS  */
  cargarDatos();
  loadnotifcart();
  $("#li_producto").addClass("active");
  $("#li_venta").removeClass("active");

  //SUBMIT PARA GUARDAR LA INFORMACIÓN DEL MODAL DE REGISTRO DEL PRODUCTO
  $("#form_producto").submit(function(e) {
    e.preventDefault();
    var errores = "";
    /* VALIDACIÓN DE LOS DATOS REQUERIDOS EN EL FORMULARIO  */
    if ($("#pro_nombre").val() == "") {
      errores += "<li> Nombre Producto es obligatorio</li>";
      $("#pro_nombre").focus();
    }
    if ($("#pro_cantidad").val() == "") {
      errores += "<li> Cantidad es obligatoria</li>";
      $("#pro_nombre").focus();
    }

    if ($("#pro_descripcion").val() == "") {
      errores += "<li> Descripción es obligatoria</li>";
      $("#pro_nombre").focus();
    }

    //MOSTRANDO MENSAJE SI ESTAN VACIOS LOS CAMPOS
    if (errores != "") {
      $("#add-brand-messages").html(
        '<div class="alert alert-danger">' +
          '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
          "<h3>&nbsp;&nbsp;&nbsp;&nbsp;¡Aviso!</h3><ul>" +
          errores +
          "</ul></div>"
      );
      //OCULTA EL ALERT
      window.setTimeout(function() {
        $(".alert-danger")
          .fadeTo(500, 0)
          .slideUp(500, function() {
            $(this).remove();
          });
      }, 4000); // /.alert

      errores = "";
      return;
    } else {
      //PARAMETROS DE LOS FORMULARIOS
      var parametros = $(this).serialize();

      $("#btnguardar_pro").button("loading");
      $(":submit").attr("disabled", true);
      //AJAX
      $.ajax({
        type: "POST",
        url: "./controller/ProductoController.php?parametro=guardar",
        data: parametros,
        beforeSend: function(objeto) {
          //MENSAJE MIESTRAS CARGA
          $("#add-brand-messages").html(
            '<img src="librerias/loading.gif"> Cargando...'
          );
        },
        success: function(datos) {
          //LIMPIAR DATOS
          $("#form_producto")[0].reset();
          $("#pro_nombre").focus();
          if (datos == "registrado") {
            //MENSAJE DE GUARDADO
            cargarDatos();
            $("#add-brand-messages").html(
              '<div class="alert alert-success text-center">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong><i class="fa fa-check-square"></i></strong> Datos Almacenados Correctamente</div>'
            );

            window.setTimeout(function() {
              $(".alert-success")
                .fadeTo(500, 0)
                .slideUp(500, function() {
                  $(this).remove();
                });
            }, 4000); // /.alert
          } else {
            alert("Error al almacenar los datos");
          }
          $("#btnguardar_pro").button("reset");
          $(":submit").attr("disabled", false);
        }
      });
    }
  });

  //SUBMIT PARA ACTUALIZAR LA INFORMACIÓN DEL MODAL DE REGISTRO DEL PRODUCTO
  $("#form_producto_edit").submit(function(e) {
    e.preventDefault();
    var errores = "";
    /* VALIDACIÓN DE LOS DATOS REQUERIDOS EN EL FORMULARIO  */
    if ($("#pro_nombre_edit").val() == "") {
      errores += "<li> Nombre Producto es obligatorio</li>";
      $("#pro_nombre_edit").focus();
    }
    if ($("#pro_cantidad_edit").val() == "") {
      errores += "<li> Cantidad es obligatoria</li>";
      $("#pro_nombre_edit").focus();
    }

    if ($("#pro_descripcion_edit").val() == "") {
      errores += "<li> Descripción es obligatoria</li>";
      $("#pro_nombre_edit").focus();
    }

    //MOSTRANDO MENSAJE SI ESTAN VACIOS LOS CAMPOS
    if (errores != "") {
      $("#add-brand-messages_edit").html(
        '<div class="alert alert-danger">' +
          '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
          "<h3>&nbsp;&nbsp;&nbsp;&nbsp;¡Aviso!</h3><ul>" +
          errores +
          "</ul></div>"
      );
      //OCULTA EL ALERT
      window.setTimeout(function() {
        $(".alert-danger")
          .fadeTo(500, 0)
          .slideUp(500, function() {
            $(this).remove();
          });
      }, 4000); // /.alert

      errores = "";
      return;
    } else {
      //PARAMETROS DE LOS FORMULARIOS
      var parametros = $(this).serialize();

      $("#btneditar_pro").button("loading");
      $(":submit").attr("disabled", true);
      //AJAX
      $.ajax({
        type: "POST",
        url: "./controller/ProductoController.php?parametro=editar",
        data: parametros,
        beforeSend: function(objeto) {
          //MENSAJE MIESTRAS CARGA
          $("#add-brand-messages_edit").html(
            '<img src="librerias/loading.gif"> Cargando...'
          );
        },
        success: function(datos) {
          //LIMPIAR DATOS
          //$("#form_producto_edit")[0].reset();
          $("#pro_nombre_edit").focus();
          if (datos == "actualizado") {
            //MENSAJE DE GUARDADO
            cargarDatos();
            $("#add-brand-messages_edit").html(
              '<div class="alert alert-success text-center">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong><i class="fa fa-check-square"></i></strong> Datos Actualizados Correctamente</div>'
            );

            window.setTimeout(function() {
              $(".alert-success")
                .fadeTo(500, 0)
                .slideUp(500, function() {
                  $(this).remove();
                });
            }, 4000); // /.alert
          } else {
            alert("Error al almacenar los datos" + datos);
          }
          $("#btneditar_pro").button("reset");
          $(":submit").attr("disabled", false);
        }
      });
    }
  });

  //Función para importar el archivo CSV
    $("#form_producto_import").submit(function(e) {
      e.preventDefault();
    var fileType = ".csv";
    var regex = new RegExp("([a-zA-Z0-9s_\\.-:])+(" + fileType + ")$");
    if (
      !regex.test(
        $("#archivocsv")
          .val()
          .toLowerCase()
      )
    ) {
      alert("El tipo de archivo es inválido");
      return false;
    }
    $.ajax({
      url: "./controller/VentaController.php?parametro=import",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function(data) {
        $("#form_producto_import")[0].reset();
        cargarDatos();
        $("#add-brand-messages_import").html(
          '<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong><i class="fa fa-file-excel-o"></i></strong> Datos en archivo <strong>CSV</strong> insertados correctamente</div>'
        );

        window.setTimeout(function() {
          $(".alert-success")
            .fadeTo(500, 0)
            .slideUp(500, function() {
              $(this).remove();
            });
        }, 4000); // /.alert
      }
    });
  });

});

//FUNCIÓN PARA ELMINAR EL PRODUCTO MEDIANTE AJAX

function eliminar_producto(id) {
  if (confirm("Estimado Usuario.\n¿Realmente desea eliminar este Producto?")) {
    $.ajax({
      type: "GET",
      url:
        "./controller/ProductoController.php?parametro=eliminar&id_producto=" +
        id,
      beforeSend: function(objeto) {
        $("#mensaje").html(
          '<div class="alert alert-warning">' +
            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong><i class="fa fa-warning"></i></strong> Espere...</div>'
        );
      },
      success: function(datos) {
        if (datos == "eliminado") {
          cargarDatos();
          $("#mensaje").html(
            '<div class="alert alert-danger">' +
              '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
              '<strong><i class="fa fa-trash"></i></strong> Datos eliminados</div>'
          );

          window.setTimeout(function() {
            $(".alert-danger")
              .fadeTo(500, 0)
              .slideUp(500, function() {
                $(this).remove();
              });
          }, 4000); // /.alert
        } else {
          alert("Error al eliminar los datos");
        }
      }
    });
  } else {
    return false;
  }
}

//FUNCION PARA ENVIAR LOS VALORES AL FORMULARIO DEL MODAL
function editar_producto(id) {
  var _nombre = $("#pro_nombre_" + id).val();
  var _descripcion = $("#pro_descripcion_" + id).val();
  var _cantidad = $("#pro_cantidad_" + id).val();

  $("#pro_nombre_edit").val(_nombre);
  $("#pro_descripcion_edit").val(_descripcion);
  $("#pro_cantidad_edit").val(_cantidad);
  $("#id_edit").val(id);
}
//FUNCION PARA CARGAR LOS PRODUCTOS MEDIANTE AJAX
function cargarProducto() {
  $("#loader").fadeIn("slow");

  $.ajax({
    type: "GET",
    url: "./controller/ProductoController.php?parametro=mostrar",
    beforeSend: function(objeto) {
      $("#loader").html('<img src="librerias/loading.gif"> Cargando...');
    },
    success: function(data) {
      $(".vertabla")
        .html(data)
        .fadeIn("slow");
      $("#loader").html("");
    }
  });
}

//CARGAR LOS PRODUCTOS EN EL MODAL DE FACTRA
function cargarProducto_carrito() {
  $("#loader_").fadeIn("slow");

  $.ajax({
    type: "GET",
    url: "./controller/ProductoController.php?parametro=add",
    beforeSend: function(objeto) {
      $("#loader_").html('<img src="librerias/loading.gif"> Cargando...');
    },
    success: function(data) {
      $(".vertabla_")
        .html(data)
        .fadeIn("slow");

      $("#loader_").html("");
    }
  });
}

//REDONDEAR CANTIDAD PARA QUE SEA ENTERA
function roundNumber(num, dec) {
  var result = Math.round(num.value);
  if (result <= 0) {
    result = 1;
  }
  num.value = result;
}
//REDONDEAR CANTIDAD PARA QUE SEA ENTERA
function validarDecimal(num) {
  var result = parseFloat(num.value);
  if (result < 0.0) {
    result = 0.0;
    alert("No ingrese números negativos");
    num.value = result;
  }
}

function cargar_carrito_venta() {
  $("#loaderr").fadeIn("slow");

  $.ajax({
    type: "GET",
    url: "./controller/ProductoController.php?parametro=detalle",
    beforeSend: function(objeto) {
      $("#loaderr").html('<img src="librerias/loading.gif"> Cargando...');
    },
    success: function(data) {
      $(".vertablar")
        .html(data)
        .fadeIn("slow");
      $("#loaderr").html("");
    }
  });
}

function addVenta(id_p) {
  var cantidad = parseInt(document.getElementById("_cantidad" + id_p).value);
  var precio = parseFloat(document.getElementById("_precio" + id_p).value);
  var qty = parseInt(document.getElementById("_qty" + id_p).value);
  if (qty > 0 && precio > 0.0) {
    if (qty > cantidad) {
      $("#mensaje_").html(
        '<div class="alert alert-info">' +
          '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
          '<strong><i class="fa fa-warning"></i></strong> Cantidad a vender supera la de inventario</div>'
      );
    } else {
      $.ajax({
        type: "GET",
        url:
          "./controller/CartController.php?parametro=session&id_p=" +
          id_p +
          "&qty=" +
          qty +
          "&precio=" +
          precio +
          "&cantidad=" +
          cantidad,
        beforeSend: function(objeto) {
          $("#mensaje_").html(
            '<div class="alert alert-warning">' +
              '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
              '<strong><i class="fa fa-warning"></i></strong> Hubo un percance</div>'
          );
        },
        success: function(datos) {
          if (datos == "supera") {
            alert(
              "Alerta:\n La cantidad que deseas agregar supera la de inventario\n Ingresa una cantidad Válida"
            );
          } else {
            $("#_precio" + id_p).attr("readonly", "readonly");
            $("#mensaje_").html(
              '<div class="alert alert-success">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong><i class="fa fa-shopping-cart"></i></strong> Datos agregados a su lista</div>'
            );
          }
          loadnotifcart();
          cargar_carrito_venta();
          window.setTimeout(function() {
            $(".alert-success")
              .fadeTo(500, 0)
              .slideUp(500, function() {
                $(this).remove();
              });
          }, 4000); // /.alert
        }
      });
    }
  } else {
    alert("Complete los campos\n Son obligatorios precio y cantidad");
  }
}

function eliminar_producto_session(id) {
  if (
    confirm(
      "Estimado Usuario.\n¿Realmente desea eliminar este producto del listado?\n ------------------------------------------------------------------------"
    )
  ) {
    $.ajax({
      type: "GET",
      url: "./controller/CartController.php?parametro=deletesession&id_=" + id,
      beforeSend: function(objeto) {
        $("#mensaje_").html(
          '<div class="alert alert-warning">' +
            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong><i class="fa fa-warning"></i></strong> Espere...</div>'
        );
      },
      success: function(datos) {
        $("#mensaje_").html(
          '<div class="alert alert-danger">' +
            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong><i class="fa fa-shopping-cart"></i></strong> Datos Eliminados</div>'
        );
        cargar_carrito_venta();
        loadnotifcart();
      }
    });
  } else {
    return false;
  }
}
//verificar la cantidad de registros en el detalle
setInterval(function() {
  loadnotifcart();
}, 2000);
function loadnotifcart() {
  $.ajax({
    type: "GET",
    url: "./controller/CartController.php?parametro=notificar",
    success: function(data) {
      // alert(data);
      $(".cartvalue").html(data);
    }
  });
}

$(function() {
  var ENV_WEBROOT = "../";

  //Funcion para guardar la venta
  $(".guardar-carrito").off("click");
  $(".guardar-carrito").on("click", function(e) {
    e.preventDefault();
    var to = $("#recorrer_t").val();
    if (to > 0) {
      var cliente = $("#cli_nombre").val();
      var responsable = $("#responsable").val();
      var fecha = $("#fecha").val();

      var errores = "";
      if (cliente == "") {
        errores += "<li><strong> Nombre Cliente</strong> requerido</li>";
        $("#cli_nombre").focus();
      }

      if (responsable == "") {
        errores +=
          "<li><strong>Nombre de Responsable Venta</strong> requerido</li>";
      }

      if (fecha == "") {
        errores += "<li><strong> Fecha</strong> requerida</li>";
        $("#cli_nombre").focus();
      }

      if (errores != "") {
        $("#mensaje_").html(
          '<div class="alert alert-danger">' +
            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
            "<h3>&nbsp;&nbsp;&nbsp;&nbsp;¡Aviso!</h3><ul>" +
            errores +
            "</ul></div>"
        );
        //OCULTA EL ALERT
        window.setTimeout(function() {
          $(".alert-danger")
            .fadeTo(500, 0)
            .slideUp(500, function() {
              $(this).remove();
            });
        }, 4000); // /.alert

        errores = "";
        return;
      } else {
        //Guardar la compra en base de datos
        $.ajax({
          type: "GET",
          url:
            "./controller/VentaController.php?parametro=cart_save&cliente=" +
            cliente +
            "&responsable=" +
            responsable +
            "&fecha=" +
            fecha,
          beforeSend: function(objeto) {
            $("#mensaje_").html(
              '<div class="alert alert-warning">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong><i class="fa fa-shopping-cart"></i></strong> Espere...</div>'
            );
          },
          success: function(datos) {
            if (datos == "add") {
              $("#mensaje_").html(
                '<div class="alert alert-success">' +
                  '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                  '<strong><i class="fa fa-shopping-cart"></i></strong> Venta Registrada...</div>'
              );
              loadnotifcart();
              cargarDatos();
              $("#cli_nombre").val("");
              $("#responsable").val("");
              $("#fecha").val("");

              window.setTimeout(function() {
                $(".alert-success")
                  .fadeTo(500, 0)
                  .slideUp(500, function() {
                    $(this).remove();
                  });
              }, 4000); // /.alert
            } else {
              alert("Error al guardar venta");
            }
          }
        });
      }
    } else {
      alert("¡No hay Productos Agreados!");
    }
  });
});

function cargarVenta() {
  //Funcion para cargar las ventas
  $("#loaderv").fadeIn("slow");

  $.ajax({
    type: "GET",
    url: "./controller/VentaController.php?parametro=lista",
    beforeSend: function(objeto) {
      $("#loaderv").html('<img src="librerias/loading.gif"> Cargando...');
    },
    success: function(data) {
      $(".vertablav")
        .html(data)
        .fadeIn("slow");
      $("#loaderv").html("");
    }
  });
}

//FUNCION PARA ADMITIR SOLO LETRAS EN EL INPUT
function soloLetras(e) {
  tecla = document.all ? e.keyCode : e.which;
  if (tecla == 8) return true; // backspace
  if (tecla == 32) return true; // espacio
  if (e.ctrlKey && tecla == 86) {
    return true;
  } //Ctrl v
  if (e.ctrlKey && tecla == 67) {
    return true;
  } //Ctrl c
  if (e.ctrlKey && tecla == 88) {
    return true;
  } //Ctrl x
  if (tecla >= 96 && tecla <= 105) {
    return true;
  } //numpad

  patron = /^[a-zA-z\s\Ã±\Ã‘\Ã\Ã‰\Ã\Ã“\Ãš\Ã¡\Ã©\Ã­\Ã³\Ãº]+$/; //patron

  te = String.fromCharCode(tecla);
  return patron.test(te); // prueba de patron
}
