/**
 * Resize function without multiple trigger
 *
 * Usage:
 * $(window).smartresize(function(){
 *     // code here
 * });
 */
 $("#foto").fileinput({
   'language': "es",
   'showRemove':false,
   'showUpload':false,
   'previewFileType':'any',
   'showCaption': false,
   resizeImage: true,
   maxImageWidth: 200,
   maxImageHeight: 200,
   minImageWidth: 50,
   minImageHeight: 50,
   resizePreference: 'width',
   //defaultPreviewContent: '<img src="http://localhost/php/adminphone2/views/layout/admin/images/avatar.png" alt="Tu Avatar" style="width:100%;height:100%">',

 });
function init_checkAll() {

  $("#checkAll").change(function () {
      $(":checkbox.checkItem").prop('checked', $(this).prop("checked"));
  });

}

///////////////////////////colores para el te/////////////////////////////////////////77

/////////////////export////////////////////////////

  $("#expt-pdf-checkbox").on('click',function(event){
    event.stopPropagation();
    //alert();
    var href =  $(this).data("href");
    var id = [];
    $(':checkbox:checked').each(function(i){

      id[i] = $(this).val();
      //alert(id);

    });

    if(id.length === 0)
    {
      $('#modal-dialog-invalid').dialog('open')
      .html('Debe seleccionar al menos un registro');
        //alert('Debe seleccionar al menos un registro');


    }
    else{
          window.location=href+id;
          $("input:checkbox").prop('checked', false);

    }


  });
  /*******************exportar toda la data***************************************/
  $('#export-pdf-all').on('click',function(){

    //alert();
      var href =  $(this).data("href");
      window.location=href;
  });

  /**********************************************************/
  /*******************exportar toda la data a pdf***************************************/
  $('#export-excel-all').on('click',function(){

    //alert();
      var href =  $(this).data("href");
      window.location=href;
  });

  /**********************************************************/
////////////////////////////////////////////////////////
$("#delete-multiple").on('click',function(event){
                          event.stopPropagation();
                          //alert();
                          var row_id = [];
                          $(':checkbox:checked').each(function(i){

                            row_id[i] = $(this).val();

                          });

                          if(row_id.length === 0)
                          {

                              //alert('Debe seleccionar al menos un registro');
                              $('#modal-dialog-invalid').dialog('open')
                              .html('Debe seleccionar al menos un registro');


                          }
                          else{
                            alert(' un registro');
                          }


                        });



/////////////////////////////////////////////////////////////////
/////////////////export excel////////////////////////////

                       $("#export-exel-checkbox").on('click',function(event){

                         var href =  $(this).data("href");

                         var id = [];
                         $(':checkbox:checked').each(function(i){

                           id[i] = $(this).val();

                         });

                         if(id.length === 0)
                         {
                           //alert('0');
                          $('#modal-dialog-invalid').dialog('open')
                           .html('Debe seleccionar al menos un registro');

                         }
                         else{
                           $("input:checkbox").prop('checked', false);
                           window.location=href+id;

                         }


                       });

                       /////////////////end export excel////////////////////////////
///////////////venta modal para mensaje de advertencia//////////////////////
$('#modal-dialog-invalid').dialog({
                        title:'Mensaje',
                        autoOpen: false,
                        modal: true,
                        width: 400,
                        resizable:false,
                        buttons: {


                          "Cerrar": function (event) {
                            $(this).dialog("close");
                            event.stopImmediatePropagation();
                          }

                        },
                        show:{
                          effect:"explode",
                          duration:900,
                        },
                        hide:{
                          effect:"explode",
                          duration:900,
                        }
                      });
/////////////////////////////////////////////////////////////////////
    $('.delete').click(function(ev) {
            var href =  $(this).data("href");
            //alert(href);
            $("#eliminar-registro").attr('href', href);
            $("#eliminar-registro").on('click',function(){
            //alert(href);
            window.location= href;

       })


        });










//////////////////////////////////////////////////////////////////

 $('#loginModal').on('shown.bs.modal', function() {
    $('#loginForm').bootstrapValidator('resetForm', true);

 });

 //ocultar los mensaje de error
 setTimeout(function() {
        $(".alert-danger").alert('close');
    }, 6000);

    setTimeout(function() {
           $(".alert-success").alert('close');
       }, 6000);

       setTimeout(function() {
              $(".alert-info").alert('close');
          }, 6000);





//////////////////////
        function init_Validator() {


            //validar los campos del formulario
             $('#FormEditUser').bootstrapValidator({
               resetForm: true,
               message: 'Este valor no es valido',
              feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
              },

              fields: {
                nombre: {
                validators: {
                  notEmpty: {message: 'El nombre es requerido'},
                  stringLength: {
                    min: 3,
                    max: 13,
                    message: 'El nombre  debe tener entre 3 y 12 caracteres de logitud'
                  },
                  regexp: {
                      regexp: /^[a-zñáéíóúA-ZÑÁÉÍÓÚ]+$/,
                      message: 'no es permitido caracteres numéricos ni espacios en blanco'
                  }


                     }
                   },
                correo: {
                validators: {
                  notEmpty: {
                                message: 'El correo es requerido'
                            },
                            emailAddress: {
                                message: 'El formato de correo no es valido'
                            }
                     }
                   },
              pass: {
                validators: {
                notEmpty: { message: 'La contraseña es requerida'},
                /*stringLength: {
                  min: 8,
                  max: 10,
                  message: 'La clave de usuario debe tener entre 8 y 10 caracteres de logitud'
                },*/
                regexp: {
                    regexp: /^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i,
                    message: 'La clave de usuario debe tener Entre 8 y 10 caracteres, por lo menos un digito y un alfanumérico, y no puede contener caracteres espaciales'
                }
              },

              },
              usuario:{
                validators: {
                notEmpty: { message: 'El nombre de usuario es requerido'},
                stringLength: {
                  min: 6,
                  max: 10,
                  message: 'El nombre de usuario debe tener entre 6 y 10 caracteres de logitud'
                },
                regexp: {
                    regexp: /^[a-z0-9ñáéíóúA-ZÑÁÉÍÓÚ_]+$/,
                    message: 'El nombre de usuario sólo puede consistir en alfabético, número y guion bajo'
                }
              },

              },
              role: {
                  validators: {
                      notEmpty: {
                          message: 'Dede seleccionar un rol'
                      }
                  }
              },
              estado: {
                  validators: {
                      notEmpty: {
                          message: 'Dede seleccionar un estado'
                      }
                  }
              },
              foto: {
                            validators: {
                                file: {
                                  extension: 'jpg,jpeg,png',
                                  type: 'image/jpeg,image/jpg,image/png',
                                    maxSize:  10*1024*1024,
                                    message: 'el archivos no es correcto.solo imagenes con formato jpg,jpeg o png'
                                }
                            }
                        }
              /*confirm_password: {
                validators: {
                notEmpty: { message: 'confirme La contraseña '},
                identical: {
                                        field: 'password',
                                        message: 'La contraseña y su confirmación deben ser los mismos'
                                    }
                }
                }*/
              }


             })/*.on('keyup', '[name="password"]', function() {
                        var isEmpty = $(this).val() == '';
                        $('#enableForm')
                                .bootstrapValidator('enableFieldValidators', 'password', !isEmpty)
                                .bootstrapValidator('enableFieldValidators', 'confirm_password', !isEmpty);

                        // Revalidate the field when user start typing in the password field
                        if ($(this).val().length == 1) {
                            $('#enableForm').bootstrapValidator('validateField', 'password')
                                            .bootstrapValidator('validateField', 'confirm_password');
                        }
                    })*/.on('success.form.bv',function(e){
                      e.preventDefault();

                      fv   = $(e.target).data('bootstrapValidator');
                      if (fv) {
                        fv.defaultSubmit();
                      }

                    });

//////////////////////////validador de add usuario///////////////////////////////////////


            //validar los campos del formulario
             $('#FormAddUser').bootstrapValidator({
               resetForm: true,
               message: 'Este valor no es valido',
              feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
              },

              fields: {
                nombre: {
                validators: {
                  notEmpty: {message: 'El nombre es requerido'},
                  stringLength: {
                    min: 3,
                    max: 13,
                    message: 'El nombre  debe tener entre 3 y 12 caracteres de logitud'
                  },
                  regexp: {
                      regexp: /^[a-zñáéíóúA-ZÑÁÉÍÓÚ]+$/,
                      message: 'no es permitido caracteres numéricos ni espacios en blanco'
                  }


                     }
                   },
                correo: {
                validators: {
                  notEmpty: {
                                message: 'El correo es requerido'
                            },
                            emailAddress: {
                                message: 'El formato de correo no es valido'
                            }
                     }
                   },
                   id_perfil: {
                   validators: {
                     notEmpty: {
                                   message: 'El perfil es requerido'
                               }
                        }
                      },
              pass: {
                validators: {
                notEmpty: { message: 'La contraseña es requerida'},
                stringLength: {
                  min: 8,
                  max: 10,
                  message: 'La clave de usuario debe tener entre 8 y 10 caracteres de logitud'
                },
                regexp: {
                    regexp: /^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i,
                    message: 'La clave de usuario debe tener Entre 8 y 10 caracteres, por lo menos un digito y un alfanumérico, y no puede contener caracteres espaciales'
                }
              },

              },
              usuario:{
                validators: {
                notEmpty: { message: 'El nombre de usuario es requerido'},
                stringLength: {
                  min: 6,
                  max: 10,
                  message: 'El nombre de usuario debe tener entre 6 y 12 caracteres de logitud'
                },
                regexp: {
                    regexp: /^[a-z0-9ñáéíóúA-ZÑÁÉÍÓÚ_]+$/,
                    message: 'El nombre de usuario sólo puede consistir en alfabético, número y guion bajo'
                }
              },

              },
              role: {
                  validators: {
                      notEmpty: {
                          message: 'Dede seleccionar un rol'
                      }
                  }
              },
              estado: {
                  validators: {
                      notEmpty: {
                          message: 'Dede seleccionar un estado'
                      }
                  }
              },
              foto: {
                            validators: {
                                file: {
                                  extension: 'jpg,jpeg,png',
                                  type: 'image/jpeg,image/jpg,image/png',
                                    maxSize:  10*1024*1024,
                                    message: 'el archivos no es correcto.solo imagenes con formato jpg,jpeg o png'
                                }
                            }
                        },
              confirm_pass: {
                validators: {
                notEmpty: { message: 'confirme La contraseña '},
                identical: {
                                        field: 'pass',
                                        message: 'La contraseña y su confirmación deben ser los mismos'
                                    }
                }
                }
              }


           }).on('keyup', '[name="password"]', function() {
                        var isEmpty = $(this).val() == '';
                        $('#enableForm')
                                .bootstrapValidator('enableFieldValidators', 'pass', !isEmpty)
                                .bootstrapValidator('enableFieldValidators', 'confirm_pass', !isEmpty);

                        // Revalidate the field when user start typing in the password field
                        if ($(this).val().length == 1) {
                            $('#enableForm').bootstrapValidator('validateField', 'pass')
                                            .bootstrapValidator('validateField', 'confirm_pass');
                        }
                    }).on('success.form.bv',function(e){
                      e.preventDefault();

                      fv   = $(e.target).data('bootstrapValidator');
                      if (fv) {
                        fv.defaultSubmit();
                      }

                    });


////////////////////////////////////////////////////////////////
//////////////////////////validador de add funcionario///////////////////////////////////////


            //validar los campos del formulario
             $('#FormAddFuncionario').bootstrapValidator({
               resetForm: true,
               message: 'Este valor no es valido',
              feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
              },

              fields: {
                cedula: {
                validators: {
                  notEmpty: {message: 'La cedula del funcionario es requerida'},
                  stringLength: {
                    min: 8,
                    max: 8,
                    message: 'la cedula  debe tener 8 digitos'
                  },
                  regexp: {
                      regexp: /^([1,2]?)([1-9])([\.\b\B ]?([0-9]){1,4}){2}$/,
                      message: 'no es permitido letras ni espacios en blanco'
                  }


                     }
                   },
                nombre1: {
                validators: {
                  notEmpty: {message: 'El Primer nombre es requerido'},
                  stringLength: {
                    min: 3,
                    max: 12,
                    message: 'El Primer nombre  debe tener un minimo  3 y un maximo 12 caracteres de logitud'
                  },
                  regexp: {
                      regexp: /^[a-zñáéíóúA-ZÑÁÉÍÓÚ]+$/,
                      message: 'no es permitido caracteres numéricos ni espacios en blanco'
                  }


                     }
                   },
                   nombre2: {
                   validators: {
                     stringLength: {
                       min: 3,
                       max: 12,
                       message: 'El Segundo nombre  debe tener un minimo  3 y un maximo 12 caracteres de logitud'
                     },
                     regexp: {
                         regexp: /^[a-zñáéíóúA-ZÑÁÉÍÓÚ]+$/,
                         message: 'no es permitido caracteres numéricos ni espacios en blanco'
                     }


                        }
                      },
                      apellido1: {
                      validators: {
                        notEmpty: {message: 'El Primer apellido es requerido'},
                        stringLength: {
                          min: 3,
                          max: 12,
                          message: 'El Primer apellido  debe tener un minimo  3 y un maximo 12 caracteres de logitud'
                        },
                        regexp: {
                            regexp: /^[a-zñáéíóúA-ZÑÁÉÍÓÚ]+$/,
                            message: 'no es permitido caracteres numéricos ni espacios en blanco'
                        }


                           }
                         },
                         apellido2: {
                         validators: {
                           stringLength: {
                             min: 3,
                             max: 12,
                             message: 'El Segundo apellido  debe tener un minimo  3 y un maximo 12 caracteres de logitud'
                           },
                           regexp: {
                               regexp: /^[a-zñáéíóúA-ZÑÁÉÍÓÚ]+$/,
                               message: 'no es permitido caracteres numéricos ni espacios en blanco'
                           }


                              }
                            },
                            fecha_nac: {
                            validators: {
                              notEmpty: {message: 'La fecha de nacimiento es requerida'},
                              stringLength: {
                                min: 10,
                                max: 10,
                                message: 'La fecha de nacimineto   debe tener un minimo  10 y un maximo 10 caracteres de logitud'
                              },
                              regexp: {
                                  regexp: /^\d{1,2}\-\d{1,2}\-\d{2,4}$/,
                                  message: 'El formato de fecha no es correcto'
                              }


                                 }
                               },
                               fecha_ing: {
                               validators: {
                                 notEmpty: {message: 'La fecha de ingreso es requerida'},
                                 stringLength: {
                                   min: 10,
                                   max: 10,
                                   message: 'La fecha de ingreso   debe tener un minimo  10 y un maximo 10 caracteres de logitud'
                                 },
                                 regexp: {
                                     regexp: /^\d{1,2}\-\d{1,2}\-\d{2,4}$/,
                                     message: 'El formato de fecha no es correcto'
                                 }


                                    }
                                  },
                               estado: {
                               validators: {
                                 notEmpty: {message: 'Debe seleccionar el status del funcionario'},
                                 }
                                  },
                                  grado_instruc: {
                                  validators: {
                                    notEmpty: {message: 'Debe seleccionar un grado de instrucción'},
                                    }
                                     },
                                     profesion: {
                                     validators: {
                                       notEmpty: {message: 'Debe ingresar una o varias profesiones'},
                                       }
                                        },
                                        codigo_cargo: {
                                        validators: {
                                          notEmpty: {message: 'El código del cargo es requerido'},
                                          stringLength: {
                                            min: 4,
                                            max: 10,
                                            message: 'El código del cargo  debe tener un minimo  4 y un maximo 10 caracteres Alfanumericos de logitud'
                                          },
                                          regexp: {
                                              regexp:/^[a-zA-Z-]{1,}\d{3,}/,
                                              message: 'Solo se permiten caracteres alfanuméricos sin espacios en blanco'
                                          }


                                             }
                                           },
                                           descrip_cargo: {
                                           validators: {
                                             notEmpty: {message: 'Debe describir el cargo'},
                                             }
                                              },
                                              func_inhe_cargo: {
                                              validators: {
                                                notEmpty: {message: 'Describe las Funciones Inherentes al Cargo'},
                                                }
                                                 },
                                                 odi: {
                                                 validators: {
                                                   notEmpty: {message: 'Debe describir Los Objetivos de Desempeño Individual'},
                                                   }
                                                    },
                                                    observacion: {
                                                    validators: {
                                                      notEmpty: {message: 'Debe Describir las observaciones'},
                                                      }
                                                       },
                                                       info_complentaria: {
                                                       validators: {
                                                         notEmpty: {message: 'Debe Describir la Información Complementaria'},
                                                         }
                                                          },
                correo: {
                validators: {
                  notEmpty: {
                                message: 'El correo es requerido'
                            },
                            emailAddress: {
                                message: 'El formato de correo no es valido'
                            }
                     }
                   },
              estado: {
                  validators: {
                      notEmpty: {
                          message: 'Dede seleccionar un estado'
                      }
                  }
              },
              foto: {
                            validators: {
                                file: {
                                  extension: 'jpg,jpeg,png',
                                  type: 'image/jpeg,image/jpg,image/png',
                                    maxSize:  10*1024*1024,
                                    message: 'el archivos no es correcto.solo imagenes con formato jpg,jpeg o png'
                                }
                            }
                        },

              }


           }).on('success.form.bv',function(e){
                      e.preventDefault();

                      fv   = $(e.target).data('bootstrapValidator');
                      if (fv) {
                        fv.defaultSubmit();
                      }

                    });


////////////////////////////////////////////////////////////////
//////////////////////validador del formulario de permisos////////////////////////////////////////
$('#FormAddPermisos').bootstrapValidator({
  resetForm: true,
  message: 'Este valor no es valido',
 feedbackIcons: {
   valid: 'glyphicon glyphicon-ok',
   invalid: 'glyphicon glyphicon-remove',
   validating: 'glyphicon glyphicon-refresh'
 },

 fields: {
   id_perfil: {
   validators: {
     notEmpty: { message: 'El perfil es requerido'},

        }
      },
 'id_recurso[]': {
   validators: {
   notEmpty: { message: 'El recurso es requerido'}
   }
 },

 }
}).on('success.form.bv',function(e){
 e.preventDefault();

 fv   = $(e.target).data('bootstrapValidator');
 if (fv) {
   fv.defaultSubmit();
 }
 //alert($form.serialize());

});
////////////////////////////////////////////
//////////////////////validador del formulario de permisos////////////////////////////////////////
$('#FormAddPerfil').bootstrapValidator({
  resetForm: true,
  message: 'Este valor no es valido',
 feedbackIcons: {
   valid: 'glyphicon glyphicon-ok',
   invalid: 'glyphicon glyphicon-remove',
   validating: 'glyphicon glyphicon-refresh'
 },

 fields: {
   nombre: {
   validators: {
     notEmpty: { message: 'El nombre del perfil es requerido'},
     regexp: {
         regexp: /^[a-zñáéíóúA-ZÑÁÉÍÓÚ]+$/,
         message: 'no es permitido caracteres numéricos ni espacios en blanco'
     }

        }
      }


 }
}).on('success.form.bv',function(e){
 e.preventDefault();

 fv   = $(e.target).data('bootstrapValidator');
 if (fv) {
   fv.defaultSubmit();
 }
 //alert($form.serialize());

});
////////////////validador del formulario de agregar categoria/////////////////////

$('#FormAddCategoria').bootstrapValidator({
  resetForm: true,
  message: 'Este valor no es valido',
 feedbackIcons: {
   valid: 'glyphicon glyphicon-ok',
   invalid: 'glyphicon glyphicon-remove',
   validating: 'glyphicon glyphicon-refresh'
 },

 fields: {
   nombre: {
   validators: {
     notEmpty: { message: 'El nombre de la categoria es requerida'},
     }
   },
   estado: {
   validators: {
     notEmpty: { message: 'Debe seleccionar un estado de la categoria'},
     }
      }


 }
}).on('success.form.bv',function(e){
 e.preventDefault();

 fv   = $(e.target).data('bootstrapValidator');
 if (fv) {
   fv.defaultSubmit();
 }
 //alert($form.serialize());

});
/////////////////////////////////////

////////////////validador del formulario de editar categoria/////////////////////

$('#FormEditCategoria').bootstrapValidator({
  resetForm: true,
  message: 'Este valor no es valido',
 feedbackIcons: {
   valid: 'glyphicon glyphicon-ok',
   invalid: 'glyphicon glyphicon-remove',
   validating: 'glyphicon glyphicon-refresh'
 },

 fields: {
   nombre: {
   validators: {
     notEmpty: { message: 'El nombre de la categoria es requerida'},
     }
   },
   estado: {
   validators: {
     notEmpty: { message: 'Debe seleccionar un estado de la categoria'},
     }
      }


 }
}).on('success.form.bv',function(e){
 e.preventDefault();

 fv   = $(e.target).data('bootstrapValidator');
 if (fv) {
   fv.defaultSubmit();
 }
 //alert($form.serialize());

});
/////////////////////////////////////

//////////////////////validador del formulario de agregar provedor////////////////////////////////////////
$('#FormAddProveedor').bootstrapValidator({
  resetForm: true,
  message: 'Este valor no es valido',
 feedbackIcons: {
   valid: 'glyphicon glyphicon-ok',
   invalid: 'glyphicon glyphicon-remove',
   validating: 'glyphicon glyphicon-refresh'
 },

 fields: {
   prov_tipo_persona: {
   validators:{
                notEmpty: { message: 'El tipo de persona es requerido'},
              }
            },
            prov_rif: {
            validators:{
                         notEmpty: { message: 'El RIF del proveedor es requerido'},
                         regexp: {
                           // /^[VEG]{1}-\d{2}/
                           regexp:/^[VEG]{1}-\d{8}-\d{1}/,
                             //regexp: /^([VEG]{1})-([0-9]{8})-([0-9]{1})$,
                             message: 'El formatod del RIF no es correcto'
                         }
                       }
                     },
                     prov_nom_repres_legal: {
                     validators:{
                                  notEmpty: { message: 'El nombre del representante legal es requerido'},
                                }
                              },
                     prov_razon_social: {
                     validators:{
                                  notEmpty: { message: 'Nombre de la Persona Natural, Jurídica o Razón Social  es requerida'},
                                }
                              },
                              prov_tipo: {
                              validators:{
                                           notEmpty: { message: 'El tipo de proveedor  es requerido'},
                                         }
                                       },
                                       prove_bienes_servicios: {
                                       validators:{
                                                    notEmpty: { message: 'El listado de bienes y servicios que ofrece el proveedor   es requerido'},
                                                    stringLength: {
                                                      min: 15,
                                                      max: 200,
                                                      message: 'El listado de bienes y servicios debe tener entre 15 y 200 caracteres de logitud'
                                                    },
                                                  }
                                                },
                              prov_cel_movil: {
                              validators:{
                                           notEmpty: { message: 'El número de teléfono movil es requerido'},
                                         }
                                       },
                                       prov_cel_movil: {
                                       validators:{
                                                    notEmpty: { message: 'El número de teléfono movil es requerido'},
                                                    regexp: {
                                                      // /^[VEG]{1}-\d{2}/
                                                      regexp:/^\d{3}\-\d{7}$/,
                                                        //regexp: /^([VEG]{1})-([0-9]{8})-([0-9]{1})$,
                                                        message: 'El formato del teléfon movil no es correcto'
                                                    },

                                                  }
                                                },
                                                prov_cel_fijo: {
                                                validators:{
                                                  regexp: {
                                                    // /^[VEG]{1}-\d{2}/
                                                    regexp:/^\d{3}\-\d{7}$/,
                                                      //regexp: /^([VEG]{1})-([0-9]{8})-([0-9]{1})$,
                                                      message: 'El formato del teléfon fijo no es correcto'
                                                  },

                                                           }
                                                         },
                                                prov_direccion_fiscal: {
                                                validators:{
                                                             notEmpty: { message: 'El listado de bienes y servicios que ofrece el proveedor   es requerido'},
                                                             stringLength: {
                                                               min: 15,
                                                               max: 200,
                                                               message: 'La dirección fiscal debe tener entre 15 y 200 caracteres de logitud'
                                                             },
                                                           }
                                                         },
                                                         prov_code_postal: {
                                                         validators:{
                                                                      notEmpty: { message: 'La dirección fiscal es requerida'},
                                                                      regexp: {
                                                                        // /^[VEG]{1}-\d{2}/
                                                                        regexp:/^[0-9]{4}/,
                                                                          //regexp: /^([VEG]{1})-([0-9]{8})-([0-9]{1})$,
                                                                          message: 'El formato del código postal no es correcto'
                                                                      }
                                                                    }
                                                                  },
                                                                  prov_apartado_code_postal: {
                                                                  validators:{
                                                                               regexp: {
                                                                                 // /^[VEG]{1}-\d{2}/
                                                                                 regexp:/^[0-9]{4}/,
                                                                                   //regexp: /^([VEG]{1})-([0-9]{8})-([0-9]{1})$,
                                                                                   message: 'El formato del apartado postal no es correcto'
                                                                               }
                                                                             }
                                                                           },
                                                                           prov_estado: {
                                                                           validators:{
                                                                                        notEmpty: { message: 'El estado del proveedor es requerido'},
                                                                                      }
                                                                                    },
                                                                                    prov_municipio: {
                                                                                    validators:{
                                                                                                 notEmpty: { message: 'El municipio del proveedor es requerido'},
                                                                                               }
                                                                                             },
                                                                                             prov_correo: {
                                                                                             validators:{
                                                                                                          notEmpty: { message: 'El correo del proveedor es requerido'},
                                                                                                          regexp: {
                                                                                                            // /^[VEG]{1}-\d{2}/
                                                                                                            regexp:/^[_a-zA-Z0-9-_]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})+$/,
                                                                                                              //regexp: /^([VEG]{1})-([0-9]{8})-([0-9]{1})$,
                                                                                                              message: 'El formato del correo no es valido'
                                                                                                          }
                                                                                                        }
                                                                                                      },




 }
}).on('success.form.bv',function(e){
 e.preventDefault();

 fv   = $(e.target).data('bootstrapValidator');
 if (fv) {
   fv.defaultSubmit();
 }
 //alert($form.serialize());

});
/////////////////////////////////////
////////////////////////
$('#FormAddProducto').bootstrapValidator({
  resetForm: true,
  message: 'Este valor no es valido',
 feedbackIcons: {
   valid: 'glyphicon glyphicon-ok',
   invalid: 'glyphicon glyphicon-remove',
   validating: 'glyphicon glyphicon-refresh'
 },

 fields: {
   codigo_barra: {
   validators: {
     notEmpty: { message: 'El código del producto es requerido'},
     regexp: {
         regexp: /^[a-zA-Z-]{1,}\d{3,}/, ///^[a-z\d]{5,}$/i
         message: 'Solo se permiten números y letras combinadas en el campo de código del producto ejemplo:TR45634'
     },
     stringLength: {
       min: 4,
       max: 10,
       message: 'El código del producto debe tener un minimo 4 y un maximo 10 caracteres  alfanumericos de logitud'
     },
     }
      },
   nombre: {
   validators: {
     notEmpty: { message: 'El nombre del producto es requerido'},
     }
      },
      descrip_producto: {
      validators: {
        notEmpty: { message: 'La descripción del producto es requerida'},

           }
         },
         minimo_stock: {
         validators: {
           notEmpty: { message: 'El número minimo de producto a ingresar es requerido'},
           regexp: {
               regexp: /^[0-9]+$/,
               message: 'Solo se permiten números en el campo nimimo stock'
           }

              }
            },
         stock: {
         validators: {
           notEmpty: { message: 'El número total de producto a ingresar es requerido'},
           regexp: {
               regexp: /^[0-9]+$/,
               message: 'Solo se permiten números en el campo stock'
           }

              }
            },
            estado: {
            validators: {
              notEmpty: { message: 'El estado del producto es requerido'},
            }
               },
               id_marca: {
               validators: {
                 notEmpty: { message: 'La marca del producto es requerido'},
               }
                  },
                  id_categoria: {
                  validators: {
                    notEmpty: { message: 'La categoria del producto es requerido'},
                  }
                     },
                     foto: {
                                   validators: {
                                       file: {
                                         extension: 'jpg,jpeg,png',
                                         type: 'image/jpeg,image/jpg,image/png',
                                           maxSize:  10*1024*1024,
                                           message: 'el archivos no es correcto.solo imagenes con formato jpg,jpeg o png'
                                       }
                                   }
                               },


 }
}).on('success.form.bv',function(e){
 e.preventDefault();

 fv   = $(e.target).data('bootstrapValidator');
 if (fv) {
   fv.defaultSubmit();
 }
 //alert($form.serialize());

});

/////////////////////

        }

//////////////////////


//////////////////////
(function($,sr){
    // debouncing function from John Hann
    // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
    var debounce = function (func, threshold, execAsap) {
      var timeout;

        return function debounced () {
            var obj = this, args = arguments;
            function delayed () {
                if (!execAsap)
                    func.apply(obj, args);
                timeout = null;
            }

            if (timeout)
                clearTimeout(timeout);
            else if (execAsap)
                func.apply(obj, args);

            timeout = setTimeout(delayed, threshold || 100);
        };
    };

    // smartresize
    jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');
/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
    $BODY = $('body'),
    $MENU_TOGGLE = $('#menu_toggle'),
    $SIDEBAR_MENU = $('#sidebar-menu'),
    $SIDEBAR_FOOTER = $('.sidebar-footer'),
    $LEFT_COL = $('.left_col'),
    $RIGHT_COL = $('.right_col'),
    $NAV_MENU = $('.nav_menu'),
    $FOOTER = $('footer');



// Sidebar
function init_sidebar() {
// TODO: This is some kind of easy fix, maybe we can improve this
var setContentHeight = function () {
	// reset height
	$RIGHT_COL.css('min-height', $(window).height());

	var bodyHeight = $BODY.outerHeight(),
		footerHeight = $BODY.hasClass('footer_fixed') ? -10 : $FOOTER.height(),
		leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
		contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;

	// normalize content
	contentHeight -= $NAV_MENU.height() + footerHeight;

	$RIGHT_COL.css('min-height', contentHeight);
};

  $SIDEBAR_MENU.find('a').on('click', function(ev) {
	  console.log('clicked - sidebar_menu');
        var $li = $(this).parent();

        if ($li.is('.active')) {
            $li.removeClass('active active-sm');
            $('ul:first', $li).slideUp(function() {
                setContentHeight();
            });
        } else {
            // prevent closing menu if we are on child menu
            if (!$li.parent().is('.child_menu')) {
                $SIDEBAR_MENU.find('li').removeClass('active active-sm');
                $SIDEBAR_MENU.find('li ul').slideUp();
            }else
            {
				if ( $BODY.is( ".nav-sm" ) )
				{
					$SIDEBAR_MENU.find( "li" ).removeClass( "active active-sm" );
					$SIDEBAR_MENU.find( "li ul" ).slideUp();
				}
			}
            $li.addClass('active');

            $('ul:first', $li).slideDown(function() {
                setContentHeight();
            });
        }
    });

// toggle small or large menu
$MENU_TOGGLE.on('click', function() {
		console.log('clicked - menu toggle');
      $LEFT_COL.toggleClass('desplasamiento');
		if ($BODY.hasClass('nav-md')) {
			$SIDEBAR_MENU.find('li.active ul').hide();
			$SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
		} else {
			$SIDEBAR_MENU.find('li.active-sm ul').show();
			$SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
		}

	$BODY.toggleClass('nav-md nav-sm');

	setContentHeight();
});

	// check active menu
	$SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');

	$SIDEBAR_MENU.find('a').filter(function () {
		return this.href == CURRENT_URL;
	}).parent('li').addClass('current-page').parents('ul').slideDown(function() {
		setContentHeight();
	}).parent().addClass('active');

	// recompute content when resizing
	$(window).smartresize(function(){
		setContentHeight();
	});

	setContentHeight();

	// fixed sidebar
	if ($.fn.mCustomScrollbar) {
		$('.menu_fixed').mCustomScrollbar({
			autoHideScrollbar: true,
			theme: 'minimal',
			mouseWheel:{ preventDefault: true }
		});
	}
};
// /Sidebar

	var randNum = function() {
	  return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
	};


// Panel toolbox
$(document).ready(function() {
    $('.collapse-link').on('click', function() {
        var $BOX_PANEL = $(this).closest('.x_panel'),
            $ICON = $(this).find('i'),
            $BOX_CONTENT = $BOX_PANEL.find('.x_content');

        // fix for some div with hardcoded fix class
        if ($BOX_PANEL.attr('style')) {
            $BOX_CONTENT.slideToggle(200, function(){
                $BOX_PANEL.removeAttr('style');
            });
        } else {
            $BOX_CONTENT.slideToggle(200);
            $BOX_PANEL.css('height', 'auto');
        }

        $ICON.toggleClass('fa-chevron-up fa-chevron-down');
    });

    $('.close-link').click(function () {
        var $BOX_PANEL = $(this).closest('.x_panel');

        $BOX_PANEL.remove();
    });
});
// /Panel toolbox


// Switchery
$(document).ready(function() {
    if ($(".js-switch")[0]) {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {
                color: '#26B99A'
            });
        });
    }
});
// /Switchery


// iCheck
$(document).ready(function() {
    if ($("input.flat")[0]) {
        $(document).ready(function () {
            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
    }
});
// /iCheck




// Accordion
$(document).ready(function() {
    $(".expand").on("click", function () {
        $(this).next().slideToggle(200);
        $expand = $(this).find(">:first-child");

        if ($expand.text() == "+") {
            $expand.text("-");
        } else {
            $expand.text("+");
        }
    });
});

// NProgress
if (typeof NProgress != 'undefined') {
    $(document).ready(function () {
        NProgress.start();
    });

    $(window).load(function () {
        NProgress.done();
    });
}


	  //hover and retain popover when on popover content
        var originalLeave = $.fn.popover.Constructor.prototype.leave;
        $.fn.popover.Constructor.prototype.leave = function(obj) {
          var self = obj instanceof this.constructor ?
            obj : $(obj.currentTarget)[this.type](this.getDelegateOptions()).data('bs.' + this.type);
          var container, timeout;

          originalLeave.call(this, obj);

          if (obj.currentTarget) {
            container = $(obj.currentTarget).siblings('.popover');
            timeout = self.timeout;
            container.one('mouseenter', function() {
              //We entered the actual popover – call off the dogs
              clearTimeout(timeout);
              //Let's monitor popover content instead
              container.one('mouseleave', function() {
                $.fn.popover.Constructor.prototype.leave.call(self, self);
              });
            });
          }
        };

        $('body').popover({
          selector: '[data-popover]',
          trigger: 'click hover',
          delay: {
            show: 50,
            hide: 400
          }
        });


	function gd(year, month, day) {
		return new Date(year, month - 1, day).getTime();
	}





	 /* AUTOSIZE */

		function init_autosize() {

			if(typeof $.fn.autosize !== 'undefined'){

			autosize($('.resizable_textarea'));

			}

		};



		  /* INPUTS */

			function onAddTag(tag) {
				alert("Added a tag: " + tag);
			  }

			  function onRemoveTag(tag) {
				alert("Removed a tag: " + tag);
			  }

			  function onChangeTag(input, tag) {
				alert("Changed a tag: " + tag);
			  }

			  //tags input
			function init_TagsInput() {

				if(typeof $.fn.tagsInput !== 'undefined'){

				$('#tags_1').tagsInput({
				  width: 'auto'
				});

				}

		    };


	   /* WYSIWYG EDITOR */

		function init_wysiwyg() {

		if( typeof ($.fn.wysiwyg) === 'undefined'){ return; }
		console.log('init_wysiwyg');

        function init_ToolbarBootstrapBindings() {
          var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
              'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
              'Times New Roman', 'Verdana'
            ],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
          $.each(fonts, function(idx, fontName) {
            fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
          });
          $('a[title]').tooltip({
            container: 'body'
          });
          $('.dropdown-menu input').click(function() {
              return false;
            })
            .change(function() {
              $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
            })
            .keydown('esc', function() {
              this.value = '';
              $(this).change();
            });

          $('[data-role=magic-overlay]').each(function() {
            var overlay = $(this),
              target = $(overlay.data('target'));
            overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
          });

          if ("onwebkitspeechchange" in document.createElement("input")) {
            var editorOffset = $('#editor').offset();

            $('.voiceBtn').css('position', 'absolute').offset({
              top: editorOffset.top,
              left: editorOffset.left + $('#editor').innerWidth() - 35
            });
          } else {
            $('.voiceBtn').hide();
          }
        }

        function showErrorAlert(reason, detail) {
          var msg = '';
          if (reason === 'unsupported-file-type') {
            msg = "Unsupported format " + detail;
          } else {
            console.log("error uploading file", reason, detail);
          }
          $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
        }

       $('.editor-wrapper').each(function(){
			var id = $(this).attr('id');	//editor-one

			$(this).wysiwyg({
				toolbarSelector: '[data-target="#' + id + '"]',
				fileUploadError: showErrorAlert
			});
		});


        window.prettyPrint;
        prettyPrint();

    };



		/* INPUT MASK  para los inputs*/

		function init_InputMask() {

			if( typeof ($.fn.inputmask) === 'undefined'){ return; }
			console.log('init_InputMask');

				$(":input").inputmask();

		};

		/* COLOR PICKER */

		function init_ColorPicker() {

      /*var picker = new CP(document.querySelector('input'));

          picker.on("change", function(color) {
              this.target.value = '#' + color;
          document.getElementById("right_col").style.backgroundColor = '#' + color;
              //document.body.style.backgroundColor = '#' + color;
          }, 'main-change');

          var colors = ['012', '123', '234', '345', '456', '567', '678', '789', '89a', '9ab'], box;

          for (var i = 0, len = colors.length; i < len; ++i) {
              box = document.createElement('span');
              box.className = 'right_col';
              box.title = '#' + colors[i];
              box.style.backgroundColor = '#' + colors[i];
              box.addEventListener("click", function(e) {
                  picker.set(this.title);
                  picker.trigger("change", [this.title.slice(1)], 'main-change');
                  e.stopPropagation();
              }, false);
              picker.picker.firstChild.appendChild(box);
          }*/
		};







	   /* SMART WIZARD  tag o pestañas */

		function init_SmartWizard() {

			if( typeof ($.fn.smartWizard) === 'undefined'){ return; }
			console.log('init_SmartWizard');

			$('#wizard').smartWizard();

			$('#wizard_verticle').smartWizard({
			  transitionEffect: 'slide'
			});

			$('.buttonNext').addClass('btn btn-success');
			$('.buttonPrevious').addClass('btn btn-primary');
			$('.buttonFinish').addClass('btn btn-default');

		};





		/* COMPOSE */

		function init_compose() {

			if( typeof ($.fn.slideToggle) === 'undefined'){ return; }
			console.log('init_compose');

			$('#compose, .compose-close').click(function(){
				$('.compose').slideToggle();
			});

		};

	   	/* CALENDAR */

		    function  init_calendar() {

				if( typeof ($.fn.fullCalendar) === 'undefined'){ return; }
				console.log('init_calendar');

				var date = new Date(),
					d = date.getDate(),
					m = date.getMonth(),
					y = date.getFullYear(),
					started,
					categoryClass;

				var calendar = $('#calendar').fullCalendar({
				  header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay,listMonth'
				  },
				  selectable: true,
				  selectHelper: true,
				  select: function(start, end, allDay) {
					$('#fc_create').click();

					started = start;
					ended = end;

					$(".antosubmit").on("click", function() {
					  var title = $("#title").val();
					  if (end) {
						ended = end;
					  }

					  categoryClass = $("#event_type").val();

					  if (title) {
						calendar.fullCalendar('renderEvent', {
							title: title,
							start: started,
							end: end,
							allDay: allDay
						  },
						  true // make the event "stick"
						);
					  }

					  $('#title').val('');

					  calendar.fullCalendar('unselect');

					  $('.antoclose').click();

					  return false;
					});
				  },
				  eventClick: function(calEvent, jsEvent, view) {
					$('#fc_edit').click();
					$('#title2').val(calEvent.title);

					categoryClass = $("#event_type").val();

					$(".antosubmit2").on("click", function() {
					  calEvent.title = $("#title2").val();

					  calendar.fullCalendar('updateEvent', calEvent);
					  $('.antoclose2').click();
					});

					calendar.fullCalendar('unselect');
				  },
				  editable: true,
				  events: [{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				  }, {
					title: 'Long Event',
					start: new Date(y, m, d - 5),
					end: new Date(y, m, d - 2)
				  }, {
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				  }, {
					title: 'Lunch',
					start: new Date(y, m, d + 14, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				  }, {
					title: 'Birthday Party',
					start: new Date(y, m, d + 1, 19, 0),
					end: new Date(y, m, d + 1, 22, 30),
					allDay: false
				  }, {
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				  }]
				});

			};

		/* DATA TABLES */

    function init_DataTables(BASE_URL) {

      $('#table').dataTable({
        //'sScrollY':300,
        'sPaginationType':'simple_numbers',
        "iDisplayLength": 5,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        'language':{
         'url':BASE_URL+'views/layout/admin/assets/datatables.net/js/dataTables.spanish.json'//traductor de la tabla
       }
      });



  };

  /*llenar el select municipio por el id de cada estado*/
  $("#prov_estado").change(function () {
    var href =  $(this).data("href");
    //alert(href);
      $("#prov_estado option:selected").each(function () {
            id_estado = $(this).val();

            //alert(id_estado);
                $.post(href, { id_estado: id_estado }, function(data){

                          $("#prov_municipio").html(data);

                });
      });
  })
/***************************************************/

/***generar codigo de barra para el producto***/
$('.gencodebar').on('click',function(){

  //alert();
  var href =  $(this).data("href");
  //alert(href);
  //$("#eliminar-registro").attr('href', href);
  var codigo =$(this).val();
  //alert(value_checkeado);
  //$('#etnia').val(value_checkeado);
  $.post(href, { codigo: codigo }, function(data){

            $('#codigo_barra').val(data);

  });
});


/******************************************/
$("#id_perfil").change(function () {

     $("#id_perfil option:selected").each(function () {

      id_perfil = $(this).val();
      if (id_perfil == "") {
        alert('debe seleccionar un perfil');
      } else {

        var href =  $(this).data("href");
        //alert(href);
        $.post(href, { idperfil: id_perfil }, function(data){

                  $('.data-permiso-perfil').html(data);
                  init_checkAll();

        });

      }


  });
})


/**************************************************/

/////////////////////////Graficas///////////////////////////
function init_chart (href) {





  //var href =  $("#graficas").data("href");
var href="controllers/estadisticaController.php";
var height= $(".x_content").height();
var width= $(".x_content").width();

$.getJSON(href, function(json) {
  //$.post(href, { idperfil: 'report' }, function(json){

  chart = new Highcharts.Chart({
  chart: {
  renderTo: 'grafica',
  type: 'column',
  width: width,
  height: '350',
  marginBottom: 25,
  animation: Highcharts.svg,
  marginRight: 10,
  events: {load: function () {series = this.series[0];}},
  backgroundColor: {
  linearGradient: [0, 0, 500, 500],
  stops: [
  [0, 'rgb(255, 255, 255)'],
  [1, 'rgb(200, 200, 255)']
  ]
  },
  polar: true,
  },
  title: {
  text: 'Grafica de bienes',
  x: -20 //center
  },
  subtitle: {
  text: '',
  x: -20
  },
  xAxis: {
  categories: []
  },
  yAxis: {
  title: {
  text: 'Bienes'
  },
  plotLines: [{
  value: 0,
  width: 1,
  color: '#808080'
  }]
  },
  tooltip: {
  formatter: function() {
  return '<b>'+ this.series.name +'</b><br/>'+
  this.x +': '+ this.y;
  }
  },
  plotOptions: {
                         series: {
                             borderWidth: 0,
                             dataLabels: {
                                enabled: true,
                                format: '{point.y}'
                             }
                         }
                     },
  legend: {
  layout: 'vertical',
  align: 'right',
  verticalAlign: 'top',
  x: -10,
  y: 100,
  borderWidth: 0
  },
  series: json
  });
  });

  }


////////////////////////////////////////////////////
	$(document).ready(function() {

    var href =  $("#grafica").data("href");
    /****direcctorio base del proyecto***/
    var BASE_URL = $(".base_url").data("href");

		init_sidebar();
		init_wysiwyg();
		init_InputMask();
		init_ColorPicker();
		init_TagsInput();
		init_SmartWizard();
		init_DataTables(BASE_URL);
		init_calendar();
		init_compose();
		init_autosize();
    init_Validator();
    init_checkAll();
    init_chart(href);


	});
