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

## -------- KnowledgeGraph --------
wfLoadExtension( 'KnowledgeGraph' );
## ======== KnowledgeGraph ========

## -------- Nuke --------
wfLoadExtension( 'Nuke' );
## ======== Nuke ========

## -------- Scribunto --------
wfLoadExtension( 'Scribunto' );
## ======== Scribunto ========

## -------- WikiEditor --------
wfLoadExtension( 'WikiEditor' );
## ======== WikiEditor ========