$('#loginModal').on('shown.bs.modal', function() {
   $('#loginForm').bootstrapValidator('resetForm', true);

});
setTimeout(function() {
       $(".alert-danger").alert('close');
   }, 4000);



$('#loginForm').bootstrapValidator({
  resetForm: true,
  message: 'Este valor no es valido',
 feedbackIcons: {
   valid: 'glyphicon glyphicon-ok',
   invalid: 'glyphicon glyphicon-remove',
   validating: 'glyphicon glyphicon-refresh'
 },

 fields: {
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
   notEmpty: { message: 'La contraseña es requerida'}
   }
 },
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
