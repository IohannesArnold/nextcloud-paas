<?php
$CONFIG = array (
  'objectstore' => [
    'class' => '\\OC\\Files\\ObjectStore\\S3',
    'arguments' => [
      'bucket' => getenv('S3_BUCKET'),
      'key'    => getenv('S3_KEY'),
      'secret' => getenv('S3_SECRET'),
      'hostname' => getenv('S3_HOSTNAME'),
      'use_ssl' => true,
    ],
  ],
);
