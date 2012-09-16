<?php
$cfg['ShowChgPassword'] = false;
$cfg['VersionCheck'] = false;
$cfg['OBGzip'] = 'auto';
$cfg['ShowServerInfo'] = false;
$cfg['ShowStats'] = false;
$cfg['ShowCreateDb'] = false;
$cfg['Error_Handler']['display'] = false;

/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * phpMyAdmin sample configuration, you can use it as base for
 * manual configuration. For easier setup you can use setup/
 *
 * All directives are explained in Documentation.html and on phpMyAdmin
 * wiki <http://wiki.phpmyadmin.net>.
 *
 * @package PhpMyAdmin
 */

/*
 * This is needed for cookie based authentication to encrypt password in
 * cookie
 */
$cfg['blowfish_secret'] = 'afaff8b7c6d'; /* YOU MUST FILL IN THIS FOR COOKIE AUTH! */

/*
 * Servers configuration
 */
$i = 0;

$services_json = json_decode(getenv("VCAP_SERVICES"),true);
foreach($services_json["mysql-5.1"] as $E)
{
$mysql_config = $E["credentials"];

/*
 * First server
 */
$i++;
$g = $i-1;
/* Authentication type */
$cfg['Servers'][$i]['auth_type'] = 'config';
/* Server parameters */
$cfg['Servers'][$i]['host'] = $mysql_config["hostname"];
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['compress'] = false;
/* Select mysql if your server does not have mysqli */
$cfg['Servers'][$i]['extension'] = 'mysqli';
$cfg['Servers'][$i]['AllowNoPassword'] = false;
$cfg['Servers'][$i]['user'] =  $mysql_config["username"];
$cfg['Servers'][$i]['password'] =  $mysql_config["password"];
$cfg['Servers'][$i]['hide_db'] = 'information_schema';
$cfg['Servers'][$i]['ShowDatabasesCommand'] = 'SELECT DISTINCT TABLE_SCHEMA FROM information_schema.SCHEMA_PRIVILEGES';
}


