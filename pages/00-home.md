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
<p>
    <strong>Markdown</strong> is a set of writing rules to build some human readable text contents, such as <code>.txt</code> common files, which can be parsed to build some HTML valid content, structurally and typographically. The first idea was from <a href="http://daringfireball.net/" title="http://daringfireball.net/">John Gruber</a>, coded in <em>Perl</em> script.
</p>
<p>
    <strong>Markdown</strong> has become one of the most common standards of rich-text contents, used for example by <a href="http://github.com" title="http://github.com">GitHub</a> as one of the proposed syntaxes for informational files.
</p>

    </div>
    <div class="col-xs-12 col-md-6">

<h2 class="nobefore"><i class="fa fa-github"></i>&nbsp;Sources</h2>

<ul class="gh-buttons">
  <li><a href="https://github.com/atelierspierrot/markdown-extended-doc/zipball/master">Download <strong>ZIP File</strong></a></li>
  <li><a href="https://github.com/atelierspierrot/markdown-extended-doc/tarball/master">Download <strong>TAR Ball</strong></a></li>
  <li><a href="https://github.com/atelierspierrot/markdown-extended-doc">View On <strong>GitHub</strong></a></li>
</ul>

    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">

<h2 class="nobefore"><i class="fa fa-users"></i>&nbsp;Open source</h2>
<p>
    The sources of the <code title="PHP package">MarkdownExtended</code> package are hosted on <a href="http://github.com" title="See online github.com">GitHub</a>.
</p>
<p>
    To participate, follow sources updates, report a bug or read opened bug tickets and any other information, please see the GitHub repository <a href="http://github.com/atelierspierrot/markdown-extended" title="http://github.com/atelierspierrot/markdown-extended">atelierspierrot/markdown-extended</a>.
</p>

    </div>
    <div class="col-xs-12 col-md-6">

<h2 class="nobefore"><i class="fa fa-cogs"></i>&nbsp;Full set of options</h2>
<p>
    The <strong>Markdown Extended</strong> version handles a large set of options to fit different needs.
</p>

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
