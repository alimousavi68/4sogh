<?php

/**
 * Add and active theme features
 */
require_once(get_template_directory() . '/inc/functions/active-features.php');

/**
 * Add Sidebar to theme
 */
require_once(get_template_directory() . '/inc/functions/sidebar.php');

/**
 * Load Custom widgets
 * 
 */
require_once(get_template_directory() . '/inc/widget/i8_show_posts_pro/i8_show_posts_pro.php');
require_once(get_template_directory() . '/inc/widget/i8_show_ads_pro/i8_show_ads_pro.php');
require_once(get_template_directory() . '/inc/widget/i8_show_posts_two_col.php');
require_once(get_template_directory() . '/inc/widget/i8_site_info_box.php');
require_once(get_template_directory() . '/inc/widget/i8_market_data.php');
require_once(get_template_directory() . '/inc/widget/i8_menu.php');


/**
 *  helper functions 
 */
require_once(get_template_directory() . '/inc/functions/helper-functions.php');

/**
 *  Customize theme options
 */
require_once(get_template_directory() . '/inc/functions/theme-options/general_setting.php');
require_once(get_template_directory() . '/inc/functions/theme-options/theme_color_pallets.php');
require_once(get_template_directory() . '/inc/functions/theme-options/theme_copy_write.php');
require_once(get_template_directory() . '/inc/functions/theme-options/inline_ads/theme_inline_ads.php');
require_once(get_template_directory() . '/inc/functions/theme-options/theme_custom_scripts.php');
require_once(get_template_directory() . '/inc/functions/theme-options/theme_footer.php');
require_once(get_template_directory() . '/inc/functions/theme-options/theme_search.php');
require_once(get_template_directory() . '/inc/functions/theme-options/theme_social_links.php');


/**
 * Change Excerpt limit characters
 */
function custom_excerpt_length($length)
{
    return 350;
}
add_filter('excerpt_length', 'custom_excerpt_length');


/**
 * Custom Term Field
 * 
 */
require_once(get_template_directory() . '/inc/functions/i8_CustomTermField.php');


// //Include jalali-date external library 
// require_once(get_template_directory() . '/lib/jDateTime-master/jdatetime.class.php');








// Check if download_url function is available, otherwise include the necessary file
if (!function_exists('download_url')) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
}


// $document_root = $_SERVER['DOCUMENT_ROOT'] . '/rasadi';
// if (file_exists($document_root . '/wp-load.php')) {
//     require_once($document_root . '/wp-load.php');
// } else {
//     error_log('wp-load.php not found!');
//     exit;
// }

// Check if the request is an Ajax request
if (defined('DOING_AJAX') && DOING_AJAX) {

    // error_log('me fired/ url: ' . $_POST['guid']);

    // Check if the required data is received
    if (isset($_POST['guid'])) {
        $guid = sanitize_text_field($_POST['guid']);
        // Call the function
        scrape_and_publish_post($guid);
    }
}

// Function to scrape data from a given URL and create a new WordPress post
// function scrape_and_publish_post($guid)
// {
//     $url = $guid;
//     // $url = "https://www.farsnews.ir/news/14021011000961/%D8%A7%D9%86%D8%AA%D8%B4%D8%A7%D8%B1-%D9%86%D8%AE%D8%B3%D8%AA%DB%8C%D9%86%E2%80%8C%D8%A8%D8%A7%D8%B1%7C-%D8%AE%D8%A7%D8%B7%D8%B1%D9%87-%D8%B1%D9%87%D8%A8%D8%B1-%D8%A7%D9%86%D9%82%D9%84%D8%A7%D8%A8-%D8%A7%D8%B2-%D9%86%D9%82%D9%84-%D9%82%D9%88%D9%84-%D8%AD%D8%A7%D8%AC-%D9%82%D8%A7%D8%B3%D9%85-%D8%AF%D8%B1%D8%A8%D8%A7%D8%B1%D9%87";

//     error_log('url in function: ' . $url);

//     // Load the HTML from the provided URL
//     $html = file_get_html($url);
//     // error_log('url-content: ' . $html);




//     // Check if HTML is successfully loaded
//     if ($html) {

//         // انتخاب المان h1 با کلاس "title" و مشخصه itemprop="headline"
//         $title_element = $html->find('h1.title', 0);

//         // بررسی وجود المان قبل از استفاده از تابع find()
//         if ($title_element) {
//             // دریافت متن موجود در المان
//             $title = $title_element->plaintext;
//         } else {
//             // در صورت عدم وجود المان، مقدار پیشفرض یا اقدام مناسب دیگر
//             $title = 'عنوان پیدا نشد';
//         }

//         $excerpt = $html->find('p.lead', 0);
//         $excerpt = $excerpt->plaintext;

//         $content = $html->find('div#CK_editor', 0);
//         $content = $content->innertext;

//         $thumbnail_url = $html->find('.contain-img img', 0)->src;


//         // Check if all required elements are found
//         if ($title && $excerpt && $content && $thumbnail_url) {

//             // Prepare data for creating a WordPress post
//             $post_data = array(
//                 'post_title' => $title,
//                 'post_content' => $content,
//                 'post_excerpt' => $excerpt,
//                 'post_status' => 'publish',
//                 'post_type' => 'post',
//             );

//             // Insert the post into the WordPress database
//             // درست کردن پست در وردپرس
//             try {
//                 error_log('dolly1 ');
//                 $post_id = wp_insert_post($post_data);
//                 ob_flush(); // تخلیه خروجی
//                 error_log('dolly2 ');
//             } catch (Exception $e) {
//                 echo '<script>console.log("Failed to insert the post. Error: ' . $e->getMessage() . '");</script>';
//                 error_log('Failed to insert the post. Error: ' . $e->getMessage());
//                 ob_flush(); // تخلیه خروجی
//             }


//             // Upload and set the featured image for the post
//             $image_url = $thumbnail_url;
//             error_log('image_url: ' . $image_url);
//             $upload_dir = wp_upload_dir();
//             error_log('upload_dir: ' . $upload_dir['path']);
//             $image_data = file_get_contents($image_url);
//             error_log('image_data: ' . $image_data);
//             $filename = basename($image_url);
//             error_log('filename: ' . $filename);
//             if (wp_mkdir_p($upload_dir['path'])) {
//                 $file = $upload_dir['path'] . '/' . $filename;
//             } else {
//                 $file = $upload_dir['basedir'] . '/' . $filename;
//             }
//             error_log('file:' . $file);

//             file_put_contents($file, $image_data);
//             $wp_filetype = wp_check_filetype($filename, null);
//             $attachment = array(
//                 'post_mime_type' => $wp_filetype['type'],
//                 'post_title' => sanitize_file_name($filename),
//                 'post_content' => '',
//                 'post_status' => 'inherit'
//             );
//             $attach_id = wp_insert_attachment($attachment, $file, $post_id);
//             require_once(ABSPATH . 'wp-admin/includes/image.php');
//             $attach_data = wp_generate_attachment_metadata($attach_id, $file);
//             wp_update_attachment_metadata($attach_id, $attach_data);
//             set_post_thumbnail($post_id, $attach_id);







//             // Output success or failure message
//             if ($post_id) {
//                 echo '<script>console.log("Post created successfully with ID: " + ' . $post_id . ');</script>';
//             } else {
//                 echo '<script>console.log("Failed to create post. ");</script>';
//                 error_log('Failed to create post.');
//             }
//         } else {
//             echo '<script>console.log("Required elements not found on the page. ");</script>';

//             error_log('Required elements not found on the page.');
//         }
//     } else {
//         echo '<script>console.log("Failed to load HTML from the URL.");</script>';
//         error_log('Failed to load HTML from the URL.');
//     }
// }






