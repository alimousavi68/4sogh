<?php
class i8_show_ads_pro extends WP_Widget
{

    /**
     * declaration Variables
     */

    // Widget Display Style
    public $file_type = array('تصویر' => 'img', 'ویدیو' => 'video');

    public $load_method = array('بارگذاری با تاخیر' => 'lazy', 'بارگذاری موازی' => 'async');


    // Default Field data 
    private $default_field_data = array(
        'hide_title'     => false,
        'icon'           => '',
        'icon_img'       => '',
        'icon_animate'   => false,
        'title'          => '',
        'sub_title'      => '',
        'head_font_size'   => 'display-3',

        'show_desktop'   => 'on',
        'show_mobile'    => 'on',

        'file_type'      => 'img',
        'file_src'       => '',
        'link_url'       => '#',
        'file_alt'       => '',
        'load_method'    => 'lazy',
        'class'       => '',
        'width'    => '300',
        'height'    => '100',
        'thumb_radius'   => 'round-0',
    );

    /**
     * Class Constructor 
     */
    function __construct()
    {
        $opt_array = array(
            'class' => 'i8_show_ads_pro',
            'description' => 'نمایش پست های یک تبلیغ با امکان تنظیم حالت های مختلف نمایش'
        );
        parent::__construct('i8-show-ads-pro', 'i8: نمایش تبلیغات پیشرفته', $opt_array);
    }


    /**
     * Display Widget Form  
     */
    function form($instance)
    {
        $instance          =    wp_parse_args((array)$instance, $this->default_field_data);

        $hide_title        =    esc_attr($instance['hide_title']);
        $icon              =    $instance['icon'];
        $icon_img          =    esc_attr($instance['icon_img']);
        $icon_animate      =    esc_attr($instance['icon_animate']);
        $title             =    esc_attr($instance['title']);
        $sub_title         =    esc_attr($instance['sub_title']);
        $head_font_size    =    esc_attr($instance['head_font_size']);

        $file_type      =    esc_attr($instance['file_type']);
        $file_src       =    esc_attr($instance['file_src']);
        $link_url       =    esc_attr($instance['link_url']);
        $file_alt       =    esc_attr($instance['file_alt']);
        $load_method    =    esc_attr($instance['load_method']);
        $class          =    esc_attr($instance['class']);
        $width          =    esc_attr($instance['width']);
        $height         =    esc_attr($instance['height']);
        $thumb_radius   =    esc_attr($instance['thumb_radius']);

        $show_desktop   =    esc_attr($instance['show_desktop']);
        $show_mobile    =    esc_attr($instance['show_mobile']);

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
        $new_instance = wp_parse_args((array)$new_instance, $this->default_field_data);

        //تغییر دیتای های قبلی با دیتای های جدید ثبت شده توسط کاربر
        $instance['title']          = sanitize_text_field($new_instance['title']);
        $instance['sub_title']      = sanitize_text_field($new_instance['sub_title']);
        $instance['head_font_size'] = sanitize_text_field($new_instance['head_font_size']);
        $instance['icon']           = ($new_instance['icon']);
        $instance['icon_img']       = sanitize_text_field($new_instance['icon_img']);
        $instance['icon_animate']   = ($new_instance['icon_animate']);
        $instance['hide_title']     = sanitize_text_field($new_instance['hide_title']);


        $instance['file_type']      = sanitize_text_field($new_instance['file_type']);
        $instance['file_src']       = sanitize_text_field($new_instance['file_src']);
        $instance['link_url']       = sanitize_text_field($new_instance['link_url']);
        $instance['file_alt']       = sanitize_text_field($new_instance['file_alt']);
        $instance['load_method']    = sanitize_text_field($new_instance['load_method']);
        $instance['class']          = sanitize_text_field($new_instance['class']);
        $instance['width']          = sanitize_text_field($new_instance['width']);
        $instance['height']         = sanitize_text_field($new_instance['height']);
        $instance['thumb_radius']   = sanitize_text_field($new_instance['thumb_radius']);

        $instance['show_desktop']   = ($new_instance['show_desktop']);
        $instance['show_mobile']    = ($new_instance['show_mobile']);


        return $instance;
    }
    // متد نمایش محتویات ویجت 
    function widget($args, $instance)
    {
        $hide_title = $instance['hide_title'];
        $title = apply_filters('wp_widget_title', $instance['title']);
        $sub_title = $instance['sub_title'];
        $sub_title_print = (!empty($sub_title)) ? '<p class="text-title f24 fw-7 m-0 me-2">' . $sub_title . '</p>' : '';
        $head_font_size = $instance['head_font_size'];
        $icon = $instance['icon'];
        $icon_animate = $instance['icon_animate'];
        $icon_img = $instance['icon_img'];
        $anime_class = ($icon_animate) ? 'icon_animate' : '';
        $icon_print = '';
        // $icon_print =  ($cat_icon) ? customizeSVG($cat_icon, $cat_color, $cat_color, 30, 30, $anime_class) : $icon_print;
        $icon_print =  ($icon)     ? customizeSVG($icon, $cat_color, $cat_color, 30, 30, $anime_class) : $icon_print;
        $icon_print =  (empty($icon) && !empty($icon_img)) ? '<img src="' . $icon_img . '" class="' . $anime_class . '"  />' : $icon_print;

        $file_type    = $instance['file_type'];
        $file_src     = $instance['file_src'];
        $link_url     = $instance['link_url'];
        $file_alt     = $instance['file_alt'];
        $load_method  = $instance['load_method'];
        $class        = $instance['class'];
        $width       = $instance['width'];
        $height       = $instance['height'];
        $thumb_radius = $instance['thumb_radius'];

        $show_mobile  = $instance['show_mobile'];
        $show_desktop = $instance['show_desktop'];

        $file_type_values = array_values($this->file_type);

        if ($file_type == $file_type_values[0]) {
?>
            <a href="<?php echo $link_url; ?>" target="_blank" >
                <img class="<?php echo ($class)  ?  $class : '';
                            echo $thumb_radius ?> " src="<?php echo ($file_src) ? $file_src : ''; ?>" alt="<?php echo ($file_alt) ? $file_alt : ''; ?>" width="<?php echo ($width) ? $width : ''; ?>" height="<?php echo ($height) ? $height : ''; ?>" <?php echo ($load_method == 'async') ? ' decoding="async" ' : ' loading="lazy" '; ?> />
            </a>

        <?php
        } elseif ($file_type == $file_type_values[1]) {
        ?>
            <a href="<?php echo $link_url; ?>" alt="<?php echo ($file_alt) ? $file_alt : ''; ?>" target="_blank">
                <video class="<?php echo ($class)  ?  $class : ''; echo $thumb_radius ?> " width="<?php echo ($width) ? $width : ''; ?>" height="<?php echo ($height) ? $height : ''; ?>" <?php echo ($load_method == 'async') ? ' decoding="async" ' : ' loading="lazy" '; ?> autoplay loop>
                    <source src="<?php echo ($file_src) ? $file_src : ''; ?> " type="video/mp4" >
                </video>
            </a>

<?php
        }
    }
}


function i8_show_ads_pro_func()
{
    register_widget('i8_show_ads_pro');
}
add_action('widgets_init', 'i8_show_ads_pro_func');
