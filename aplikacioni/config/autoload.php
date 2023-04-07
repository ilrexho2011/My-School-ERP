<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Instruksione
| -------------------------------------------------------------------
|
| Keto jane mundesite per ngarkimin automatik nga sistemi:
|
| 1. Packages
| 2. Libraries
| 3. Drivers
| 4. Helper files
| 5. Custom config files
| 6. Language files
| 7. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packages
| -------------------------------------------------------------------
| Prototipi:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/

$autoload['packages'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| 
| Prototipi:
|
|	$autoload['libraries'] = array('database', 'email', 'session');
|
| Mund te jepni edhe emrin e nje librarie alternative 
|
|	$autoload['libraries'] = array('user_agent' => 'ua');
*/

$autoload['libraries'] = array('pagination', 'xmlrpc' , 'form_validation', 'email','upload','paypal');


/*
| -------------------------------------------------------------------
|  Auto-load Drivers
| -------------------------------------------------------------------
| 
|
| Prototipi:
|
|	$autoload['drivers'] = array('cache');
*/

$autoload['drivers'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototipi:
|
|	$autoload['helper'] = array('url', 'file');
*/

$autoload['helper'] = array('url','file','form','security','string','inflector','directory','download','multi_language');


/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototipi:
|
|	$autoload['config'] = array('config1', 'config2');
|
| SHENIM: Kjo vlen vetem kur keni krijuar nje CONFIG sipas deshires
| Perndryshe lereni bosh.
|
*/

$autoload['config'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Language
| -------------------------------------------------------------------
| Prototipi:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| 
|
*/

$autoload['language'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototipi:
|
|	$autoload['model'] = array('first_model', 'second_model');
|
| Mund te jepni emrin e nje modeli alternativÖ
|
|	$autoload['model'] = array('first_model' => 'first');
*/

$autoload['model'] = array('email_model' , 'crud_model' , 'sms_model');
