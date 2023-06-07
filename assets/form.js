$(document).ready(function () {
 
    $('#sender').submit(function(e){


        var action = $("#sender").attr("data-action");
        console.log("action :"+action);

    


        e.preventDefault();
        $.ajax({
            url: './functions/'+action+'.php',
            type: 'POST',
            data:$('#sender').serialize(),
            success: function(data) {


                if(action=='calendar'){

                    $('#feature').html(data);


    

                }else{


                                   
                $('#notification').html(data);

                $('#notification').addClass("popup");
                setTimeout(function() {

$('#notification').removeClass('popup');


},2500);

                    
                }

 

               },
               error: function() {
                $('#notification').text('Erreur au niveau du menu');
               }


        });
    });




});