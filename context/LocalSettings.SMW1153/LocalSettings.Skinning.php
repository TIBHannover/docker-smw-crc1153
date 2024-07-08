<?php

## Logo
$wgLogos = [
	"1x" => "$wgScriptPath/resources/src/mediawiki.smw1153.media/logo.svg",
	"icon" => "$wgScriptPath/resources/src/mediawiki.smw1153.media/logo.svg",
	"svg" => "$wgScriptPath/resources/src/mediawiki.smw1153.media/logo.svg",
];

$egChameleonLayoutFile= "$IP/skins/chameleon/layouts/standard.xml";

$egChameleonAvailableLayoutFiles = [
	'standard'   => "$IP/skins/chameleon/layouts/standard.xml",
	'navhead'    => "$IP/skins/chameleon/layouts/navhead.xml",
	'fixedhead'  => "$IP/skins/chameleon/layouts/fixedhead.xml",
	'stickyhead' => "$IP/skins/chameleon/layouts/stickyhead.xml",
	'clean'      => "$IP/skins/chameleon/layouts/clean.xml",
];

## (Global) Styles
$egChameleonExternalStyleModules = [
	__DIR__ . "/../resources/src/mediawiki.smw1153.styles/smw1153.scss" => 'afterMain',
];