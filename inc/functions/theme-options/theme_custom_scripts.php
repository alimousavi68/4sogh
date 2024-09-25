<?php
/**
 * 
 * Customize Theme 
 * 
 */
add_action('customize_register', 'i8_custom_script');
function i8_custom_script($wp_customize)
{
    /**
     * Add Sections
     */
    $wp_customize->add_section('i8_theme_custom_scripts_section', array(
        'title' => __('اسکریپت های سفارشی', 'i8_theme'),
        'priority'  => 30
    ));

    /**
     * Add Setting
     */
    $wp_customize->add_setting('i8_custom_scripts_header_immididally_load',  array('default' => '', 'transport' => 'postMessage'));
    $wp_customize->add_setting('i8_custom_scripts_header_scroll_load',  array('default' => '', 'transport' => 'postMessage'));
    $wp_customize->add_setting('i8_custom_scripts_header_defer_load',  array('default' => '', 'transport' => 'postMessage'));

    $wp_customize->add_setting('i8_custom_scripts_footer_immididally_load', array('default' => '', 'transport' => 'postMessage'));
    $wp_customize->add_setting('i8_custom_scripts_footer_scroll_load', array('default' => '', 'transport' => 'postMessage'));
    $wp_customize->add_setting('i8_custom_scripts_footer_defer_load', array('default' => '', 'transport' => 'postMessage'));


    /**
     * Add Controls
     */
    $wp_customize->add_control(new WP_Customize_Code_Editor_Control($wp_customize, 'i8_custom_scripts_header_immididally_load', array(
        'label' => __('کد سفارشی هدر / اجرای آنی', 'i8_theme'),
        'section' => 'i8_theme_custom_scripts_section',
        'settings' => 'i8_custom_scripts_header_immididally_load',
        'theme' => 'dracula', 
        'options' => array('lineNumbers' => true) 
    )));
    $wp_customize->add_control(new WP_Customize_Code_Editor_Control($wp_customize, 'i8_custom_scripts_header_scroll_load', array(
        'label' => __('کد سفارشی هدر / اجرای با اسکرول', 'i8_theme'),
        'description' => esc_html__('نکته: کدهای خود را از بلوک &lt;script&gt; خارج کنید!', 'i8_theme'),
        'section' => 'i8_theme_custom_scripts_section',
        'settings' => 'i8_custom_scripts_header_scroll_load',
        'code_type' => 'text/javascript', 
        'theme' => 'dracula', 
        'options' => array('lineNumbers' => true) 
    )));
    $wp_customize->add_control(new WP_Customize_Code_Editor_Control($wp_customize, 'i8_custom_scripts_header_defer_load', array(
        'label' => __('کد سفارشی هدر / اجرای با تاخیر', 'i8_theme'),
        'description' => esc_html__('نکته: کدهای خود را از بلوک &lt;script&gt; خارج کنید!', 'i8_theme'),
        'section' => 'i8_theme_custom_scripts_section',
        'settings' => 'i8_custom_scripts_header_defer_load',
        'code_type' => 'text/javascript', 
        'theme' => 'dracula', 
        'options' => array('lineNumbers' => true) 
    )));

    $wp_customize->add_control(new WP_Customize_Code_Editor_Control($wp_customize, 'i8_custom_scripts_footer_immididally_load', array(
        'label' => __('کد سفارشی فوتر / اجرای آنی', 'i8_theme'),
        'section' => 'i8_theme_custom_scripts_section',
        'settings' => 'i8_custom_scripts_footer_immididally_load',
        'theme' => 'dracula', 
        'options' => array('lineNumbers' => true) 
    )));
    $wp_customize->add_control(new WP_Customize_Code_Editor_Control($wp_customize, 'i8_custom_scripts_footer_scroll_load', array(
        'label' => __('کد سفارشی فوتر / اجرای با اسکرول', 'i8_theme'),
        'description' => esc_html__('نکته: کدهای خود را از بلوک &lt;script&gt; خارج کنید!', 'i8_theme'),
        'section' => 'i8_theme_custom_scripts_section',
        'settings' => 'i8_custom_scripts_footer_scroll_load',
        'code_type' => 'text/javascript', 
        'theme' => 'dracula', 
        'options' => array('lineNumbers' => true) 
    )));
    $wp_customize->add_control(new WP_Customize_Code_Editor_Control($wp_customize, 'i8_custom_scripts_footer_defer_load', array(
        'label' => __('کد سفارشی فوتر / اجرای با تاخیر', 'i8_theme'),
        'description' => esc_html__('نکته: کدهای خود را از بلوک &lt;script&gt; خارج کنید!', 'i8_theme'),
        'section' => 'i8_theme_custom_scripts_section',
        'settings' => 'i8_custom_scripts_footer_defer_load',
        'code_type' => 'text/javascript', 
        'theme' => 'dracula', 
        'options' => array('lineNumbers' => true) 
    )));
}



/**
 * Add customize code to header
 *
 * 
 */
function i8_add_custom_scripts_header_immididally_load()
{
    $i8_custom_scripts_header_immididally_load   = get_theme_mod('i8_custom_scripts_header_immididally_load');
    if ($i8_custom_scripts_header_immididally_load) {
        echo $i8_custom_scripts_header_immididally_load;
    }
}
add_action('wp_head', 'i8_add_custom_scripts_header_immididally_load');

function i8_add_custom_scripts_header_defer_load()
{
    $i8_custom_scripts_header_defer_load   = get_theme_mod('i8_custom_scripts_header_defer_load');
    if ($i8_custom_scripts_header_defer_load) {
        echo '<script type="text/javascript" defer>';
        echo $i8_custom_scripts_header_defer_load;
        echo '</script>';
    }
}
add_action('wp_head', 'i8_add_custom_scripts_header_defer_load');

function i8_custom_scripts_header_scroll_load()
{

?>
    <script type="text/javascript">
        // تابعی که کد جاوا اسکریپتی را با تاخیر اجرا می‌کند
        function runDelayedCode() {
            <?php
            $i8_custom_scripts_header_scroll_load = get_theme_mod('i8_custom_scripts_header_scroll_load');
            if ($i8_custom_scripts_header_scroll_load) {
                echo $i8_custom_scripts_header_scroll_load;
            }
            ?>
        }

        // اضافه کردن یک شنونده بر روی رویداد اسکرول
        window.addEventListener('scroll', function() {
            // بررسی اسکرول کاربر
            if (window.scrollY > 200) { // در اینجا 200 نماینده اسکرول به میزان پنجصد پیکسل به پایین
                runDelayedCode();
                // یکبار اجرای کد و بعد حذف شنونده
                window.removeEventListener('scroll', arguments.callee);
            }
        });
    </script>
    <?php

    ?>

<?php
}
add_action('wp_head', 'i8_custom_scripts_header_scroll_load');



/**
 * Add customize code to footer
 *
 * 
 */
function i8_add_custom_scripts_footer_immididally_load()
{
    $i8_custom_scripts_footer_immididally_load   = get_theme_mod('i8_custom_scripts_footer_immididally_load');
    if ($i8_custom_scripts_footer_immididally_load) {
        echo $i8_custom_scripts_footer_immididally_load;
    }
}
add_action('wp_footer', 'i8_add_custom_scripts_footer_immididally_load');

function i8_add_custom_scripts_footer_defer_load()
{
    $i8_custom_scripts_footer_defer_load   = get_theme_mod('i8_custom_scripts_footer_defer_load');
    if ($i8_custom_scripts_footer_defer_load) {
        echo '<script type="text/javascript" defer>';
        echo $i8_custom_scripts_footer_defer_load;
        echo '</script>';
    }
}
add_action('wp_footer', 'i8_add_custom_scripts_footer_defer_load');

function i8_custom_scripts_footer_scroll_load()
{

?>
    <script type="text/javascript">
        function runDelayedCode() {
            <?php
            $i8_custom_scripts_footer_scroll_load = get_theme_mod('i8_custom_scripts_footer_scroll_load');
            if ($i8_custom_scripts_footer_scroll_load) {
                echo $i8_custom_scripts_footer_scroll_load;
            }
            ?>
        }

        window.addEventListener('scroll', function() {
            if (window.scrollY > 200) { 
                runDelayedCode();
                window.removeEventListener('scroll', arguments.callee);
            }
        });
    </script>
    <?php

    ?>
<?php
}
add_action('wp_footer', 'i8_custom_scripts_footer_scroll_load');
