$( document ).ready(function() {
    var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};
if(isMobile.any()) {
$(".imagen > img").hide(); 
$(".logo1 img").insertAfter($(".headerlo img"));

$('<img id="theImg" src="img/stars.png" />').insertAfter($(".logo1 "));
 $("video").hide();

   //some code...
$(".parrafoform").css("font-size","3em");
$(".parrafoform").css("padding-top","40px");
   $(".actionss").removeClass("actionss");
        $(".claslogin").removeClass("claslogin");
        $(".btnact").hide();
        $(".form form").css("width","90%");
$(".imagen").css("z-index","999");

}
$( ".btnact" ).delay(800).mouseover();
setTimeout(function(){
$(".activar").click(); 
$(".activar").removeClass("activar");  

}, 10);

setTimeout(function(){  
$(".action21").mouseover();
$(".action21").removeClass("action21");
 
}, 3000);

var menu1=1
                $(".btnact").mouseover(function(){
                      
                        $(".actionss").removeClass("actionss");
                        $(".claslogin").removeClass("claslogin");
                        $(".imagen").addClass("imagen11")
                    });
                        menu1 = 0;
                        
                        $(".btnact").click(function(){
                        $(".login-form, .parrafoform").addClass("actionss");
                        $(".form").addClass("claslogin");
                        $(".imagen11").removeClass("imagen11");
                        menu1 = 1;
                        
                    });
                
       




});



