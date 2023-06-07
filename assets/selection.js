$(document).ready(function () {
 
    $.ajax({
        url: './functions/selection.php',
        type : 'post',
        success: function(data) {
         $('#selector').html(data);
        },
        error: function() {
         $('#selector').text('Erreur au niveau des infos clients');
        }
             });
    



             

});