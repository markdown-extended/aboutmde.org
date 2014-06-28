<?php
_use('bootstrap');
_use('bootcomp');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
<?php echo $_template->getTemplateObject('CssFile')->write("\n\t\t %s "); ?>
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
<?php echo $_template->getTemplateObject('MetaTag')->write("\n\t\t %s "); ?>
</head>
<body>
<a id="top"></a>
<a href="#content" class="sr-only">Skip to main content</a>
<a href="#navigation" class="sr-only">See page's navigation</a>

<a id="scrollup-button" class="hidden nav-button" href="#header" title="Back to top of the page"><i class="fa fa-chevron-up"></i></a>

<div class="navbar navbar-default navbar-fixed-top visible-xs hidden-print" role="navigation">
    <div class="container">
        <div class="navbar-header" id="smartphone-navigation-wrapper">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php _echo($website['home']); ?>">
<!--                <img class="brand-icon" src="img/dcurtis-markdown-mark/39x24-solid.png" alt="M&amp;darr;" /> -->
                <?php _echo($website['name']); ?>
            </a>
        </div>
        <div class="navbar-collapse collapse" id="smartphone-navigation">
            <ul class="nav navbar-nav">
            <?php foreach ($pages as $node) : ?>
                <li<?php if ($route == $node['path']) : ?> class="active"<?php endif; ?>><a href="<?php _echo($basePath.$node['path']); ?>">
                    <span class="fa fa-<?php echo $node['icon']; ?> fa-fw"></span>
                    <?php _echo($node['name']); ?>
                </a></li>
            <?php endforeach; ?>
            <li class="divider"></li>
            <?php if ($page['toc']) : ?>
                <li><a href="#toc" class="scroll-to-hash">
                    <span class="fa fa-sitemap"></span> Table of contents
                </a></li>
            <?php endif; ?>
                <li><a href="#bottom" class="scroll-to-hash" id="scrolldown-button">
                    <span class="fa fa-chevron-down"></span> Footer infos
                </a></li>
            </ul>
        </div>
    </div>
</div>
    
<div class="wrapper">
    <div class="box">
        <div class="row row-offcanvas row-offcanvas-left" id="sidebar-wrapper">
            <div class="column hidden-xs col-lg-2 col-md-3 col-sm-1 sidebar-offcanvas hidden-print colfixed" id="sidebar">
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
                            <span class="fa fa-<?php echo $node['icon']; ?> fa-fw"></span>
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
                <a id="sidebar-button" href="#sidebar-wrapper" data-toggle="offcanvas" class="visible-sm nav-button" title="Open sidebar"><i class="fa fa-chevron-right"></i></a>
            </div>
            <div class="column col-lg-10 col-md-9 col-sm-11 col-xs-12 content-print" id="main">
                <?php if (isset($page['pre-content'])) : ?>
                <div class="post-content">
                    <?php _echo($page['pre-content']); ?>
                </div>
                <?php endif; ?>
                <section id="content">
                    <?php if ($page['toc']) : ?>
                    <aside id="table-of-contents" class="toc">
                        <div class="bs-sidebar hidden-print pull-right navbar-section" role="complementary">
                            <a class="pull-right nav-button collapse-handler" id="toc-collapse-button" data-toggle="collapse" href="#collapsible-toc > ul">
                                <span class="fa fa-angle-down"></span>
                            </a>
                            <div id="collapsible-toc" class="">
                                <?php _echo($page['toc']); ?>
                            </div>
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
                <?php if (isset($page['post-content'])) : ?>
                <div class="post-content">
                    <?php _echo($page['post-content']); ?>
                </div>
                <?php endif; ?>
                <div class="clearfix visible-xs"></div>
                <footer class="footer-bordered visible-xs">
                    <?php view(\AboutMde\Controller::$views_dir.'footer.html.php', array(
                        'route'=>$route, 'website'=>$website
                    )); ?>
                </footer>
                <footer class="footer-bordered visible-xs visible-print">
                    <p>This page comes from the internet at: <?php _echo($request); ?>.</p>
                    <?php view(\AboutMde\Controller::$views_dir.'footer.html.php', array(
                        'route'=>$route, 'website'=>$website
                    )); ?>
                </footer>
                <a id="bottom"></a>
            </div>
        </div>
    </div>
</div>

<?php echo $_template->getTemplateObject('JavascriptFile', 'jsfiles_footer')->write("\n\t\t %s "); ?>
<script src="libs/jquery/bindWithDelay.js"></script>
<script src="libs/jquery/jquery.filtertable.custom.js"></script>
<script src="js/scripts.js"></script>
<script>

$(function() {

    $.fn.BootstrapCompanion({
        debug:                          true,
        icons_library:                  'fa',
        main_selector:                  "#main",
        main_scroll_selector:           "#main",
        margin_top_xs:                  -80,
        margin_top_sm:                  -30,
        margin_top_md:                  -30,
        margin_top_lg:                  -30,
        navbar_id:                      "smartphone-navigation",
        scroll_speed:                   1000,
        scroll_to_top_selector:         "#scrollup-button",
        scroll_to_bottom_selector:      "#scrolldown-button",
        use_popovers:                   true,
        use_github_buttons:             true
    });

    $(".ab-box").alertBox({
        icons_library: 'fa'
    });

/*
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
*/

// off-canvas sidebar toggle
$('[data-toggle=offcanvas]').click(function(e) {
    $("#sidebar").toggleClass('col-sm-1').toggleClass('col-sm-3');
    $("#main").toggleClass('col-sm-11').toggleClass('col-sm-9');
    $('.row-offcanvas').toggleClass('active');
    toggleCollapseHandler($("#sidebar-button"), {
        collapse_handler_icon_down:     'fa-chevron-right',
        collapse_handler_icon_up:       'fa-chevron-left',
        collapse_handler_icon_block:    'i'
    });
//    $("#sidebar-button").find('i').toggleClass('fa-chevron-right').toggleClass('fa-chevron-left');
    $('.sidebar-toggled').each(function(i,el){
        $(this).toggleClass('hidden-sm').toggleClass('visible-sm');
    });
});

//    $("a:not(.no-hash)").on("click", scrollToAnchor);
    $(".bs-sidenav a").on("click", scrollToAnchor);
	$("#main").scroll(function(){
		if ($(this).scrollTop() > 100) {
			$("#scrollup-button").removeClass("hidden").fadeIn();
        } else {
            $("#scrollup-button").fadeOut();
        }
    });
    
});
</script>
<?php echo $_template->getTemplateObject('JavascriptTag')->write("%s"); ?>

<?php if (isset($website['piwik']) && isset($website['piwik']['active']) && true===$website['piwik']['active']) : ?>
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
  _paq.push(["setCookieDomain", "*.aboutmde.org"]);
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);
  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://<?php echo $website['piwik']['server']; ?>/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "<?php echo $website['piwik']['idSite']; ?>"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript>
<!-- Piwik Image Tracker -->
<img src="http://stats.ateliers-pierrot.fr/piwik.php?idsite=14&amp;rec=1" style="border:0" alt="" />
</noscript>
<!-- End Piwik Code -->
<?php endif; ?>
    
</body>
</html>
