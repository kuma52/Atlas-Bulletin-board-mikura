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

//postへのいいね・unいいね
$(document).on('click', '.like_btn', function (e) {
  e.preventDefault();
  $(this).addClass('un_like_btn');//thisはクリックされた要素 にun_like_btnクラスを付ける
  $(this).removeClass('like_btn');
  let post_id = $(this).attr('post_id');//iタグのpost_id属性を取得
  let count = $('.favorite_counts' + post_id).text();//favorite_countsクラスを持つ要素のテキストコンテンツがcount変数に代入される
  let countInt = Number(count);
  $.ajax({//Ajaxリクエストを行なっていくよー
    headers: {//リクエストヘッダーに追加する情報を指定
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method: 'POST',//HTTPメソッドを指定 type:ていうかきかたもあるぽ 何が違うん？
    url: '/postfavorite/post/' + post_id,//リクエスト先のURLを指定
    // url: '{{ route("post.favorite", ["id" => ":post_id"]) }}'.replace(':post_id', post_id),//<-この書き方はできない
    data: {//サーバーに送信するデータ
      post_id: $(this).attr('post_id'),
      // 'post_id': post_id
    },
  })
    .done(function (res) {//Ajaxリクエスト成功の場合
      console.log(res);
      $('.favorite_counts' + post_id).text(countInt + 1);
      // var url;
    }).fail(function (res) {//Ajaxリクエスト失敗の場合
      console.log('fail');
      // console.log('エラー');
      // console.log(err);
      // console.log(whr);
    });
});

$(document).on('click', '.un_like_btn', function (e) {
  e.preventDefault();
  $(this).removeClass('un_like_btn');
  $(this).addClass('like_btn');
  var post_id = $(this).attr('post_id');
  var count = $('.favorite_counts' + post_id).text();
  var countInt = Number(count);

  $.ajax({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    method: "post",
    url: "/postunfavorite/post/" + post_id,
    data: {
      post_id: $(this).attr('post_id'),
    },
  }).done(function (res) {
    $('.favorite_counts' + post_id).text(countInt - 1);
  }).fail(function () {

  });
});
