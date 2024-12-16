<?php
//footer
?>
<!-- footer -->
<footer id="footer" class="">

  <div class="container  d-flex  bg-secondary cornner-bottom p-4 i8-header flex-column flex-md-row row-gap-2">
    <div class="col-18 col-24 col-md-18 h-right row row-gap-3 row-gap-md-0">
      <div class="align-items-center col-24 col-md-5 d-flex h-logo m-0 px-3 justify-content-center justify-content-md-start">
        <!-- Logo -->
        <a href="<?php echo bloginfo('url') ?>" title="<?php bloginfo('title'); ?> " class="logo">
          <img width="153" height="73" class="header-logo"
            src="<?php echo get_stylesheet_directory_uri(); ?>/images/global/logo.png" alt="logo" />
        </a>
        <!-- End Logo -->
      </div>

      <div class="col-auto d-md-flex d-none i8-line-divider"></div>

      <div class="col-18 col-24 col-md-18 d-flex flex-column h-menu justify-content-center row row-gap-2">
        <div class="">
          <?php build_custom_menu_by_location('footer'); ?>
        </div>
      </div>
    </div>
    <div class="align-content-center col-24 col-md-6 d-flex flex-column h-left justify-content-center">
      <div class="p-2">
        <?php
        dynamic_sidebar('fl-sidebar');
        ?>
      </div>
    </div>
  </div>



  <!-- footer menu -->
  <div class="bottom-menu pt-2 pb-5">

    <div class="container p-3 ">
      <div class="row d-flex text-grey text-center text-lg-end text-md-end text-sm-center row-gap-3 flex-wrap-reverse">
        <span class="col-24 col-lg-20 col-md-20 col-sm-24 f13">
          تمامی حقوق مادی و معنوی این وبسایت متعلق به روزنامه چارسوق می باشد و هرگونه کپی برداری با ذکر منبع بلامانع است.</span>
        <div class="col-24 col-lg-4 col-sm-24 col-md-4">
          <div
            class="d-xl-flex d-lg-flex d-md-flex text-grey justify-content-center gap-2 social-links justify-content-center align-items-center">
            <span class="f13">طراحی: <a href="https://ihasht.ir/" class="text-grey i8-blink" title="هشت بهشت"
                alt="Website designer: Hasht Behesht professional website design site" target="_blank">هشت بهشت</a>
            </span>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- End - footer menu -->
</footer>
<?php wp_footer(); ?>
<!-- footer -->

<?php if (is_singular()): ?>
  <!-- shared button -->
  <script type="text/javascript" defer>
    document.addEventListener('DOMContentLoaded', function () {
      // cache dom
      var shareBtn = document.querySelector('.share-btn-mini');
      var shareBtn = document.querySelector('.share-btn');
      var shareUrl = document.querySelector('.share-url');
      var shareContainer = document.querySelector('.share-container');
      var notificationButton = document.querySelector('.notification-button');

      // set data
      var url = '<?php echo bloginfo('url'); ?>/?p=<?php the_ID(); ?>';
      var shared = false;

      /**
       * Share link function
       */
      function shareLink(e) {
        e.preventDefault(); // Prevent the default click behavior

        // set active class
        shareBtn.classList.toggle('active');
        shareUrl.classList.toggle('active');
        shareContainer.classList.toggle('active');

        if (shared === false) {

          // trigger notification alert
          notificationButton.classList.add('active');
          shared = true;
          shareBtn.textContent = 'بستن';
          shareUrl.textContent = url;

          // Create a temporary textarea element to copy the URL to clipboard
          var tempTextArea = document.createElement('textarea');
          tempTextArea.value = url;
          document.body.appendChild(tempTextArea);
          tempTextArea.select();

          try {
            // Execute the copy command
            var successful = document.execCommand('copy');
            var msg = successful ? 'موفق' : 'ناموفق';

          } catch (err) {
          } finally {
            // Remove the temporary textarea
            document.body.removeChild(tempTextArea);
          }

        } else {
          shared = false;
          shareBtn.textContent = 'کپی لینک';
        }
      }

      /**
       * Removes the active class after a set period of time
       */
      function fadeOutNotification() {
        notificationButton.classList.remove('active');
      }

      // bind events
      shareBtn.addEventListener('click', shareLink);
      notificationButton.addEventListener('transitionend', fadeOutNotification);
    });


    // print button
    document.getElementById('printButton').addEventListener('click', function () {
      window.print();
    });
  </script>



<?php endif; ?>

<script type="text/javascript" defer>
  document.addEventListener('DOMContentLoaded', function () {
    "use strict";

    // Scroll back to top
    var progressPath = document.querySelector('.progress-wrap path');
    if (progressPath) {
      var pathLength = progressPath.getTotalLength();
      progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
      progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
      progressPath.style.strokeDashoffset = pathLength;
      progressPath.getBoundingClientRect();
      progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';

      var updateProgress = function () {
        var scroll = window.scrollY || document.documentElement.scrollTop;
        var height = (document.documentElement.scrollHeight || document.body.scrollHeight) - window.innerHeight;
        var progress = pathLength - (scroll * pathLength) / height;
        progressPath.style.strokeDashoffset = progress;
      };

      updateProgress();
      window.addEventListener('scroll', updateProgress);

      var offset = 50;
      var duration = 550;
      window.addEventListener('scroll', function () {
        var progressWrap = document.querySelector('.progress-wrap');
        if (window.scrollY > offset) {
          progressWrap.classList.add('active-progress');
        } else {
          progressWrap.classList.remove('active-progress');
        }
      });

      document.querySelector('.progress-wrap').addEventListener('click', function (event) {
        event.preventDefault();
        window.scrollTo({
          top: 0,
          behavior: "smooth"
        });
      });
    }
  });

</script>

<style>
  :root {
    --prgc-main: var(--i8-light-complete-color);
    --prgc-arrow: var(--i8-light-complete-color);
    --prgc-arrow2: var(--i8-light-complete-color);
    --prgc-line: rgb(255, 153, 0 / 20%);
  }

  /* #Progress
================================================== */

  .progress-wrap {
    position: fixed;
    right: 10px;
    bottom: 15vh;
    height: 46px;
    width: 46px;
    cursor: pointer;
    display: block;
    border-radius: 50px;
    box-shadow: inset 0 0 0 2px #c4c4c482;
    z-index: 10000;
    opacity: 0;
    visibility: hidden;
    transform: translateY(15px);
    -webkit-transition: all 200ms linear;
    transition: all 200ms linear;
    /* background-color: #ffffff; */
  }

  .progress-wrap.active-progress {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
  }

  .progress-wrap::after {
    position: absolute;
    content: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="crimson" class="bi bi-arrow-up-short" viewBox="0 0 16 16"><path fill-rule="crimson" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5"/></svg>');
    text-align: center;
    line-height: 46px;
    font-size: 20px;
    color: var(--i8-light-complete-color);
    left: 0;
    top: 0;
    height: 46px;
    width: 46px;
    cursor: pointer;
    display: block;
    z-index: 1;
    -webkit-transition: all 200ms linear;
    transition: all 200ms linear;
  }

  .progress-wrap:hover::after {
    opacity: 0;
  }

  .progress-wrap::before {
    position: absolute;
    content: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="grey" class="bi bi-arrow-up-short" viewBox="0 0 16 16"><path fill-rule="grey" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5"/></svg>');
    text-align: center;
    line-height: 46px;
    font-size: 20px;
    opacity: 0;
    background-image: linear-gradient(298deg, var(--prgc-arrow), var(--prgc-arrow2));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    left: 0;
    top: 0;
    height: 46px;
    width: 46px;
    cursor: pointer;
    display: block;
    z-index: 2;
    -webkit-transition: all 200ms linear;
    transition: all 200ms linear;
  }

  .progress-wrap:hover::before {
    opacity: 1;
  }

  .progress-wrap svg path {
    fill: none;
  }

  .progress-wrap svg.progress-circle path {
    stroke: var(--prgc-main);
    stroke-width: 4;
    box-sizing: border-box;
    -webkit-transition: all 200ms linear;
    transition: all 200ms linear;
  }
</style>

<div class="progress-wrap">
  <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
  </svg>
</div>

</body>

</html>