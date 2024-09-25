<?php
/*
Template Name: طلا و سکه
Description: نمایش داده های بازار - نیاز به اضافه کردن چیزی نیست.
*/
?>
<?php
//header
get_header();
?>
<div class="container mt-4">
    <div class="row mx-0">
        <?php
        // post tags 
        $posttags = get_the_tags();

        ?>
        <div class="col-xl-17 col-md-24 col-sm-24 pe-0 ps-2 ps-lg-2 ps-sm-0 d-flex flex-column gap-3">

            <section class="d-flex flex-column row-gap-3">
                <div class="box l2 content-entry">
                    <div class="col-xl-24 col-lg-24 col-md-24 col-sm-24 ps-2 mb-4 mb-md-4 text-center">
                        <h1 class="title f50 mt-md-3"><?php the_title(); ?></h1>
                    </div>
                    <?php the_content(); ?>


                    <!--  golden data -->
                    <tgju type="market-overview" items="137119,137123,137120,137121,137122" columns="dot" token="webservice"></tgju>

                    <!-- sekeh -->
                    <tgju type="market-data" items="137138,137137,137139,137140,137141" columns="dot,diff,low,high,time" token="webservice"></tgju>
                    <!-- script -->
                    <script src="https://api.tgju.org/v1/widget/v2" defer></script>

                </div>
                <div class="box d-flex flex-xxl-row flex-xl-row flex-lg-row justify-content-between flex-column-reverse align-items-center">
                    <div class="tags d-flex">
                        <?php
                        if ($posttags) :
                            foreach ($posttags as $tag) :
                                if ($tag) :
                        ?>
                                    <a href="<?php echo get_tag_link($tag); ?>" class="tag-item mb-0"><?php echo $tag->name ?></a>
                        <?php
                                endif;
                            endforeach;
                        endif;

                        ?>
                    </div>





                </div>
            </section>
        </div>
        <!--section 1-->



        <!-- sidebar  -->
        <div class="col-xl-7 col-md-24 col-sm-24 ps-0 pt-4 pt-xl-0 pt-md-4 pt-sm-4 pe-xl-3 pe-0 pe-sm-0 i8-sticky">
            <div class="box">
                <?php dynamic_sidebar('hl-sidebar'); ?>
            </div>
        </div>

    </div>
</div>


<?php
//footer
get_footer();
?>