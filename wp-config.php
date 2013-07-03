<?php
/**
 * Baskonfiguration för WordPress.
 *
 * Denna fil innehåller följande konfigurationer: Inställningar för MySQL,
 * Tabellprefix, Säkerhetsnycklar, WordPress-språk, och ABSPATH.
 * Mer information på {@link http://codex.wordpress.org/Editing_wp-config.php 
 * Editing wp-config.php}. MySQL-uppgifter får du från ditt webbhotell.
 *
 * Denna fil används av wp-config.php-genereringsskript under installationen.
 * Du behöver inte använda webbplatsen, du kan kopiera denna fil direkt till
 * "wp-config.php" och fylla i värdena.
 *
 * @package WordPress
 */

// ** MySQL-inställningar - MySQL-uppgifter får du från ditt webbhotell ** //
/** Namnet på databasen du vill använda för WordPress */
define('DB_NAME', 'tobiasbill');

/** MySQL-databasens användarnamn */
define('DB_USER', 'root');

/** MySQL-databasens lösenord */
define('DB_PASSWORD', '1860,a');

/** MySQL-server */
define('DB_HOST', 'localhost');

/** Teckenkodning för tabellerna i databasen. */
define('DB_CHARSET', 'utf8');

/** Kollationeringstyp för databasen. Ändra inte om du är osäker. */
define('DB_COLLATE', '');

/**#@+
 * Unika autentiseringsnycklar och salter.
 *
 * Ändra dessa till unika fraser!
 * Du kan generera nycklar med {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Du kan när som helst ändra dessa nycklar för att göra aktiva cookies obrukbara, vilket tvingar alla användare att logga in på nytt.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'xfjJ.`d<-;+n;wFmpaQduKl*p5Ho<uXxT-avfSAsHCJ/o/4ZE!Z~8+0VXP^xiS6y');
define('SECURE_AUTH_KEY',  'P`|)>?/q)74#R^5P|irpQHy&qdJo,Zlc}({hm#r 7[$+LHHhb=$ sD;]9;<9`i-|');
define('LOGGED_IN_KEY',    '?>sQY/hr=3-YuY46A$HJJ/`E:*.!x-]TU3B X_-Fngn-8bp;f=)9B^3o}p-%me)c');
define('NONCE_KEY',        '}w(H*{?X<.H=5kW=!rP;n-zHuPyUN^*<r+<gC+L.3f#]%-!m[Yl75idWLc1MQ+=b');
define('AUTH_SALT',        '^@08Y,jc4%!b*OV.]r3s/9.TaE8Cm+GoWfs`AkNJ$ a@n!^lQk116+Z-cp+FeRr-');
define('SECURE_AUTH_SALT', 'V<,-7fy+ul3T>[1g1IccO 8hN 11WBjPct[*u}@_19&8k@Ix|+yuzVL$uDNk+,NH');
define('LOGGED_IN_SALT',   'Rt|)v1AEwh:Z$#A6fk&lFFy-Fv,|y,mR).R$:JC+LY0|rJQ;X`Jr.Z5<Q]`-}R8:');
define('NONCE_SALT',       '-13yYCHG[t; Q~Tn,|XOGo-|Ee!8&rR=~r^=.YJ*0;[<D+O_Dp-0>1*;GDC=W:r6');

/**#@-*/

/**
 * Tabellprefix för WordPress Databasen.
 *
 * Du kan ha flera installationer i samma databas om du ger varje installation ett unikt
 * prefix. Endast siffror, bokstäver och understreck!
 */
$table_prefix  = 'wp_';

/**
 * WordPress-språk, förinställt för svenska.
 *
 * Du kan ändra detta för att ändra språk för WordPress.  En motsvarande .mo-fil
 * för det valda språket måste finnas i wp-content/languages. Exempel, lägg till
 * sv_SE.mo i wp-content/languages och ange WPLANG till 'sv_SE' för att få sidan
 * på svenska.
 */
define('WPLANG', 'sv_SE');

/** 
 * För utvecklare: WordPress felsökningsläge. 
 * 
 * Ändra detta till true för att aktivera meddelanden under utveckling. 
 * Det är rekommderat att man som tilläggsskapare och temaskapare använder WP_DEBUG 
 * i sin utvecklingsmiljö. 
 */ 
define('WP_DEBUG', false);

/* Det var allt, sluta redigera här! Blogga på. */

/** Absoluta sökväg till WordPress-katalogen. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Anger WordPress-värden och inkluderade filer. */
require_once(ABSPATH . 'wp-settings.php');