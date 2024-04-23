// pickup
$(document).ready(function(){
  if (windowWidth <= 749) {
    var items = $(".pickup__item");
    if(items.length >= 4){
      items.slice(3).hide(); // Hide items starting from the fourth one
      var toggleButtonArea = $('<div class="pickup__btnarea"></div>');
      toggleButtonArea.insertAfter(".pickup__list");
      var toggleButton = $('<p class="btn -blue -arrow pickup__btn">ピックアップをもっと見る</p>');
      toggleButtonArea.append(toggleButton);
      toggleButton.click(function(){
        if($(this).hasClass('-active')) {
          $(this).removeClass('-active').text('ピックアップをもっと見る');
        } else {
          $(this).addClass('-active').text('ピックアップを閉じる');
        }
        items.slice(3).slideToggle();
      });
    }
  }
});