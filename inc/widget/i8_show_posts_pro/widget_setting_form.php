<?php

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
        <input type="checkbox" name="<?php echo $this->get_field_name('hide_title'); ?>" id="<?php echo $this->get_field_id('hide_title'); ?>" class="checkbox" <?php echo ($hide_title == 'on') ? 'checked="checked"' : ''; ?>>
        <label for="<?php echo $this->get_field_id('hide_title'); ?>">مخفی سازی عنوان</label>
    </p>
    <p>
        <input type="checkbox" name="<?php echo $this->get_field_name('hide_thumb'); ?>" id="<?php echo $this->get_field_id('hide_thumb'); ?>" class="checkbox" <?php echo ($hide_thumb == 'on') ? 'checked="checked"' : ''; ?>>
        <label for="<?php echo $this->get_field_id('hide_thumb'); ?>">مخفی سازی تصویر مطلب</label>
    </p>
    <p>
        <input type="checkbox" name="<?php echo $this->get_field_name('hide_excerpt'); ?>" id="<?php echo $this->get_field_id('hide_excerpt'); ?>" class="checkbox" <?php echo ($hide_excerpt == 'on') ? 'checked="checked"' : ''; ?>>
        <label for="<?php echo $this->get_field_id('hide_excerpt'); ?>">مخفی سازی خلاصه مطلب</label>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('icon_list_bullet'); ?>">آیکن کنار تیتر ( کد svg)</label>
        <textarea type="text" name="<?php echo $this->get_field_name('icon_list_bullet'); ?>" id="<?php echo $this->get_field_id('icon_list_bullet'); ?>" style="text-align:left;direction:ltr;" class="widefat" cols="30" rows="4"><?php echo $icon_list_bullet; ?></textarea>
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
        <label for="<?php echo $this->get_field_id('icon'); ?>">آیکن هدر ( کد svg)</label>
        <textarea type="text" name="<?php echo $this->get_field_name('icon'); ?>" id="<?php echo $this->get_field_id('icon'); ?>" style="text-align:left;direction:ltr;" class="widefat" cols="30" rows="4"><?php echo $icon; ?></textarea>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('icon_img'); ?>">تصویر آیکن (آدرس تصویر)</label>
        <input type="text" name="<?php echo $this->get_field_name('icon_img'); ?>" id="<?php echo $this->get_field_id('icon_img'); ?>" value="<?php echo $icon_img; ?>" class="widefat">
    </p>
    <p>
        <input type="checkbox" name="<?php echo $this->get_field_name('icon_animate'); ?>" id="<?php echo $this->get_field_id('icon_animate'); ?>" class="checkbox" <?php echo ($icon_animate == true) ? 'checked="checked"' : ''; ?>>
        <label for="<?php echo $this->get_field_id('icon_animate'); ?>">متحرک سازی آیکن</label>
    </p>
</div>
<div class="i8-panel">
    <span class="i8-panel-title">تنظیمات دسته بندی</span>
    <p>
        <label for="<?php echo $this->get_field_id('cat'); ?>">دسته بندی</label>
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
        <label for="<?php echo $this->get_field_id('num'); ?>">تعداد</label>
        <input type="number" name="<?php echo $this->get_field_name('num'); ?>" id="<?php echo $this->get_field_id('num'); ?>" value="<?php echo (!empty($num)) ? $num : 5; ?>" class="widefat">
    </p>
</div>
<div class="i8-panel">
    <span class="i8-panel-title">تنظیمات نمایش</span>
    <p>
        <label for="<?php echo $this->get_field_id('orderby'); ?>">ترتیب نمایش</label>
        <select name="<?php echo $this->get_field_name('orderby'); ?>" id="<?php echo $this->get_field_id('orderby'); ?>" class="widefat">
            <option value="0">انتخاب کنید</option>
            <?php
            foreach ($this->orderby as $orderby_name => $orderby_value) :

                echo '<option value="' . $orderby_value . '" ' . selected($orderby, $orderby_value, false) . '>' . $orderby_name . '</option>';
            endforeach;
            ?>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('display_style'); ?>">استایل نمایش</label>
        <select name="<?php echo $this->get_field_name('display_style'); ?>" id="<?php echo $this->get_field_id('display_style'); ?>" onchange="toggleSelectBox()" class="widefat">
            <option value="0">انتخاب کنید</option>
            <?php
            foreach ($this->display_style as $style_name => $style_value) :

                echo '<option value="' . $style_value . '" ' . selected($display_style, $style_value, false) . '>' . $style_name . '</option>';
            endforeach;
            ?>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('thumb_radius'); ?>"> زاویه لبه عکس</label>
        <select name="<?php echo $this->get_field_name('thumb_radius'); ?>" id="<?php echo $this->get_field_id('thumb_radius'); ?>" class="widefat">
            <?php for ($i = 0; $i <= 5; $i++) { ?>
                <option value='<?php echo 'rounded-' . $i; ?>' <?php selected($thumb_radius, 'rounded-' . $i, true); ?>><?php echo 'گوش های خمیده ' . $i; ?></option>
            <?php } ?>
            <option value="rounded-circle" <?php selected($thumb_radius, 'rounded-circle', true); ?>>دایره</option>
            <option value="rounded-pill" <?php selected($thumb_radius, 'rounded-pill', true); ?>>بیضی</option>
            <option value="rounded-start" <?php selected($thumb_radius, 'rounded-start', true); ?>>شروع گرد</option>
            <option value="rounded-bottom" <?php selected($thumb_radius, 'rounded-bottom', true); ?>>پایین گرد</option>
            <option value="rounded-end" <?php selected($thumb_radius, 'rounded-end', true); ?>>پایان گرد</option>
            <option value="rounded-top" <?php selected($thumb_radius, 'rounded-top', true); ?>>بالا گرد</option>
        </select>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('head_font_size'); ?>">سایز فونت هدر</label>
        <select name="<?php echo $this->get_field_name('head_font_size'); ?>" id="<?php echo $this->get_field_id('head_font_size'); ?>" class="widefat">
            <?php for ($i = 1; $i <= 6; $i++) { ?>
                <option value='<?php echo 'display-' . $i; ?>' <?php selected($head_font_size, 'display-' . $i, true); ?>><?php echo 'سایز -  ' . $i; ?></option>
            <?php } ?>
        </select>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('title_font_size'); ?>">سایز تیتر</label>
        <select name="<?php echo $this->get_field_name('title_font_size'); ?>" id="<?php echo $this->get_field_id('title_font_size'); ?>" class="widefat">
            <?php for ($i = 1; $i <= 6; $i++) { ?>
                <option value='<?php echo 'display-' . $i; ?>' <?php selected($title_font_size, 'display-' . $i, true); ?>><?php echo 'سایز -  ' . $i; ?></option>
            <?php } ?>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('title_font_weight'); ?>">وزن تیتر</label>
        <select name="<?php echo $this->get_field_name('title_font_weight'); ?>" id="<?php echo $this->get_field_id('title_font_weight'); ?>" class="widefat">
            <?php for ($i = 1; $i <= 10; $i++) { ?>
                <option value='<?php echo 'fw-' . $i; ?>' <?php selected($title_font_weight, 'fw-' . $i, true); ?>><?php echo 'وزن -  ' . $i; ?></option>
            <?php } ?>
        </select>
    </p>

    <div style="display: flex;flex-direction: row;gap: 9px;">
        <p style="width:50%;">
            <label for="<?php echo $this->get_field_id('thumb_width'); ?>">طول تصویر</label>
            <input type="number" min="30" name="<?php echo $this->get_field_name('thumb_width'); ?>" id="<?php echo $this->get_field_id('thumb_width'); ?>" value="<?php echo (!empty($thumb_width)) ? $thumb_width : 75; ?>" class="widefat">
        </p>
        <p style="width:50%;">
            <label for="<?php echo $this->get_field_id('thumb_height'); ?>">عرض تصویر</label>
            <input type="number" min="30" name="<?php echo $this->get_field_name('thumb_height'); ?>" id="<?php echo $this->get_field_id('thumb_height'); ?>" value="<?php echo (!empty($thumb_height)) ? $thumb_height : 75; ?>" class="widefat">
        </p>
    </div>

    <p>
        <label for="<?php echo $this->get_field_id('display_column_num_desktop'); ?>">تعداد ستون در دسکتاپ</label>
        <select name="<?php echo $this->get_field_name('display_column_num_desktop'); ?>" id="<?php echo $this->get_field_id('display_column_num_desktop'); ?>" class="widefat">
            <?php for ($i = 1; $i < 7; $i++) {
                if ($i != 5) :
            ?>
                    <option value='<?php echo $i; ?>' <?php selected($display_column_num_desktop, $i, true); ?>><?php echo $i; ?></option>
            <?php
                endif;
            } ?>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('display_column_num_mini_desktop'); ?>">تعداد ستون در دسکتاپ(نمایشگر های کوچک)</label>
        <select name="<?php echo $this->get_field_name('display_column_num_mini_desktop'); ?>" id="<?php echo $this->get_field_id('display_column_num_mini_desktop'); ?>" class="widefat">
            <?php for ($i = 1; $i < 7; $i++) {
                if ($i != 5) :
            ?>
                    <option value='<?php echo $i; ?>' <?php selected($display_column_num_mini_desktop, $i, true); ?>><?php echo $i; ?></option>
            <?php
                endif;
            } ?>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('display_column_num_tablet'); ?>">تعداد ستون در تبلت</label>
        <select name="<?php echo $this->get_field_name('display_column_num_tablet'); ?>" id="<?php echo $this->get_field_id('display_column_num_tablet'); ?>" class="widefat">
            <?php for ($i = 1; $i < 7; $i++) {
                if ($i != 5) :
            ?>
                    <option value='<?php echo $i; ?>' <?php selected($display_column_num_tablet, $i, true); ?>><?php echo $i; ?></option>
            <?php
                endif;
            } ?>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('display_column_num_mobile'); ?>">تعداد ستون در موبایل</label>
        <select name="<?php echo $this->get_field_name('display_column_num_mobile'); ?>" id="<?php echo $this->get_field_id('display_column_num_mobile'); ?>" class="widefat">
            <?php for ($i = 1; $i < 7; $i++) {
                if ($i != 5) :
            ?>
                    <option value='<?php echo $i; ?>' <?php selected($display_column_num_mobile, $i, true); ?>><?php echo $i; ?></option>
            <?php
                endif;
            } ?>
        </select>
    </p>
    <p>
        <input type="checkbox" name="<?php echo $this->get_field_name('show_desktop'); ?>" id="<?php echo $this->get_field_id('show_desktop'); ?>" class="checkbox" <?php echo ($show_desktop == 'on') ? 'checked="checked"' : ''; ?>>
        <label for="<?php echo $this->get_field_id('show_desktop'); ?>">نمایش دسکتاپ</label>
    </p>
    <p>
        <input type="checkbox" name="<?php echo $this->get_field_name('show_mobile'); ?>" id="<?php echo $this->get_field_id('show_mobile'); ?>" class="checkbox" <?php echo ($show_mobile == 'on') ? 'checked="checked"' : ''; ?>>
        <label for="<?php echo $this->get_field_id('show_mobile'); ?>">نمایش موبایل</label>
    </p>
</div>