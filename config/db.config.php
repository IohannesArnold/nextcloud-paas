<?php
$dbopts = parse_url(getenv('DATABASE_URL'));

$CONFIG = array (
  'dbtype' => 'pgsql',
  'dbhost' => $dbopts["host"],
  'dbport' => $dbopts["port"],
  'dbname' => ltrim($dbopts["path"],'/')
  'dbuser' => $dbopts["user"],
  'dbpassword' => $dbopts["pass"],
  'dbtableprefix' => 'oc_',
);
