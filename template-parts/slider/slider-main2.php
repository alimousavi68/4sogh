<?php
$bigSliderCat = 17;


$one_post_query_args = array(
  'posts_per_page' => '1',
  'cat' => $bigSliderCat,
  'order' => 'DESC',
);
// The Query
$one_post_query = new WP_Query($one_post_query_args);

$two_post_query_args = array(
  'posts_per_page' => '4',
  'cat' => $bigSliderCat,
  'offset' => '1',
  'order' => 'DESC',
);
// The Query
$two_post_query = new WP_Query($two_post_query_args);
?>

<div class="row">
  <!--  top-right-sidebar -->
  <div class="col-24 col-xl-18 col-lg-18 col-md-24 main-slider-2 d-flex gap-0 row">

    <!-- mainslider-2 Single-Item -->
    <div class="col-24 col-xl-12  col-lg-12 col-md-12 col-sm-24 single-item d-flex flex-column gap-1 ps-2 border-start i8-border-md-none">
      <a href="#">
        <img class="single-item-thumb w-100 i8-img-fit i8-img-fit" src="<?php echo get_template_directory_uri(); ?>/images/archive/big-pic.jpg" width="462" height="340" alt="">
      </a>
      <div class="single-item-data d-flex flex-column gap-1">
        <span class="post-category ">استارت آپ</span>
        <h1 class="post-title f32">از هر 10 کاربر ایرانی 9 نفر از dns غیرایرانی استفاده می‌کنند</h1>
        <p class="post-excerpt f15">ابردراک بر اساس تحلیل تطبیقی لاگ سرورهای لبه و DNS خود به این نتیجه رسید که از هر ۱۰ کاربر ایرانی ۹ کاربر از DNS غیرایرانی استفاده می‌کنند. </p>
        <p class="post-publish-date f12 text-start text-subtitle">۱۲شهریور</p>
      </div>
    </div>
    <style>
      .multi-item {
        height: 240px;
      }

      .single-item-data {
        height: 100%;
      }
    </style>
    <!-- mainslider-2 multi-Item -->
    <div class="col-24 col-xl-12  col-lg-12 col-md-12 col-sm-24 multi-items d-flex gap-2">
      <div class="col-12 d-flex flex-column gap-3 ps-2 border-start" >
        <div class="multi-item d-flex flex-column gap-2" style="border-bottom: 1px solid #ccc;">
          <a href="#">
            <img class="multi-item-thumb w-100 i8-img-fit" src="<?php echo get_template_directory_uri(); ?>/images/archive/big-pic.jpg" width="231" height="140" alt="">
          </a>
          <div class="single-item-data d-flex flex-column gap-1 justify-content-between">
            <div class="title-box">
              <span class="post-category f15">بیمه و بانک</span>
              <h1 class="post-title f15">پیش بینی قیمت طلا و سکه 13 شهریور 1402 / طلا رنج و سکه صعودی شد</h1>
            </div>
            <p class="post-publish-date f12 text-start text-subtitle my-0">۱۲شهریور</p>
          </div>
        </div>
        <div class="multi-item d-flex flex-column gap-2">
          <a href="#">
            <img class="multi-item-thumb w-100 i8-img-fit" src="<?php echo get_template_directory_uri(); ?>/images/archive/big-pic.jpg" width="231" height="140" alt="">
          </a>
          <div class="single-item-data d-flex flex-column gap-1 justify-content-between">
            <div class="title-box">
              <span class="post-category f15">طلاو ارز</span>
              <h1 class="post-title f15">دستور جدید درباره وام 100 میلیونی بدون ضامن/ پرداخت وام تسهیل می‌شود؟</h1>
            </div>
            <p class="post-publish-date f12 text-start text-subtitle my-0">۱۲شهریور</p>
          </div>
        </div>
      </div>

      <div class="col-12 d-flex flex-column gap-3 ps-2 i8-border-md-none" style="border-left: 1px solid #ccc;">
        <div class="multi-item d-flex flex-column gap-2" style="border-bottom: 1px solid #ccc;">
          <a href="#">
            <img class="multi-item-thumb w-100 i8-img-fit" src="<?php echo get_template_directory_uri(); ?>/images/archive/big-pic.jpg" width="231" height="140" alt="">
          </a>
          <div class="single-item-data d-flex flex-column gap-1 justify-content-between">
            <div class="title-box">
              <span class="post-category f15">بورس خودرو</span>
              <h1 class="post-title f15">رد پای خاندوزی در تغییر معاون نظارتی بانک مرکزی/ فرشاد محمدپور کیست؟</h1>
            </div>
            <p class="post-publish-date f12 text-start text-subtitle my-0">۱۲شهریور</p>
          </div>
        </div>
        <div class="multi-item d-flex  flex-column gap-2">
          <a href="#">
            <img class="multi-item-thumb w-100 i8-img-fit" src="<?php echo get_template_directory_uri(); ?>/images/archive/big-pic.jpg" width="231" height="140" alt="">
          </a>
          <div class="single-item-data d-flex flex-column gap-1 justify-content-between">
            <div class="title-box">
              <span class="post-category f15">صنعت</span>
              <h1 class="post-title f15">جدال بر سر پتروشیمی میانکاله/ زور سرمایه‌گذار بیشتر از دولت است؟</h1>
            </div>
            <p class="post-publish-date f12 text-start text-subtitle my-0">۱۲شهریور</p>
          </div>
        </div>
      </div>

    </div>


  </div>

  <!--  top-left-sidebar -->
  <div class="col-24 col-lg-6 col-md-24">
    <?php
    dynamic_sidebar('top_section_left');
    ?>
  </div>
</div>