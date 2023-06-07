
<script>



$(document).ajaxStart(function(){
    $("#loaderfeature").html("<div id='danteloader'><img src='build/media/images/logo.png' /><br><div class='anime-load'><span class='loader-icon loader-bars'><span></span></span>Chargement...</div></div>");
 
});



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


var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}


function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}



$( ".cleaned" ).replaceWith("");


$.ajax({
    url: "./functions/explorer.php",
    type: "POST",
    data: { source : '' },


    success: function(data) {


        $("#explorer").html(data);


       },
       error: function() {
        $("#explorer").text("Erreur au niveau des fonctions");
       }


});


$("#field-date_birth").mouseout(function() {

  
  var date = new Date($('#field-date_birth').val());
  var myage = getAge(date);
  console.log("age:"+myage);
  $("#field-age").val(myage);



});

$("#field-id_certificate ").mouseout(function() {

  var certificatehour = $("#field-id_certificate option:selected").attr("data-hour");

  localStorage.setItem('ctf', certificatehour);

  console.log(certificatehour);

});


$("#field-reason").change(function() {


  var reason= $("#field-reason").val();

    if(reason=="nopaid" || reason=="family" ){

      $("#paid").hide();
      
    }else{
      $("#paid").show();

    }


});


$("#date_start").change(function() {

  var datestart = new Date($('#field-date_start').val());



    var pathname = window.location.pathname;

      if(pathname=='/formation'){

        if(localStorage.getItem('ctf')){

        var hourdata = localStorage.getItem('ctf');

  }else{

    var hourdata = 0;
  }

}else{

  var hourdata = 0;
}

  var dayformation= hourdata/7;

  if(dayformation<=1){

    dayformation=1;

  }else{
    dayformation=Math.ceil(dayformation);
  }



  console.log("Nb jour de formation :"+dayformation);

  var dateend = datestart.setDate(datestart.getDate()+parseInt(dayformation)-1); 
  var setdate =  new Date(dateend); 
  var year=setdate.getFullYear();
  var month=setdate.getMonth()+1;
  var day=setdate.getDate();

  var digit1="";
  var digit2="";

  if(month<10){digit1="0";}
  if(day<10){digit2="0";}

  var dateformat=year+"-"+digit1+month+"-"+digit2+day;

  console.log(dateformat);

  $('#field-date_end').val(dateformat);



});




$(".radiothis").click(function() {


  console.log("radio");


  var id = $(this).closest(".radiothis").attr("data-id");


  $.ajax({
    url: "./functions/calendar.php",
    type: "POST",
    data: { idfeature : id ,
            featurename : "permission",
    },



    success: function(data) {


        $("#feature").html(data);


       },
       error: function() {
        $("#feature").text("Erreur au niveau des fonctions");
       }


});






});



$(".filtering").click(function() {


console.log("filter");


var filter = $(this).closest(".filtering").attr("data-filter");
var order = $(this).closest(".filtering").attr("data-order");
var feature = $(this).closest(".filtering").attr("data-feature");
var colnumber = $(this).closest(".filtering").attr("data-colnumber");


$.ajax({
url: "./functions/"+feature+".php",
type: "POST",
data: { filter : filter ,
      featurename : feature,
      order : order,
      colnumber : colnumber,
},

success: function(data) {


  $("#feature").html(data);


 },
 error: function() {
  $("#feature").text("Erreur au niveau des fonctions");
 }


});

});

$(".refreshing").click(function() {

  window.location.reload();

});



$("#id_institute").click(function() {

  var institutename=$("#field-id_institute").find(':selected').data('name');
  var instituteid=$("#field-id_institute").val();

  console.log("Organisme:"+instituteid);

  $("#institutename").html(" de "+institutename);

  $.ajax({
url: "./functions/input-certificate.php",
type: "POST",
data: { 
  instituteid : instituteid ,
},

success: function(data) {

  $("#field-id_certificate").html(data);

 },
 error: function() {
  $("#field-id_certificate").text("Erreur au niveau des fonctions");
 }

      });
  });




  $("#companylist").click(function() {

var costumername=$("#field-id_costumer").val();


console.log("Organisme:"+costumername);
$("#company").html(costumername);

$.ajax({
url: "./functions/input-consulting.php",
type: "POST",
data: { 
  costumername : costumername ,
},

success: function(data) {

$("#consulting-listing").html(data);

},
error: function() {

$("#consulting-listing").text("Erreur au niveau des fonctions");
}

    });
});






$(".checkthis").click(function() {

  var feature = $(this).closest(".checkthis").attr("data-feature");
  var count=parseInt($("#counter").attr("value"));


  if($(this).closest(".checkthis").hasClass("checked")){


      count=count-1;

      if(count==0){

          $(".checkthis").attr("name","");

      }else{

        $(".checkthis").attr("name","id_"+feature+"_"+count);

      }

 

      $(this).closest(".checked").attr("name","");

$(this).closest(".checkthis").removeClass("checked");

$("#counter").val(count);

    

  }else{

    count=count+1;

    $(this).closest(".checkthis").attr("name","id_"+feature+"_"+count);
  $(this).closest(".checkthis").addClass("checked");


  $("#counter").val(count);


  }




});



$(".opening").click(function() {

var pathname = window.location.pathname;

console.log( "animation : move " );

var id = $(this).closest(".opening").attr("data-id");



    console.log( "open "+id );

      $.ajax({
    url: "./functions/"+feature+".php",
    type: "POST",
    data: { idfeature : id },


    success: function(data) {


        $("#feature").html(data);


       },
       error: function() {
        $("#feature").text("Erreur au niveau des fonctions");
       }


});




});



function page(page,order) {

  

  var count = $("#currentpage").attr("data-page");
  var pagenumber=1
  $("#numberpage").html(1);




  if(order==0){

    count--;

    if(count<1){


      count=1;

    }



  }else{

    count++;
    
    if(count>page){

count=page;


}
pagenumber=count;

$("#numberpage").html(pagenumber);

  }


console.log("move to:"+page);

$('.formpart').addClass('hidden')

$('#page-'+count).removeClass('hidden');

$("#currentpage").attr("data-page",count);


}


$(".adding-institute").click(function() {


    
    
console.log( "animation : move " );


var id = $(this).closest(".adding").attr("id");


      $.ajax({
    url: "./functions/addform.php",
    type: "POST",
    data: { featurename : "institute" },


    success: function(data) {


        $("#feature").html(data);


       },
       error: function() {
        $("#feature").text("Erreur au niveau des fonctions");
       }


});




});



$(".adding").click(function() {


    
    
console.log( "animation : move " );


var id = $(this).closest(".adding").attr("id");


      $.ajax({
    url: "./functions/addform.php",
    type: "POST",
    data: { featurename : feature },


    success: function(data) {


        $("#feature").html(data);


       },
       error: function() {
        $("#feature").text("Erreur au niveau des fonctions");
       }


});




});



$(".viewing").click(function() {



var url = $(this).closest(".viewing").attr("data-cv");

window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=800,height=800");

});


$(".waiting").click(function() {

console.log("move : decision")

var id = $(this).closest(".waiting").attr("data-id");
var decision = 2;





  decisionmessage=" Relecture validée !";





$.ajax({
    url: "./functions/decision.php",
    type: "POST",
    data: { 
      
      
      featureid : id ,
        
          featurename : feature ,

          valuename :'decision',

          setvalue : decision,

          featuremessage : decisionmessage,
    
    
    },



    success: function(data) {


        $("#notification").html(data);
        $('#notification').addClass("popup");
        setTimeout(function() {

$('#notification').removeClass('popup');

},1000);


setTimeout(function() {  


window.location.replace("/"+feature);


},1100);


       },
       error: function() {
        $("#notification").text("Erreur au niveau des fonctions");
       }


});

});


$(".lightning").click(function() {


  var light = $(this).closest(".lightning").attr("data-light");
  

  if(light==1){


    $("#date_contrat_start").addClass("hidden");
    $("#date_contrat_end").addClass("hidden");
    $("#date_arrive").removeClass("hidden");



  }else{


    $("#date_contrat_start").removeClass("hidden");
    $("#date_contrat_end").removeClass("hidden");
    $("#date_arrive").addClass("hidden");




  }



});


$(".choosing").click(function() {

console.log("move : decision");


var id = $(this).closest(".choosing").attr("data-id");
var decision = $(this).closest(".choosing").attr("data-decision");
let excuses = "";




if(decision==1){


  decisionmessage=" Décision Validée !";

}


else{

  decisionmessage=" Décision Refusée !";




   excuses = prompt("La raison de votre refus :", "");



}



$.ajax({
    url: "./functions/decision.php",
    type: "POST",
    data: { featureid : id ,
        
          featurename : feature ,

          valuename :'decision',

          setvalue : decision,

          featuremessage : decisionmessage,

          excuses : excuses,
    
    
    },



    success: function(data) {


        $("#notification").html(data);
        $('#notification').addClass("popup");
        setTimeout(function() {

$('#notification').removeClass('popup');

},1000);


setTimeout(function() {  


window.location.replace("/"+feature);


},1100);


       },
       error: function() {
        $("#notification").text("Erreur au niveau des fonctions");
       }


});

});



$(".deleting").click(function() {

var pathname = window.location.pathname;






console.log( "animation : delete " );

var id = $(this).closest(".deleting").attr("data-id");

var title = $(this).closest(".deleting").attr("data-frh");

/*Message de suppression et alert */

message = "Le "+title+" n°"+id+" a bien été supprimé";  alert="Souhaitez vous supprimer le "+title+"  n°"+id+" ?"; 
/*Message de suppression et alert  */


    console.log( "delete "+feature+" "+id );

    
    
    if (confirm(alert)) {

      $.ajax({
    url: "./functions/delete.php",
    type: "POST",
    data: { featureid : id ,
            featurename : feature,
            featuremessage : message,
    
    
    },



    success: function(data) {


  
            $("#notification").html(data);

  $('#notification').addClass("popup");
        setTimeout(function() {

$('#notification').removeClass('popup');

},1000);

setTimeout(function() {  


    window.location.replace("/"+feature);


},1100);













       },
       error: function() {
        $("#notification").text("Erreur au niveau des fonctions");
       }


});

}

else {




window.location.replace("/"+feature);
console.log('Thing was not saved to the database.');
}




});


$(".printing").click(function() {

var pathname = window.location.pathname;

console.log( "animation : printing" );

var id = $(this).closest(".printing").attr("data-id");



    console.log( "print "+id );

      $.ajax({
    url: "./functions/print.php",
    type: "POST",
    data: { featureid : id ,
        
        featurename : feature ,
    
    
    },


    success: function(data) {


        $("#print").html(data);


       },
       error: function() {
        $("#notification").text("Erreur au niveau des fonctions");
       }


});




});

$("#editdata").click(function() {

  $("#informations").addClass('hidden');
  $("#sender").removeClass('hidden');

});


$("#previouspage").click(function() {

  
  var total = $("#nextpage").attr("data-total");
var range = $("#nextpage").attr("data-range");
var feature = $("#nextpage").attr("data-feature");
var pagenum = $("#pagenumeration").attr("data-pagenum");
var totalpage = $("#pagenumeration").attr("data-totalpage");
var minimum = $("#pagenumeration").attr("data-minimum");

var newpage=parseInt(pagenum)-1;

minimum=parseInt(minimum)-4;

if(minimum<=0){

  minimum=0;
}

if(newpage<=1){
  newpage=1;
}

    console.log("next page");

  $.ajax({
    url: './functions/'+feature+'.php',
type: "POST",
data: { 
  
    totalrow : total,
    range : range,
    newpage : newpage,
    currentmin : minimum,

},


success: function(data) {

  $('#feature').html(data);

       },
   error: function() {
    $("#feature").text("Erreur au niveau de la table");
       }


      });




});

$("#nextpage").click(function() {

  
var total = $("#nextpage").attr("data-total");
var range = $("#nextpage").attr("data-range");
var feature = $("#nextpage").attr("data-feature");
var pagenum = $("#pagenumeration").attr("data-pagenum");
var totalpage = $("#pagenumeration").attr("data-totalpage");
var minimum = $("#pagenumeration").attr("data-minimum");

var newpage=parseInt(pagenum)+1;

minimum=parseInt(minimum)+4;

if(minimum>=total){

  minimum=minimum-4;
}

if(newpage>=parseInt(totalpage)){
  newpage=parseInt(totalpage);
}


    console.log("next page");

  $.ajax({
    url: './functions/'+feature+'.php',
type: "POST",
data: { 
  
    totalrow : total,
    range : range,
    newpage : newpage,
    currentmin : minimum,

},


success: function(data) {

  $('#feature').html(data);

       },
   error: function() {
    $("#feature").text("Erreur au niveau de la table");
       }


      });



});


$("#editcancel").click(function() {

$("#informations").removeClass('hidden');
$("#sender").addClass('hidden');

});



$(".checking").click(function() {

var pathname = window.location.pathname;

console.log( "animation : checking" );

var id = $(this).closest(".checking").attr("data-id");



    console.log( "print "+id );

      $.ajax({
    url: "./functions/check.php",
    type: "POST",
    data: { featureid : id ,
        featurename : feature ,
    },


    success: function(data) {


        $("#feature").html(data);


       },
       error: function() {
        $("#notification").text("Erreur au niveau des fonctions");
       }


});


});


$(".asking").click(function() {

var pathname = window.location.pathname;

console.log( "animation : asking" );

var id = $(this).closest(".asking").attr("data-id");



    console.log( "print "+id );

      $.ajax({
    url: "./functions/ask.php",
    type: "POST",
    data: { featureid : id ,
        featurename : feature ,
    },


    success: function(data) {


        $("#feature").html(data);


       },
       error: function() {
        $("#notification").text("Erreur au niveau des fonctions");
       }


});


});


$('.uploader').submit(function(e){


  var action = $(this).closest(".uploader").attr("data-action");
    /*-----------UPLOAD SCRIPT-----------------*/
    e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    url: './functions/'+action+'.php',
    type: 'POST',
    data:formData,
              success: function(data){
               

                  $('#notification').html(data);

$('#notification').addClass("popup");
setTimeout(function() {

$('#notification').removeClass('popup');


},1500);

setTimeout(function() {

  window.location.reload();


},1600);



  
              },cache: false,
        contentType: false,
        processData: false

 
           });


});





$('#searcher').submit(function(e){


var action = $("#searcher").attr("data-action");
console.log("action :"+action);



  e.preventDefault();
$.ajax({
    url: './functions/'+action+'.php',
    type: 'POST',
    data:$('#searcher').serialize(),
    success: function(data) {




            $('#feature').html(data);

        
      

       },
       error: function() {
        $('#feature').text('Erreur au niveau du search engine');
       }


});

  



});




$('#sender').submit(function(e){


var action = $("#sender").attr("data-action");
console.log("action :"+action);

if(action=='upload'){

  /*-----------UPLOAD SCRIPT-----------------*/
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    url: './functions/'+action+'.php',
    type: 'POST',
    data:formData,
              success: function(data){
               

                  $('#notification').html(data);

$('#notification').addClass("popup");
setTimeout(function() {

$('#notification').removeClass('popup');


},1500);

setTimeout(function() {

  window.location.reload();


},1600);



  
              },cache: false,
        contentType: false,
        processData: false

 
           });



  /*-----------UPLOAD SCRIPT-----------------*/
}




else{


  e.preventDefault();
$.ajax({
    url: './functions/'+action+'.php',
    type: 'POST',
    data:$('#sender').serialize(),
    success: function(data) {


        if(action=='certificate' || action=='user' || action=='calendar' || action=='customer' || action=='formation' || action=='partner' || action=='institute' || action=='personal' || action=='consulting' || action=='permission' ){

            $('#feature').html(data);

        }
        
        else{
     
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

  
}


});



$(".exploring").click(function() {

var path = $(this).closest(".exploring").attr("data-directory");

localStorage.setItem('directory', path);



window.location.replace('documents/');



});



</script>