<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Modalitetet e Lexim/Shkrimit
|--------------------------------------------------------------------------
|
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| Modalitetet e Lexim/Shkrimit ne Skedar
|--------------------------------------------------------------------------
|
| Kane vlere kur perdoren instruksionet fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); 
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); 
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Paraqet gjurmimin e Debug
|--------------------------------------------------------------------------
|
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Kodet e Gjendjes Exit 
|--------------------------------------------------------------------------
|
|
*/
define('EXIT_SUCCESS', 0); // pa gabime
define('EXIT_ERROR', 1); // gabime xhenerike
define('EXIT_CONFIG', 3); // gabim konfigurimi
define('EXIT_UNKNOWN_FILE', 4); // nuk u gjet skedari
define('EXIT_UNKNOWN_CLASS', 5); // klase e panjohur
define('EXIT_UNKNOWN_METHOD', 6); // anetar i nje klase te panjohur
define('EXIT_USER_INPUT', 7); // input i pavlefshem nga perdoruesi
define('EXIT_DATABASE', 8); // gabim ne databaze
define('EXIT__AUTO_MIN', 9); // gabim per lowest automatically-assigned
define('EXIT__AUTO_MAX', 125); // gabim per highest automatically-assigned
