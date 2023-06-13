//アコーディオンメニュー
$(document).ready(function () {
  $('.accordion-title').click(function () {
    $(this).toggleClass('active');
    $(this).next('.accordion-content').slideToggle();
  });
});

// ハンバーガーメニュー
$(function () {
  $('.menu_trigger').click(function () {
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
      $('.nav').addClass('active');
    } else {
      $('.nav').removeClass('active');
    }
  });
  $('.nav ul li a').click(function () {
    $('.menu_trigger').removeClass('active');
    $('.g-navi').removeClass('active');
  });
});
