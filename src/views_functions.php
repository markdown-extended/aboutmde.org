<?php

use \CarteBlanche\CarteBlanche;
use \AboutMde\Controller;

function _markdownify($str)
{
    return _echo(Controller::markdownify($str));
}

function findManifest()
{
    $src = Controller::findModule('manifest');
    return $src.'/MDE-manifest.md';
}

// Endfile
