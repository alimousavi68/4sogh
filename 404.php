<?php
//header
get_header();

?>
<style>
    .i8-404-container {
        display: flex;
        width: 100%;
        /* height: 100%; */
        align-items: center;
        justify-content: center;
        margin:  24px;
        color: red;
        font-size: 96px;
        letter-spacing: -7px;
    }


    .i8-404 {
        animation: glitch 1s linear infinite;
    }

    @keyframes glitch {

        2%,
        64% {
            transform: translate(2px, 0) skew(0deg);
        }

        4%,
        60% {
            transform: translate(-2px, 0) skew(0deg);
        }

        62% {
            transform: translate(0, 0) skew(5deg);
        }
    }

    .i8-404:before,
    .i8-404:after {
        content: attr(title);
        position: absolute;
        left: 0;
    }

    .i8-404:before {
        animation: glitchTop 1s linear infinite;
        clip-path: polygon(0 0, 100% 0, 100% 33%, 0 33%);
        -webkit-clip-path: polygon(0 0, 100% 0, 100% 33%, 0 33%);
    }

    @keyframes glitchTop {

        2%,
        64% {
            transform: translate(2px, -2px);
        }

        4%,
        60% {
            transform: translate(-2px, 2px);
        }

        62% {
            transform: translate(13px, -1px) skew(-13deg);
        }
    }

    .i8-404:after {
        animation: glitchBotom 1.5s linear infinite;
        clip-path: polygon(0 67%, 100% 67%, 100% 100%, 0 100%);
        -webkit-clip-path: polygon(0 67%, 100% 67%, 100% 100%, 0 100%);
    }

    @keyframes glitchBotom {

        2%,
        64% {
            transform: translate(-2px, 0);
        }

        4%,
        60% {
            transform: translate(-2px, 0);
        }

        62% {
            transform: translate(-22px, 5px) skew(21deg);
        }
    }
</style>
<div class="container mt-4">
    <div class="row mx-0">
        <?php get_template_part('template-parts/content/content-404'); ?>
    </div>
</div>

<?php
//footer
get_footer();
?>