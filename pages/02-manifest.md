process: phpize

<?php

$manifest_f = findManifest();
if (file_exists($manifest_f)) {
    echo file_get_contents($manifest_f);
} else {
    echo "No manifest version found!";
}

?>