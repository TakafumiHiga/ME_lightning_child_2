<?php
/**
 * Lightning Child theme functions
 *
 * @package lightning
 */

/************************************************
 * カスタムフィールド専用
 *
 */



/* ▼ ▼ ▼ ▼グローバルナビ 上部追加　必要に応じて変更・削除してください▼ ▼ ▼ ▼ */
function add_custom_buttons_after_logo() {
?>
<div class="custom-buttons-wrapper">
  <a href="tel:0120-000-000" class="c-gnavi-btn__tel c-tel"><i
      class="fa-solid fa-phone"></i>0000-000-000<br><span>受付：10:00-19:00（年中無休）</span></a>
  <a href="/" class="c-btn c-btn--line c-btn--cubic c-btn--shadow c-gnav-btn__line"><i class="fab fa-line"
      style="font-size:23px;"></i>LINE査定・相談<i class="far fa-arrow-alt-circle-right"
      style="font-size:20px; margin-right: initial; margin-left: 0.5rem;"></i></a>
  <a href="/" class="c-btn c-btn--blue c-btn--cubic c-btn--shadow c-gnav-btn__contact"><i class="far fa-envelope"
      style="font-size:23px;"></i>お問い合わせ<i class="far fa-arrow-alt-circle-right"
      style="font-size:20px; margin-right: initial; margin-left: 0.5rem;"></i></a>
</div>
<?php
}
add_action('lightning_site_header_logo_after', 'add_custom_buttons_after_logo');


/* グローバルナビ 上部追加時のJavaScript*/
function enqueue_custom_fadeout_script() {
    wp_add_inline_script('jquery-core', '
        jQuery(document).ready(function($) {
            $(window).on("scroll", function() {
                var scrollTop = $(this).scrollTop();

                if (scrollTop > 30) {
                    $(".custom-buttons-wrapper").fadeOut();
                } else {
                    $(".custom-buttons-wrapper").fadeIn();
                }
            });
        });
    ');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_fadeout_script', 20);