$(document).ready(function () {

// $("body").css("background-color", "white");
 $(".footer-wrapper").css({
            'position': 'relative'
            });
$("html").css("background-color", "");
$(".icon-burger,#header-item").click(function(){
$(".slider-header").toggle();
});
$(".icon-cross").click(function(){
     $(".arrow-down").toggle();
     $(".slider-header").toggle();
});


function scrollToElement(selector, callback){
    var animation = {scrollTop: $(selector).offset().top};
    $('html,body').animate(animation, 'slow', 'swing', function() {
        if (typeof callback == 'function') {
            callback();
        }
        callback = null;
    });
}
  $(".arrow-down").click(function() {
    var goTo = $(".gap").offset().top - 65;
     $('body').css('overflow-y', 'auto');
     $('body').css('background-color', '#ECECEC');
     $('html, body').animate({
        scrollTop: goTo
    }, 500);
    
});



 var imgSrc = $('#first-slide img:first-child').attr('data-src');
 var imgSrcTwo = $('#second-slide img:first-child').attr('data-src');
 var imgSrcThree = $('#third-slide img:first-child').attr('data-src');
 var imgSrcFour = $('#forth-slide img:first-child').attr('data-src');
 var imgSrcFive = $('#fifth-slide img:first-child').attr('data-src');

$('.ls-inner').children('div').children('img').remove();

$('#post-3247').remove();

$('.homepage-slider').html('<ul><li><div class="new-img ls-bg ls-preloaded"></div></li><li><div class="new-img-two ls-bg ls-preloaded"></div></li><li><div class="new-img-three ls-bg ls-preloaded"></div></li><li><div class="new-img-four ls-bg ls-preloaded"></div></li><li><div class="new-img-five ls-bg ls-preloaded"></div></li></ul>');
$('.new-img').css('background-image', 'url(' + imgSrc + ')');
$('.new-img-two').css('background-image', 'url(' + imgSrcTwo + ')');
$('.new-img-three').css('background-image', 'url(' + imgSrcThree + ')');
$('.new-img-four').css('background-image', 'url(' + imgSrcFour + ')');
$('.new-img-five').css('background-image', 'url(' + imgSrcFive + ')');
$('.homepage-slider ul li').children().css({
    'background-repeat': 'no-repeat',
    'background-size': 'cover',
    'background-position': 'center',
    'width': '100%',
    'height': '100vh'

});


//slider functions
 //button click


// automatic rotation of slides
   function loadthis() {
    var slider = $(".homepage-slider ul");
    var left = slider.css('margin-left');
    var news = parseInt(left, 10);
    var slideContainer = $('.homepage-slider ul').css('overflow-x', 'hidden').children('li'),
    imgsLen = slideContainer.length,
    imgWidth = slideContainer.width();
    totalImgsWidth = imgsLen * imgWidth;
    var slider = $(".homepage-slider ul");
    var numbs = imgWidth + news;
    if(news == 0){
    slider.animate( { 'margin-left': -numbs}); 
    } 

    else if(news < 0 && news > -totalImgsWidth+imgWidth+imgWidth) {
     // console.log(-imgWidth + news)
    slider.animate( { 'margin-left': -imgWidth + news}); 
    }  

    else {
         slider.animate( { 'margin-left': 0 }); 
    }

}
   window.setInterval(loadthis, 5000);


    


    })
    
   }
});




