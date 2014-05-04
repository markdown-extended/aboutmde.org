<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <link href="vendor/atelierspierrot/assets-bootstrapper/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/atelierspierrot/assets-bootstrapper/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <title><?php _echo(
        (isset($page['name']) ? $page['name'].' - ' : '').$website['name']
    ); ?></title>
<?php if (isset($page['description'])) : ?>
    <meta name="description" content="<?php _echo($page['description']); ?>">
<?php else : ?>
    <meta name="description" content="<?php _echo($website['presentation']); ?>">
<?php endif; ?>
<?php if (isset($website['author'])) : ?>
    <meta name="author" content="<?php _echo($website['author']); ?>">
<?php endif; ?>
</head>
<body>
<a href="#content" class="sr-only">Skip to main content</a>
<a href="#navigation" class="sr-only">See page's navigation</a>

<a id="scrollup-button" class="hidden nav-button" href="#header" title="Back to top of the page"><i class="fa fa-chevron-up"></i></a>

<div class="navbar navbar-default navbar-fixed-top visible-xs hidden-print" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php _echo($website['home']); ?>">
                <img class="brand-icon" src="img/dcurtis-markdown-mark/39x24.png" alt="M&amp;darr;" />
                <?php _echo($website['name']); ?>
            </a>
        </div>
        <div class="navbar-collapse collapse" id="smartphone-navigation">
            <ul class="nav navbar-nav">
            <?php foreach ($pages as $node) : ?>
                <li<?php if ($route == $node['path']) : ?> class="active"<?php endif; ?>><a href="<?php _echo($basePath.$node['path']); ?>">
                    <span class="fa fa-<?php echo $node['icon']; ?>"></span>
                    <?php _echo($node['name']); ?>
                </a></li>
            <?php endforeach; ?>
            <?php if ($page['toc']) : ?>
                <li class="divider"></li>
                <li><a href="#toc">
                    <span class="fa fa-sitemap"></span> Table of contents
                </a></li>
            <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
    
<div class="wrapper">
    <div class="box">
        <div class="row row-offcanvas row-offcanvas-left">
            <div class="column hidden-xs col-md-3 col-sm-1 sidebar-offcanvas hidden-print colfixed" id="sidebar">
                <header>
                  <div class="page-header">
                      <h1>
                        <a href="<?php _echo($website['home']); ?>" title="<?php _echo($website['home']); ?>">
                          <img src="img/dcurtis-markdown-mark/39x24.png" alt="M&amp;darr;" />
                          <span class="hidden-xs hidden-sm sidebar-toggled"><?php _echo($website['name']); ?></span>
                        </a>
                        <div class="hidden-xs hidden-sm">
                            <small><?php _echo($website['presentation']); ?></small>
                        </div>
                      </h1>
                  </div>
                    <ul class="nav" id="navigation" role="navigation">
                    <?php foreach ($pages as $node) : ?>
                        <li<?php if ($route == $node['path']) : ?> class="active"<?php endif; ?>><a href="<?php _echo($basePath.$node['path']); ?>" title="<?php _echo($node['name']); ?>">
                            <span class="fa fa-<?php echo $node['icon']; ?>"></span>
                            <span class="hidden-sm sidebar-toggled"> <?php _echo($node['name']); ?></span>
                        </a></li>
                    <?php endforeach; ?>
                    </ul>
                </header>
                <footer class="hidden-xs hidden-sm sidebar-toggled" id="sidebar-footer">
                    <?php view(\AboutMde\Controller::$views_dir.'footer.html.php', array(
                        'route'=>$route, 'website'=>$website
                    )); ?>
                </footer>
                <a id="sidebar-button" href="#" data-toggle="offcanvas" class="visible-sm nav-button" title="Open sidebar"><i class="fa fa-chevron-right"></i></a>
            </div>
            <div class="column col-md-9 col-sm-11 col-xs-12 content-print" id="main">
                <section id="content">
                    <?php if ($page['toc']) : ?>
                    <aside id="table-of-contents" class="toc">
                        <div class="bs-sidebar hidden-print pull-right navbar-section" role="complementary">
                            <?php _echo($page['toc']); ?>
                        </div>
                    </aside>
                    <?php endif; ?>
                    <?php _echo($page['content']); ?>
                    <?php if ($page['notes']) : ?>
                    <div class="footnotes">
                        <ol>
                        <?php foreach ($page['notes'] as $id=>$note_content) {
                            _echo('<li id="'.$note_content['note-id'].'">'.$note_content['text'].'</li>');
                        } ?>
                        </ol>
                    </div>
                    <?php endif; ?>
                    <?php if ($page['date']) : ?>
                    <div class="last-infos">
                        <p class="small text-right">Last update of this page: <?php _echo($page['date']->format('d M Y H:i:s')); ?></p>
                    </div>
                    <?php endif; ?>
                </section>
                <div class="clearfix"></div>
                <footer class="footer-bordered visible-xs">
                    <div class="visible-print">
                    This page comes from the internet at: <?php _echo($request); ?>.
                    </div>
                    <?php view(\AboutMde\Controller::$views_dir.'footer.html.php', array(
                        'route'=>$route, 'website'=>$website
                    )); ?>
                </footer>
            </div>
        </div>
    </div>
</div>

<script src="vendor/atelierspierrot/templatengine/vendor_assets/jquery-last.min.js"></script>
<script src="jquery/bindWithDelay.js"></script>
<script src="jquery/jquery.filtertable.custom.js"></script>
<script src="vendor/atelierspierrot/assets-bootstrapper/bootstrap/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
<script>
$(function() {

var mainMarginTop = parseInt($('#main').css("marginTop")),
    mainTimeout = null;
function expandMain() {
    $('#main').css({ marginTop: parseInt(mainMarginTop+$('#smartphone-navigation').outerHeight())+"px" });
}
$('#smartphone-navigation')
    .on('show.bs.collapse', function(){ mainTimeout = setTimeout(expandMain, 10); })
    .on('shown.bs.collapse', function(){ expandMain(); clearTimeout(expandMain); })
    .on('hide.bs.collapse', function(){ mainTimeout = setTimeout(expandMain, 10); })
    .on('hidden.bs.collapse', function(){ expandMain(); clearTimeout(expandMain); })
;


// off-canvas sidebar toggle
$('[data-toggle=offcanvas]').click(function() {
    $("#sidebar").toggleClass('col-sm-1').toggleClass('col-sm-3');
    $("#main").toggleClass('col-sm-11').toggleClass('col-sm-9');
    $("#sidebar-button").find('i').toggleClass('fa-chevron-right').toggleClass('fa-chevron-left');
    $('.row-offcanvas').toggleClass('active');
    $('.sidebar-toggled').each(function(i,el){
        $(this).toggleClass('hidden-sm').toggleClass('visible-sm');
    });
});

//    $("a:not(.no-hash)").on("click", scrollToAnchor);

	$("#main").scroll(function(){
		if ($(this).scrollTop() > 100) {
			$("#scrollup-button").removeClass("hidden").fadeIn();
        } else {
            $("#scrollup-button").fadeOut();
        }
    });
    $("#scrollup-button").click(function(){
        $("#main").animate({ scrollTop: 0 }, 1000);
            return false;
    });

});
</script>
<?php echo $_template->getTemplateObject('JavascriptTag')->write("%s"); ?>
</body>
</html>
