<?php
// auto-generated by sfDatabaseConfigHandler
// date: 2016/09/10 12:32:45

$database = new sfPropelDatabase();
$database->initialize(array (
  'phptype' => 'mysql',
  'hostspec' => 'localhost',
  'database' => 'itutor',
  'username' => 'itutor',
  'password' => '8+PoDcr*6qdciLo3J.sRNt8YUG2+#6n$',
  'encoding' => 'utf8',
  'persistent' => true,
), 'itutor');
$this->databases['itutor'] = $database;

$database = new sfPropelDatabase();
$database->initialize(array (
  'phptype' => 'mysql',
  'hostspec' => 'localhost',
  'database' => 'itutor',
  'username' => 'itutor',
  'password' => '8+PoDcr*6qdciLo3J.sRNt8YUG2+#6n$',
  'encoding' => 'utf8',
  'persistent' => true,
), 'propel');
$this->databases['propel'] = $database;
