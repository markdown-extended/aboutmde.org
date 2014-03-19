process: phpize

<?php

$manifest_f = findManifest();
if (file_exists($manifest_f)) {
    echo file_get_contents($manifest_f);
} else {
    echo "No manifest version found!";
}

?>

<br class="clearfix" />
<div class="well">
    These specifications are maintained as a standalone GIT repository at: 
    <a href="<?php _echo(findManifestHome()); ?>" title="<?php _echo(findManifestHome()); ?>"><?php _echo(findManifestHome()); ?></a>.
</div>