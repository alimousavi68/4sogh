<?php
//header
get_header();
?>
<style>
    .i8-wrapper {}

    .i8-container {
        position: relative;
        font: 'iransansxv';
    }

    .i8-input {
        width: 400px;
        border: 1px solid #dadada;
        background: transparent;
        padding: 15px 30px;
        border-radius: 50px;
        outline: none;
        font-size: 18px;
        color: var(--i8-light-primary);
        font: 'iransansxv';
    }

    ::-webkit-input-placeholder {
        /* Chrome/Opera/Safari */
        color: var(--i8-light-primary);
        font-family: Roboto;
        text-transform: uppercase;
    }

    ::-moz-placeholder {
        /* Firefox 19+ */
        color: var(--i8-light-primary);
    }

    :-ms-input-placeholder {
        /* IE 10+ */
        color: var(--i8-light-primary);
    }

    .i8-close-btn {
        position: absolute;
        top: 3px;
        left: 3px;
        cursor: pointer;
        color: #fff;
        background: var(--i8-light-primary);
        border: 0px;
        width: 120px;
        height: 53px;
        border-radius: 50px;
        outline: none;
        text-transform: uppercase;
        font-weight: bold;
    }
</style>

<!-- main section -->
<div class="container px-0 mb-4">
    <?php get_template_part( 'template-parts/content/content-search'); ?>
</div>
<!-- main section -->


<!-- /main -->
<?php
//footer
get_footer();
?>