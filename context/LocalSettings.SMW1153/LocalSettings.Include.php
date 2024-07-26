<?php

require_once( "$IP/LocalSettings.OpenResearchStack/LocalSettings.Include.php");

#$wgWikiBrand = 'semantic::core';
#$wgWikiVersion = '{{SEMANTIC_CORE_VERSION}}';

$settings = [ 
    'Extensions',
    'Namespaces',
    'Runtime',
    'Skinning',
];

foreach ( $settings as $setting ) {
    if ( file_exists( "$IP/LocalSettings.SMW1153/LocalSettings.$setting.php" ) ) {
        require_once( "$IP/LocalSettings.SMW1153/LocalSettings.$setting.php" );
    }
}
