<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */
require_once(__DIR__ . '/builder/vendor/autoload.php');
(new \Dotenv\Dotenv(__DIR__.'/'))->load();

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', $_ENV['DB_NAME'] );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', $_ENV['DB_USER'] );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', $_ENV['DB_PASSWORD'] );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', $_ENV['DB_HOST'] );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'T%m^KH]Ar Q(=4Ntw>?<^Xc<QVat81AuZ;HV)V(#@zGR[=p1I8t,C&JWLL=B3k}5' );
define( 'SECURE_AUTH_KEY',  'j5iD+31zD3qHz}_^0=kEZOK?1|H>3/.[rOFEB^X_8@m?fYi&Vi|(n=I_[6$).&`3' );
define( 'LOGGED_IN_KEY',    ',S?u5tzp}]?Z#m+EaA[*49]O.`hy].SM.zD;3G4JfD1oD4#T$oChD+i:X6&F%e#0' );
define( 'NONCE_KEY',        ',_3}36!(TaBklq4E*cZd7}xkl!O}<T_z,U?>o O%h>6R#XKE[@3c]^D|egkX7lQa' );
define( 'AUTH_SALT',        ' v~=091kUS+>rb0>N(BV|(OoTEN*xXSvMVVBvlm]K4y+u:=b8fW/l&H:9^SQ^yM^' );
define( 'SECURE_AUTH_SALT', 'G*{pvOrCS8{3k!;~z`9;^5C7_!sO)Hze]rd>dKNtFq^;at8+=t,BGT:]o&>p6WTP' );
define( 'LOGGED_IN_SALT',   '57UBxxfa:9syOy{O4@Oq74XgvuxR7!d8U>%U4#SD]&oqJ[zN-A(]0{AyapGt@p,8' );
define( 'NONCE_SALT',       'U=QVlA#{oqqaakNIzJ!FmkoT*KUP76>}a/zA2j>ye569cL{Nb;+A(6S}i]GfEX ^' );
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
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', true);
define('WP_CACHE', true);
// to force chmod file
define('FS_CHMOD_DIR', (0755 & ~ umask()));
define('FS_CHMOD_FILE', (0644 & ~ umask()));

// Désactiver l’Éditeur d'Extension et de Thème
define('DISALLOW_FILE_EDIT',true);

/**
 * server folder (change when you're going live)
 */
// $folder_serveur = PRODUCTION ? '' : '/' . basename(__DIR__);
$folder_serveur = $_ENV['ENVIRONMENT_PROD'] !== "true"
  ? 'localhost:8888/' . $_ENV['SERVER_PRE_PROD'] . '/'
  : '/' . $_ENV['SERVER_PROD'] . '/';

/**
 * wp-content folder
 */

$folder_content = 'resources';

$url = $_ENV['ENVIRONMENT_PROD'] !== "true"
  ? "http"
  : "https";

define( 'WP_CONTENT_DIR',   dirname(__FILE__) . '/' . $folder_content ); // Do not remove. Removing this line could break your site. Added by Security > Settings > Change Content Directory.
define( 'WP_CONTENT_URL',   $url . '://'.$folder_serveur . $folder_content ); // Do not remove. Removing this line could break your site. Added by Security > Settings > Change Content Directory.
define( 'WP_PLUGIN_DIR',    WP_CONTENT_DIR . '/' . 'p' );
define( 'WP_PLUGIN_URL',    WP_CONTENT_URL . '/' . 'p');
define( 'PLUGINDIR',        WP_CONTENT_DIR . '/' . 'p' );
define( 'WPMU_PLUGIN_DIR',  WP_CONTENT_DIR . '/' . 'mu-p' );
define( 'WPMU_PLUGIN_URL',  WP_CONTENT_URL . '/' . 'mu-p');

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
