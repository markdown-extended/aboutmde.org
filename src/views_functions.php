<?php

use \CarteBlanche\CarteBlanche;
use \AboutMde\Controller;

function _markdownify($str)
{
    return _echo(Controller::markdownify($str));
}

function findModule($module)
{
    return Controller::findModule($module);
}

function findManifest()
{
    return Controller::findManifest();
}

function findManifestHome()
{
    $cfg = CarteBlanche::getConfig('aboutmde');
    return (!empty($cfg) && isset($cfg['manifest_repo'])) ? $cfg['manifest_repo'] : '';
}

// Endfile
