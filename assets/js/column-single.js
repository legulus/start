function toc() {
  const toc_term = $('.toc__term');
  toc_term.html('<span class="toc__term__main">目次</span><span class="toc__btn is-active">[ <span class="text">非表示</span> ]</span>');

  const toc_btn = $('.toc__btn'),
  toc_btn_text = $('.toc__btn .text'),
  toc_desc = $('.toc__desc'),
  active = ('is-active');
  toc_btn.on("click",function(){
    if (toc_desc.css('display') == 'none') {
      toc_desc.slideDown(400);
      toc_btn_text.text("非表示");
      toc_btn.addClass(active);
    } else {
      toc_desc.slideUp(400);
      toc_btn_text.text("表示");
      toc_btn.removeClass(active);
    };
  });
};

toc();