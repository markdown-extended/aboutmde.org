data: implementations
process: phpize

Implementations & Downloads
===========================

## Implementations

<?php foreach ($page['data']['implementations'] as $item) : ?>
<ul>
  <li><a href="#<?php _echo($item['name']); ?>"><strong><?php _echo($item['name']); ?></strong></a></li>
</ul>
<?php endforeach; ?>


<?php
foreach ($page['data']['implementations'] as $item) : 
    $item_id = uniqid();
?>

<hr>

# <?php _echo($item['name']); ?>

<?php if ($item['status'] == 'stable') : ?>
## Last stable version

The last stable version is **<?php _echo($item['version']); ?>** available for download at <<?php _echo($item['link']); ?>>.
<?php else: ?>
<div class="alert alert-danger alert-dismissable" markdown="1">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

**!! WARNING !!**

This package is still in development and not yet proposed in a "stable" version ;
some works remains before the first stable version.

<?php if ($item['watch_url']) : ?>
To get informed about the first stable version, you can follow the development
on the repository homepage at <<?php _echo($item['watch_url']); ?>>.
<?php endif; ?>

</strong>
</div>
<?php endif; ?>

## Source code repository

<?php if ($item['repository']) : ?>
View the original <?php _echo($item['name']); ?> parser on <?php _echo($item['host']); ?> : <<?php _echo($item['repository']); ?>>
<?php endif; ?>

<ul class="gh-buttons">
<?php if ($item['zipfile']) : ?>
  <li><a href="<?php _echo($item['zipfile']); ?>">Download <strong>ZIP File</strong></a></li>
<?php endif; ?>
<?php if ($item['tarball']) : ?>
  <li><a href="<?php _echo($item['tarball']); ?>">Download <strong>TAR Ball</strong></a></li>
<?php endif; ?>
<?php if ($item['repository']) : ?>
  <li><a href="<?php _echo($item['repository']); ?>">View On <strong><?php _echo($item['host']); ?></strong></a></li>
<?php endif; ?>
</ul>

<?php if ($item['api_infos'] || $item['manifest']) : ?>
<div class="row"><div class="col-xs-12 col-md-12" markdown="1">

## Version &amp; Manifest

<div class="well">

    <?php if ($item['manifest']) : ?>
<div id="classinfo-<?php _echo($item_id); ?>"><p></p></div>
<p><a id="manifest-<?php _echo($item_id); ?>_handler" class="handler" title="Infos extracted from your package version manifest">Full package manifest</a></p>
<div id="manifest-<?php _echo($item_id); ?>" class="show-on-printer"><dl class="dl-horizontal list_infos"></dl></div>
    <?php endif; ?>
    <?php if ($item['api_infos']) : ?>
<p><a id="github-<?php _echo($item_id); ?>_handler" class="handler" title="Infos extracted from the repository on GitHub.com">Current repository infos</a></p>
<div id="github-<?php _echo($item_id); ?>" class="show-on-printer">
<strong>Last commits</strong><dl class="dl-horizontal" id="commits_list"></dl>
<strong>Last bugs</strong><dl class="dl-horizontal" id="bugs_list"></dl>
</div>
    <?php endif; ?>

</div>
</div></div>
<?php
$js_str = '';
if ($item['manifest']) {
    $js_str .= 'implementorManifest("'.$item_id.'",  "'.$item['manifest'].'");';
}
if ($item['api_infos']) {
    $js_str .= 'implementorRepository("github-'.$item_id.'", "'.$item['api_infos'].'");';
}
$_template->getTemplateObject('JavascriptTag')->set(array(
    "$(function() { $js_str });"
));
?>
<?php endif; ?>

<?php endforeach; ?>
