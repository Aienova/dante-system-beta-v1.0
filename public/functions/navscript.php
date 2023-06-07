<script>
$("#nextbutton").click(function() {


  

var page = $(this).closest("#pagecount").attr("data-count");

var count = $(this).closest("#currentpage").attr("data-count");

count++;

console.log(page);
console.log(count);




if(count>page){

  count=page;
}



console.log("move to:"+count);



$('.formpart').addClass('hidden');



$('#page-'+count).removeClass('hidden');


$("#currentpage").attr("data-count",count);


});


$("#prevbutton").click(function() {


var page = $(this).closest("#pagecount").attr("data-count");

var count = $(this).closest("#currentpage").attr("data-count");

count--;


console.log("move to:"+page);



if(count<1){

count=1;
}

$('.formpart').addClass('hidden')

$('#page-'+count).removeClass('hidden');

$("#currentpage").attr("data-count",count);


});

</script>
