<?php

## -------- CodeEditor --------
wfLoadExtension( 'CodeEditor' );
## ======== CodeEditor ========

## -------- ConfirmAccount --------
wfLoadExtension( 'ConfirmAccount' );
$wgConfirmAccountRequestFormItems["Biography"]["enabled"] = false;
$wgWhitelistRead = array( "Special:RequestAccount" );
$wgGroupPermissions["bureaucrat"]["confirmaccount-notify"] = true;
## ======== ConfirmAccount ========

## -------- EditAccount --------
wfLoadExtension("EditAccount");
$wgGroupPermissions["sysop"]["editaccount"] = true;
$wgGroupPermissions["bureaucrat"]["editaccount"] = true;
## ======== EditAccount ========

## -------- ExternalData --------
$wgExternalDataSources['graphviz'] = [
	'name'              => 'GraphViz',
	'program url'       => 'https://graphviz.org/',
	'version command'   => null,
	'command'           => 'dot -K$layout$ -Tsvg',
	'params'            => [ 'layout' => 'dot' ],
	'param filters'     => [ 'layout' => '/^(dot|neato|twopi|circo|fdp|osage|patchwork|sfdp)$/' ],
	'input'             => 'dot',
	'preprocess'        => 'EDConnectorExe::wikilinks4dot',
	'postprocess'       => 'EDConnectorExe::innerXML',
	'env' => [
        'HOME'           => '/tmp',
        'XDG_CACHE_HOME' => '/tmp',
    ],
	'min cache seconds' => 30 * 24 * 60 * 60,
	'tag'               => 'graphviz'
];
## ======== ExternalData ========

## -------- KnowledgeGraph --------
wfLoadExtension( 'KnowledgeGraph' );
$wgKnowledgeGraphColorPalettes = [
    'default' => [
        "#1f77b4","#ff7f0e","#2ca02c","#d62728","#9467bd",
        "#8c564b","#e377c2","#7f7f7f","#bcbd22","#17becf",
        "#fbb4ae","#b3cde3","#ccebc5","#decbe4","#fed9a6",
        "#ffffcc","#e5d8bd","#fddaec","#f2f2f2","#b3e2cd",
        "#fdcdac","#cbd5e8","#a6cee3","#1f78b4","#b2df8a",
        "#33a02c","#fb9a99","#e31a1c","#fdbf6f","#ff7f00",
        "#cab2d6","#6a3d9a","#ffff99","#b15928","#7fc97f",
        "#beaed4","#fdc086","#ffff99","#386cb0","#f0027f",
        "#bf5b17","#666666","#1b9e77","#d95f02","#7570b3",
        "#e7298a","#66a61e","#e6ab02","#a6761d","#666666",
    ],
    'schemeSet3' => [
        "#fbb4ae","#b3cde3","#ccebc5","#decbe4","#fed9a6",
        "#ffffcc","#e5d8bd","#fddaec","#f2f2f2","#b3e2cd",
        "#fdcdac","#cbd5e8",
    ],
    'schemePaired' => [
        "#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99",
        "#e31a1c","#fdbf6f","#ff7f00","#cab2d6","#6a3d9a",
        "#ffff99","#b15928",
    ],
    'schemeAccent' => [
        "#7fc97f","#beaed4","#fdc086","#ffff99","#386cb0",
        "#f0027f","#bf5b17","#666666",
    ],
    'schemeDark2' => [
        "#1b9e77","#d95f02","#7570b3","#e7298a","#66a61e",
        "#e6ab02","#a6761d","#666666",
    ],
];
## ======== KnowledgeGraph ========

## -------- Nuke --------
wfLoadExtension( 'Nuke' );
## ======== Nuke ========

## -------- SemanticResultFormats --------
$srfgFormats[] = "gantt";
$srfgFormats[] = "graph";
$srfgFormats[] = "excel";
$srfgFormats[] = "filtered";
## ======== SemanticResultFormats ========

## -------- Scribunto --------
wfLoadExtension( 'Scribunto' );
## ======== Scribunto ========

## -------- UserFunctions --------
$wgUFAllowedNamespaces[NS_MAIN] = true;
$wgUFEnabledPersonalDataFunctions = [
	'nickname',
	'realname',
	'useremail',
	'username',
];
## ======== UserFunctions ========

## -------- WikiEditor --------
wfLoadExtension( 'WikiEditor' );
## ======== WikiEditor ========