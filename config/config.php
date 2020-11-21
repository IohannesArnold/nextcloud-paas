<?php
$CONFIG = array (
  'passwordsalt' => getenv('PASSWORD_SALT'),
  'secret' => getenv('SECRET'),
  'trusted_domains' =>
  array (
    0 => 'localhost',
  ),
  'datadirectory' => '/app/data',
  'version' => '20.0.2.2',
  'installed' => true,
);
