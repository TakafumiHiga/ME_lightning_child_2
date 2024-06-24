<?php wp_footer(); ?>
<!-- CTAを表示させたくないスラッグを記載する -->
<?php if( is_page(array('contact','contact/confirm','document-contact','document-contact/confirm','success_stories','success_stories/confirm','seminar_entry','seminar_entry/confirm')) ): ?>
<?php else : ?>
<!-- モバイルのみ表示したい場合はコメントアウトを外してください -->
<?php //if(wp_is_mobile()) : ?>
<!-- floatingボタン 適宜テキスト、class名変更して下さい。-->
<div id="footerFloatingMenu" class="footerFloatingMenu">
  <a href="tel:000-000-000" class="footerFloatingMenu__btn c-tel-btn c-btn c-btn--blue c-btn--cubic c-btn--shadow"><i
      class="fas vk_button_link_before fa-phone"></i>電話で問い合わせる</a>
  <a href="<?php bloginfo('url'); ?>/contact"
    class="footerFloatingMenu__btn c-contact-btn c-btn c-btn--orange c-btn--cubic c-btn--shadow"><i
      class="far vk_button_link_before fa-envelope"></i>メールで問い合わせる</a>
  <?php //endif ?>
  <?php endif ?>
</div>
<script>
jQuery(function() {
  var topBtn = jQuery('#footerFloatingMenu');
  topBtn.hide();
  jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 200) { // 200pxで表示
      topBtn.fadeIn();
    } else {
      topBtn.fadeOut();
    }
  });
});
</script>
</body>

</html>