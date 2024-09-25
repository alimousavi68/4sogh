<?php
class i8_site_info_box extends WP_Widget
{
    //داده های پیش فرض در صورت خالی رها شدن فیلدها
    private $default_field_data = array(
        'title'           => '',
        'sub_title'       => '',

        'hide_title'       => true,
        'hide_logo'       => false,
        'hide_social_box' => false,
        'hide_menu'       => false,
        'hide_description'       => false,

        'logo_img'        => '',
        'description'     => '',

        'social_link_1'   => '',
        'social_link_2'   => '',
        'social_link_3'   => '',
        'social_link_4'   => '',
        'social_link_5'   => '',

        'social_icon_1'   => '',
        'social_icon_2'   => '',
        'social_icon_3'   => '',
        'social_icon_4'   => '',
        'social_icon_5'   => '',

        'meni_id'         => ''
    );
    //متد سازنده کلاس
    function __construct()
    {
        $opt_array = array(
            'class' => 'i8_site_info_box_widget',
            'description' => 'نمایش اطلاعاتی همچون لوگو/شبکه های اجتماعی و منوی سایت'
        );
        parent::__construct('i8-category-posts', 'i8: باکس اطلاعات سایت', $opt_array);
    }
    //متد نمایش فرم در بخش تنظیمات 
    function form($instance)
    {
        $instance = wp_parse_args((array)$instance, $this->default_field_data);
        $title = esc_attr($instance['title']);
        $sub_title = esc_attr($instance['sub_title']);
        
        $hide_title      = esc_attr($instance['hide_title']);
        $hide_logo       = esc_attr($instance['hide_logo']);
        $hide_social_box = esc_attr($instance['hide_social_box']);
        $hide_menu       = esc_attr($instance['hide_menu']);
        $hide_description = esc_attr($instance['hide_description']);
        
        $logo_img        = esc_attr($instance['logo_img']);
        $description = esc_attr($instance['description']);

        $social_link_1   = esc_attr($instance['social_link_1']);
        $social_link_2   = esc_attr($instance['social_link_2']);
        $social_link_3   = esc_attr($instance['social_link_3']);
        $social_link_4   = esc_attr($instance['social_link_4']);
        $social_link_5   = esc_attr($instance['social_link_5']);

        $social_icon_1   = esc_attr($instance['social_icon_1']);
        $social_icon_2   = esc_attr($instance['social_icon_2']);
        $social_icon_3   = esc_attr($instance['social_icon_3']);
        $social_icon_4   = esc_attr($instance['social_icon_4']);
        $social_icon_5   = esc_attr($instance['social_icon_5']);

        $menu_id   = esc_attr($instance['menu_id']);
?>
        <p>
            <input type="checkbox" name="<?php echo $this->get_field_name('hide_title'); ?>" id="<?php echo $this->get_field_id('hide_title'); ?>" class="checkbox" <?php echo ($hide_title == 'on') ? 'checked="checked"' : ''; ?>>
            <label for="<?php echo $this->get_field_id('hide_title'); ?>">مخفی سازی عنوان</label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">عنوان</label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $title; ?>" class="widefat">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('sub_title'); ?>">زیر عنوان (متنی که در زیرعنوان قرار می گیرد)</label>
            <input type="text" name="<?php echo $this->get_field_name('sub_title'); ?>" id="<?php echo $this->get_field_id('sub_title'); ?>" value="<?php echo $sub_title; ?>" class="widefat">
        </p>
        <!-- logo -->
        <p>
            <input type="checkbox" name="<?php echo $this->get_field_name('hide_logo'); ?>" id="<?php echo $this->get_field_id('hide_logo'); ?>" class="checkbox" <?php echo ($hide_logo == 'on') ? 'checked="checked"' : ''; ?>>
            <label for="<?php echo $this->get_field_id('hide_logo'); ?>">مخفی سازی لوگو</label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('logo_img'); ?>">تصویر لوگو (آدرس تصویر)</label>
            <input type="text" name="<?php echo $this->get_field_name('logo_img'); ?>" id="<?php echo $this->get_field_id('logo_img'); ?>" value="<?php echo $logo_img; ?>" class="widefat">
        </p>
        <!-- description -->
        <p>
            <input type="checkbox" name="<?php echo $this->get_field_name('hide_description'); ?>" id="<?php echo $this->get_field_id('hide_description'); ?>" class="checkbox" <?php echo ($hide_description == 'on') ? 'checked="checked"' : ''; ?>>
            <label for="<?php echo $this->get_field_id('hide_description'); ?>">مخفی سازی توضیحات</label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>">توضیحات سایت</label>
            <input type="text" name="<?php echo $this->get_field_name('description'); ?>" id="<?php echo $this->get_field_id('description'); ?>" value="<?php echo $description; ?>" class="widefat">
        </p>
        <!-- social network links -->
        <p>
            <input type="checkbox" name="<?php echo $this->get_field_name('hide_social_box'); ?>" id="<?php echo $this->get_field_id('hide_social_box'); ?>" class="checkbox" <?php echo ($hide_social_box == 'on') ? 'checked="checked"' : ''; ?>>
            <label for="<?php echo $this->get_field_id('hide_social_box'); ?>">مخفی سازی شبکه های اجتماعی</label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('social_link_1'); ?>"> لینک شبکه اجتماعی ۱ (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('social_link_1'); ?>" id="<?php echo $this->get_field_id('social_link_1'); ?>" value="<?php echo $social_link_1; ?>" class="widefat">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('social_icon_1'); ?>">آیکن شبکه اجتماعی ۱ (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('social_icon_1'); ?>" id="<?php echo $this->get_field_id('social_icon_1'); ?>" value="<?php echo $social_icon_1; ?>" class="widefat">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('social_link_2'); ?>"> لینک شبکه اجتماعی ۲ (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('social_link_2'); ?>" id="<?php echo $this->get_field_id('social_link_2'); ?>" value="<?php echo $social_link_2; ?>" class="widefat">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('social_icon_2'); ?>">آیکن شبکه اجتماعی ۲ (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('social_icon_2'); ?>" id="<?php echo $this->get_field_id('social_icon_2'); ?>" value="<?php echo $social_icon_2; ?>" class="widefat">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('social_link_3'); ?>"> لینک شبکه اجتماعی ۳ (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('social_link_3'); ?>" id="<?php echo $this->get_field_id('social_link_3'); ?>" value="<?php echo $social_link_3; ?>" class="widefat">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('social_icon_3'); ?>">آیکن شبکه اجتماعی ۳ (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('social_icon_3'); ?>" id="<?php echo $this->get_field_id('social_icon_3'); ?>" value="<?php echo $social_icon_3; ?>" class="widefat">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('social_link_4'); ?>"> لینک شبکه اجتماعی ۴ (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('social_link_4'); ?>" id="<?php echo $this->get_field_id('social_link_4'); ?>" value="<?php echo $social_link_4; ?>" class="widefat">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('social_icon_4'); ?>">آیکن شبکه اجتماعی ۴ (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('social_icon_4'); ?>" id="<?php echo $this->get_field_id('social_icon_4'); ?>" value="<?php echo $social_icon_4; ?>" class="widefat">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('social_link_5'); ?>"> لینک شبکه اجتماعی ۵ (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('social_link_5'); ?>" id="<?php echo $this->get_field_id('social_link_5'); ?>" value="<?php echo $social_link_5; ?>" class="widefat">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('social_icon_5'); ?>">آیکن شبکه اجتماعی ۵ (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('social_icon_5'); ?>" id="<?php echo $this->get_field_id('social_icon_5'); ?>" value="<?php echo $social_icon_5; ?>" class="widefat">
        </p>
        <p>
            <input type="checkbox" name="<?php echo $this->get_field_name('hide_menu'); ?>" id="<?php echo $this->get_field_id('hide_menu'); ?>" class="checkbox" <?php echo ($hide_menu == 'on') ? 'checked="checked"' : ''; ?>>
            <label for="<?php echo $this->get_field_id('hide_menu'); ?>">مخفی سازی منو</label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('menu_id'); ?>">موقعیت منو</label>
            <select name="<?php echo $this->get_field_name('menu_id'); ?>" id="<?php echo $this->get_field_id('menu_id'); ?>" class="widefat">
                <option value="none">انتخاب کنید</option>
                <?php
                $menus = wp_get_nav_menus();
                foreach ($menus as $item) :
                ?>
                    <option value="<?php echo $item->term_id ?>" <?php echo ($item->term_id == $menu_id) ? 'selected="selected"' : ''; ?>><?php echo $item->name; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
    <?php
    }
    //متد ذخیره تنظیمات ویجت 
    function update($new_instance, $old_instance)
    {
        // دیتای قبلی در متغییری که به خروجی فرستاده می شود ست می شود تا در صورت عدم تغییر از همین اطلاعات استفاده شود
        $instance = $old_instance;
        //در صورتی که کاربر فیلدی را خالی رها کرده بود و نیاز به دیتای پیش فرض داشت با این روش دیتای پیش فرض از قبل تعریف شده با دیتای جدید مرج می شود
        $new_instance = wp_parse_args((array)$new_instance, $this->default_field_data);
        //تغییر دیتای های قبلی با دیتای های جدید ثبت شده توسط کاربر
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['sub_title'] = sanitize_text_field($new_instance['sub_title']);
        $instance['hide_title'] = sanitize_text_field($new_instance['hide_title']);
        $instance['hide_logo'] = sanitize_text_field($new_instance['hide_logo']);
        $instance['hide_social_box'] = sanitize_text_field($new_instance['hide_social_box']);
        $instance['hide_menu'] = sanitize_text_field($new_instance['hide_menu']);
        $instance['hide_description'] = sanitize_text_field($new_instance['hide_description']);
        $instance['description'] = sanitize_text_field($new_instance['description']);
        $instance['logo_img'] = ($new_instance['logo_img']);
        $instance['social_icon_1'] = ($new_instance['social_icon_1']);
        $instance['social_icon_2'] = ($new_instance['social_icon_2']);
        $instance['social_icon_3'] = ($new_instance['social_icon_3']);
        $instance['social_icon_4'] = ($new_instance['social_icon_4']);
        $instance['social_icon_5'] = ($new_instance['social_icon_5']);
        $instance['social_link_1'] = sanitize_text_field($new_instance['social_link_1']);
        $instance['social_link_2'] = sanitize_text_field($new_instance['social_link_2']);
        $instance['social_link_3'] = sanitize_text_field($new_instance['social_link_3']);
        $instance['social_link_4'] = sanitize_text_field($new_instance['social_link_4']);
        $instance['social_link_5'] = sanitize_text_field($new_instance['social_link_5']);

        $instance['menu_id'] = sanitize_text_field($new_instance['menu_id']);

        $instance['show_desktop'] = ($new_instance['show_desktop']);
        $instance['show_mobile'] = ($new_instance['show_mobile']);

        return $instance;
    }

    // متد نمایش محتویات ویجت 
    function widget($args, $instance)
    {
        $title = apply_filters('wp_widget_title', $instance['title']);
        $sub_title = $instance['sub_title'];
        $sub_title_print = (!empty($sub_title)) ? '<p>' . $sub_title . '</p>' : '';
        
        $hide_title      = $instance['hide_title'];
        $hide_description      = $instance['hide_description'];
        $hide_logo       = $instance['hide_logo'];
        $hide_social_box = $instance['hide_social_box'];
        $hide_menu       = $instance['hide_menu'];
        
        $logo_img = $instance['logo_img'];
        $description = $instance['description'];

        $social_icon_1 = $instance['social_icon_1'];
        $social_icon_2 = $instance['social_icon_2'];
        $social_icon_3 = $instance['social_icon_3'];
        $social_icon_4 = $instance['social_icon_4'];
        $social_icon_5 = $instance['social_icon_5'];

        $social_link_1 = $instance['social_link_1'];
        $social_link_2 = $instance['social_link_2'];
        $social_link_3 = $instance['social_link_3'];
        $social_link_4 = $instance['social_link_4'];
        $social_link_5 = $instance['social_link_5'];

        $menu_id = $instance['menu_id'];

        $show_mobile  = $instance['show_mobile'];
        $show_desktop = $instance['show_desktop'];



        echo $args['before_widget'];

        if ($hide_title != 'on') {
            echo '<div class="text-title box-title display-4">';
            echo $args['before_title'] . $icon_print . $title  .  $args['after_title'];
            echo $sub_title_print . '</div>';
        }
    ?>
        <div class="site-info-box d-flex flex-column gap-1 w-100 ">
            <?php if ($hide_logo != 'on') : ?>
                <div class="site-info-logo text-center">
                    <img width="190" height="90" class="footer-logo w-100 py-2" src="<?php echo $logo_img; ?>" loading="lazy" alt="logo" />
                </div>
            <?php endif; ?>
            <?php if ($hide_description != 'on') : ?>
                <div class="site-info-description">
                    <p class="f-14 l3 text-center"><?php echo $description; ?></p>
                </div>
            <?php endif; ?>
            <?php if ($hide_social_box != 'on') : ?>
                <div class="site-info-social-links">
                    <div class="d-flex justify-content-between gap-2 ">
                        <a class="p-0 p-lg-0 p-sm-1" href="<?php echo $social_link_1; ?>" alt="twitter channel" aria-label="twitter channel">
                            <?php echo $social_icon_1; ?>
                        </a>
                        <a class="p-0 p-lg-0 p-sm-1" href="<?php echo $social_link_2; ?>" alt="twitter channel" aria-label="twitter channel">
                            <?php echo $social_icon_2; ?>
                        </a>
                        <a class="p-0 p-lg-0 p-sm-1" href="<?php echo $social_link_3; ?>" alt="twitter channel" aria-label="twitter channel">
                            <?php echo $social_icon_3; ?>
                        </a>
                        <a class="p-0 p-lg-0 p-sm-1" href="<?php echo $social_link_4; ?>" alt="twitter channel" aria-label="twitter channel">
                            <?php echo $social_icon_4; ?>
                        </a>
                        <a class="p-0 p-lg-0 p-sm-1" href="<?php echo $social_link_5; ?>" alt="twitter channel" aria-label="twitter channel">
                            <?php echo $social_icon_5; ?>
                        </a>

                    </div>
                </div>
            <?php endif; ?>
            <?php if ($hide_menu != 'on') : ?>
                <div class="site-info-menu ">
                    <?php build_custom_menu_by_id($menu_id, 'row'); ?>
                </div>
            <?php endif; ?>
        </div>
<?php
        echo $args['after_widget'];
    }
}


function i8_site_info_box()
{
    register_widget('i8_site_info_box');
}
add_action('widgets_init', 'i8_site_info_box');
