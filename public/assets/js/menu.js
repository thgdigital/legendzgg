var ops = {
    'html':true,
    content: function(){
        return $('#poupover').html();
    }
};

$(function(){

    $('#examplepoupover').popover(ops)

$(".isLogin").click(function (event) {
    var filho = $( event.target ).children(".text-sidebar");

    $("#ezAlerts-message").text("Deve estar logado para acessar o "+filho.context.innerText.toUpperCase()+"!");

    $('#logoutModal').modal('toggle');
    event.preventDefault();
});

    $( ".menu-rifas" ).click(function() {
        $( "#sub-menu-rifa" ).toggle( "slow");
    });

   $(".main").css({'min-height': 900});
 $("#menu a").mouseover(function(){
  var menu = $(this).parent().children('.treeview-menu');
  var submenu =  $(this).parent().parent();

  if(menu.length > 0 && menu.is(':hidden')){
   $("#menu a").removeClass('ativo');
   $(this).addClass('ativo');
   $('.treeview-menu').slideUp();
   var icon = $(this).last();

   if(icon.find(".fa-angle-left")){
     var left = icon.find(".fa-angle-left");
     left.removeClass('fa-angle-left');
     left.addClass('fa fa-angle-down');

   }else{
     console.log(icon.hasClass("fa fa-angle-down"))

   }
   menu.slideDown();
 }
 if(!submenu.hasClass('treeview-menu') && menu.length == 0){
   $("#menu a").removeClass('ativo');
   $(this).addClass('ativo');
   var icon = $(this).last();

   if(icon.find(".fa-angle-left")){
     var left = icon.find(".fa-angle-left");
     left.removeClass('fa-angle-left');
     left.addClass('fa fa-angle-down');
   }else{

   }
   $('.treeview-menu').slideUp();
 }

});
 $("#active-sidebar").click(function() {
  if ($("#menu-sidebar").hasClass("text-hinden")){

    $("#sidebar").css('width', "200px");

   $("#menu-sidebar").removeClass('text-hinden');
   $(".nav-sidebar-sub").removeClass('text-hinden');
   $("#rede-social").removeClass('text-margin');
 

  }else{
    
    $(".nav-sidebar").addClass("text-hinden");
    $(".nav-sidebar-sub").addClass("text-hinden");
    $("#rede-social").addClass('text-margin');
    $("#sidebar").css('width', "60px");
  }
  widthConatiner()

});
 $(".close-propaganda").click(function() {
     $(".header-roleta").hide();
 })

 //Clicando sidebar
$(".box-hideen").click(function() {
    $(".sidebar-right").hide();
    // $(".contant-slider").css({"width": "57%", "margin-left": "0px"});
    $("#loja-inventario").css({"width": "40%",  "float": "right"});
    widthConatiner()
  });
$(".chat").click(function() {
  if($(".sidebar-right").is(':hidden')){
    $(".sidebar-right").show();


    // $(".contant-slider").css({"width": "100%"});
    $("#loja-inventario").css({"width": "100%", "float": "left"});

  }
   widthConatiner()
})

// Calculando a Div 
$(window).resize(function() {
    //update stuff
    widthConatiner()
  });
   widthConatiner()

});
// 
function widthConatiner(){
 var widthMain = $(".conteudo").width();
 
  // $(".sidebar").css({'height': $(".main").height() + 150});
var $el = $('#sidebar');  //record the elem so you don't crawl the DOM everytime  
var bottom = $el.position().top + $el.outerHeight(true);
 


   if($(".sidebar-right").is(':visible') && !$("#menu-sidebar").hasClass("text-hinden")){


    // $("#menu-sidebar").addClass("text-hinden");
    $("body").removeClass('menu-hidden');
    $("body").removeClass('chat-hidden');

  }else if($(".sidebar-right").is(':hidden') && $("#menu-sidebar").hasClass("text-hinden")){
    $("body").addClass('menu-hidden');
    $("body").addClass('chat-hidden');

   
  }else if($(".sidebar-right").is(':hidden')){


  $("body").addClass('menu-hidden');
  $("body").removeClass('chat-hidden');

  }else if($("#menu-sidebar").hasClass("text-hinden")){


 $("body").removeClass('menu-hidden');
  $("body").addClass('chat-hidden');
   
  }else{
    console.log($("#menu-sidebar").hasClass("text-hinden"));
  }

}
function addCssDinamico(width, left){
  $(".main").css({
    // "left": left,
    "width": 860
  });
}