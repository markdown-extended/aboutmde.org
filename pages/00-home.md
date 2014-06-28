title: Home
process: phpize

<div class="page-header blurb text-center">
  <h1>Markdown Extended<br><small>The new way of writing for the web</small></h1>
  <p>
  <a class="btn btn-default btn-lg" href="02-manifest.html">Read the manifest</a>
  <span class="hidden-xs">&nbsp;</span>
  <span class="visible-xs"><br></span>
  <a class="btn btn-default btn-lg" href="06-downloads.html">Find a parser</a>
  </p>
  <br>
<div class="row">
    <div class="col-xs-1 col-sm-3 col-md-4"></div>
    <div class="col-xs-5 col-sm-3 col-md-2 text-center">
        <a href="http://github.com/piwi/markdown-extended" class="github-button" data-type="fork" data-show-count="true"
        title="Markdown Extended forkers" id="github-frame-forkers">Fork GitHub@piwi/markdown-extended</a>
    </div>
    <div class="col-xs-5 col-sm-3 col-md-2 text-center">
        <a href="http://github.com/piwi/markdown-extended" class="github-button" data-type="watch" data-show-count="true" title="Markdown Extended watchers" id="github-frame-watchers">Star GitHub@piwi/markdown-extended</a>
    </div>
    <div class="col-xs-1 col-sm-3 col-md-4"></div>
</div>
</div>

<div class="jumbotron home">
<p>
    <strong>Markdown Extended</strong> is an <em>extended implementation</em> of <a href="http://daringfireball.net/projects/markdown/" title="See it online">John Gruber's original markdown syntax</a> to write reach contents from simple text files such as common <code>.txt</code>.
    <i class="fa fa-info-circle" id="plain-text-content"
        data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover"
        data-title="Markdown Extended plain text version of this content"
        data-content="**Markdown Extended** is an *extended implementation* of [John Gruber's original markdown syntax](http://daringfireball.net/projects/markdown/ 'See it online') to write reach contents from simple text files such as common `.txt`."></i>
</p>
</div>

<div class="marketing">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2 class="nobefore"><i class="fa fa-quote-right"></i>&nbsp;About</h2>
            <?php _markdownify(file_get_contents(__DIR__.'/00-home/about.md')); ?>
            <p class="text-right">
                <a class="btn btn-default btn-home" role="button" href="01-about.html">Read more <span class="fa fa-angle-double-right"></span></a>
            </p>
        </div>
        <div class="col-xs-12 col-md-6">
            <h2 class="nobefore"><i class="fa fa-users"></i>&nbsp;Open source</h2>
            <?php _markdownify(file_get_contents(__DIR__.'/00-home/open-source.md')); ?>
            <p class="text-right">
                <a class="btn btn-default btn-home" role="button" href="06-downloads.html">Read more <span class="fa fa-angle-double-right"></span></a>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2 class="nobefore"><i class="fa fa-pencil-square-o"></i>&nbsp;Syntax's rules</h2>
            <?php _markdownify(file_get_contents(__DIR__.'/00-home/syntax.md')); ?>
            <p class="text-right">
                <a class="btn btn-default btn-home" role="button" href="02-manifest.html">Read more <span class="fa fa-angle-double-right"></span></a>
            </p>
        </div>
        <div class="col-xs-12 col-md-6">
            <h2 class="nobefore"><i class="fa fa-cogs"></i>&nbsp;Implementations API</h2>
            <?php _markdownify(file_get_contents(__DIR__.'/00-home/api.md')); ?>
            <p class="text-right">
                <a class="btn btn-default btn-home" role="button" href="05-developers-doc.html">Read more <span class="fa fa-angle-double-right"></span></a>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <h2 class="nobefore"><i class="fa fa-code"></i>&nbsp;Contribute</h2>
            <?php _markdownify(file_get_contents(__DIR__.'/00-home/contribute.md')); ?>
        </div>
        <div class="col-xs-12 col-sm-4">
            <h2 class="nobefore"><i class="fa fa-comments"></i>&nbsp;Talk about MDE</h2>
            <?php _markdownify(file_get_contents(__DIR__.'/00-home/talk.md')); ?>
        </div>
        <div class="col-xs-12 col-sm-4">
            <h2 class="nobefore"><i class="fa fa-rss"></i>&nbsp;Follow MDE</h2>
            <?php _markdownify(file_get_contents(__DIR__.'/00-home/follow.md')); ?>
        </div>
    </div>

</div>

<br class="clearfix">
<!--
<div class="well">
    <p>This project is maintained by <a href="https://github.com/pierowbmstr" title="github.com/pierowbmstr">@pierowbmstr</a>.</p>
</div>
-->