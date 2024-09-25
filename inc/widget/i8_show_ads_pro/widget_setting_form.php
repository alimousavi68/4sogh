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
        <label for="<?php echo $this->get_field_id('icon_list_bullet'); ?>">آیکن کنار تیتر ( کد svg)</label>
        <!-- <textarea type="text" name="<?php echo $this->get_field_name('icon_list_bullet'); ?>" id="<?php echo $this->get_field_id('icon_list_bullet'); ?>" style="text-align:left;direction:ltr;" class="widefat" cols="30" rows="4"><?php echo $icon_list_bullet; ?></textarea> -->
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
</div>

<div class="i8-panel">
    <span class="i8-panel-title">تنظیمات نمایش</span>
    <!-- file type  -->
    <p>
        <label for="<?php echo $this->get_field_id('file_type'); ?>"> نوع فایل</label>
        <select name="<?php echo $this->get_field_name('file_type'); ?>" id="<?php echo $this->get_field_id('file_type'); ?>" onchange="toggleSelectBox()" class="widefat">
            <option value="0">انتخاب کنید</option>
            <?php
            foreach ($this->file_type as $file_type_name => $file_type_value) :
                echo '<option value="' . $file_type_value . '" ' . selected($file_type, $file_type_value, false) . '>' . $file_type_name . '</option>';
            endforeach;
            ?>
        </select>
    </p>
    <!-- file src -->
    <p>
        <label for="<?php echo $this->get_field_id('file_src'); ?>">آدرس فایل</label>
        <input type="text" name="<?php echo $this->get_field_name('file_src'); ?>" id="<?php echo $this->get_field_id('file_src'); ?>" value="<?php echo $file_src; ?>" class="widefat">
    </p>
    <!-- link url -->
    <p>
        <label for="<?php echo $this->get_field_id('link_url'); ?>">آدرس لینک</label>
        <input type="text" name="<?php echo $this->get_field_name('link_url'); ?>" id="<?php echo $this->get_field_id('link_url'); ?>" value="<?php echo $link_url; ?>" class="widefat">
    </p>
    <!-- file alt -->
    <p>
        <label for="<?php echo $this->get_field_id('file_alt'); ?>">توضیح کوتاه</label>
        <input type="text" name="<?php echo $this->get_field_name('file_alt'); ?>" id="<?php echo $this->get_field_id('file_alt'); ?>" value="<?php echo $file_alt; ?>" class="widefat">
    </p>
    <!-- load method -->
    <p>
        <label for="<?php echo $this->get_field_id('load_method'); ?>"> نوع بارگذاری</label>
        <select name="<?php echo $this->get_field_name('load_method'); ?>" id="<?php echo $this->get_field_id('load_method'); ?>" onchange="toggleSelectBox()" class="widefat">
            <option value="0">انتخاب کنید</option>
            <?php
            foreach ($this->load_method as $load_method_name => $load_method_value) :
                echo '<option value="' . $load_method_value . '" ' . selected($load_method, $load_method_value, false) . '>' . $load_method_name . '</option>';
            endforeach;
            ?>
        </select>
    </p>
    <!-- class -->
    <p>
        <label for="<?php echo $this->get_field_id('class'); ?>">کلاس استایل ها</label>
        <input type="text" name="<?php echo $this->get_field_name('class'); ?>" id="<?php echo $this->get_field_id('class'); ?>" value="<?php echo $class; ?>" class="widefat">
    </p>
    <!-- width and height -->
    <div style="display: flex;flex-direction: row;gap: 9px;">
        <p style="width:50%;">
            <label for="<?php echo $this->get_field_id('width'); ?>">طول تصویر/ ویدیو</label>
            <input type="number" min="30" name="<?php echo $this->get_field_name('width'); ?>" id="<?php echo $this->get_field_id('width'); ?>" value="<?php echo (!empty($width)) ? $width : 300; ?>" class="widefat">
        </p>
        <p style="width:50%;">
            <label for="<?php echo $this->get_field_id('height'); ?>">عرض تصویر/ ویدیو</label>
            <input type="number" min="30" name="<?php echo $this->get_field_name('height'); ?>" id="<?php echo $this->get_field_id('height'); ?>" value="<?php echo (!empty($height)) ? $height : 100; ?>" class="widefat">
        </p>
    </div>


    <p>
        <input type="checkbox" name="<?php echo $this->get_field_name('show_desktop'); ?>" id="<?php echo $this->get_field_id('show_desktop'); ?>" class="checkbox" <?php echo ($show_desktop == 'on') ? 'checked="checked"' : ''; ?>>
        <label for="<?php echo $this->get_field_id('show_desktop'); ?>">نمایش دسکتاپ</label>
    </p>
    <p>
        <input type="checkbox" name="<?php echo $this->get_field_name('show_mobile'); ?>" id="<?php echo $this->get_field_id('show_mobile'); ?>" class="checkbox" <?php echo ($show_mobile == 'on') ? 'checked="checked"' : ''; ?>>
        <label for="<?php echo $this->get_field_id('show_mobile'); ?>">نمایش موبایل</label>
    </p>
</div>