<?php
class i8_market_data_btn_box extends WP_Widget
{
    //داده های پیش فرض در صورت خالی رها شدن فیلدها
    private $default_field_data = array(
        'title'           => '',
        'sub_title'       => '',

        'hide_title'       => true,

        'market_link_1'   => '',
        'market_link_2'   => '',
        'market_link_3'   => '',
        'market_link_4'   => '',
        'market_link_5'   => '',
        'market_link_6'   => '',

    );
    //متد سازنده کلاس
    function __construct()
    {
        $opt_array = array(
            'class' => 'i8_market_data_btn_widget',
            'description' => 'نمایش دکمه های داده های بازار'
        );
        parent::__construct('i8-market-data-btn', 'i8: باکس دکمه های داده های بازار ', $opt_array);
    }
    //متد نمایش فرم در بخش تنظیمات 
    function form($instance)
    {
        $instance = wp_parse_args((array)$instance, $this->default_field_data);
        $title = esc_attr($instance['title']);
        $sub_title = esc_attr($instance['sub_title']);

        $hide_title      = esc_attr($instance['hide_title']);

        $market_link_1   = esc_attr($instance['market_link_1']);
        $market_link_2   = esc_attr($instance['market_link_2']);
        $market_link_3   = esc_attr($instance['market_link_3']);
        $market_link_4   = esc_attr($instance['market_link_4']);
        $market_link_5   = esc_attr($instance['market_link_5']);
        $market_link_6   = esc_attr($instance['market_link_6']);

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

        <p>
            <label for="<?php echo $this->get_field_id('market_link_1'); ?>"> لینک برگه طلاوسکه (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('market_link_1'); ?>" id="<?php echo $this->get_field_id('market_link_1'); ?>" value="<?php echo $market_link_1; ?>" class="widefat">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('market_link_2'); ?>"> لینک برگه ارز (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('market_link_2'); ?>" id="<?php echo $this->get_field_id('market_link_2'); ?>" value="<?php echo $market_link_2; ?>" class="widefat">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('market_link_3'); ?>"> لینک برگه روزنامه ها (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('market_link_3'); ?>" id="<?php echo $this->get_field_id('market_link_3'); ?>" value="<?php echo $market_link_3; ?>" class="widefat">
        </p>
        <p>

        <p>
            <label for="<?php echo $this->get_field_id('market_link_4'); ?>"> لینک برگه خودرو (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('market_link_4'); ?>" id="<?php echo $this->get_field_id('market_link_4'); ?>" value="<?php echo $market_link_4; ?>" class="widefat">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('market_link_5'); ?>"> لینک برگه ارزدیجیتال (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('market_link_5'); ?>" id="<?php echo $this->get_field_id('market_link_5'); ?>" value="<?php echo $market_link_5; ?>" class="widefat">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('market_link_6'); ?>"> لینک برگه بورس (آدرس کامل)</label>
            <input type="text" name="<?php echo $this->get_field_name('market_link_6'); ?>" id="<?php echo $this->get_field_id('market_link_6'); ?>" value="<?php echo $market_link_6; ?>" class="widefat">
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

        $instance['market_link_1'] = sanitize_url($new_instance['market_link_1']);
        $instance['market_link_2'] = sanitize_url($new_instance['market_link_2']);
        $instance['market_link_3'] = sanitize_url($new_instance['market_link_3']);
        $instance['market_link_4'] = sanitize_url($new_instance['market_link_4']);
        $instance['market_link_5'] = sanitize_url($new_instance['market_link_5']);
        $instance['market_link_6'] = sanitize_url($new_instance['market_link_6']);

        // $instance['show_desktop'] = ($new_instance['show_desktop']);
        // $instance['show_mobile'] = ($new_instance['show_mobile']);

        return $instance;
    }

    // متد نمایش محتویات ویجت 
    function widget($args, $instance)
    {
        $title = apply_filters('wp_widget_title', $instance['title']);
        $sub_title = $instance['sub_title'];
        $sub_title_print = (!empty($sub_title)) ? '<p>' . $sub_title . '</p>' : '';

        $hide_title      = $instance['hide_title'];


        $market_link_1 = $instance['market_link_1'];
        $market_link_2 = $instance['market_link_2'];
        $market_link_3 = $instance['market_link_3'];
        $market_link_4 = $instance['market_link_4'];
        $market_link_5 = $instance['market_link_5'];
        $market_link_6 = $instance['market_link_6'];

        // $show_mobile  = $instance['show_mobile'];
        // $show_desktop = $instance['show_desktop'];



        echo $args['before_widget'];

        if ($hide_title != 'on') {
            echo '<div class="text-title box-title display-4">';
            echo $args['before_title'] . $title  .  $args['after_title'];
            echo $sub_title_print . '</div>';
        }
    ?>
        <style>
            .i8-col-3 {
                padding: 12px;
                min-width: 93px;
                width: 31%;
                border-radius: 3px;
            }
        </style>
        <div class="gap-2 justify-content-center d-flex flex-wrap">
            <a href="<?php echo ($market_link_1) ? $market_link_1 : '#'; ?>" class="i8-col-3 btn btn-outline-primary market-btn">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-svg" width="32px" height="32px" fill="none" stroke-width="1.5" stroke="var(--i8-light-primary)" viewBox="0 0 24 24" color="var(--i8-light-primary)">
                        <path stroke-width="1.5" stroke-linecap="round" d="m12.147 18.28 1.184-5.8a.6.6 0 0 1 .588-.48h6.162a.6.6 0 0 1 .588.48l1.184 5.8a.6.6 0 0 1-.588.72h-8.53a.6.6 0 0 1-.588-.72Z"></path>
                        <path stroke-width="1.5" stroke-linecap="round" d="m7.147 11.28 1.184-5.8A.6.6 0 0 1 8.918 5h6.164a.6.6 0 0 1 .587.48l1.184 5.8a.6.6 0 0 1-.588.72h-8.53a.6.6 0 0 1-.588-.72Z"></path>
                        <path stroke-width="1.5" stroke-linecap="round" d="m2.147 18.28 1.184-5.8a.6.6 0 0 1 .587-.48h6.163a.6.6 0 0 1 .588.48l1.184 5.8a.6.6 0 0 1-.588.72h-8.53a.6.6 0 0 1-.588-.72Z"></path>
                    </svg>
                </span>
                <span class="d-block ">طلا و سکه</span>
            </a>
            <a href="<?php echo ($market_link_2) ? $market_link_2 : '#'; ?>" class="i8-col-3 btn btn-outline-primary market-btn">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-svg" width="32" height="32" fill="var(--i8-light-primary)" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                        <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" />
                    </svg>
                </span>
                <span class="d-block ">ارز</span>
            </a>
            <a href="<?php echo ($market_link_3) ? $market_link_3 : '#'; ?>" class="i8-col-3 btn btn-outline-primary market-btn">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-svg" width="32" height="32" fill="var(--i8-light-primary)" class="bi bi-newspaper" viewBox="0 0 16 16">
                        <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z" />
                        <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z" />
                    </svg>
                </span>
                <span class="d-block ">روزنامه ها</span>
            </a>
            <a href="<?php echo ($market_link_4) ? $market_link_4 : '#'; ?>" class="i8-col-3 btn btn-outline-primary market-btn">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-svg" width="32" height="32" fill="var(--i8-light-primary)" class="bi bi-car-front" viewBox="0 0 16 16">
                        <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17 1.247 0 2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276Z" />
                        <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.807.807 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155 1.806 0 4.037-.084 5.592-.155A1.479 1.479 0 0 0 15 9.611v-.413c0-.099-.01-.197-.03-.294l-.335-1.68a.807.807 0 0 0-.43-.563 1.807 1.807 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3H4.82Z" />
                    </svg>
                </span>
                <span class="d-block ">خودرو</span>
            </a>
            <a href="<?php echo ($market_link_5) ? $market_link_5 : '#'; ?>" class="i8-col-3 btn btn-outline-primary market-btn">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-svg" width="32px" height="32px" fill="var(--i8-light-primary)" class="bi bi-currency-bitcoin" viewBox="0 0 16 16">
                        <path d="M5.5 13v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.5v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.084c1.992 0 3.416-1.033 3.416-2.82 0-1.502-1.007-2.323-2.186-2.44v-.088c.97-.242 1.683-.974 1.683-2.19C11.997 3.93 10.847 3 9.092 3H9V1.75a.25.25 0 0 0-.25-.25h-1a.25.25 0 0 0-.25.25V3h-.573V1.75a.25.25 0 0 0-.25-.25H5.75a.25.25 0 0 0-.25.25V3l-1.998.011a.25.25 0 0 0-.25.25v.989c0 .137.11.25.248.25l.755-.005a.75.75 0 0 1 .745.75v5.505a.75.75 0 0 1-.75.75l-.748.011a.25.25 0 0 0-.25.25v1c0 .138.112.25.25.25L5.5 13zm1.427-8.513h1.719c.906 0 1.438.498 1.438 1.312 0 .871-.575 1.362-1.877 1.362h-1.28V4.487zm0 4.051h1.84c1.137 0 1.756.58 1.756 1.524 0 .953-.626 1.45-2.158 1.45H6.927V8.539z" />
                    </svg>
                </span>
                <span class="d-block ">ارز دیجیتال</span>
            </a>
            <a href="<?php echo ($market_link_6) ? $market_link_6 : '#'; ?>" class="i8-col-3 btn btn-outline-primary market-btn">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-svg" width="32" height="32" fill="var(--i8-light-primary)" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z" />
                    </svg>
                </span>
                <span class="d-block ">بورس</span>
            </a>
        </div>


<?php
        echo $args['after_widget'];
    }
}


function i8_market_data_btn_box()
{
    register_widget('i8_market_data_btn_box');
}
add_action('widgets_init', 'i8_market_data_btn_box');
