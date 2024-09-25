<?php
class i8_show_posts_two_col extends WP_Widget
{

    /**
     * declaration Variables
     */

    // Default Field data 
    private $default_field_data = array(
        'hide_title'     => false,
        'icon'           => '',
        'icon2'           => '',
        'icon_img'       => '',
        'icon_img2'       => '',
        'title'          => '',
        'title2'          => '',
        'sub_title'      => '',
        'sub_title2'      => '',
        'cat'            => '-1',
        'cat2'            => '-1',
        'num'            => '5',
        'show_desktop'   => true,
        'show_mobile'    => true,
    );

    /**
     * Class Constructor 
     */
    function __construct()
    {
        $opt_array = array(
            'class' => 'i8_show_posts_two_col',
            'description' => 'نمایش پست های یک دسته بندی خاص با امکان تنظیم دوستون'
        );
        parent::__construct('i8-show-posts-two-col', 'i8: نمایش پست های دوستونه', $opt_array);
    }

    /**
     * Display Widget Form  
     */
    function form($instance)
    {
        $instance          =    wp_parse_args((array)$instance, $this->default_field_data);
        $hide_title        =    esc_attr($instance['hide_title']);
        $icon              =    esc_attr($instance['icon']);
        $icon2              =    esc_attr($instance['icon2']);
        $icon_img          =    esc_attr($instance['icon_img']);
        $icon_img2          =    esc_attr($instance['icon_img2']);
        $title             =    esc_attr($instance['title']);
        $title2             =    esc_attr($instance['title2']);
        $sub_title         =    esc_attr($instance['sub_title']);


        $sub_title2         =    esc_attr($instance['sub_title2']);
        $cat               =    esc_attr($instance['cat']);
        $cat2               =    esc_attr($instance['cat2']);
        $num               =    esc_attr($instance['num']);
        $show_desktop      =    esc_attr($instance['show_desktop']);
        $show_mobile       =    esc_attr($instance['show_mobile']);

?>
        <style>
            .i8-panel {
                border: 1px solid #ccc;
                border-radius: 10px;
                padding: 10px;
                margin: 24px 0;
                background-color: aliceblue;
            }

            .i8-panel-title {
                background-color: #a0abb5;
                padding: 2px 24px;
                color: white;
                border-radius: 5px;
            }
        </style>
        <div class="i8-panel">
            <span class="i8-panel-title">تنظیمات عنوان</span>
            <p>
                <input type="checkbox" name="<?php echo $this->get_field_name('hide_title'); ?>" id="<?php echo $this->get_field_id('hide_title'); ?>" class="checkbox" <?php echo ($hide_title == true) ? 'checked="checked"' : ''; ?>>
                <label for="<?php echo $this->get_field_id('hide_title'); ?>">نمایش عنوان</label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>">عنوان ستون اول</label>
                <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $title; ?>" class="widefat">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('sub_title'); ?>">زیر عنوان (متنی که در زیرعنوان قرار می گیرد)</label>
                <input type="text" name="<?php echo $this->get_field_name('sub_title'); ?>" id="<?php echo $this->get_field_id('sub_title'); ?>" value="<?php echo $sub_title; ?>" class="widefat">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('title2'); ?>">عنوان ستون دوم</label>
                <input type="text" name="<?php echo $this->get_field_name('title2'); ?>" id="<?php echo $this->get_field_id('title2'); ?>" value="<?php echo $title2; ?>" class="widefat">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('sub_title2'); ?>">زیر عنوان (متنی که در زیرعنوان قرار می گیرد)</label>
                <input type="text" name="<?php echo $this->get_field_name('sub_title2'); ?>" id="<?php echo $this->get_field_id('sub_title2'); ?>" value="<?php echo $sub_title2; ?>" class="widefat">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('icon'); ?>">آیکن ستون اول( کد آیکن بوت استرپ)</label>
                <input type="text" name="<?php echo $this->get_field_name('icon'); ?>" id="<?php echo $this->get_field_id('icon'); ?>" value="<?php echo $icon; ?>" class="widefat">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('icon_img'); ?>">تصویر آیکن ستون اول(آدرس تصویر)</label>
                <input type="text" name="<?php echo $this->get_field_name('icon_img'); ?>" id="<?php echo $this->get_field_id('icon_img'); ?>" value="<?php echo $icon_img; ?>" class="widefat">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('icon2'); ?>">آیکن ستون دوم( کد آیکن بوت استرپ)</label>
                <input type="text" name="<?php echo $this->get_field_name('icon2'); ?>" id="<?php echo $this->get_field_id('icon2'); ?>" value="<?php echo $icon2; ?>" class="widefat">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('icon_img2'); ?>">تصویر آیکن ستون دوم(آدرس تصویر)</label>
                <input type="text" name="<?php echo $this->get_field_name('icon_img2'); ?>" id="<?php echo $this->get_field_id('icon_img2'); ?>" value="<?php echo $icon_img2; ?>" class="widefat">
            </p>
        </div>
        <div class="i8-panel">
            <span class="i8-panel-title">تنظیمات دسته بندی</span>
            <p>
                <label for="<?php echo $this->get_field_id('cat'); ?>">دسته بندی ستون اول</label>
                <select name="<?php echo $this->get_field_name('cat'); ?>" id="<?php echo $this->get_field_id('cat'); ?>" class="widefat">
                    <option value="0">انتخاب کنید</option>
                    <?php
                    $categories = get_categories();
                    foreach ($categories as $category) :
                        echo '<option value="' . $category->term_id . '" ' . selected($cat, $category->term_id, false) . '>' . $category->name . '</option>';
                    endforeach;
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('cat2'); ?>">دسته بندی ستون دوم</label>
                <select name="<?php echo $this->get_field_name('cat2'); ?>" id="<?php echo $this->get_field_id('cat2'); ?>" class="widefat">
                    <option value="0">انتخاب کنید</option>
                    <?php
                    $categories2 = get_categories();
                    foreach ($categories2 as $category) :
                        echo '<option value="' . $category->term_id . '" ' . selected($cat2, $category->term_id, false) . '>' . $category->name . '</option>';
                    endforeach;
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('num'); ?>">تعداد</label>
                <input type="number" name="<?php echo $this->get_field_name('num'); ?>" id="<?php echo $this->get_field_id('num'); ?>" value="<?php echo (!empty($num)) ? $num : 5; ?>" class="widefat">
            </p>
        </div>
        <div class="i8-panel">
            <span class="i8-panel-title">تنظیمات نمایش</span>
            <p>
                <input type="checkbox" name="<?php echo $this->get_field_name('show_desktop'); ?>" id="<?php echo $this->get_field_id('show_desktop'); ?>" class="checkbox" <?php echo ($show_desktop == true) ? 'checked="checked"' : ''; ?>>
                <label for="<?php echo $this->get_field_id('show_desktop'); ?>">نمایش دسکتاپ</label>
            </p>
            <p>
                <input type="checkbox" name="<?php echo $this->get_field_name('show_mobile'); ?>" id="<?php echo $this->get_field_id('show_mobile'); ?>" class="checkbox" <?php echo ($show_mobile == true) ? 'checked="checked"' : ''; ?>>
                <label for="<?php echo $this->get_field_id('show_mobile'); ?>">نمایش موبایل</label>
            </p>
        </div>
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
        $instance['title2'] = sanitize_text_field($new_instance['title2']);
        $instance['sub_title'] = sanitize_text_field($new_instance['sub_title']);
        $instance['sub_title2'] = sanitize_text_field($new_instance['sub_title2']);
        $instance['num'] = sanitize_text_field($new_instance['num']);
        $instance['cat'] = sanitize_text_field($new_instance['cat']);
        $instance['cat2'] = sanitize_text_field($new_instance['cat2']);
        $instance['icon'] = sanitize_text_field($new_instance['icon']);
        $instance['icon2'] = sanitize_text_field($new_instance['icon2']);
        $instance['icon_img'] = sanitize_text_field($new_instance['icon_img']);
        $instance['icon_img2'] = sanitize_text_field($new_instance['icon_img2']);
        $instance['hide_title'] = sanitize_text_field($new_instance['hide_title']);
        $instance['show_desktop'] = sanitize_text_field($new_instance['show_desktop']);
        $instance['show_mobile'] = sanitize_text_field($new_instance['show_mobile']);

        return $instance;
    }
    // متد نمایش محتویات ویجت 
    function widget($args, $instance)
    {
        $title = apply_filters('wp_widget_title', $instance['title']);
        $title2 = apply_filters('wp_widget_title', $instance['title2']);
        $sub_title = $instance['sub_title'];
        $sub_title2 = $instance['sub_title2'];
        $sub_title_print = (!empty($sub_title)) ? '<p class="text-title f24 fw-7 m-0 me-2">' . $sub_title . '</p>' : '';
        $sub_title_print2 = (!empty($sub_title2)) ? '<p class="text-title f24 fw-7 m-0 me-2">' . $sub_title2 . '</p>' : '';
        $cat = $instance['cat'];
        $cat2 = $instance['cat2'];
        $cat_color          =   get_term_meta($cat, 'i8_CustomTerm_color', true) ? get_term_meta($cat, 'i8_CustomTerm_color', true) : '#000';
        $cat_icon   =   get_term_meta($cat, 'i8_CustomTerm_icon', true) ? get_term_meta($cat, 'i8_CustomTerm_icon', true) : '';


        $num = $instance['num'];
        $icon = $instance['icon'];
        $icon2 = $instance['icon2'];
        $icon_print =  ($icon) ? '<i class="bi ' . $icon . '"></i>' : '';
        $icon_print2 =  ($icon) ? '<i class="bi ' . $icon2 . '"></i>' : '';
        $icon_img = $instance['icon_img'];
        $icon_img2 = $instance['icon_img2'];
        $icon_img_print =  (empty($icon) && !empty($icon_img)) ? '<img src="' . $icon_img . '"  />' : '';
        $icon_img_print2 =  (empty($icon2) && !empty($icon_img2)) ? '<img src="' . $icon_img2 . '"  />' : '';
        $cat_color2          =   get_term_meta($cat2, 'i8_CustomTerm_color', true) ? get_term_meta($cat2, 'i8_CustomTerm_color', true) : '#000';
        $cat_icon2   =   get_term_meta($cat2, 'i8_CustomTerm_icon', true) ? get_term_meta($cat2, 'i8_CustomTerm_icon', true) : '';

        $icon_print = '';
        $icon_print =  ($cat_icon) ? customizeSVG($cat_icon, $cat_color, $cat_color) : $icon_print;
        $icon_print =  ($icon) ? '<i class="bi ' . $icon . '"></i>' : $icon_print;
        $icon_print =  (empty($icon) && !empty($icon_img)) ? '<img src="' . $icon_img . '"  />' : $icon_print;

        $icon_print2 = '';
        $icon_print2 =  ($cat_icon2) ? customizeSVG($cat_icon2, $cat_color2, $cat_color2) : $icon_print2;
        $icon_print2 =  ($icon2) ? '<i class="bi ' . $icon2 . '"></i>' : $icon_print2;
        $icon_print2 =  (empty($icon2) && !empty($icon_img2)) ? '<img src="' . $icon_img2 . '"  />' : $icon_print2;
    ?>

        <div class="row me-xl-0 row-gap-4">
            <?php
            // The Query
            $simple_post_list_query = new WP_Query(array(
                'posts_per_page' => $num,
                'cat' => $cat,
                'order' => 'DESC',
            ));
            $simple_post_list_query2 = new WP_Query(array(
                'posts_per_page' => $num,
                'cat' => $cat2,
                'order' => 'DESC',
            ));
            echo $args['before_widget'];
            i8_show_post_list_creator($simple_post_list_query , $cat,  $title,  $sub_title_print,  $icon_print , $num, $args, true );
            i8_show_post_list_creator($simple_post_list_query2, $cat2, $title2, $sub_title_print2, $icon_print2, $num, $args, false);
            ?>

        </div><!--  end main div -->


        <?php
        echo $args['after_widget'];
    }
}



function i8_show_post_list_creator($simple_post_list_query, $cat, $title, $sub_title_print, $icon_print, $num, $args, $first_child = false)
{
    $row = '<div class="col-xl-12 col-md-12 col-sm-24 ';
    $row .= ($first_child) ? 'pe-xl-0' : '';
    $row .=  '"><div class="box">';
    echo $row;

    if ($title) {
        echo '<div class="title-icon d-flex align-items-center align-items-center mb-3">';
        echo '<p class="text-title f24 fw-7 me-2 mb-0">';
        echo $args['before_title'] . $icon_print . $title  .  $args['after_title'];
        echo $sub_title_print . '</p></div>';
    }
    // نمایش محتویات ویجت- نمایش پست ها
    $category_posts = new WP_Query(array(
        'posts_per_page' => $num,
        'cat'            => $cat,
        'order' => 'DESC',
    ));

    if ($simple_post_list_query->have_posts()) {
        while ($simple_post_list_query->have_posts()) {
            $simple_post_list_query->the_post();
        ?>
            <div class="mini-article d-flex align-items-center mb-3">
                <a href="<?php the_permalink(); ?>" class="i8-blink"><?php echo i8_the_thumbnail('i8-sm-130-88', 'hover'); ?></a>
                <a class="f15 me-2 l22-05  text-grey i8-blink" href="<?php echo get_the_permalink(); ?>"><?php i8_limit_text(get_the_title(), 72, '...'); ?></a>
            </div>
<?php
        }
        wp_reset_postdata();
    }
    echo '</div>';
    echo '</div>';
}

function i8_show_posts_two_col_func()
{
    register_widget('i8_show_posts_two_col');
}
add_action('widgets_init', 'i8_show_posts_two_col_func');
