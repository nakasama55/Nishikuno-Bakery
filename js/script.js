//TOPのMENUのスライダー

$(document).ready(function(){
  $('.slider').slick({
    autoplay: true, //自動再生
    infinite: true, //スライドのループ有効化
    dots: true, //ドットのナビゲーションを表示
    slidesToShow: 4, //表示するスライドの数
    slidesToScroll: 4, //スクロールで切り替わるスライドの数
    responsive: [{
      breakpoint: 600, //ブレークポイントが600px
      settings: {
        slidesToShow: 3, //表示するスライドの数
        slidesToScroll: 3, //スクロールで切り替わるスライドの数
      }
    }, {
      breakpoint: 480, //ブレークポイントが480px
      settings: {
        slidesToShow: 2, //表示するスライドの数
        slidesToScroll: 2, //スクロールで切り替わるスライドの数
      }
    }]
  });
});


//TOPのMAINのスライドショー
$(function () {
	$(".slick01").slick({
		fade: true,            // fedeオン
		speed: 1200,           // 画像切り替えにかかる時間（ミリ秒）
		autoplaySpeed: 2000,   // 自動スライド切り替え速度
		arrows: false,         // 矢印表示・非表示
		autoplay: true,        // 自動再生
		slidesToShow: 1,       // スライド表示数
		slidesToScroll: 1,     // スライドする数
		infinite: true         // 無限リピート オン・オフ
		});
});


//ハンバーガーメニュー 1
$(function () {
  $('#js-hamburger-menu, .navigation__link').on('click', function () {
    $('.navigation').slideToggle(500)
    $('.hamburger-menu').toggleClass('hamburger-menu--open')
  });
});

//ハンバーガーメニュー 2
(function($) {
  $(function () {
    $('#nav-toggle').on('click', function() {
      $('body').toggleClass('open');
    });
  });
})(jQuery);


//フェードのアニメーション
$(function(){
    // ウインドウをスクロールしたら
	$(window).scroll(function (){
        // .js-fadeのクラスを持つ要素（それぞれに対して）
		$('.js-fade').each(function(){
            // この要素のスクロール位置（上から）
			var pos = $(this).offset().top;
            // ウインドウのスクロール量（上から）
			var scroll = $(window).scrollTop();
            // ウインドウの縦幅
			var windowHeight = $(window).height();
            // ウインドウのスクロール量（上から）が
            // この要素のスクロール位置 - ウインドウの縦幅 + 100pxより大きい場合
			if (scroll > pos - windowHeight + 100){
                // .scrollというクラス.js-fadeに付与する
				$(this).addClass('scroll');
			}
		});
	});
});
