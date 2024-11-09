<?php

/**
 * 
 * generate custom thumbnail tag 
 */
function i8_the_thumbnail($size_name, $class = '', $dimension = array("width" => 70, "height" => 70), $default_img = true, $style = '', $lazy_load = true, $decoding_async = false)
{
    $default_thumbnail_url = get_template_directory_uri() . '/images/global/no-image.webp';
    $lazyLoad = ($lazy_load) ? ' loading="lazy" ' : '';
    $decodingAsync = ($decoding_async) ? 'decoding="async"' : '';

    $thumbnail_id = get_post_thumbnail_id();
    $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
    $thumbnail_alt = !empty($thumbnail_alt) ? $thumbnail_alt : get_the_title();
    $thumbnail_src = wp_get_attachment_image_src($thumbnail_id, $size_name);
    $thumbnail_srcset = wp_get_attachment_image_srcset($thumbnail_id, $size_name);
    $style = ($style) ? 'style="' . $style . ' "' : '';

    if (has_post_thumbnail() && $thumbnail_src) {
        return '<img width="' . $dimension["width"] . '" height="' . $dimension["height"] . '" class="' . $class . '" alt="' . esc_attr($thumbnail_alt) . '"  ' . '" aria-label="' . esc_attr($thumbnail_alt) . '"  ' . $lazyLoad . ' ' . $decodingAsync . '  src="' . esc_url($thumbnail_src[0]) . '" ' . $style . '  />';
    } elseif ($default_img) {
        return '<img width="' . $dimension["width"] . '" height="' . $dimension["height"] . '" class="' . $class . '" alt="' . esc_attr(get_the_title()) . '" ' . $lazyLoad . ' ' . $decodingAsync . '  src="' . esc_url($default_thumbnail_url) . '" ' . $style . '  />';
    }
    return '';
}


/**
 * Make custom pagination 
 */
function i8_custom_pagination()
{
    global $wp_query;
    $total_posts = $wp_query->found_posts; // تعداد کل مطالب
    $big = 999999999; // عدد بزرگ برای جایگزینی در URL صفحه‌بندی

    $paginate_links = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%', // فرمت URL صفحه‌های بندی
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_next' => true,
        'prev_text' => '&lt; قبلی',
        'next_text' => 'بعدی &gt;',
    ));

    if ($paginate_links) {
        ?>
        <div class="row mt-3 py-2 mx-0 d-flex align-content-center justify-content-center">
            <div class="number-pagintion py-2 my-2">
                <div class="pagination pagination-archive">
                    <small>تعداد کل مطالب:
                        <?php echo $total_posts; ?>
                    </small>
                    <?php echo $paginate_links; ?>
                </div>
            </div>
        </div>
        <?php
    }
}


/**
 * 
 * limit string-text by character-base system
 */
function i8_limit_text($text, $limit_count, $ending_text)
{
    // تنظیم محدودیت تعداد حروف  
    $limited_text = mb_substr($text, 0, $limit_count);

    // اگر عنوان اصلی بیشتر از محدودیت حرف بود، متن پایانی  را به عنوان نمایش ادامه اضافه کنید
    if (mb_strlen($text) > $limit_count) {
        $limited_text .= $ending_text;
    }

    // نمایش متن محدود شده
    echo $limited_text;
}

/**
 * 
 * 
 *  add Sub title to post edit page
 *
 * 
 */
function add_custom_subtitle_field()
{
    add_action('edit_form_after_title', 'custom_subtitle_field');
}

add_action('add_meta_boxes', 'add_custom_subtitle_field');

function custom_subtitle_field()
{
    $value = get_post_meta(get_the_ID(), '_post_subtitle', true);
    echo '<input type="text" class="widefat" id="post_subtitle" name="post_subtitle" value="' . esc_attr($value) . '" placeholder="روتیتر" size="25" />';
}

function save_post_subtitle($post_id)
{

    if (isset($_POST['post_subtitle'])) {
        update_post_meta($post_id, '_post_subtitle', sanitize_text_field($_POST['post_subtitle']));
    }
}

add_action('save_post', 'save_post_subtitle');




/**
 * 
 * Add Primary Category meta data Feature to post page 
 * با این قابلیت میتونیم یک دسته بندی اصلی از بین دسته های انتخاب شده در زمان انتشار مطلب انتخاب کنیم
 * 
 */

// اضافه کردن یک متا باکس جدید به صفحه ایجاد و ویرایش پست ها
add_action('add_meta_boxes', 'add_primary_category_meta_box');
function add_primary_category_meta_box()
{
    add_meta_box('primary_category_meta_box', 'داشبورد ویژه', 'render_primary_category_meta_box', 'post', 'side', 'high');
}

// نمایش متا باکس دسته بندی اصلی
function render_primary_category_meta_box($post)
{
    // بررسی آیا دسته بندی اصلی قبلا انتخاب شده است
    $selected_category = get_post_meta($post->ID, 'hasht_primary_category', true);

    // دریافت لیست دسته بندی های پست ها
    $categories = get_categories(array('hide_empty' => false));

    // نمایش لیست کشویی با دسته بندی ها
    echo '<div class="misc-pub-section"><label for="hasht-primary-category">انتخاب دسته بندی اصلی:</label>';
    echo '<select name="hasht_primary_category" class="widefat" id="hasht-primary-category">';
    echo '<option value="">انتخاب کنید</option>';
    foreach ($categories as $category) {
        echo '<option value="' . esc_attr($category->cat_ID) . '" ' . selected($selected_category, $category->cat_ID, false) . '>' . esc_html($category->name) . '</option>';
    }
    echo '</select></div>';


    ?>
    <!-- نام منبع -->
    <div class="misc-pub-section">
        <label for="hasht-reference-name">نام منبع:</label>
        <input type="text" name="hasht-reference-name" id="hasht-reference-name" class="widefat"
            value="<?php echo get_post_meta($post->ID, 'hasht-reference-name', true); ?>">
    </div>

    <!-- لینک منبع -->
    <div class="misc-pub-section">
        <label for="hasht-reference-link">لینک منبع:</label>
        <input type="text" name="hasht-reference-link" id="hasht-reference-link" class="widefat"
            value="<?php echo get_post_meta($post->ID, 'hasht-reference-link', true); ?>">
    </div>

    <!-- نام نویسنده -->
    <div class="misc-pub-section">
        <label for="hasht-author-name">نام نویسنده:</label>
        <input type="text" name="hasht-author-name" id="hasht-author-name" class="widefat"
            value="<?php echo get_post_meta($post->ID, 'hasht-author-name', true); ?>">
    </div>


    <!-- نوع پست -->
    <?php
    $array_post_structure = array('video', 'imgae', 'text', 'hot','none-thumbnail');
    $selected_post_structure = get_post_meta($post->ID, 'i8_post_structure', true);
    $selected_post_structure = ($selected_post_structure == '') ? 'text' : $selected_post_structure;
    ?>
    <div class="misc-pub-section"><label for="hasht-primary-category">
            <label for="i8_post_structure">نوع پست</label>
            <select name="i8_post_structure" id="i8_post_structure" class="widefat">
                <option value="text" <?php echo ($selected_post_structure == 'text') ? 'selected' : ''; ?>>ساده</option>
                <option value="none-thumbnail" <?php echo ($selected_post_structure == 'none-thumbnail') ? 'selected' : ''; ?>>بدون تصویر </option>
                <option value="image" <?php echo ($selected_post_structure == 'image') ? 'selected' : ''; ?>>تصویری</option>
                <option value="video" <?php echo ($selected_post_structure == 'video') ? 'selected' : ''; ?>>ویدیو</option>
                <option value="hot" <?php echo ($selected_post_structure == 'hot') ? 'selected' : ''; ?>>داغ</option>
            </select>
    </div>

    <!-- لینک ویدیو -->

    <!-- لینک امبد -->
    <div id="hasht-video-embbed-sec" class="misc-pub-section " <?php echo ($selected_post_structure != 'video') ? ' style="display:none;" ' : ''; ?>>
        <label for="hasht-video-embbed">کد امبد:</label>
        <input type="text" name="hasht-video-embbed" id="hasht-video-embbed" class="widefat"
            value="<?php echo esc_attr(get_post_meta($post->ID, 'hasht-video-embbed', true)); ?>">
    </div>

    <!-- لینک مستقیم -->
    <div id="hasht-video-link-sec" class="misc-pub-section " <?php echo ($selected_post_structure != 'video') ? ' style="display:none;" ' : ''; ?>>
        <label for="hasht-video-link">لینک ویدیو:</label>
        <input type="text" name="hasht-video-link" id="hasht-video-link" class="widefat"
            value="<?php echo get_post_meta($post->ID, 'hasht-video-link', true); ?>">
    </div>

    <!-- کیفیت زیاد - لینک مستقیم -->
    <div id="hasht-video-link-high-sec" class="misc-pub-section " <?php echo ($selected_post_structure != 'video') ? ' style="display:none;" ' : ''; ?>>
        <label for="hasht-video-link-high">لینک ویدیو(کیفیت بالا)</label>
        <input type="text" name="hasht-video-link-high" id="hasht-video-link-high" class="widefat"
            value="<?php echo get_post_meta($post->ID, 'hasht-video-link-high', true); ?>">
    </div>
    <!-- کیفیت کم - لینک مستقیم -->
    <div id="hasht-video-link-low-sec" class="misc-pub-section " <?php echo ($selected_post_structure != 'video') ? ' style="display:none;" ' : ''; ?>>
        <label for="hasht-video-link-low">لینک ویدیو(کیفیت پایین)</label>
        <input type="text" name="hasht-video-link-low" id="hasht-video-link-low" class="widefat"
            value="<?php echo get_post_meta($post->ID, 'hasht-video-link-low', true); ?>">
    </div>


    <!-- نمایش تاریخ  -->
    <?php
    $i8_hide_date = (get_post_meta($post->ID, 'i8_hide_date', true) == 'on') ? ' checked' : '';
    // فیلد مخفی سازی تاریخ دلخواه
    echo '<div class="misc-pub-section"><label  for="i8_hide_date"> مخفی سازی تاریخ ';
    echo '<input type="checkbox" class="widefat" name="i8_hide_date" id="i8_hide_date" ' . $i8_hide_date . '>';
    echo '</label></div>';
    ?>

    <script>
        jQuery(document).ready(function ($) {
            // هنگام تغییر در selectbox
            $("#i8_post_structure").change(function () {
                var selectedValue = $(this).val();

                // اگر گزینه مشخص شده "option2" باشد
                if (selectedValue === "video") {
                    // نمایش input باکس
                    $("#hasht-video-link-sec").show();
                    $("#hasht-video-embbed-sec").show();
                } else {
                    // پنهان کردن input باکس
                    $("#hasht-video-link-sec").hide();
                    $("#hasht-video-embbed-sec").hide();
                }

            });
        });
    </script>


    <?php
}



/**
 * 
 * Save Meta box Values in Datatbase
 * 
 */
add_action('save_post', 'save_primary_category_meta_data');
function save_primary_category_meta_data($post_id)
{
    if (isset($_POST['hasht_primary_category'])) {
        update_post_meta($post_id, 'hasht_primary_category', sanitize_text_field($_POST['hasht_primary_category']));
    }

    if (isset($_POST['i8_hide_date'])) {
        update_post_meta($post_id, 'i8_hide_date', 'on');
    } else {
        update_post_meta($post_id, 'i8_hide_date', 'off');
    }

    if (isset($_POST['hasht-reference-name'])) {
        update_post_meta($post_id, 'hasht-reference-name', $_POST['hasht-reference-name']);
    }

    if (isset($_POST['hasht-reference-link'])) {
        update_post_meta($post_id, 'hasht-reference-link', $_POST['hasht-reference-link']);
    }

    if (isset($_POST['hasht-author-name'])) {
        update_post_meta($post_id, 'hasht-author-name', $_POST['hasht-author-name']);
    }

    if (isset($_POST['i8_post_structure'])) {
        update_post_meta($post_id, 'i8_post_structure', sanitize_text_field($_POST['i8_post_structure']));
    }

    if (isset($_POST['hasht-video-link'])) {
        update_post_meta($post_id, 'hasht-video-link', sanitize_text_field($_POST['hasht-video-link']));
    }

    if (isset($_POST['hasht-video-embbed'])) {
        update_post_meta($post_id, 'hasht-video-embbed', $_POST['hasht-video-embbed']);
    }

    if (isset($_POST['hasht-video-link-high'])) {
        update_post_meta($post_id, 'hasht-video-link-high', sanitize_text_field($_POST['hasht-video-link-high']));
    }

    if (isset($_POST['hasht-video-link-low'])) {
        update_post_meta($post_id, 'hasht-video-link-low', sanitize_text_field($_POST['hasht-video-link-low']));
    }



    // print and show $_POST value in consle
    // if (!empty($_POST)) {
    //     echo '<script>console.log(' . json_encode($_POST) . ');</script>';
    // }
}


function show_post_structure_related_icon($post_id)
{

    $image_icon = '<svg width="20" height="21" class="ms-2" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M1.6665 16.1667V7.83337C1.6665 6.9129 2.4127 6.16671 3.33317 6.16671H3.74984C4.27443 6.16671 4.76841 5.91972 5.08317 5.50004L6.93317 3.03337C7.0276 2.90747 7.1758 2.83337 7.33317 2.83337H12.6665C12.8239 2.83337 12.9721 2.90747 13.0665 3.03337L14.9165 5.50004C15.2313 5.91972 15.7253 6.16671 16.2498 6.16671H16.6665C17.587 6.16671 18.3332 6.9129 18.3332 7.83337V16.1667C18.3332 17.0872 17.587 17.8334 16.6665 17.8334H3.33317C2.4127 17.8334 1.6665 17.0872 1.6665 16.1667Z" stroke="var(--i8-light-secondary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M9.99984 14.5C11.8408 14.5 13.3332 13.0076 13.3332 11.1667C13.3332 9.32579 11.8408 7.83337 9.99984 7.83337C8.15889 7.83337 6.6665 9.32579 6.6665 11.1667C6.6665 13.0076 8.15889 14.5 9.99984 14.5Z" stroke="var(--i8-light-secondary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>';
    $video_icon = '<svg width="24" height="25" class="ms-2" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M15 12.3334V16.7334C15 17.0648 14.7314 17.3334 14.4 17.3334H3.6C3.26863 17.3334 3 17.0648 3 16.7334V7.93337C3 7.602 3.26863 7.33337 3.6 7.33337H14.4C14.7314 7.33337 15 7.602 15 7.93337V12.3334ZM15 12.3334L20.0159 8.15346C20.4067 7.8278 21 8.10569 21 8.6144V16.0524C21 16.5611 20.4067 16.839 20.0159 16.5133L15 12.3334Z" stroke="var(--i8-light-secondary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>';
    // $hot_icon = '<svg width="24" height="25" class="ms-2" viewBox="0 0 21 21" version="1.1" aria-hidden="true"><title>blinking-dot</title><g><circle cx="8" cy="8" r="7.16" stroke="var(--i8-light-complete-color)" stroke-width="1.68" fill="#ffffff"></circle><circle cx="8" cy="8" r="4" fill="var(--i8-light-complete-color)"><animate attributeName="opacity" values="1;1;1;1;0;1" dur="2.5s" repeatCount="indefinite"></animate></circle></g></svg>';
    $hot_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" class="icon_animate" viewBox="0 0 24 24"><path fill="var(--i8-light-complete-color)" d="M12 6c-3.309 0-6 2.691-6 6s2.691 6 6 6s6-2.691 6-6s-2.691-6-6-6zm0 10c-2.206 0-4-1.794-4-4s1.794-4 4-4s4 1.794 4 4s-1.794 4-4 4z"></path><path fill="var(--i8-light-complete-color)" d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10s10-4.579 10-10S17.421 2 12 2zm0 18c-4.337 0-8-3.663-8-8s3.663-8 8-8s8 3.663 8 8s-3.663 8-8 8z"></path><path fill="var(--i8-light-complete-color)" d="M12 10c-1.081 0-2 .919-2 2s.919 2 2 2s2-.919 2-2s-.919-2-2-2z"></path>
    <animate attributeName="opacity" values="1;1;1;1;0;1" dur="0.5s" repeatCount="indefinite"></animate>    
    </svg>
    ';

    if (have_posts($post_id)) {
        $post_structure = get_post_meta($post_id, 'i8_post_structure', true);
        $post_structure = ($post_structure != '') ? $post_structure : '';
    }
    if ($post_structure != '') {
        switch ($post_structure) {
            case 'video':
                echo $video_icon;
                break;
            case 'image':
                echo $image_icon;
                break;
            case 'hot':
                echo $hot_icon;
                break;
            default:
                echo '';
                break;
        }
    }
}


/**
 * 
 * 
 * Retrive primary category name 
 * 
 * 
 */
function i8_primary_category($post_id, $string_return = false)
{

    $primary_cat_id = (get_post_meta($post_id, 'hasht_primary_category') != '') ? get_post_meta($post_id, 'hasht_primary_category') : '';

    if (@$primary_cat_id[0] != ''):
        $primary_cat_name = get_the_category_by_ID(intval($primary_cat_id[0]));
        $primary_cat_url = get_category_link(intval($primary_cat_id[0]));
        if (!$string_return):
            return '<a class="post-category f-15" href="' . $primary_cat_url . '" >' . $primary_cat_name . "</a>";
        else:
            return array('cat_id' => $primary_cat_id[0], 'cat_name' => $primary_cat_name, 'cat_url' => $primary_cat_url);
        endif;
    else:
        return false;
    endif;
}



/**
 * 
 * Create custom Menu Function 
 * 
 * 
 */

function build_custom_menu($items, $parent_id = 0)
{
    $menu = '';

    foreach ($items as $item) {
        if ($item->menu_item_parent == $parent_id) {
            // بررسی وجود زیرمنو
            $submenu = get_submenu_items($items, $item->ID);
            if (!empty($submenu)) {
                // اگر ساب منو داشت
                $menu .= '<li class="nav-item dropdown">';
                $menu .= '<a class="nav-link hasht-dropdown-toggle " id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down mx-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
              </svg>' . '</a>';
                $menu .= '<ul class="dropdown-menu submenu py-2" aria-labelledby="navbarDropdown">';
                $menu .= build_custom_menu($submenu, $item->ID); // فراخوانی بازگشایی
                $menu .= '</ul>';
            } else {
                //اگر ساب منو نداشت
                $menu .= '<li class="nav-item">';
                $menu .= '<a class="nav-link ';

                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
                $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                if ($url == $item->url) {
                    $menu .= ' active fw-bold';
                }
                $menu .= '" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
            }
            $menu .= '</li>';
        }
    }

    return $menu;
}


/**
 * 
 * 
 * Check Sub Menu is existing
 * 
 * 
 */
function get_submenu_items($items, $parent_id)
{
    $submenu = array();

    foreach ($items as $item) {
        if ($item->menu_item_parent == $parent_id) {
            $submenu[] = $item;
        }
    }
    // if($submenu) var_dump($submenu);
    return $submenu;
}




/**
 * 
 * 
 * Show Menus by Menu Location
 * 
 * 
 */
function build_custom_menu_by_location($location, $style_type = 'row')
{
    $locations = get_nav_menu_locations();
    $menu_id = $locations[$location];

    $menu_items = wp_get_nav_menu_items($menu_id);

    if ($menu_items) {
        $type_class = ($style_type == 'column') ? 'flex-column' : 'flex-row';
        $gap = ($style_type == 'column') ? 'gap-0' : 'gap-3';
        echo '<ul class="navbar-nav mb-lg-0 menu-list d-flex  ' . $type_class . ' flex-wrap gap-2  px-0 ' . $gap . ' ">';
        echo build_custom_menu($menu_items);
        echo '</ul>';
    }
}



/**
 * 
 * 
 * Show Menus by Menu ID
 * 
 * 
 */
function build_custom_menu_by_id($menu_id, $style_type = 'row')
{
    $menu_items = wp_get_nav_menu_items($menu_id);

    if ($menu_items) {
        $type_class = ($style_type == 'column') ? 'flex-column menu-fix' : 'flex-row';
        $gap = ($style_type == 'column') ? 'column-gap-0' : 'column-gap-3';
        echo '<ul class="navbar-nav mb-lg-0 menu-list d-flex ' . $type_class . ' g-2  px-0 flex-wrap ' . $gap . ' ">';
        echo build_custom_menu($menu_items);
        echo '</ul>';
    }
}



/**
 * 
 * Show Bread Crumnb
 * 
 */
function i8_breadcrumb(
    $delimiter = ' &nbsp;/&nbsp; ', // جداکننده بین عناصر breadcrumb
    $home = 'صفحه اصلی', // متن لینک خانه
    $before = '<span class="current">', // قبل از عنوان صفحه فعلی
    $after = '</span>' // بعد از عنوان صفحه فعلی 
) {

    global $post;
    if (is_home() || is_front_page()) {
        echo '<a class="text-grey br-home" href="' . home_url() . '">' . $home . '</a>';
    } else {
        echo '<a class="text-grey br-home" href="' . home_url() . '">' . $home . '</a>' . $delimiter;
        if (is_single()) {
            if ($primary_cat = i8_primary_category(get_the_ID(), true)):
                $cat_color = get_term_meta($primary_cat['cat_id'], 'i8_CustomTerm_color', true) ? get_term_meta($primary_cat['cat_id'], 'i8_CustomTerm_color', true) : 'var(--bs-secondary)';
                echo '<a class=""  href="' . $primary_cat['cat_url'] . '">' . $primary_cat['cat_name'] . '</a>';
            else:
                // the_category('/ ');
                // echo $delimiter;
            endif;
        } elseif (is_page()) {
            if ($post->post_parent) {
                $anc = get_post_ancestors($post->ID);
                $anc = array_reverse($anc);
                foreach ($anc as $ancestor) {
                    $output = '<a class="text-grey" href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a>' . $delimiter;
                }
                echo $output;
                echo $before . get_the_title() . $after;
            } else {
                echo $before . get_the_title() . $after;
            }
        } elseif (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $this_category = get_category($cat_obj->term_id);
            $parent_category = get_category($this_category->parent);
            if ($this_category->parent != 0)
                echo (get_category_parents($parent_category, TRUE, ' ' . $delimiter . ' '));
            echo $before . single_cat_title('', false) . $after;
        } elseif (is_tag()) {
            echo $before . single_tag_title('', false) . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . 'نویسنده: ' . $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before . 'خطای 404' . $after;
        } elseif (is_search()) {
            echo $before . 'نتایج جستجو برای: "' . get_search_query() . '"' . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_month()) {
            echo $before . get_the_time('F Y') . $after;
        } elseif (is_day()) {
            echo $before . get_the_time('F j, Y') . $after;
        } elseif (is_post_type_archive()) {
            echo $before . post_type_archive_title('', false) . $after;
        } else {
            echo $before . get_the_title() . $after;
        }
    }
}


/**
 * hamberger mobile menu 
 */
function i8_mobile_menu($location)
{
    // آیتم های منوی یک لوکیشن را به صورت آرایه بازگردانی میکند
    $locations = get_nav_menu_locations();
    $menu_id = $locations[$location];

    $menu_name = wp_get_nav_menu_name($location);
    $menu_items = wp_get_nav_menu_items($menu_id);
    foreach ($menu_items as $menu_item) {
        if ($menu_item->menu_item_parent == 0) {
            $parent_menu[] = $menu_item;
        }
    }

    $menu = '';
    echo '<nav class="i8-h-menu ">
            <input type="checkbox" id="menu" name="menu" class="m-menu__checkbox">
            <label class="m-menu__toggle" for="menu">
            <?xml version="1.0" encoding="UTF-8"?><svg width="32px" height="32px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="var(--i8-light-fg-color)"><path d="M8 6h12M4 6.01l.01-.011M4 12.01l.01-.011M4 18.01l.01-.011M8 12h12M8 18h12" stroke="var(--i8-light-fg-color )" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </label>
             <div class="m-menu">
                <div class="m-menu__header">
                    <span> ' . $menu_name . ' </span>

                    <label class="m-menu__toggle" for="menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="var(--i8-fg-primary )" class="bi bi-x-lg" viewBox="0 0 16 16">
                          <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                        </svg>
                    </label>
                </div>
                <ul class="p-0">
        ';
    $menu = print_mobile_menu($menu_items, $parent_menu);
    echo '</ul></div></nav>';
}


/**
 * 
 * 
 * Show Mobile Menu Hamberger button and list 
 * 
 * 
 */
function print_mobile_menu($all_items, $parent_items_level)
{
    foreach ($parent_items_level as $item) {

        // بررسی وجود زیرمنو
        $submenu = get_submenu_items($all_items, $item->ID);
        $menu = '';
        if (!empty($submenu)) {
            // اگر ساب منو داشت
            echo '<li>
                        <label class="a-label__chevron me-3" for="' . esc_html($item->title) . '">' . esc_html($item->title) . '</label>
                        <input type="checkbox" id="' . esc_html($item->title) . '" name="' . esc_html($item->title) . '" class="m-menu__checkbox">
                        <div class="m-menu">
                            <div class="m-menu__header">
                                <span>' . esc_html($item->title) . '</span>
                                <label class="m-menu__toggle" for="' . esc_html($item->title) . '">
                                    <svg width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="var(--i8-light-primary )" stroke-width="1.5" stroke-linecap="butt" stroke-linejoin="arcs">
                                        <path d="M19 12H6M12 5l-7 7 7 7" />
                                    </svg>
                                </label>
                                
                            </div>
                            <ul class="p-0">';
            print_mobile_menu($all_items, $submenu);
            echo '</ul>
                        </div>
                    </li>';
        } else {
            //اگر ساب منو نداشت
            echo '<li><label><a href="' . esc_html($item->url) . '" >' . esc_html($item->title) . '</label></a></li>';
        }
    }

}


/**
 * 
 * 
 * Customize Svg to my own style
 * 
 * 
 */
function customizeSVG($svg, $fill = '#000000', $stroke = '#000000', $width = 32, $height = 32, $class = "")
{
    // Check if the SVG is not empty
    if (!empty($svg)) {
        // Check if the SVG has fill="none"
        if (strpos($svg, 'fill="none"') !== false) {
            // Replace stroke attributes with the provided $stroke value
            $svg = preg_replace('/stroke="[^"]*"/', 'stroke="' . $stroke . '"', $svg);
        } else {
            // Replace fill attributes with the provided $fill value
            $svg = preg_replace('/fill="[^"]*"/', 'fill="' . $fill . '"', $svg);
        }
    }

    // Update width and height attributes
    $svg = preg_replace('/ width="[^"]*"/', ' width="' . $width . '"', $svg);
    $svg = preg_replace('/ height="[^"]*"/', ' height="' . $height . '" class="' . $class . '"', $svg);

    return $svg;
}

/**
 * 
 * 
 * Show Social media link and icons 
 * 
 * 
 */
function i8_show_social_icons($width = 16, $height = 16)
{
    // echo get_option('i8_social_link_twitter');
    $twitter = sanitize_url(get_theme_mod('i8_social_link_twitter'));
    $instagram = sanitize_url(get_theme_mod('i8_social_link_instagram'));
    $telegram = sanitize_url(get_theme_mod('i8_social_link_telegram'));
    $youtube = sanitize_url(get_theme_mod('i8_social_link_youtube'));
    $aparat = sanitize_url(get_theme_mod('i8_social_link_aparat'));
    $whatsapp = sanitize_url(get_theme_mod('i8_social_link_whatsapp'));
    $facebook = sanitize_url(get_theme_mod('i8_social_link_facebook'));
    $eitta = sanitize_url(get_theme_mod('i8_social_link_eitta'));
    $bale = sanitize_url(get_theme_mod('i8_social_link_bale'));
    $rubika = sanitize_url(get_theme_mod('i8_social_link_rubika'));
    ?>
    <div class="d-flex">
        <div class="d-none d-xl-flex d-lg-flex d-md-flex justify-content-center gap-2 social-links ">
            <?php if ($twitter): ?>
                <a class="p-0 p-lg-0 p-sm-1 dark-btn" target="_blank" href="<?php echo $twitter; ?>" alt="twitter share button"
                    aria-label="twitter share button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $width; ?>" height="<?php echo $height; ?>"
                        fill="var(--i8-light-fg-color)" class="bi bi-twitter mx-1" viewBox="0 0 16 16">
                        <path
                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                    </svg>
                </a>
            <?php endif; ?>
            <?php if ($facebook): ?>
                <a class="p-0 p-lg-0 p-sm-1 dark-btn" target="_blank" href="<?php echo $facebook; ?>"
                    alt="facebook share button" aria-label="facebook share button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $width; ?>" height="<?php echo $height; ?>"
                        fill="var(--i8-light-fg-color)" class="bi bi-facebook mx-1" viewBox="0 0 16 16">
                        <path
                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                    </svg>
                </a>
            <?php endif; ?>
            <?php if ($telegram): ?>
                <a class="p-0 p-lg-0 p-sm-1 dark-btn" href="<?php echo $telegram; ?>" alt="telegram share button"
                    aria-label="telegram share button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $width; ?>" height="<?php echo $height; ?>"
                        fill="var(--i8-light-fg-color)" class="bi bi-telegram mx-1" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z" />
                    </svg>
                </a>
            <?php endif; ?>
            <?php if ($whatsapp): ?>
                <a class="p-0 p-lg-0 p-sm-1 dark-btn" target="_blank" href="<?php echo $whatsapp; ?>"
                    alt="whatsapp share button" aria-label="whatsapp share button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $width; ?>" height="<?php echo $height; ?>"
                        fill="var(--i8-light-fg-color)" class="bi bi-whatsapp mx-1" viewBox="0 0 16 16">
                        <path
                            d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                    </svg>
                </a>
            <?php endif; ?>
            <?php if ($instagram): ?>
                <a class="p-0 p-lg-0 p-sm-1 dark-btn" target="_blank" href="<?php echo $instagram; ?>"
                    alt="instagram share button" aria-label="instagram share button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $width; ?>" height="<?php echo $height; ?>"
                        fill="var(--i8-light-fg-color)" class="bi bi-instagram mx-1" viewBox="0 0 16 16">
                        <path
                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                    </svg>
                </a>

            <?php endif; ?>
            <?php if ($youtube): ?>
                <a class="p-0 p-lg-0 p-sm-1 dark-btn" target="_blank" href="<?php echo $youtube; ?>" alt="youtube share button"
                    aria-label="youtube share button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $width; ?>" height="<?php echo $height; ?>"
                        fill="var(--i8-light-fg-color)" class="bi bi-youtube mx-1" viewBox="0 0 16 16">
                        <path
                            d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
                    </svg>
                </a>
            <?php endif; ?>
            <?php if ($aparat): ?>
                <a class="p-0 p-lg-0 p-sm-1 dark-btn" target="_blank" href="<?php echo $aparat; ?>" alt="aparat share button"
                    aria-label="aparat share button">
                    <svg fill="var(--i8-light-fg-color)" width="<?php echo $width; ?>" height="<?php echo $height; ?>"
                        class="bi bi-twitter mx-1" viewBox="0 0 24.00 24.00" role="img" xmlns="http://www.w3.org/2000/svg"
                        transform="rotate(0)matrix(1, 0, 0, 1, 0, 0)" stroke="var(--i8-light-fg-color)"
                        stroke-width="0.00024000000000000003">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                            stroke="var(--i8-light-fg-color)" stroke-width="0.192"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M12.001 1.594c-9.27-.003-13.913 11.203-7.36 17.758a10.403 10.403 0 0 0 17.76-7.355c0-5.744-4.655-10.401-10.4-10.403zM6.11 6.783c.501-2.598 3.893-3.294 5.376-1.103 1.483 2.19-.422 5.082-3.02 4.582A2.97 2.97 0 0 1 6.11 6.783zm4.322 8.988c-.504 2.597-3.897 3.288-5.377 1.096-1.48-2.192.427-5.08 3.025-4.579a2.97 2.97 0 0 1 2.352 3.483zm1.26-2.405c-1.152-.223-1.462-1.727-.491-2.387.97-.66 2.256.18 2.04 1.334a1.32 1.32 0 0 1-1.548 1.053zm6.198 3.838c-.501 2.598-3.893 3.293-5.376 1.103-1.484-2.191.421-5.082 3.02-4.583a2.97 2.97 0 0 1 2.356 3.48zm-1.967-5.502c-2.598-.501-3.293-3.896-1.102-5.38 2.19-1.483 5.081.422 4.582 3.02a2.97 2.97 0 0 1-3.48 2.36zM13.59 23.264l2.264.61a3.715 3.715 0 0 0 4.543-2.636l.64-2.402a11.383 11.383 0 0 1-7.448 4.428zm7.643-19.665L18.87 2.97a11.376 11.376 0 0 1 4.354 7.62l.65-2.459A3.715 3.715 0 0 0 21.231 3.6zM.672 13.809l-.541 2.04a3.715 3.715 0 0 0 2.636 4.543l2.107.562a11.38 11.38 0 0 1-4.203-7.145zM10.357.702 8.15.126a3.715 3.715 0 0 0-4.547 2.637l-.551 2.082A11.376 11.376 0 0 1 10.358.702z">
                            </path>
                        </g>
                    </svg>
                </a>

            <?php endif; ?>
            <?php if ($eitta): ?>  
                <a class="p-0 p-lg-0 p-sm-1 dark-btn" target="_blank" href="<?php echo $eitta; ?>" alt="eitta share button"
                    aria-label="eitta share button">

                    <svg fill="var(--i8-light-fg-color)" width="<?php echo $width; ?>" height="<?php echo $height; ?>"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m5.968 23.942a6.624 6.624 0 0 1 -2.332-.83c-1.62-.929-2.829-2.593-3.217-4.426-.151-.717-.17-1.623-.15-7.207.019-6.009.005-5.699.291-6.689.142-.493.537-1.34.823-1.767 1.055-1.57 2.607-2.578 4.53-2.943.384-.073.94-.08 6.056-.08 6.251 0 6.045-.009 7.066.314a6.807 6.807 0 0 1 4.314 4.184c.33.937.346 1.087.369 3.555l.02 2.23-.391.268c-.558.381-1.29 1.06-2.316 2.15-1.182 1.256-2.376 2.42-2.982 2.907-1.309 1.051-2.508 1.651-3.726 1.864-.634.11-1.682.067-2.302-.095-.553-.144-.517-.168-.726.464a6.355 6.355 0 0 0 -.318 1.546l-.031.407-.146-.03c-1.215-.241-2.419-1.285-2.884-2.5a3.583 3.583 0 0 1 -.26-1.219l-.016-.34-.309-.284c-.644-.59-1.063-1.312-1.195-2.061-.212-1.193.34-2.542 1.538-3.756 1.264-1.283 3.127-2.29 4.953-2.68.658-.14 1.818-.177 2.403-.075 1.138.198 2.067.773 2.645 1.639.182.271.195.31.177.555a.812.812 0 0 1 -.183.493c-.465.651-1.848 1.348-3.336 1.68-2.625.585-4.294-.142-4.033-1.759.026-.163.04-.304.031-.313-.032-.032-.293.104-.575.3-.479.334-.903.984-1.05 1.607-.036.156-.05.406-.034.65.02.331.053.454.192.736.092.186.275.45.408.589l.24.251-.096.122a4.845 4.845 0 0 0 -.677 1.217 3.635 3.635 0 0 0 -.105 1.815c.103.461.421 1.095.739 1.468.242.285.797.764.886.764.024 0 .044-.048.044-.106.001-.23.184-.973.326-1.327.423-1.058 1.351-1.96 2.82-2.74.245-.13.952-.47 1.572-.757 1.36-.63 2.103-1.015 2.511-1.305 1.176-.833 1.903-2.065 2.14-3.625.086-.57.086-1.634 0-2.207-.368-2.438-2.195-4.096-4.818-4.37-2.925-.307-6.648 1.953-8.942 5.427-1.116 1.69-1.87 3.565-2.187 5.443-.123.728-.169 2.08-.093 2.75.193 1.704.822 3.078 1.903 4.156a6.531 6.531 0 0 0 1.87 1.313c2.368 1.13 4.99 1.155 7.295.071.996-.469 1.974-1.196 3.023-2.25 1.02-1.025 1.71-1.88 3.592-4.458 1.04-1.423 1.864-2.368 2.272-2.605l.15-.086-.019 3.091c-.018 2.993-.022 3.107-.123 3.561-.6 2.678-2.54 4.636-5.195 5.242l-.468.107-5.775.01c-4.734.008-5.85-.002-6.19-.056z" />
                    </svg>
                </a>

            <?php endif; ?>
            <?php if ($bale): ?>
                <a class="p-0 p-lg-0 p-sm-1 dark-btn" target="_blank" href="<?php echo $bale; ?>" alt="bale share button"
                    aria-label="bale share button">

                    <svg fill="var(--i8-light-fg-color)" width="<?php echo $width; ?>" height="<?php echo $height; ?>"
                        role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.425 23.987a12.218 12.218 0 0 1-2.95-.514 6.578 6.578 0 0 0-.336-.116C4.936 22.303 2.22 19.763.913 16.599a11.92 11.92 0 0 1-.9-4.063C.005 12.377.001 10.246 0 6.74 0 .71-.005 1.137.07.903.23.394.673.05 1.224.005c.421-.034.7.088 1.603.699.562.38 1.119.78 1.796 1.289.315.237.353.261.376.247l.35-.23c.58-.381 1.11-.677 1.7-.945A11.913 11.913 0 0 1 9.766.21a11.19 11.19 0 0 1 2.041-.2c1.14-.016 2.077.091 3.152.36 3.55.888 6.538 3.411 8.028 6.78.492 1.113.845 2.43.945 3.522.033.366.039.43.053.611.008.105.015.406.015.669 0 .783-.065 1.57-.169 2.064a5.474 5.474 0 0 0-.046.26c-.056.378-.214.987-.399 1.535-.205.613-.367.999-.684 1.633a11.95 11.95 0 0 1-2.623 3.436c-.44.396-.829.705-1.26 1.003-.647.445-1.307.812-2.039 1.134-.6.265-1.44.539-2.101.686a11.165 11.165 0 0 1-1.178.202 12.28 12.28 0 0 1-2.076.082zm-.61-5.92c.294-.06.678-.209.864-.337.144-.099.428-.376 2.064-2.013a161.8 161.8 0 0 1 1.764-1.753c.017 0 1.687-1.67 1.687-1.689 0-.02 1.64-1.648 1.661-1.648.01 0 .063-.047.118-.106.467-.495.682-.957.716-1.547.026-.433-.06-.909-.217-1.196a2.552 2.552 0 0 0-.983-1.024c-.281-.163-.512-.233-.888-.27-.306-.031-.688 0-.948.075-.243.07-.603.274-.853.481-.042.035-1.279 1.265-2.748 2.733l-2.671 2.67-1.093-1.09c-.6-.6-1.12-1.114-1.155-1.142a2.419 2.419 0 0 0-1.338-.51c-.404-.013-.91.09-1.224.25a2.89 2.89 0 0 0-.659.526c-.108.12-.287.357-.29.385-.003.03-.009.044-.065.16a2.312 2.312 0 0 0-.224.91c-.011.229-.01.265.019.491.045.353.24.781.51 1.115.05.063.97.992 2.044 2.064 1.507 1.505 1.98 1.97 2.074 2.039.327.24.683.388 1.101.456.182.03.5.016.734-.03z" />
                    </svg>
                </a>

            <?php endif; ?>
            <?php if ($rubika): ?>
                <a class="p-0 p-lg-0 p-sm-1 dark-btn" target="_blank" href="<?php echo $rubika; ?>" alt="rubika share button"
                    aria-label="rubika share button">

                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        x="0px" y="0px" fill="var(--i8-light-fg-color)" width="<?php echo $width; ?>"
                        height="<?php echo $height; ?>" viewBox="0 0 412.287 412.287"
                        style="enable-background:new 0 0 412.287 412.287;" xml:space="preserve">
                        <g>
                            <path d="M380.546,110.125L211.552,1.586c-3.293-2.115-7.515-2.115-10.807,0L31.744,110.081c-2.866,1.84-4.6,5.014-4.598,8.42
        l0.041,180.039c0.002,3.476,1.806,6.699,4.767,8.519l168.961,103.75c1.605,0.986,3.419,1.479,5.233,1.479
        c1.814,0,3.629-0.491,5.232-1.479L380.352,307.1c2.96-1.818,4.766-5.043,4.767-8.519l0.023-180.039
        C385.143,115.137,383.409,111.965,380.546,110.125z M206.147,25.627l61.936,39.629l-61.936,39.627l-61.934-39.627L206.147,25.627z
         M50.197,291.254v-63.938l60.692,36.848l0.01,64.377L50.197,291.254z M110.899,237.623l-60.703-37.285v-64.74l60.703,38.842
        V237.623z M63.22,116.834l59.186-37.869l59.186,37.869l-59.186,37.869L63.22,116.834z M133.908,174.44l60.705-38.844v64.742
        l-60.705,37.285V174.44z M133.938,277.927l40.348,25.815l-40.348,24.783V277.927L133.938,277.927z M194.642,379.952l-50.232-30.854
        l50.232-30.847V379.952z M206.138,297.04l-62.076-38.765l62.076-38.592l62.076,38.733L206.138,297.04z M217.653,379.952v-61.645
        l50.194,30.812L217.653,379.952z M278.358,328.571l-40.388-24.805l40.388-25.842V328.571z M278.388,237.67l-60.703-37.287v-64.736
        l60.703,38.842V237.67z M230.708,116.879l59.186-37.867l59.186,37.867l-59.186,37.869L230.708,116.879z M362.104,291.3
        l-60.705,37.286v-63.17l60.705-37.983V291.3z M362.104,200.383l-60.705,37.287v-63.182l60.705-38.844V200.383z" />
                        </g>
                    </svg>
                </a>

            <?php endif; ?>

        </div>
    </div>
    <?php
}



/**
 * 
 * 
 * Add Image gallery style And js to pages with gallery tag
 * 
 * 
 */

add_filter('post_gallery', 'custom_gallery_format', 10, 2);
function custom_gallery_format($output, $attr)
{
    // Parse the gallery shortcode attributes
    $gallery_atts = shortcode_atts(array(
        'ids' => '',
        'columns' => 3,
        'size' => 'thumbnail',
        'link' => 'file'
    ), $attr);

    // Get the image IDs from the gallery shortcode
    $image_ids = explode(',', $gallery_atts['ids']);

    // Initialize the output variable
    $gallery_output = '<section class="photo-gallery mb-4"><div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 gallery-grid">';


    // Loop through each image ID
    foreach ($image_ids as $image_id) {
        // Get the image URL
        $image_url = wp_get_attachment_url($image_id);

        // Get the image alt text
        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);

        // Generate the HTML for the image
        $gallery_output .= '<div class="col">
                    <a class="gallery-item" href="' . $image_url . '">
                        <img src="' . $image_url . '" class="img-fluid"
                            alt="' . $image_alt . '">
                    </a>
                </div>';

        // Add any other desired modifications to the image HTML here
    }
    $gallery_output .= '</div></section>';


    // Return the modified gallery output
    return $gallery_output;
}



function custom_lightbox_gallery()
{
    $post_structure = get_post_meta(get_the_ID(), 'i8_post_structure', true);
    if (is_singular('post') && $post_structure == 'image'):

        global $post;

        if (has_shortcode($post->post_content, 'gallery')) {
            ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
            <style>
                :root {
                    --lightbox: rgb(0 0 0 / 0.75);
                    --carousel-text: #fff;
                }

                @keyframes zoomin {
                    0% {
                        transform: scale(1);
                    }

                    50% {
                        transform: scale(1.05);
                    }

                    100% {
                        transform: scale(1);
                    }
                }

                .gallery-item {
                    display: block;
                }

                .gallery-item img {
                    box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.15);
                    transition: box-shadow 0.2s;
                }

                .gallery-item:hover img {
                    box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.35);
                }

                .lightbox-modal .modal-content {
                    background-color: var(--lightbox);
                }

                .lightbox-modal .btn-close {
                    position: absolute;
                    top: 1.25rem;
                    right: 1.25rem;
                    font-size: 1.25rem;
                    z-index: 10;
                    filter: invert(1) grayscale(100);
                }

                .lightbox-modal .modal-body {
                    display: flex;
                    align-items: center;
                    padding: 0;
                }

                .lightbox-modal .lightbox-content {
                    width: 100%;
                }

                .lightbox-modal .carousel-indicators {
                    margin-bottom: 0;
                }

                .lightbox-modal .carousel-indicators [data-bs-target] {
                    background-color: var(--carousel-text) !important;
                }

                .lightbox-modal .carousel-inner {
                    width: 75%;
                }

                .lightbox-modal .carousel-inner img {
                    animation: zoomin 10s linear infinite;
                }

                .lightbox-modal .carousel-item .carousel-caption {
                    right: 0;
                    bottom: 0;
                    left: 0;
                    padding-bottom: 2rem;
                    background-color: var(--lightbox);
                    color: var(--carousel-text) !important;
                }

                .lightbox-modal .carousel-control-prev,
                .lightbox-modal .carousel-control-next {
                    width: auto;
                }

                .lightbox-modal .carousel-control-prev {
                    left: 1.25rem;
                }

                .lightbox-modal .carousel-control-next {
                    right: 1.25rem;
                }

                @media (min-width: 1400px) {
                    .lightbox-modal .carousel-inner {
                        max-width: 60%;
                    }
                }

                [data-bs-theme="dark"] .lightbox-modal .carousel-control-next-icon,
                [data-bs-theme="dark"] .lightbox-modal .carousel-control-prev-icon {
                    filter: none;
                }

                .btn-fullscreen-enlarge,
                .btn-fullscreen-exit {
                    position: absolute;
                    top: 1.25rem;
                    right: 3.5rem;
                    z-index: 10;
                    border: 0;
                    background: transparent;
                    opacity: 0.6;
                    font-size: 1.25rem;
                }
            </style>

            <div class="modal fade lightbox-modal" id="lightbox-modal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                    <div class="modal-content">
                        <button type="button" class="btn-fullscreen-enlarge" aria-label="Enlarge fullscreen">
                            <svg class="bi">
                                <use href="#enlarge"></use>
                            </svg>
                        </button>
                        <button type="button" class="btn-fullscreen-exit d-none" aria-label="Exit fullscreen">
                            <svg class="bi">
                                <use href="#exit"></use>
                            </svg>
                        </button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-body">
                            <div class="lightbox-content">
                                <!-- JS content here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>

                document.addEventListener("DOMContentLoaded", () => {
                    // --- Create LightBox
                    const galleryGrid = document.querySelector(".gallery-grid");
                    const links = galleryGrid.querySelectorAll("a");
                    const imgs = galleryGrid.querySelectorAll("img");
                    const lightboxModal = document.getElementById("lightbox-modal");
                    const bsModal = new bootstrap.Modal(lightboxModal);
                    const modalBody = lightboxModal.querySelector(".lightbox-content");

                    function createCaption(caption) {
                        return `<div class="carousel-caption d-none d-md-block">
                                                                                                                                    <h4 class="m-0">${caption}</h4>
                                                                                                                                  </div>`;
                    }

                    function createIndicators(img) {
                        let markup = "",
                            i,
                            len;

                        const countSlides = links.length;
                        const parentCol = img.closest(".col");
                        const curIndex = [...parentCol.parentElement.children].indexOf(parentCol);

                        for (i = 0, len = countSlides; i < len; i++) {
                            markup += `
                                                                                                                                    <button type="button" data-bs-target="#lightboxCarousel"
                                                                                                                                      data-bs-slide-to="${i}"
                                                                                                                                      ${i === curIndex ? 'class="active" aria-current="true"' : ""}
                                                                                                                                      aria-label="Slide ${i + 1}">
                                                                                                                                    </button>`;
                        }

                        return markup;
                    }

                    function createSlides(img) {
                        let markup = "";
                        const currentImgSrc = img.closest(".gallery-item").getAttribute("href");

                        for (const img of imgs) {
                            const imgSrc = img.closest(".gallery-item").getAttribute("href");
                            const imgAlt = img.getAttribute("alt");

                            markup += `
                                                                                                                                    <div class="carousel-item${currentImgSrc === imgSrc ? " active" : ""}">
                                                                                                                                      <img class="d-block img-fluid w-100" src=${imgSrc} alt="${imgAlt}">
                                                                                                                                      ${imgAlt ? createCaption(imgAlt) : ""}
                                                                                                                                    </div>`;
                        }

                        return markup;
                    }

                    function createCarousel(img) {
                        const markup = `
                                                                                                                                  <!-- Lightbox Carousel -->
                                                                                                                                  <div id="lightboxCarousel" class="carousel slide carousel-fade" data-bs-ride="true">
                                                                                                                                    <!-- Indicators/dots -->
                                                                                                                                    <div class="carousel-indicators">
                                                                                                                                      ${createIndicators(img)}
                                                                                                                                    </div>
                                                                                                                                    <!-- Wrapper for Slides -->
                                                                                                                                    <div class="carousel-inner justify-content-center mx-auto">
                                                                                                                                      ${createSlides(img)}
                                                                                                                                    </div>
                                                                                                                                    <!-- Controls/icons -->
                                                                                                                                    <button class="carousel-control-prev" type="button" data-bs-target="#lightboxCarousel" data-bs-slide="prev">
                                                                                                                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                                                                                      <span class="visually-hidden">Previous</span>
                                                                                                                                    </button>
                                                                                                                                    <button class="carousel-control-next" type="button" data-bs-target="#lightboxCarousel" data-bs-slide="next">
                                                                                                                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                                                                                      <span class="visually-hidden">Next</span>
                                                                                                                                    </button>
                                                                                                                                  </div>
                                                                                                                                  `;

                        modalBody.innerHTML = markup;
                    }

                    for (const link of links) {
                        link.addEventListener("click", function (e) {
                            e.preventDefault();
                            const currentImg = link.querySelector("img");
                            const lightboxCarousel = document.getElementById("lightboxCarousel");

                            if (lightboxCarousel) {
                                const parentCol = link.closest(".col");
                                const index = [...parentCol.parentElement.children].indexOf(parentCol);

                                const bsCarousel = new bootstrap.Carousel(lightboxCarousel);
                                bsCarousel.to(index);
                            } else {
                                createCarousel(currentImg);
                            }

                            bsModal.show();
                        });
                    }

                    // --- Support Fullscreen
                    const fsEnlarge = document.querySelector(".btn-fullscreen-enlarge");
                    const fsExit = document.querySelector(".btn-fullscreen-exit");

                    function enterFS() {
                        lightboxModal
                            .requestFullscreen()
                            .then({})
                            .catch((err) => {
                                alert(
                                    `Error attempting to enable full-screen mode: ${err.message} (${err.name})`
                                );
                            });
                        fsEnlarge.classList.toggle("d-none");
                        fsExit.classList.toggle("d-none");
                    }

                    function exitFS() {
                        document.exitFullscreen();
                        fsExit.classList.toggle("d-none");
                        fsEnlarge.classList.toggle("d-none");
                    }

                    fsEnlarge.addEventListener("click", (e) => {
                        e.preventDefault();
                        enterFS();
                    });

                    fsExit.addEventListener("click", (e) => {
                        e.preventDefault();
                        exitFS();
                    });
                });

            </script>

            <?php


        }
    endif;
}
add_action('wp_footer', 'custom_lightbox_gallery', 10, 1);


// End Image gallery



// inline reltead post
function insert_related_post_link_in_content($content)
{
    // دریافت پست‌های مرتبط با برچسب‌های پست فعلی
    $related_posts = get_posts(
        array(
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_tag', // نوع دسته‌بندی (در اینجا برچسب)
                    'field' => 'id', // فیلد برای مقایسه (می‌تواند id یا slug باشد)
                    'terms' => wp_get_post_terms(get_the_ID(), 'post_tag', array("fields" => "ids")), // برچسب‌های پست فعلی
                ),
            ),
            'post__not_in' => array(get_the_ID()),
            'posts_per_page' => 3, // تعداد پست‌های مرتبط که می‌خواهید نمایش داده شود
            'ignore_sticky_posts' => 1
        )
    );

    // اگر پست‌های مرتبط وجود داشته باشند
    if ($related_posts) {
        $first_related_post = $related_posts[0];
        $second_related_post = isset($related_posts[1]) ? $related_posts[1] : null;
        $third_related_post = isset($related_posts[2]) ? $related_posts[2] : null;

        // تفکیک محتوا به پاراگراف‌ها
        $paragraphs = explode('</p>', $content);
        $paragraphs_count = count($paragraphs);


        $ads_pos_1 = null;
        $ads_pos_2 = null;
        $ads_pos_3 = null;

        if ($paragraphs_count <= 4 && $paragraphs_count >= 1) {
            $ads_pos_1 = (ceil($paragraphs_count / 2))-1;
        }
        if ($paragraphs_count <= 8 && $paragraphs_count > 4) {
            $ads_pos_1 = (ceil(($paragraphs_count / 4)))-1;
            $ads_pos_2 = (ceil(($paragraphs_count / 2)))-1; 
        }
        if ($paragraphs_count > 8 ) {
            $ads_pos_1 = (ceil($paragraphs_count / 6))-1;
            $ads_pos_2 = (ceil($paragraphs_count / 4)-1);
            $ads_pos_3 = (ceil($paragraphs_count / 2))-1;
            
        }
        // $ads_pos_1 = ceil($paragraphs_count / 2);
        // $ads_pos_2 = ceil($paragraphs_count / 3);
        // $ads_pos_3 = ceil($paragraphs_count / 4);



        // لینک اول و دوم را تهیه می‌کنیم
        if ($first_related_post && $ads_pos_1 != null) {
            $first_link = '
            <div class="inline-related-box d-flex flex-column gap-2 align-items-start py-3">
                <h4 class="releated-head ">همچنین بخوانید: </h4>
                <div class="d-flex flex-row gap-3">
                    <a href="' . get_permalink($first_related_post->ID) . '" class="">'
                . get_the_post_thumbnail($first_related_post, 'i8-sm-100-75', array("width" => 100, "height" => 75)) . '
                    </a>
                    <a href="' . get_permalink($first_related_post->ID) . '" class="border-0" > ' . get_the_title($first_related_post->ID) . '</a>
                </div>
            </div>';
            ?>


            <?php
            $paragraphs[$ads_pos_1] .= $first_link;
        }
        if ($second_related_post && $ads_pos_2 != null) {
            $sec_link = '
            <div class="inline-related-box d-flex flex-column gap-2 align-items-start py-3">
                <h4 class="releated-head ">همچنین بخوانید: </h4>
                <div class="d-flex flex-row gap-3">
                    <a href="' . get_permalink($second_related_post->ID) . '" class="">'
                . get_the_post_thumbnail($second_related_post, 'i8-sm-100-75', array("width" => 100, "height" => 75)) . '
                    </a>
                    <a href="' . get_permalink($second_related_post->ID) . '" class="border-0" > ' . get_the_title($second_related_post->ID) . '</a>
                </div>
            </div>';
            $paragraphs[$ads_pos_2] .= $sec_link;
        }
        if ($third_related_post && $ads_pos_3 != null ) {
            $third_link = '
            <div class="inline-related-box d-flex flex-column gap-2 align-items-start py-3">
                <h4 class="releated-head ">همچنین بخوانید: </h4>
                <div class="d-flex flex-row gap-3">
                    <a href="' . get_permalink($third_related_post->ID) . '" class="">'
                . get_the_post_thumbnail($third_related_post, 'i8-sm-100-75', array("width" => 100, "height" => 75)) . '
                    </a>
                    <a href="' . get_permalink($third_related_post->ID) . '" class="border-0" > ' . get_the_title($third_related_post->ID) . '</a>
                </div>
            </div>';
            $paragraphs[$ads_pos_3] .= $third_link;
        }

        // ایجاد محتوای جدید با پاراگراف‌های ویرایش شده
        $content = implode('</p>', $paragraphs);
    }

    return $content;
}
add_filter('the_content', 'insert_related_post_link_in_content');
