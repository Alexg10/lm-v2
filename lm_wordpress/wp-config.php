<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'lm' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'root' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '(dI?)sC=K[O-|t6|`(!wTH;i]gMBt77twtMEY<*-}lx*UXSC4ZG1FDbQ*Tr8:;<c' );
define( 'SECURE_AUTH_KEY',  'GwWb+U,6XW;9@<U7%/iN<TqAk>Dp;oKK9Nl7Msr6J5%MNN2PtYS!|J3d_/LoQD9u' );
define( 'LOGGED_IN_KEY',    'w#6vhw}3I-3C%[cEMaKQ)sC~+#  Kr)3sr/et V^Kh,1wD12|3jgQVY|,qBh1K0P' );
define( 'NONCE_KEY',        '- &VCJG-3EE-DN4q8qIeoO*PlZy{<ZEB]t~7hc>&QQT%xMmuL7GUjJ{Zk$M/R(U:' );
define( 'AUTH_SALT',        'w?9{f>P=bGDEGCa>QZ_]FSZkE3k,E&jQ.0QD|d WdlC=p2V<{JmRb|Ch)2usuD8U' );
define( 'SECURE_AUTH_SALT', '>)Yq$-{XV<K1U/G?#<wN3__.9pK_AH#B.Fg$@UNtL@[^9JX8~vN~cKR8BA[Dox!0' );
define( 'LOGGED_IN_SALT',   'G8,Z}tj<q:OW94Odw-3sGOF:lWWo<wX@zhQT{/PI(ds$H?]2<7oEMdw(3^u.k~>J' );
define( 'NONCE_SALT',       'E[GthLkIEvZOf%=r6>pNx+]LvE;Wf8QUC9XHOAGaRYH,*Q!NT3<4F<w``a*5H}(j' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
