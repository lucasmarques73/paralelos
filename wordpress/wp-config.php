<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'wordpress');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'xph,Ta4W?g hS)*Tu_-_V6#+OD)^W5T.Kk2rL;a/F,8Yk8cCUzaW3touIu%,6gER');
define('SECURE_AUTH_KEY',  '%MjXBx{p>AT)7 j&PHM/$)04x0Z-z6#z.g0BBe??NNA@39ds73J;Q~ke/tp9c}{3');
define('LOGGED_IN_KEY',    'vf*b~9zKfXWGmuYeVQSe*!}7C?AwF6aM3qg1~A3;3`]VW!$Ej6#s*`L(D #tw_9#');
define('NONCE_KEY',        'DWRtz8Z^ybfDTv(d&}Exq5eP;f#`gw5dx<{]6X`q*`?lX8zVDWc xCcGz0-JA5gt');
define('AUTH_SALT',        'Y#HXuc{arF:mZ6&H)qUA0H]i,gH[2S)wVe_YTc+p2YT]VoHag|zgcQ3OvrL4?~db');
define('SECURE_AUTH_SALT', 't75yC#lFyFuxt}l2-k- +~RPJHv%o1HTXkF;r)Ig[n2*`bYzII>5N1Rpj/=%7fR{');
define('LOGGED_IN_SALT',   'vHmc &y!?Mn<$A@3:/($Zsk(>=?C4.Vwxu?=4a+*ejfi%[&r#L(n`h~&l1og%R_B');
define('NONCE_SALT',       '{`[AIcwIia#g-&.yYWP;)UftHeCNx^o6hG5yui0d4zWP)jM96K-mLAQ[rV 6WfLv');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente ao
 * idioma escolhido deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define('WPLANG', 'pt_BR');

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
