<?php
/**
* seminarで表示する記事ページにカスタムフィールドの値を追加
*/

function add_seminar_status() {
global $post;

if (is_singular('seminar') && isset($post->ID)) {
$seminar_status_array = CFS()->get('seminar_status', $post->ID);

// 配列から最初のキーを取得する
if (!empty($seminar_status_array)) {
$seminar_status = key($seminar_status_array); // 配列の最初のキーを取得
echo '<span>' . esc_html($seminar_status) . '</span>';

// 満員御礸の場合、申込受付終了のボタンを表示
if ($seminar_status === '満員御礼') {
echo '<button disabled="disabled" style="cursor: not-allowed; opacity: 0.5;">申込受付を終了しました</button>';
}
} else {
echo '<span>情報が設定されていません</span>';
}
}
}

add_action('lightning_main_section_prepend', 'add_seminar_status');


//
function add_seinminar_status_entry_body_apppend() {
global $post;

if (is_singular('seminar') && isset($post->ID)) {
$seminar_status_array = CFS()->get('seminar_status', $post->ID);

// 配列から最初のキーを取得する
if (!empty($seminar_status_array)) {
$seminar_status = key($seminar_status_array); // 配列の最初のキーを取得
echo '<span>' . esc_html($seminar_status) . '</span>';
} else {
echo '<span>情報が設定されていません</span>';
}
}
}

add_action('lightning_entry_body_apppend', 'add_seinminar_status_entry_body_apppend');

//カスタム投稿seminar一覧ページに過去に開催したセミナーを表示する
function display_on_seminar_list() {
// カスタム投稿タイプ 'seminar' のアーカイブページであるか確認
if (is_post_type_archive('seminar')) {
// 'seminar_open_close' タクソノミーで 'on-seminar' タームに属する投稿を取得
$args = array(
'post_type' => 'seminar',
'posts_per_page' => -1, // すべての該当する投稿を表示
'tax_query' => array(
array(
'taxonomy' => 'seminar_open_close',
'field' => 'slug',
'terms' => 'off-seminar',
),
),
);

$query = new WP_Query($args);

if ($query->have_posts()) {
echo '<div class="on-seminar-list">
  <h3>過去に開催したセミナー</h3>
  <ul>';
    while ($query->have_posts()) {
    $query->the_post();
    echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
    }
    echo '</ul>
</div>';
// メインクエリのポストデータをリセット
wp_reset_postdata();
} else {
echo '<p>No seminars currently open.</p>';
}
}
}

add_action('lightning_loop_after', 'display_on_seminar_list'); // または、テーマのデザインや構造に合わせた適切なフック

/**
* セミナー一覧にカスタムフィールドの値を追加
*/
function custom_seminar_archive_cf($options) {
if ('seminar' === get_post_type()) {
global $post;
$append_html = '';

// カスタムフィールドの値を取得する
$seminar_status_array = CFS()->get('seminar_status', $post->ID);

// カスタムフィールドの値が存在する場合、それを表示する
if (!empty($seminar_status_array)) {
$seminar_status = reset($seminar_status_array); // 配列の最初の要素を取得
ob_start();
?>
<h5 class="p-works__item-title"><span
    class="p-works__item-cf"><?php echo esc_html($seminar_status); ?></span><?php the_title(); ?></h5>
<?php
            $append_html .= ob_get_clean();
        }

        // オプションにHTMLを追加する
        $options['body_append'] .= $append_html;
    }

    return $options;
}

add_filter('vk_post_options', 'custom_seminar_archive_cf');