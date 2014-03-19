<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.ico">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
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

<div class="navbar navbar-default navbar-fixed-top visible-xs hidden-print" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php _echo($website['home']); ?>"><?php _echo($website['name']); ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            <?php foreach ($pages as $node) : ?>
                <li<?php if ($route == $node['path']) : ?> class="active"<?php endif; ?>><a href="<?php _echo($basePath.$node['path']); ?>">
                    <?php _echo($node['name']); ?>
                </a></li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
    
<div class="container-fluid">
    <div class="row">
        <div class="hidden-xs col-sm-3 hidden-print">
            <div class="colfixed-wrapper">
                <div class="colfixed" id="colfixed">
                    <header>
                      <div class="page-header">
                      <h1>
                        <a href="<?php _echo($website['home']); ?>" title="<?php _echo($website['home']); ?>">
                          <img src="img/dcurtis-markdown-mark/39x24.png" alt="M&amp;darr;" />
                          <?php _echo($website['name']); ?>
                        </a>
                          <br />
                          <small><?php _echo($website['presentation']); ?></small>
                      </h1>
                      </div>

                    <ul class="nav" id="navigation">
                    <?php foreach ($pages as $node) : ?>
                        <li<?php if ($route == $node['path']) : ?> class="active"<?php endif; ?>><a href="<?php _echo($basePath.$node['path']); ?>">
                            <?php _echo($node['name']); ?>
                        </a></li>
                    <?php endforeach; ?>
                    </ul>
                    </header>

                    <footer class="hidden-sm">
                        <?php view(\AboutMde\Controller::$views_dir.'footer.html.php', array(
                            'route'=>$route, 'website'=>$website
                        )); ?>
                    </footer>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-9 col-bordered content-print">
            <section id="content">

                <?php if ($page['toc']) : ?>
                <aside id="table-of-contents" class="toc">
                    <div class="bs-sidebar hidden-print pull-right navbar-section" role="complementary">
                        <?php _echo($page['toc']); ?>
                    </div>
                </aside>
                <?php endif; ?>

                <?php _echo($page['content']); ?>

                <?php if ($page['footnotes']) : ?>
                <div class="footnotes">
                    <?php _echo($page['footnotes']); ?>
                </div>
                <?php endif; ?>

                <?php if ($page['date']) : ?>
                <div class="last-infos">
                    <p class="small text-right">Last update of this page: <?php _echo($page['date']->format('d M Y H:i:s')); ?></p>
                </div>
                <?php endif; ?>

            </section>
        </div>
    </div>

</div>

<div class="clearfix"></div>
<footer class="footer-bordered visible-xs visible-sm">
    <div class="visible-print">
    This page comes from the internet at: <?php _echo($request); ?>.
    </div>
    <?php view(\AboutMde\Controller::$views_dir.'footer.html.php', array(
        'route'=>$route, 'website'=>$website
    )); ?>
</footer>

<script src="jquery/latest.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
<script>
$(function() {
    resizeColfixed();
    $(window).resize(function() { resizeColfixed(); });
});
</script>
<?php echo $_template->getTemplateObject('JavascriptTag')->write("%s"); ?>
</body>
</html>
