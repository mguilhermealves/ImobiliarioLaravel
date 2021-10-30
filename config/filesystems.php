<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'models' => [
            'driver' => 'local',
            'root' => base_path('app/Models'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        'produtos' => [
          'driver' => 's3',
          'version' => 'latest',
          'endpoint' => 'https://lss.locawebcorp.com.br',
          'account' => 'Locaweb CORP Object Storage',
          'key' => '0Y4BMD42RZ5AAHQKHJLK',
          'secret' => 'Si1UflhSJzzf2ici82OHv9iZkziTYENIs4bHdsUk',
          'region' => '',
          'bucket' => 'dyuan88_produtos',
          'Body' => '',
          'ACL' => 'public-read-write',
       ],

        'banco' => [
          'driver' => 's3',
          'version' => 'latest',
          'endpoint' => 'https://lss.locawebcorp.com.br',
          'account' => 'Locaweb CORP Object Storage',
          'key' => '0Y4BMD42RZ5AAHQKHJLK',
          'secret' => 'Si1UflhSJzzf2ici82OHv9iZkziTYENIs4bHdsUk',
          'region' => '',
          'bucket' => 'dyuan88_banco',
          'Body' => '',
          'ACL' => 'public-read-write',
       ],

        'mensagens' => [
          'driver' => 's3',
          'version' => 'latest',
          'endpoint' => 'https://lss.locawebcorp.com.br',
          'account' => 'Locaweb CORP Object Storage',
          'key' => '0Y4BMD42RZ5AAHQKHJLK',
          'secret' => 'Si1UflhSJzzf2ici82OHv9iZkziTYENIs4bHdsUk',
          'region' => '',
          'bucket' => 'dyuan88_mensagens',
          'Body' => '',
          'ACL' => 'public-read-write',
       ],

        'cotacoes' => [
          'driver' => 's3',
          'version' => 'latest',
          'endpoint' => 'https://lss.locawebcorp.com.br',
          'account' => 'Locaweb CORP Object Storage',
          'key' => '0Y4BMD42RZ5AAHQKHJLK',
          'secret' => 'Si1UflhSJzzf2ici82OHv9iZkziTYENIs4bHdsUk',
          'region' => '',
          'bucket' => 'dyuan88_cotacoes',
          'Body' => '',
          'ACL' => 'public-read-write',
       ],

        'rfqs' => [
          'driver' => 's3',
          'version' => 'latest',
          'endpoint' => 'https://lss.locawebcorp.com.br',
          'account' => 'Locaweb CORP Object Storage',
          'key' => '0Y4BMD42RZ5AAHQKHJLK',
          'secret' => 'Si1UflhSJzzf2ici82OHv9iZkziTYENIs4bHdsUk',
          'region' => '',
          'bucket' => 'dyuan88_rfqs',
          'Body' => '',
          'ACL' => 'public-read-write',
        ],

        'certificados' => [
          'driver' => 's3',
          'version' => 'latest',
          'endpoint' => 'https://lss.locawebcorp.com.br',
          'account' => 'Locaweb CORP Object Storage',
          'key' => '0Y4BMD42RZ5AAHQKHJLK',
          'secret' => 'Si1UflhSJzzf2ici82OHv9iZkziTYENIs4bHdsUk',
          'region' => '',
          'bucket' => 'dyuan88_certificados',
          'Body' => '',
          'ACL' => 'public-read-write',
        ],

    ],

];
