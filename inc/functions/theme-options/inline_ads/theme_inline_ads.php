<?php

/**
 * 
 * Customize Theme 
 * - inline ads option manager
 * 
 */

add_action('customize_register', 'i8_inline_ads');
function i8_inline_ads($wp_customize)
{
    //add panel
    $wp_customize->add_panel('i8_inline_ads_i8_inline_ads_panel', array(
        'title' => __('تبلیغات درون مطلب', 'i8_theme'),
        'description' => __('تنظیمات سفارشی در این پنل قرار می‌گیرند.', 'your-theme'),
        'priority' => 30, // اولویت نمایش پنل
    ));
    include(get_template_directory() . '/inc/functions/theme-options/inline_ads/inline_ads1.php');
    include(get_template_directory() . '/inc/functions/theme-options/inline_ads/inline_ads2.php');
    include(get_template_directory() . '/inc/functions/theme-options/inline_ads/inline_ads3.php');
    include(get_template_directory() . '/inc/functions/theme-options/inline_ads/inline_ads4.php');


}


add_filter('the_content', 'i8_inline_ads_insert_to_post');
function i8_inline_ads_insert_to_post($content)
{
    $count_ads = 4;
    for ($i = 1; $i <= $count_ads; $i++) {
        $content =  i8_insert_add_content($content, $i);
    }
    return $content;
}

function i8_insert_add_content($content, $ads_number)
{
    // بررسی آیا ما در صفحه نوشته هستیم و دارای پاراگراف‌ها هستیم
    if (is_single() && get_theme_mod('i8_inline_ads_i8_inline_ads' . $ads_number . '_status') == 'enable') {
        $i8_ads_code            =     get_theme_mod('i8_inline_ads_i8_inline_ads' . $ads_number . '_code');
        $i8_ads_insert_type     =     get_theme_mod('i8_inline_ads_i8_inline_ads' . $ads_number . '_insert_type');
        $i8_ads_post_number     =     get_theme_mod('i8_inline_ads_i8_inline_ads' . $ads_number . '_post_number');

        // تفکیک محتوا به پاراگراف‌ها
        $paragraphs = explode('</p>', $content);
        $paragraphs_count = count($paragraphs);

        if ($i8_ads_insert_type == 'number') {
            $ads_pos = ($i8_ads_post_number > $paragraphs_count) ? ($paragraphs_count - 1) : ($i8_ads_post_number - 1);
        } elseif ($i8_ads_insert_type == 'between') {
            $ads_pos = ceil($paragraphs_count / 2);
        } elseif ($i8_ads_insert_type == 'third') {
            $ads_pos = ceil($paragraphs_count / 3);
        } elseif ($i8_ads_insert_type == 'quarter') {
            $ads_pos = ceil($paragraphs_count / 4);
        } elseif ($i8_ads_insert_type == 'end') {
            $ads_pos = ($paragraphs_count - 1);
        }

        $paragraphs[$ads_pos] .= $i8_ads_code;

        // ایجاد محتوای جدید با پاراگراف‌های ویرایش شده
        $content = implode('</p>', $paragraphs);
    }
    return $content;
}
