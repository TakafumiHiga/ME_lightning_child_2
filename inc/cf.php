<?php
/**
 * Lightning Child theme functions
 *
 * @package lightning
 */

/************************************************
 * カスタムフィールド専用
 *
 * 
 */



/* ▼ ▼ ▼ ▼カスタム投稿 例：買取実績　カスタムフィールド表示　必要に応じて変えてください▼ ▼ ▼ ▼ */

function add_purchases_field(){?>

<?php if(is_singular('purchases')):?>

<!--  カスタムフィールドから値を取得 -->
<?php 
      $price = get_post_meta( get_the_ID(), 'purchases-price', true ); 
      $genre = get_post_meta( get_the_ID(), 'purchases-genre', true ); 
      $maker = get_post_meta( get_the_ID(), 'brands-maker', true );
      $name = get_post_meta( get_the_ID(), 'purchases-name', true );
      $point = get_post_meta( get_the_ID(), 'purchases-point', true );
      $comment = get_post_meta( get_the_ID(), 'purchases-comment', true );
  ?>
<div class="p-add-purchases-field">
  <section class="p-add-purchases-field__table">
    <h3><?php echo $price ;?>円</h3>
    <table class="table-sm mt-3 case-table">
      <tr>
        <th>商品ジャンル</th>
        <td><?php echo $genre;?></td>
      </tr>
      <tr>
        <th>ブランド/メーカー</th>
        <td><?php echo $maker;?></td>
      </tr>
      <tr>
        <th>商品名</th>
        <td><?php echo $name;?></td>
      </tr>
    </table>
  </section>
  <section class="p-add-purchases-field__text">
    <h3>査定のポイント</h3>
    <div class="p-add-purchases-field__text-area"><?php echo $point ;?></div>
  </section>
  <section class="p-add-purchases-field__text">
    <h3>査定したスタッフのコメント</h3>
    <div class="p-add-purchases-field__text-area"><?php echo $comment ;?></div>
  </section>
</div>
<div class="c-btn-wrap"><a href="<?php echo esc_url( home_url( '/purchases' ) ); ?>"
    class="c-btn c-btn--blue c-btn--cubic c-btn--shadow c-gnav-btn__contact">一覧に戻る<i
      class="far fa-arrow-alt-circle-right" style="font-size:20px; margin-right: initial; margin-left: 0.5rem;"></i></a>
</div>
<?php endif;?>

<?php }
  add_action( 'lightning_entry_body_apppend', 'add_purchases_field' );
  
  
  /* ▲▲▲▲買取実績カスタムフィールド表示▲▲▲▲*/