<?php
class i8_menu extends WP_Widget
{
    //داده های پیش فرض در صورت خالی رها شدن فیلدها
    private $default_field_data = array(
        'title'           => '',
        'sub_title'       => '',
        'hide_title'      => true,
        'menu_id'    => '',
        'num'             => '',
    );
    //متد سازنده کلاس
    function __construct()
    {
        $opt_array = array(
            'class' => 'i8_menu_widget',
            'description' => 'نمایش منو'
        );
        parent::__construct('i8-menu', 'i8: نمایش منو', $opt_array);
    }
    //متد نمایش فرم در بخش تنظیمات 
    function form($instance)
    {
        $instance = wp_parse_args((array)$instance, $this->default_field_data);
        $title = esc_attr($instance['title']);
        $sub_title = esc_attr($instance['sub_title']);

        $hide_title      = esc_attr($instance['hide_title']);

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
        <p>
            <label for="<?php echo $this->get_field_id('num'); ?>">نقطه شکست</label>
            <input type="number" name="<?php echo $this->get_field_name('num'); ?>" id="<?php echo $this->get_field_id('num'); ?>" value="<?php echo (!empty($num)) ? $num : 5; ?>" class="widefat">
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

        $instance['menu_id'] = sanitize_text_field($new_instance['menu_id']);

        $instance['num'] = sanitize_text_field($new_instance['num']);

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

        $num = $instance['num'];

        $menu_id = $instance['menu_id'];

        $show_mobile  = $instance['show_mobile'];
        $show_desktop = $instance['show_desktop'];

        echo $args['before_widget'];

        if ($hide_title != 'on') {
            echo '<div class="text-title box-title fs-5 bg-secondary cornner-tr py-2 px-3 fw-5 box-title-mini ">';
            echo $args['before_title']  . $title  .  $args['after_title'];
            echo $sub_title_print . '</div>';
        } else {
            echo '<div class="text-title box-title fs-5 bg-secondary cornner-tr py-2 px-3 fw-5 box-title-mini "></div>';
        }
    ?>

        <?php build_custom_menu_by_id($menu_id, 'column'); ?>


<?php
        echo $args['after_widget'];
    }
}


function i8_menu()
{
    register_widget('i8_menu');
}
add_action('widgets_init', 'i8_menu');
