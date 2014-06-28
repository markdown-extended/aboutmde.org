<?php
if (!isset($code)) $code = 404;
?>
<div class="row blurb full-height">

    <div class="hidden-xs col-sm-1 col-lg-2"></div>
    <div class="col-xs-12 col-sm-10 col-lg-8">

                
        <h1 class="text-center">
            <span class="fa fa-<?php echo (isset($icon) ? $icon : 'bug'); ?> fa-2x"></span>
            <br><?php echo $title; ?>
        </h1>
        <br>
        <?php echo $content; ?>
        <br>
        <?php if (isset($stack_trace)) : ?>
            <h3>Guru meditation</h3>
            <pre class="small"><?php echo $stack_trace; ?></pre>
        <?php endif; ?>
        
    </div>
    <div class="hidden-xs col-sm-1 col-lg-2"></div>

</div>