<?php ?>
<div class="row mx-0">
    <div class="col-xl-17 col-md-24 col-sm-24 d-flex flex-column box px-3 ">

        <div class=" row d-flex py-3 mx-0 align-content-center row-gap-1">
            <div class="col-md-24 col-sm-24 text-center ">
                <?php
                $icon_print = '<?xml version="1.0" encoding="UTF-8"?><svg width="32px" height="32px" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg" color="#ffffff"><path d="M17 17l4 4M3 11a8 8 0 1016 0 8 8 0 00-16 0z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>';
                if (!empty(get_search_query())):
                    echo '<span  class="title f26 ms-2">' . 'جستجوی برای :' . get_search_query() . '</span>';
                    echo '<p class="title f13 text-gray">تعداد موارد پیدا شده:' . $wp_query->found_posts . '</p>';
                endif;
                ?>
            </div>

            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <div class="i8-wrapper">
                    <div class="i8-container">
                        <input type="search" class="i8-input w-100" placeholder="عبارت مورد نظر …"
                            value="<?php echo get_search_query(); ?>" name="s" />
                        <button type="submit" class="i8-close-btn">
                            <?php echo $icon_print; ?>
                        </button>
                    </div>
                </div>
            </form>

        </div>
        <?php
        if (have_posts()):
            while (have_posts()):
                the_post();
                get_template_part('template-parts/content/content-archive');
            endwhile;
            // Pagination
            i8_custom_pagination();
        else:
            //to do 
            echo '<p>پستی وجو ندارد!</p>';
        endif;
        ?>
    </div>
    <!-- sidebar  -->

    <!-- sidebar  -->
    <div
        class="col-xl-7 col-md-24 col-sm-24 ps-0 pt-4 pt-xl-0 pt-md-4 pt-sm-4 pe-xl-3 pe-0 pe-sm-0 i8-sticky border-end ">
        <?php
        dynamic_sidebar('al-sidebar');
        ?>
    </div>

</div>