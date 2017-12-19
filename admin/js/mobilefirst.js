$(document.ready(function(){
	$("#competences").on("click",function(){
      $.get("competences.html", function(enter){
         $("#block").append(enter);
	  });
	});

});
