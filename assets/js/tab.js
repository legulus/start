$(document).ready(function(){
  if($('[data-tab]') && $('[data-tab-content]')) {
    $('[data-tab-content]').hide();
    $('[data-tab-content="' + $('.-active[data-tab]').data('tab') + '"]').show();
    $('[data-tab]').click(function(){
      $(this).siblings().removeClass('-active');
      $(this).addClass('-active');
      var thisContent = $('[data-tab-content="' + $(this).data('tab') + '"]');
      thisContent.siblings().hide();
      thisContent.show();
    });
    $('.js-tabOtherBtn').click(function() {
      const thisDataTab = $(this).data('tab');
      $('[data-tab]').removeClass('-active');
      $('[data-tab]').each(function() {
        if($(this).data('tab') == thisDataTab) {
          $(this).addClass('-active');
        }
      });
    });
  }
});