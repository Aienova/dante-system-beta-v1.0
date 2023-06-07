

$( document ).ready(function() {


    console.log('pathname:'+window.location.pathname);

/*----MOVE TO ROUTE-----*/

    $(".routing").click(function() {

        var pathname = window.location.pathname;
     
        console.log( "animation : move " );

        var router = $(this).closest(".routing").attr("data-id");

        if(pathname!='/'+router){

            $("#dante").removeClass("arrive");

            setTimeout(function() {
    
                
                window.location.replace("/"+router);
                
                },500);


                
            $("#dante").addClass("moove");
    

            console.log( "move to "+router );
    




        }

        



 

        /*----HOVER MENU -----*/
            



      });


   



      $("#shutdown").click(function() {

     
        console.log( "animation : shutdown " );


        var button = $(this).closest(".routing").attr("data-button");

        $.ajax({
            url: "./functions/disconnected.php",
            type: "POST",
            data: { disconnect : button ,
  
            },
        
        
            success: function(data) {

                $("#myaccount").html(data);

               },
               error: function() {
                $("#myaccount").text("Erreur au niveau du bouton de déconnexion");
               }
        
        
        });



    });



});