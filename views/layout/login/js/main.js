
  $('#loginModal').on('shown.bs.modal', function() {
     $('#loginForm').bootstrapValidator('resetForm', true);

  });
  $('#loginForm').bootstrapValidator({
    resetForm: true,
    message: 'Este valor no es valido',
   feedbackIcons: {
     valid: 'glyphicon glyphicon-ok',
     invalid: 'glyphicon glyphicon-remove',
     validating: 'glyphicon glyphicon-refresh'
   },

   fields: {
     usuario: {
     validators: {
       notEmpty: { message: 'El nombre de usuario es requerido'},
            stringLength: {
              min: 6,
              max: 30,
              message: 'El nombre de usuario debe tener entre 6 y 30 caracteres de logitud'
            },
            regexp: {
              regexp: /^[a-zA-Z0-9_]+$/,
              message: 'The username can only consist of alphabetical, number and underscore'
            }
          }
        },
   password: {
     validators: {
     notEmpty: { message: 'La contraseña es requerida'}
     }
   },
   confirm_password: {
     validators: {
     notEmpty: { message: 'confirme La contraseña '},
     identical: {
                             field: 'password',
                             message: 'La contraseña y su confirmación deben ser los mismos'
                         }
     }
     }
   }


  }).on('keyup', '[name="password"]', function() {
             var isEmpty = $(this).val() == '';
             $('#enableForm')
                     .bootstrapValidator('enableFieldValidators', 'password', !isEmpty)
                     .bootstrapValidator('enableFieldValidators', 'confirm_password', !isEmpty);

             // Revalidate the field when user start typing in the password field
             if ($(this).val().length == 1) {
                 $('#enableForm').bootstrapValidator('validateField', 'password')
                                 .bootstrapValidator('validateField', 'confirm_password');
             }
         }).on('success.form.bv',function(e){
           e.preventDefault();
           var $form = $(e.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

           //alert($form.serialize());
           $.post($form.attr('action'), $form.serialize(), function(result) {
               alert(result);
             }, 'json');
         });
