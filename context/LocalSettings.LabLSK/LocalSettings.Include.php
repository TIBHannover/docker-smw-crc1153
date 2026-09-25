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
    if ( file_exists( "$IP/LocalSettings.LabLSK/LocalSettings.$setting.php" ) ) {
        require_once( "$IP/LocalSettings.LabLSK/LocalSettings.$setting.php" );
    }
}
