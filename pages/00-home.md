title: Home
process: phpize

<div class="page-header">
  <h1>Markdown Extended <small>The new way of writing for the web</small></h1>
</div>

<div class="jumbotron home">

<p>
    <strong>Markdown Extended</strong> is an extended implementation of <a href="http://daringfireball.net/projects/markdown/" title="See it online">John Gruber's original markdown syntax</a> to write reach contents from simple text files.
    <i class="fa fa-info-circle" id="plain-text-content"
        data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover"
        data-title="Markdown Extended plain text version of this content"
        data-content="**Markdown Extended** is an extended implementation of [John Gruber's original markdown syntax](http://daringfireball.net/projects/markdown/ 'See it online') to write reach contents from simple text files."></i>
</p>

<div class="row">
    <div class="col-xs-6 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3">
        <a href="http://github.com/atelierspierrot/markdown-extended" class="github-button" data-type="fork" data-show-count="true"
        title="Markdown Extended forkers" id="github-frame-forkers">Fork GitHub@atelierspierrot/markdown-extended</a>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-3">
        <a href="http://github.com/atelierspierrot/markdown-extended" class="github-button" data-type="watch" data-show-count="true" title="Markdown Extended watchers" id="github-frame-watchers">Star GitHub@atelierspierrot/markdown-extended</a>
    </div>
    <div class="hidden-xs col-sm-2 col-md-3"></div>
</div>

</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <h2 class="nobefore"><i class="fa fa-quote-right"></i>&nbsp;About</h2>
        <?php _markdownify(file_get_contents(__DIR__.'/00-home/about.md')); ?>
    </div>
    <div class="col-xs-12 col-md-6">
        <h2 class="nobefore"><i class="fa fa-users"></i>&nbsp;Open source</h2>
        <?php _markdownify(file_get_contents(__DIR__.'/00-home/open-source.md')); ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <h2 class="nobefore"><i class="fa fa-pencil-square-o"></i>&nbsp;Syntax's rules</h2>
        <?php _markdownify(file_get_contents(__DIR__.'/00-home/syntax.md')); ?>
    </div>
    <div class="col-xs-12 col-md-6">
        <h2 class="nobefore"><i class="fa fa-cogs"></i>&nbsp;Implementations API</h2>
        <?php _markdownify(file_get_contents(__DIR__.'/00-home/api.md')); ?>
    </div>
</div>

<p>This project is maintained by <a href="https://github.com/atelierspierrot" title="github.com/atelierspierrot">@atelierspierrot</a></p>

<?php
$_template->getTemplateObject('JavascriptTag')->set(array("
$(function() { 
    // popover on homepage
    onLoadIdExists('plain-text-content', function(){
        $('#plain-text-content').popover();
    });
});
"));
?>
