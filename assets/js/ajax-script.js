// jQuery(document).ready(function ($) {
//     $('#buttons button').click(function () {
//         var imageID = $(this).data('id'); // دریافت ID از دکمه

//         $.ajax({
//             url: ajax_object.ajax_url, // URL ایجکس وردپرس
//             type: 'POST',
//             data: {
//                 action: 'load_drawattention',
//                 image_id: imageID,
//             },
//             success: function (response) {
//                 // جایگزینی محتوای شورت‌کد
//                 $('#drawattention-container').html(response);
//                 console.log(typeof drawattention_init);
//                 // افزودن تأخیر برای حذف انیمیشن
//                 setTimeout(function () {
//                     $('.hotspots-container .hotspots-image-container').css('opacity', '1');
//                     $('.hotspots-container .hotspots-image-container > img').css('opacity', '1');
//                     $('<style>.hotspots-container:before, .hotspots-container:after { content: none !important; display: none !important; }</style>').appendTo('head');
//                     drawattention_init();
//                     // مقداردهی مجدد افزونه Draw Attention
//                     if (typeof drawattention_init === 'function') {
//                         drawattention_init();
//                     } else {
//                         console.log('drawattention_init is not defined.');
//                     }
//                 }, 1000); // تأخیر 1 ثانیه (1000 میلی‌ثانیه)
//             },
//             error: function () {
//                 $('#drawattention-container').html('<p>مشکلی پیش آمده است. لطفاً دوباره تلاش کنید!</p>');
//             }
//         });
//     });
// });
jQuery(document).ready(function($) {
    function loadDrawAttentionShortcode(imageMapId) {
        $.ajax({
            url: ajax_draw_attention.ajax_url,
            type: 'POST',
            data: {
                action: 'load_draw_attention_map',
                image_map_id: imageMapId
            },
            success: function(response) {
                if (response.success) {
                    // حذف کامل محتوای قبلی
                    $('#draw-attention-container').empty();
                    
                    // درج محتوای جدید
                    $('#draw-attention-container').html(response.data.shortcode_html);
                    
                    // بارگذاری مجدد اسکریپت‌های افزونه
                    reInitializeDrawAttention();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    }

    // تابع بازسازی کامل تنظیمات Draw Attention
    function reInitializeDrawAttention() {
        // حذف نمونه‌های قبلی
        $('.da-image-map-highlight').off();
        
        // اجرای مجدد هایلایت‌ها
        $('.da-image-map-highlight').each(function() {
            $(this).on({
                mouseenter: function() {
                    var $highlight = $(this);
                    $highlight.addClass('da-highlight-hover');
                    
                    // نمایش توضیحات
                    var $hotspot = $highlight.closest('.hotspots-container');
                    var $tooltip = $hotspot.find('.hotspot-info[data-index="' + $highlight.data('index') + '"]');
                    $tooltip.addClass('visible');
                },
                mouseleave: function() {
                    var $highlight = $(this);
                    $highlight.removeClass('da-highlight-hover');
                    
                    // مخفی کردن توضیحات
                    var $hotspot = $highlight.closest('.hotspots-container');
                    $hotspot.find('.hotspot-info').removeClass('visible');
                }
            });
        });
    
        // اگر افزونه اسکریپت اصلی دارد
        if (typeof DrawAttention !== 'undefined' && DrawAttention.init) {
            DrawAttention.init();
        }
    }
    

    // رویداد کلیک برای دکمه‌ها
    $('.image-map-button').on('click', function(e) {
        e.preventDefault();
        var imageMapId = $(this).data('image-map-id');
        loadDrawAttentionShortcode(imageMapId);
    });
});