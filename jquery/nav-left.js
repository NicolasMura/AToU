$(document).ready(function(){
	
  $("#menuBurger a").on("click", function(e){
    e.preventDefault();
	
	console.log("prevent");
	
    var hrefval = $(this).attr("href");
	
	console.log(hrefval);
    
    if(hrefval == "#about") {
      var distance = $('.content').css('left');
      
      if(distance == "auto" || distance == "0px") {
        $(this).addClass("open");
        openSidepage();
      } else {
        closeSidepage();
      }
    }
  }); // end click event handler
  
 /* $(".black nav #menuBurger a").on("hover", function(){
    var classval = $(this).hasClass("hovertrigger");
    
    if(classval == true) {
      var distance = $('.content').css('left');
      
      if(distance == "auto" || distance == "0px") {
        $(this).addClass("open");
        openSidepage();
      }
    }
  }); // end hover event handler*/

  function openSidepage() {
	  
	  console.log($(".content").animate());
	  
    $(".content").animate({
      left:'260px'
    }, 400, 'easeOutBack'); 
  }
  
  function closeSidepage(){
	  
	   console.log($(".content").animate());
	  
    $("#menuBurger a").removeClass("open");
    $('.content').animate({
      left: '0px'
    }, 400, 'easeOutQuint');  
  }
}); 