$(document).ready(function(){

    //頁籤
    $('.list_map > li').click(function(e){
        $(this).closest('ul').find('li').removeClass('on');
        $(this).addClass('on');
      
        
        $('div.inBox_map').removeClass('on');
        $('div.inBox_map.'+$(this).attr('data-target')).addClass('on');

        $('div.YueLao_block').removeClass('on');
        $('div.YueLao_block.'+$(this).attr('data-target')).addClass('on');
    });
   

  //header_nav點擊
  $("button.hamburger").on("click", function(){
    $(this).toggleClass("is-active");
    let t = $(this).hasClass("is-active");
    if(t){    
      $('.barList').css('right','0');
    }else{
        $('.barList').removeAttr('style');
        
       } 
  });
 
  //只for首頁
  // $('body').css('overflow','hidden');
 

});










