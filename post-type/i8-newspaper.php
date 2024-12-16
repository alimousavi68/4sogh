<?php
// Add custom post type and custom fields
function i8_newspaper_post_type()
{

    register_taxonomy('i8_newspaper_category', 'i8-newspaper', array(
        'labels' => array(
            'name' => 'دسته‌بندی‌های روزنامه',
            'singular_name' => 'دسته‌بندی روزنامه',
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
    ));

    register_post_type('i8-newspaper', array(
        'labels' => array(
            'name' => 'روزنامه',
            'singular_name' => 'شماره روزنامه',
        ),
        'public' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-media-document',
        'supports' => array('title', 'thumbnail'),
        'taxonomies' => array('i8_newspaper_category'),
        'has_archive' => true, 
    ));

    add_action('add_meta_boxes', function () {
        add_meta_box('i8_newspaper_meta_box', 'اطلاعات روزنامه', 'i8_newspaper_meta_box_callback', 'i8-newspaper', 'side', 'high');
    });

    add_action('save_post', function ($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        if (isset($_POST['i8_print_number'])) {
            update_post_meta($post_id, '_i8_print_number', intval($_POST['i8_print_number']));
        }
        if (isset($_POST['i8_print_year'])) {
            update_post_meta($post_id, '_i8_print_year', sanitize_text_field($_POST['i8_print_year']));
        }
        if (isset($_POST['i8_pdf'])) {
            update_post_meta($post_id, '_i8_pdf', esc_url($_POST['i8_pdf']));
        }
        if (isset($_POST['i8_pages'])) {
            update_post_meta($post_id, '_i8_pages', $_POST['i8_pages']);
        }
    });

    add_action('add_meta_boxes', function () {
        add_meta_box('i8_pages_meta_box', 'صفحات روزنامه', 'i8_pages_meta_box_callback', 'i8-newspaper', 'normal', 'default');
    });
}
add_action('init', 'i8_newspaper_post_type');

function enqueue_select2() {
    wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css');
    wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'enqueue_select2');

function i8_newspaper_meta_box_callback($post)
{
    $print_number = get_post_meta($post->ID, '_i8_print_number', true);
    $print_year = get_post_meta($post->ID, '_i8_print_year', true);
    $pdf = get_post_meta($post->ID, '_i8_pdf', true);
    ?>
    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
        <div style="flex: 1;">
            <label>شماره چاپ: </label>
            <input type="number" name="i8_print_number" value="<?php echo esc_attr($print_number); ?>" style="width: 100%;" />
        </div>
        <div style="flex: 1;">
            <label>سال چاپ: </label>
            <select name="i8_print_year" style="width: 100%;">
                <?php
                $years = array('سال اول', 'سال دوم', 'سال سوم', 'سال چهارم', 'سال پنجم', 'سال ششم', 'سال هفتم', 'سال هشتم', 'سال نهم', 'سال دهم');
                foreach ($years as $year): ?>
                    <option value="<?php echo esc_attr($year); ?>" <?php selected($print_year, $year); ?>><?php echo esc_html($year); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div style="flex: 1;display: flex;flex-direction: column;">
            <label>PDF کل صفحات: </label>
            <button type="button" class="upload-pdf-button" style="display: flex;flex-direction: row;align-items: center;justify-content: center;gap: 5px;" data-target="i8_pdf">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                </svg>
                آپلود فایل
            </button>
            <input type="hidden" id="i8_pdf" name="i8_pdf" value="<?php echo esc_url($pdf); ?>" />
            <p class="pdf-preview"><?php echo $pdf ? '<a href="' . esc_url($pdf) . '" target="_blank">مشاهده فایل</a>' : ''; ?></p>
        </div>
    </div>
    <?php
}

function i8_pages_meta_box_callback($post)
{
    $pages = get_post_meta($post->ID, '_i8_pages', true);
    $categories = get_terms(array('taxonomy' => 'i8_newspaper_category', 'hide_empty' => false));
    
    $draw_attention_posts = get_posts(array(
        'post_type' => 'da_image',
        'numberposts' => 100,
        'orderby' => 'date',
    ));
    
    $draw_attention_options = array();
    foreach ($draw_attention_posts as $draw_post) {
        $draw_attention_options[$draw_post->ID] = $draw_post->post_title;
    }
    ?>
    <div id="i8-pages-container" style="margin-bottom: 20px;">
        <?php if (!empty($pages)):
            foreach ($pages as $index => $page): ?>
                <div class="i8-page" style="border: 1px solid rgb(221, 221, 221);padding: 15px;margin-bottom: 15px;position: relative;display: flex;flex-direction: column;padding-top: 25px;">
                    <button type="button" class="remove-page" style="position: absolute; top: 10px; left: 10px; background: #f44336; color: #fff; border: none; border-radius: 50%; width: 25px; height: 25px; text-align: center;">×</button>
                    <label>شماره صفحه: </label>
                    <input type="number" name="i8_pages[<?php echo $index; ?>][number]" value="<?php echo esc_attr($page['number']); ?>" style="width: 100%;" /><br>
                    
                    <label>آدرس تصویر صفحه: </label>
                    <select name="i8_pages[<?php echo $index; ?>][image]" class="draw-attention-select" style="width: 100%;">
                        <option value="">انتخاب تصویر</option>
                        <?php foreach ($draw_attention_options as $id => $title): ?>
                            <option value="<?php echo esc_attr($id); ?>" <?php selected($page['image'], $id); ?>>
                                <?php echo esc_html($title); ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>

                    <label>دسته‌بندی: </label>
                    <select name="i8_pages[<?php echo $index; ?>][category]" style="width: 100%;">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo esc_attr($category->slug); ?>" <?php selected($page['category'], $category->slug); ?>>
                                <?php echo esc_html($category->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>

                    <label>PDF صفحه: </label>
                    <button type="button" class="upload-pdf-button" data-target="i8_pages_<?php echo $index; ?>_pdf">آپلود فایل</button>
                    <input type="hidden" id="i8_pages_<?php echo $index; ?>_pdf" name="i8_pages[<?php echo $index; ?>][pdf]" value="<?php echo esc_url($page['pdf']); ?>" />
                    <p class="pdf-preview"><?php echo $page['pdf'] ? '<a href="' . esc_url($page['pdf']) . '" target="_blank">مشاهده فایل</a>' : ''; ?></p>
                </div>
            <?php endforeach; endif; ?>
    </div>
    <button type="button" id="add-page" style="background: #0073aa; color: #fff; padding: 10px 15px; border: none; cursor: pointer;">افزودن صفحه جدید</button>
    <script>
       jQuery(document).ready(function ($) {
    function setupPdfUploadButton(button) {
        const targetInputId = button.dataset.target;
        const targetInput = document.getElementById(targetInputId);

        button.addEventListener('click', function (e) {
            e.preventDefault(); // جلوگیری از رفتار پیش‌فرض
            const mediaUploader = wp.media({
                title: 'انتخاب فایل PDF',
                button: {
                    text: 'انتخاب فایل'
                },
                multiple: false // تنها انتخاب یک فایل مجاز است
            }).on('select', function () {
                const attachment = mediaUploader.state().get('selection').first().toJSON();
                targetInput.value = attachment.url;

                const preview = targetInput.nextElementSibling;
                if (preview && preview.classList.contains('pdf-preview')) {
                    preview.innerHTML = `<a href="${attachment.url}" target="_blank">مشاهده فایل</a>`;
                }
            });
            mediaUploader.open();
        });
    }

    // تنظیم دکمه آپلود PDF اصلی
    const mainPdfButton = document.querySelector('.upload-pdf-button[data-target="i8_pdf"]');
    if (mainPdfButton) {
        setupPdfUploadButton(mainPdfButton);
    }

    // تنظیم دکمه‌های آپلود PDF در صفحات
    const container = document.getElementById('i8-pages-container');
    if (container) {
        container.querySelectorAll('.upload-pdf-button').forEach(function (button) {
            setupPdfUploadButton(button);
        });
    }

    // اضافه کردن صفحه جدید
    let pageCount = <?php echo !empty($pages) ? count($pages) : 0; ?>;
    $('#add-page').on('click', function () {
        const div = $(`
            <div class="i8-page" style="border: 1px solid rgb(221, 221, 221);padding: 15px;margin-bottom: 15px;position: relative;display: flex;flex-direction: column;padding-top: 25px;">
                <button type="button" class="remove-page" style="position: absolute; top: 10px; left: 10px; background: #f44336; color: #fff; border: none; border-radius: 50%; width: 25px; height: 25px; text-align: center;">×</button>
                <label>شماره صفحه: </label>
                <input type="number" name="i8_pages[${pageCount}][number]" style="width: 100%;" /><br>
                <label>آدرس تصویر صفحه: </label>
                <select name="i8_pages[${pageCount}][image]" class="draw-attention-select" style="width: 100%;">
                    <option value="">انتخاب تصویر</option>
                    <?php foreach ($draw_attention_options as $id => $title): ?>
                        <option value="<?php echo esc_attr($id); ?>"><?php echo esc_html($title); ?></option>
                    <?php endforeach; ?>
                </select><br>
                <label>دسته‌بندی: </label>
                <select name="i8_pages[${pageCount}][category]" style="width: 100%;">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo esc_attr($category->slug); ?>"><?php echo esc_html($category->name); ?></option>
                    <?php endforeach; ?>
                </select><br>
                <label>PDF صفحه: </label>
                <button type="button" class="upload-pdf-button" data-target="i8_pages_${pageCount}_pdf">آپلود فایل</button>
                <input type="hidden" id="i8_pages_${pageCount}_pdf" name="i8_pages[${pageCount}][pdf]" />
                <p class="pdf-preview"></p>
            </div>
        `);
        $('#i8-pages-container').append(div);
        setupPdfUploadButton(div.find('.upload-pdf-button')[0]);
        div.find('.remove-page').on('click', function () {
            div.remove();
        });
        pageCount++;
    });
});

    </script>
    <?php
}

function get_pages_by_category($post_id) {
    // دریافت اطلاعات پست
    $pages = get_post_meta($post_id, '_i8_pages', true);
    $categories = get_the_terms($post_id, 'i8_newspaper_category');

    // بررسی وجود صفحات و دسته‌بندی‌ها
    if (empty($pages) || is_wp_error($categories)) {
        return 'هیچ صفحه‌ای برای این پست وجود ندارد.';
    }

    // آرایه برای نگهداری اطلاعات دسته‌بندی و شماره صفحات
    $category_pages = [];

    // پردازش هر صفحه
    foreach ($pages as $page) {
        $category_slug = $page['category'];
        $page_number = $page['number'];

        // بررسی وجود دسته‌بندی در آرایه
        if (!isset($category_pages[$category_slug])) {
            $category_pages[$category_slug] = [];
        }

        // اضافه کردن شماره صفحه به دسته‌بندی مربوطه
        $category_pages[$category_slug][] = $page_number;
    }

    // استفاده از تابع
    $current_url = get_current_page_url_without_query();
    $np_number = $post_id;

    // دریافت شماره صفحه فعال از query string
    $active_page = isset($_GET['np-page']) ? intval($_GET['np-page']) : 1;

    // ساخت خروجی نهایی به صورت لیست HTML
    $output = '<ul class="news-paper-pagemenu d-flex flex-row row-gap-1 flex-md-column row-gap-1 justify-content-between w-100">';
    foreach ($category_pages as $slug => $page_numbers) {
        $category = get_term_by('slug', $slug, 'i8_newspaper_category');
        if ($category) {
            $output .= '<li>';
            $output .= '<span class="d-none d-md-inline">' . esc_html($category->name) . '</span>';
            $output .= '<div class="np-item-number">';
            foreach ($page_numbers as $number) {
                // بررسی اینکه آیا شماره صفحه برابر با شماره صفحه فعال است یا خیر
                if ($number == $active_page) {
                    $output .= '<span class="np-active"><a class="np-item-number-link" href="' . esc_url($current_url . '?np-number=' . intval($np_number). '&np-page=' . intval($number)) . '">' . esc_html($number) . '</a></span>';
                } else {
                    $output .= '<span><a class="np-item-number-link" href="' . esc_url($current_url . '?np-number=' . intval($np_number). '&np-page=' . intval($number)) . '">' . esc_html($number) . '</a></span>';
                }
            }
            $output .= '</div>';
            $output .= '</li>';
        }
    }
    $output .= '</ul>';

    return $output;
}



function get_last_i8_newspaper_post_id() {
    // تنظیمات کوئری برای دریافت آخرین پست از پست تایپ da_image
    $args = array(
        'post_type' => 'i8-newspaper',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    );

    // واکشی پست‌ها
    $last_post = get_posts($args);

    // بررسی وجود پست
    if (!empty($last_post)) {
        return $last_post[0]->ID; // برگرداندن ID آخرین پست
    }

    return null; // اگر پستی وجود نداشت، null برمی‌گرداند
}


function get_last_post_year_and_number_meta() 
{
    $args = array(
        'post_type' => 'i8-newspaper',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $last_post = get_posts($args);

    // بررسی وجود پست
    if (!empty($last_post)) {
        $i8_print_year = get_post_meta(  $last_post[0]->ID,   '_i8_print_year', true);
        $i8_print_number = get_post_meta($last_post[0]->ID, '_i8_print_number', true);

        return array(
            'year' => $i8_print_year,
            'number' => $i8_print_number,
        );
    }
    else {
        return array(
            'year' => '',
            'number' => '',
        );
    }
    
}


// function get retrive specific _i8_pdf value from database
function get_i8_pdf_value($post_id , $page_number) {

    $post = get_post( $post_id);

    // بررسی وجود پست
    if (!empty($post)) {
        $pdf_full = get_post_meta(  $post->ID,   '_i8_pdf', true);
        $all_post_meta_page = get_post_meta($post->ID, '_i8_pages', true);
        $pdf_page = $all_post_meta_page[$page_number-1]['pdf'];

        return array(
            'pdf_full' => $pdf_full,
            'pdf_page' => $pdf_page,
        );
    }
    else {
        return array(
            'pdf_full' => '',
            'pdf_page' => '',
        );
    }
}




