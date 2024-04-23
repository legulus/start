function accordion() {
  $('.accordion-wrap:first-of-type').find('.accordion-title').addClass('-active');
  $('.accordion-wrap:first-of-type').find('.accordion-content').slideDown();
  $('.accordion-title').click(function(){
    $(this).toggleClass('-active');
    $(this).parents('.accordion-wrap').find('.accordion-content').slideToggle();
  });
}
accordion();