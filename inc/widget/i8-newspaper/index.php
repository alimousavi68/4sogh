<?php
// اضافه کردن ابزارک به وردپرس
class I8_Newspaper_Widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'i8_newspaper_widget', // نام ابزارک
            __('آرشیو i8 Newspaper', 'text_domain'), // عنوان ابزارک
            array('description' => __('ابزارک نمایش آرشیو پست‌های i8 Newspaper', 'text_domain')) // توضیحات
        );
    }

    // تابع نمایش ابزارک
    public function widget($args, $instance)
    {
        $number_of_posts = !empty($instance['number_of_posts']) ? $instance['number_of_posts'] : 5;
        $offset = !empty($instance['offset']) ? $instance['offset'] : 0; // مقدار offset

        if (is_singular('i8-newspaper')) {
            $post = get_post();
            $query_args = array(
                'post_type' => 'i8-newspaper',
                'posts_per_page' => $number_of_posts,
                'offset' => $offset, // استفاده از offset
                'post__not_in' => array($post->ID),
            );
            $query = new WP_Query($query_args);
        } else {
            // دریافت پست‌ها
            $query_args = array(
                'post_type' => 'i8-newspaper',
                'posts_per_page' => $number_of_posts,
                'offset' => $offset, // استفاده از offset
            );
            $query = new WP_Query($query_args);
        }

        // شروع خروجی
        echo $args['before_widget'];
        ?>
        <div class="widget-container">
            <div class="widget-header d-flex align-items-center justify-content-between cornner-tr">
                <div class="widget-title d-flex align-items-center gap-2 justify-content-start">
                    <span class="fw-6 fs-5 icon-before-qoute">آرشیو</span>
                </div>
            </div>
            <div class="widget-body row">
                <div class="d-flex flex-lg-column flex-row i8-post-items-list px-0 row row-gap-3 ">
                    <?php
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            ?>
                            <div class="col-12 col-md-24 i8-post-item d-flex flex-column row-gap-2 border-bottom-dashed pb-2">
                                <div class="i8-post-item-img">
                                    <a href="<?php the_permalink(); ?>" class="image_frame">
                                        <?php echo i8_the_thumbnail('', 'hover multi-item-thumb w-100 i8-img-fit', array("width" => '100%', "height" => 'auto'), true, '', false, true); ?>
                                    </a>
                                </div>
                                <div class="i8-post-item-content">
                                    <a class="arrow-bullet d-flex align-items-center i8-blink" href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<p>پستی وجود ندارد.</p>';
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }

    // تابع تنظیمات ابزارک
    public function form($instance)
    {
        $number_of_posts = !empty($instance['number_of_posts']) ? $instance['number_of_posts'] : 5;
        $offset = !empty($instance['offset']) ? $instance['offset'] : 0; // مقدار offset ?>
        <p>
            <label for="<?php echo $this->get_field_id('number_of_posts'); ?>"><?php _e('تعداد پست‌ها:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number_of_posts'); ?>"
                name="<?php echo $this->get_field_name('number_of_posts'); ?>" type="number"
                value="<?php echo esc_attr($number_of_posts); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('offset'); ?>"><?php _e('مقدار Offset:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('offset'); ?>"
                name="<?php echo $this->get_field_name('offset'); ?>" type="number" value="<?php echo esc_attr($offset); ?>" />
        </p>
        <?php
    }

    // تابع ذخیره تنظیمات ابزارک
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['number_of_posts'] = (!empty($new_instance['number_of_posts'])) ? strip_tags($new_instance['number_of_posts']) : '';
        $instance['offset'] = (!empty($new_instance['offset'])) ? strip_tags($new_instance['offset']) : ''; // ذخیره مقدار offset
        return $instance;
    }
}

// ثبت ابزارک
function register_i8_newspaper_widget()
{
    register_widget('I8_Newspaper_Widget');
}
add_action('widgets_init', 'register_i8_newspaper_widget');