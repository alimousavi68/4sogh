<?php
class i8_show_posts_pro extends WP_Widget
{

    /**
     * declaration Variables
     */

    // Widget Display Style
    public $display_style = array(
        'نمایش به صورت عمودی' => 'mod1',
        'نمایش به صورت عمودی + ویژه' => 'mod2',
        'نمایش  به صورت افقی' => 'mod3',
        'نمایش  به صورت افکت روی تصویر' => 'mod4',
        '۲ نمایش به صورت عمودی + ویژه' => 'mod5',
        'نمایش به صورت گالری' => 'mod6',
        'نمایش به لیست عددی' => 'mod7',
        'نمایش به صورت هیرو باکس مدل ۱' => 'mod8',
        'نمایش به صورت هیرو باکس مدل ۲' => 'mod9',
        'نمایش به صورت تک عکس و بقیه متن' => 'mod10',
        '۲نمایش  به صورت افقی' => 'mod11',
        'نمایش به صورت گالری ۲' => 'mod12',
        'نمایش به صورت تایم لاین' => 'mod13',
        'نمایش به صورت عکس و متن زیر هم ' => 'mod14',


    );
    public $orderby = array(
        'تصادفی' => 'rand',
        'جدیدترین' => 'date',
        'پر بحث ترین' => 'comment_count'
    );

    // Default Field data 
    private $default_field_data = array(
        'hide_title' => false,
        'hide_thumb' => false,
        'hide_excerpt' => true,
        'icon' => '',
        'icon_list_bullet' => '',
        'icon_img' => '',
        'icon_animate' => false,
        'title' => '',
        'sub_title' => '',
        'cat' => '-1',
        'num' => '5',
        'thumb_width' => '75',
        'thumb_height' => '75',
        'thumb_radius' => 'round-2',
        'head_font_size' => 'display-3',
        'title_font_size' => 'display-2',
        'title_font_weight' => 'fw-4',
        'display_style' => 'mod1',
        'display_column_num_desktop' => '1',
        'display_column_num_mini_desktop' => '1',
        'display_column_num_tablet' => '1',
        'display_column_num_mobile' => '1',
        'show_desktop' => 'on',
        'show_mobile' => 'on',
        'orderby' => 'date'
    );

    /**
     * Class Constructor 
     */
    function __construct()
    {
        $opt_array = array(
            'class' => 'i8_show_posts_pro',
            'description' => 'نمایش پست های یک دسته بندی خاص با امکان تنظیم حالت های مختلف نمایش'
        );
        parent::__construct('i8-show-posts-pro', 'i8: نمایش پست های پیشرفته', $opt_array);
    }



    /**
     * Display Widget Form  
     */
    function form($instance)
    {
        $instance = wp_parse_args((array) $instance, $this->default_field_data);
        $hide_title = esc_attr($instance['hide_title']);
        $hide_thumb = esc_attr($instance['hide_thumb']);
        $hide_excerpt = esc_attr($instance['hide_excerpt']);
        $icon = $instance['icon'];
        $icon_list_bullet = $instance['icon_list_bullet'];
        $icon_img = esc_attr($instance['icon_img']);
        $icon_animate = esc_attr($instance['icon_animate']);
        $title = esc_attr($instance['title']);
        $sub_title = esc_attr($instance['sub_title']);
        $cat = esc_attr($instance['cat']);
        $num = esc_attr($instance['num']);
        $thumb_width = esc_attr($instance['thumb_width']);
        $thumb_height = esc_attr($instance['thumb_height']);
        $thumb_radius = esc_attr($instance['thumb_radius']);
        $head_font_size = esc_attr($instance['head_font_size']);
        $title_font_size = esc_attr($instance['title_font_size']);
        $title_font_weight = esc_attr($instance['title_font_weight']);
        $orderby = esc_attr($instance['orderby']);
        $display_style = esc_attr($instance['display_style']);
        $show_desktop = esc_attr($instance['show_desktop']);
        $show_mobile = esc_attr($instance['show_mobile']);
        $display_column_num_desktop = esc_attr($instance['display_column_num_desktop']);
        $display_column_num_mini_desktop = esc_attr($instance['display_column_num_mini_desktop']);
        $display_column_num_tablet = esc_attr($instance['display_column_num_tablet']);
        $display_column_num_mobile = esc_attr($instance['display_column_num_mobile']);
        include('widget_setting_form.php');
    }


    /**
     * متد ذخیره تنظیمات ویجت 
     */
    function update($new_instance, $old_instance)
    {
        // دیتای قبلی در متغییری که به خروجی فرستاده می شود ست می شود تا در صورت عدم تغییر از همین اطلاعات استفاده شود
        $instance = $old_instance;

        //در صورتی که کاربر فیلدی را خالی رها کرده بود و نیاز به دیتای پیش فرض داشت با این روش دیتای پیش فرض از قبل تعریف شده با دیتای جدید مرج می شود
        $new_instance = wp_parse_args((array) $new_instance, $this->default_field_data);

        //تغییر دیتای های قبلی با دیتای های جدید ثبت شده توسط کاربر
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['sub_title'] = sanitize_text_field($new_instance['sub_title']);
        $instance['num'] = sanitize_text_field($new_instance['num']);
        $instance['thumb_width'] = sanitize_text_field($new_instance['thumb_width']);
        $instance['thumb_height'] = sanitize_text_field($new_instance['thumb_height']);
        $instance['thumb_radius'] = sanitize_text_field($new_instance['thumb_radius']);
        $instance['head_font_size'] = sanitize_text_field($new_instance['head_font_size']);
        $instance['title_font_size'] = sanitize_text_field($new_instance['title_font_size']);
        $instance['title_font_weight'] = sanitize_text_field($new_instance['title_font_weight']);
        $instance['cat'] = sanitize_text_field($new_instance['cat']);
        $instance['icon'] = ($new_instance['icon']);
        $instance['icon_list_bullet'] = ($new_instance['icon_list_bullet']);
        $instance['icon_img'] = sanitize_text_field($new_instance['icon_img']);
        $instance['icon_animate'] = ($new_instance['icon_animate']);
        $instance['hide_title'] = sanitize_text_field($new_instance['hide_title']);
        $instance['hide_thumb'] = sanitize_text_field($new_instance['hide_thumb']);
        $instance['hide_excerpt'] = sanitize_text_field($new_instance['hide_excerpt']);
        $instance['orderby'] = sanitize_text_field($new_instance['orderby']);
        $instance['display_style'] = sanitize_text_field($new_instance['display_style']);
        $instance['show_desktop'] = ($new_instance['show_desktop']);
        $instance['show_mobile'] = ($new_instance['show_mobile']);
        $instance['display_column_num_desktop'] = sanitize_text_field($new_instance['display_column_num_desktop']);
        $instance['display_column_num_mini_desktop'] = sanitize_text_field($new_instance['display_column_num_mini_desktop']);
        $instance['display_column_num_tablet'] = sanitize_text_field($new_instance['display_column_num_tablet']);
        $instance['display_column_num_mobile'] = sanitize_text_field($new_instance['display_column_num_mobile']);

        return $instance;
    }

    // متد نمایش محتویات ویجت 
    function widget($args, $instance)
    {
        $hide_title = $instance['hide_title'];
        $hide_thumb = $instance['hide_thumb'];
        $hide_excerpt = $instance['hide_excerpt'];
        $title = apply_filters('wp_widget_title', $instance['title']);
        $sub_title = $instance['sub_title'];
        $sub_title_print = (!empty($sub_title)) ? $sub_title : '';
        $cat = $instance['cat'];
        $num = $instance['num'];
        $thumb_width = $instance['thumb_width'];
        $thumb_height = $instance['thumb_height'];
        $thumb_radius = $instance['thumb_radius'];
        $title_font_size = $instance['title_font_size'];
        $title_font_weight = $instance['title_font_weight'];
        $head_font_size = $instance['head_font_size'];
        $icon = $instance['icon'];
        $icon_list_bullet = $instance['icon_list_bullet'];
        $icon_animate = $instance['icon_animate'];
        $icon_img = $instance['icon_img'];
        $orderby = $instance['orderby'];
        $display_style = $instance['display_style'];

        $display_column_num_desktop = $instance['display_column_num_desktop'];
        $display_column_num_mini_desktop = $instance['display_column_num_mini_desktop'];
        $display_column_num_tablet = $instance['display_column_num_tablet'];
        $display_column_num_mobile = $instance['display_column_num_mobile'];

        //with cat color 
        // $cat_color = get_term_meta($cat, 'i8_CustomTerm_color', true) ? get_term_meta($cat, 'i8_CustomTerm_color', true) : 'var(--i8-light-complete-color)';
        
        // with out cat color 
        $cat_color = 'var(--i8-light-complete-color)';
        $cat_icon = get_term_meta($cat, 'i8_CustomTerm_icon', true) ? get_term_meta($cat, 'i8_CustomTerm_icon', true) : '';

        $anime_class = ($icon_animate) ? 'icon_animate' : '';
        $icon_print = '';
        $icon_print = ($cat_icon) ? customizeSVG($cat_icon, $cat_color, $cat_color , 30, 30, $anime_class) : $icon_print;
        // $icon_print = ($icon) ? customizeSVG($icon, $cat_color, $cat_color, 12, 6, $anime_class) : $icon_print;
        $icon_print = ($icon) ? $icon : $icon_print;
        $icon_print = (empty($icon) && !empty($icon_img)) ? '<img src="' . $icon_img . '" class="' . $anime_class . '"  />' : $icon_print;

        $grid_col_base = 24;
        $col_xl = $grid_col_base / $display_column_num_desktop;
        $col_lg = $grid_col_base / $display_column_num_mini_desktop;
        $col_md = $grid_col_base / $display_column_num_tablet;
        $col_sm = $grid_col_base / $display_column_num_mobile;
        $col = "col-xl-$col_xl col-lg-$col_lg col-md-$col_md col-sm-$col_sm";

        $show_mobile = $instance['show_mobile'];
        $show_desktop = $instance['show_desktop'];

        $values = array_values($this->display_style);

        if ($display_style == $values[0]) {
            if ((wp_is_mobile() && $show_mobile == 'on')) {
                require('content/simple_post_list_one_col.php');
            } elseif ((!wp_is_mobile() && $show_desktop == 'on')) {
                require('content/simple_post_list_one_col.php');
            }
        } elseif ($display_style == $values[1]) {
            if ((wp_is_mobile() && $show_mobile == 'on')) {
                require('content/special_post_list.php');
            } elseif ((!wp_is_mobile() && $show_desktop == 'on')) {
                require('content/special_post_list.php');
            }
        } elseif ($display_style == $values[2]) {
            if ((wp_is_mobile() && $show_mobile == 'on')) {
                require('content/simple_post_list_vertical.php');
            } elseif ((!wp_is_mobile() && $show_desktop == 'on')) {
                require('content/simple_post_list_vertical.php');
            }
        } elseif ($display_style == $values[3]) {
            if ((wp_is_mobile() && $show_mobile == 'on')) {
                require('content/special_post_flip_box.php');
            } elseif ((!wp_is_mobile() && $show_desktop == 'on')) {
                require('content/special_post_flip_box.php');
            }
        } elseif ($display_style == $values[4]) {
            if ((wp_is_mobile() && $show_mobile == 'on')) {
                require('content/special_post_list_2.php');
            } elseif ((!wp_is_mobile() && $show_desktop == 'on')) {
                require('content/special_post_list_2.php');
            }
        } elseif ($display_style == $values[5]) {
            if ((wp_is_mobile() && $show_mobile == 'on')) {
                require('content/gallery_post.php');
            } elseif ((!wp_is_mobile() && $show_desktop == 'on')) {
                require('content/gallery_post.php');
            }
        } elseif ($display_style == $values[6]) {
            if ((wp_is_mobile() && $show_mobile == 'on')) {
                require('content/numeric_list.php');
            } elseif ((!wp_is_mobile() && $show_desktop == 'on')) {
                require('content/numeric_list.php');
            }
        } elseif ($display_style == $values[7]) {
            if ((wp_is_mobile() && $show_mobile == 'on')) {
                require('content/hero_section1.php');
            } elseif ((!wp_is_mobile() && $show_desktop == 'on')) {
                require('content/hero_section1.php');
            }
        } elseif ($display_style == $values[8]) {
            if ((wp_is_mobile() && $show_mobile == 'on')) {
                require('content/hero_section2.php');
            } elseif ((!wp_is_mobile() && $show_desktop == 'on')) {
                require('content/hero_section2.php');
            }
        } elseif ($display_style == $values[9]) {
            if ((wp_is_mobile() && $show_mobile == 'on')) {
                require('content/special_post_list_3.php');
            } elseif ((!wp_is_mobile() && $show_desktop == 'on')) {
                require('content/special_post_list_3.php');
            }
        } elseif ($display_style == $values[10]) {
            if ((wp_is_mobile() && $show_mobile == 'on')) {
                require('content/simple_post_list_vertical2.php');
            } elseif ((!wp_is_mobile() && $show_desktop == 'on')) {
                require('content/simple_post_list_vertical2.php');
            }
        } elseif ($display_style == $values[11]) {
            if ((wp_is_mobile() && $show_mobile == 'on')) {
                require('content/gallery_post2.php');
            } elseif ((!wp_is_mobile() && $show_desktop == 'on')) {
                require('content/gallery_post2.php');
            }
        } elseif ($display_style == $values[12]) {
            if ((wp_is_mobile() && $show_mobile == 'on')) {
                require('content/simple_post_list_timeline.php');
            } elseif ((!wp_is_mobile() && $show_desktop == 'on')) {
                require('content/simple_post_list_timeline.php');
            }
        } elseif ($display_style == $values[13]) {
            if ((wp_is_mobile() && $show_mobile == 'on')) {
                require('content/special_post_list_4.php');
            } elseif ((!wp_is_mobile() && $show_desktop == 'on')) {
                require('content/special_post_list_4.php');
            }
        }
    }
}


function i8_show_posts_pro_func()
{
    register_widget('i8_show_posts_pro');
}
add_action('widgets_init', 'i8_show_posts_pro_func');
