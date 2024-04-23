const body = $('body'),
  windowWidth = $(window).width(),
  header = $('#hd'),
  // headerHeight = header.height(),
  gnavItem = $('.gnav__item'),
  gnavChild = $('.gnavChild'),
  classShow = 'is-show';

scroll();
smoothScroll();
if (windowWidth <= 1199) {
  headerHeight = 60;
  gnavSp();
} else {
  headerHeight = 80;
  gnavPc();
};

function scroll() {
  const classView = 'is-view';
  const heroHeight = $('.hero').height();
  const classHero = 'is-hero';
  $(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
      if ($(this).scrollTop() >= headerHeight) {
        body.addClass(classView);
      }
    } else {
      body.removeClass(classView);
    }
    if ($(this).scrollTop() >= heroHeight) {
      body.addClass(classHero);
    } else {
      body.removeClass(classHero);
    }
  });
}

function smoothScroll() {
  $('a[href^="#"]').click(function () {
    const headerPosition = header.css('position'),
      speed = 500,
      href = $(this).attr("href");
      let target = $(href == "#" || href == "" ? 'html' : href),
      position;
    if (headerPosition == 'fixed') {
      position = target.offset().top - headerHeight;
    } else {
      position = target.offset().top;
    }
    $("html, body").animate({
      scrollTop: position
    }, speed, "swing");
    return false;
  });
}

function gnavPc() {
  const classHover = 'is-hover';
  const gnavItemTab = $('.gnav__item.-hover');
  gnavItemTab.mouseover(function () {
    itemthis = $(this);
    itemthis.addClass(classShow);
    body.addClass(classHover);
  }).mouseout(function () {
    itemthis.removeClass(classShow);
    body.removeClass(classHover);
  });
}

function gnavSp() {
  var gnavItemTab = $('.gnav__anc.-tab');
  gnavItemTab.click(function () {
    return false;
  })
  gnavItemTab.on("click", function () {
    var itemthis = $(this);
    itemthis.next(gnavChild).slideToggle();
    gnavChild.not(itemthis.next(gnavChild)).slideUp();
    gnavItemTab.not(itemthis).removeClass(classShow);
    itemthis.toggleClass(classShow);
    if (!(itemthis.hasClass(classShow))) {
      itemthis.removeClass(classShow);
    }
  });
  const ham = $('#js-ham'),
    classActive = 'is-active';
  ham.click(function () {
    hamClick()
  });
  function hamClick() {
    body.toggleClass(classActive);
    if (!(body.hasClass(classActive))) {
      body.removeClass(classActive);
    }
  }
}