<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<?php
$args = wp_parse_args($args ?? [], [
    'class' => '',
    'movies' => [],
    'post_metas' => [],
]);
?>
<div class="flex flex-col bg-gradient-to-r from-gray-800 to-gray-900 rounded-lg">
    <?php
    $results = $args['movies'];
    if (count($results) > 0) {
        $count = 1;
        foreach ($results as $row) {
            $movie_data = json_decode(array_first($args['post_metas'], function ($meta) use ($row) {
                return $meta['post_id'] === $row->ID;
            })['meta_value'], true);
            // echo '<pre>';
            // var_dump($movie_data);
            // var_dump($row);
            // echo '</pre>';
            //Kiểm tra điều kiện nếu như kết quả tổng tập trả về lớn hơn 0
            $total_episode = '??';
            $episode = 'Đang cập nhật';
            if (isset($movie_data['episode_total']) && $movie_data['episode_total'] > 0) {
                $total_episode = $movie_data['episode_total'];
            }
            // lấy $current_episode và $episode
            if (isset($movie_data['server_name']) && $movie_data['server_name'] == 'Ophim') {
                $current_episode = count($movie_data['server_data']);
                $episode = ($current_episode > 1) ? '(' . $current_episode . '/' . $total_episode . ')' : 'Full';
            }
            if (isset($movie_data['server_name']) && $movie_data['server_name'] == 'KKphim') {
                $current_episode = 1;
                $episode = ($current_episode > 1) ? $current_episode . '/' . $total_episode : 'Full';
                if (isset($movie_data['episode_total']) && $movie_data['episode_total'] > 1) {
                    $current_episode = trim(str_replace("Tập", "", $movie_data['episode_current']));
                    $episode = '(' . $current_episode . '/' . $movie_data['episode_total'] . ')';
                    // $current_episode=count($movie_data['server_data']['sv1']['server_data']);
                    $check_trangthai = mb_stripos($movie_data['episode_current'], 'Hoàn Tất'); //Kiểm tra xem API trả về có chứa Hoàn tất
                    if ($check_trangthai !== false) {
                        $episode = trim(preg_replace('/hoàn\s*tất/iu', "", $movie_data['episode_current']));
                        // $episode = $movie_data['episode_current'];
                    }
                    // $episode=$episode=($current_episode>1)?$current_episode.'/'.$total_episode:'Full';
                }
            }
            if (isset($movie_data['server_name']) && $movie_data['server_name'] == 'Ophim16') {
                $current_episode = 1;
                $episode = ($current_episode > 1) ? $current_episode . '/' . $total_episode : 'Full';
                if (isset($movie_data['episode_total']) && $movie_data['episode_total'] > 1) {
                    $current_episode = trim(preg_replace('/\btập\b/iu', "", $movie_data['episode_current']));
                    $episode_total = trim(preg_replace('/\btập\b/iu', "", $movie_data['episode_total']));
                    $episode = '(' . $current_episode . '/' . $episode_total . ')';

                    // $current_episode=count($movie_data['server_data']['sv1']['server_data']);
                    $check_trangthai = mb_stripos($movie_data['episode_current'], 'Hoàn Tất'); //Kiểm tra xem API trả về có chứa Hoàn tất
                    if ($check_trangthai !== false) {
                        $episode = trim(preg_replace('/hoàn\s*tất/iu', "", $movie_data['episode_current']));
                        // $episode = $movie_data['episode_current'];
                    }
                    // $episode=$episode=($current_episode>1)?$current_episode.'/'.$total_episode:'Full';
                }
            }
            // end lấy $current_episode và $episode
    ?>
            <a href="<?= get_permalink($row->ID) ?>" class="block">
                <div class="p-3 flex items-center gap-3 hover:bg-gray-700 transition-colors">
                    <div class="relative">
                        <div class="absolute -top-1 -left-1 bg-yellow-400 text-black font-bold text-xs px-2 py-0.5 rounded">
                            #<?= $count ?>
                        </div>
                        <img src="<?= get_the_post_thumbnail_url($row->ID, 'thumbnail') ?>" alt="<?= $row->post_title ?>" class="w-14 h-20 rounded object-cover">
                    </div>
                    <div class="flex-1">
                        <h3 class="text-white font-semibold mb-1"><?= $row->post_title ?></h3>
                        <div class="flex items-center gap-2">
                            <?php
                            $best  = get_option('kksr_stars');
                            $score = get_post_meta($row->ID, '_kksr_ratings', true) ? ((int) get_post_meta($row->ID, '_kksr_ratings', true)) : 0;
                            $votes = get_post_meta($row->ID, '_kksr_casts', true) ? ((int) get_post_meta($row->ID, '_kksr_casts', true)) : 0;
                            $avg = $score && $votes ? round((float)(($score / $votes) * ($best / 5)), 1) : 0;
                            // $percentage=($avg/5)*10;
                            ?>
                            <span class="Vote AAIco-star"><?= $avg ?></span>
                            <svg class="w-4 h-4 text-gray-400 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-400 text-sm"><?= $episode ?></span>
                            <?= (get_field('quality', $row->ID)) ? '<span class="bg-pink-600 text-white text-xs font-bold px-2 py-0.5 rounded ml-auto">' . get_field('quality', $row->ID) . '</span>' : '' ?>
                        </div>
                    </div>
                </div>
            </a>

    <?php
            $count++;
        }
    } else {
        echo 'Chưa có dữ liệu';
    }
    ?>
</div>