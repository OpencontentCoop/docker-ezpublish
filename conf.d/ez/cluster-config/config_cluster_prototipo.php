<?php

define( 'CLUSTER_STORAGE_GATEWAY_PATH',  'extension/ezpostgresqlcluster/clustering/dfs/gateway.php' );
define( 'CLUSTER_STORAGE_BACKEND',       'dfspostgresql'  );
define( 'CLUSTER_STORAGE_HOST',          'postgres' );
define( 'CLUSTER_STORAGE_PORT',          5432 );
define( 'CLUSTER_STORAGE_USER',          'postgres' );
define( 'CLUSTER_STORAGE_PASS',          'verygoodsecret' );
define( 'CLUSTER_STORAGE_DB',            'ezpublish' );
define( 'CLUSTER_STORAGE_CHARSET',       'utf8' );
define( 'CLUSTER_MOUNT_POINT_PATH',      '/mnt/efs/cluster/' );
define( 'CLUSTER_METADATA_TABLE_CACHE',  'ezdfsfile_cache' );
define( 'CLUSTER_METADATA_CACHE_PATH',   '/cache/' );
define( 'CLUSTER_METADATA_STORAGE_PATH', '/storage/' );
define( 'CLUSTER_EXPIRY_TIMEOUT',        2592000 );
