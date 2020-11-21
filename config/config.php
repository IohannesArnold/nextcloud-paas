<?php
if(getenv('SECRET') || getenv('PASSWORD_SALT')) {
  $CONFIG = array (
    'secret' => getenv('SECRET'),
    'passwordsalt' => getenv('PASSWORD_SALT'),
    'trusted_domains' =>
    array (
      0 => 'localhost',
    ),
    'datadirectory' => '/app/data',
    'version' => '20.0.2.2',
    'installed' => true,
  );
}
