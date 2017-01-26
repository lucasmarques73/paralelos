<?php
/**
* admin.brazilian_portuguese.php
* @package: Sigsiu Online Business Index 2
* ===================================================
* @author
* Name: Sigrid & Radek Suski, Sigsiu.NET
* Email: sobi@sigsiu.net
* Url: http://www.sigsiu.net
* ===================================================
* @copyright Copyright (C) 2008 Sigsiu.NET (http://www.sigsiu.net). All rights reserved.
* @license see http://www.gnu.org/licenses/lgpl.html GNU/LGPL.
* You can use, redistribute this file and/or modify
* it under the terms of the GNU Lesser General Public License as published by
* the Free Software Foundation.
*
* Translation made by Renato Ferrari de Souza
* rfsouza@yahoo.com
*/


// no direct access
defined( '_SOBI2_' ) || ( trigger_error("Acesso Restrito", E_USER_ERROR) && exit() );

/*
 * added (RC 2.9)
 */
define('_CCOUNT_VISITED', '( visitado %count% vez(es) )');
defined('_BACK') or define('_BACK', 'Voltar');

/*
 * added (RC 2.8.7.2)
 */
define('_SOBI2_GOOGLEMAPS_LABEL', 'Títulos');

/*
 * added (RC 2.8.7.1)
 */
defined('_PN_PREVIOUS') or define('_PN_PREVIOUS', 'Anterior');
defined('_PN_START') or define('_PN_START', 'Iniciar');
defined('_PN_NEXT') or define('_PN_NEXT', 'Próximo');
defined('_PN_END') or define('_PN_END', 'Fim');

/*
 * added (RC 2.8.7)
 */
define('_SOBI2_RENEW_EXP_TXT', 'Esta Entrada está expirada a %days% dia(s). Você gostaria de <a href="%href%" title="Renovar esta Entrada Agora">Renovar esta Entrada Agora</a> ?');

/*
 * added (RC 2.8.5)
 */
define('_SOBI2_DEFAULT_TOOLTIP_TITLE', 'Dica');
define('_SOBI2_ENTRIES_LIMIT_REACHED', 'Você já adicionou %count% Entrada(s). Você pode adicionar no máximo %limit% Entrada(s).');

/*
 * added (RC 2.8.4)
 */
define('_SOBI2_RENEW_TPL_TXT', 'Esta Entrada expirou a %days% dia(s). Você gostaria de <a href="%href%" title="Renovar esta Entrada Agora">Renovar esta Entrada Agora</a> ?');
define('_SOBI2_RENEW_BT_NOW', 'Renovar esta Entrada Agora');
define('_SOBI2_RENEW_HEADER', 'Renovar Entrada');
define('_SOBI2_RENEW_EXPL', 'Você está renovando sua Entrada ( %title% ). Sua prorrogação será de %days% dia(s) e expirará novamente em %date%');
define('_SOBI2_RENEWED_EXPL', 'Sua Entrada ( %title% ) foi renovada para mais %days% dia(s). Sua nova data de expiração será em %date%');
define('_SOBI2_PAY_DISCOUNT', 'Desconto');
define('_JS_SOBI2_QFIELD_NO_VALUE', 'Dados não encontrados');
define('_JS_SOBI2_QFIELD_DBL_CLK_TO_EDIT', 'Duplo click para editar os dados');

/*
 * added (RC 2.8.1)
 */
define('_SOBI2_NEW_LABEL', 'Novo');
define('_SOBI2_UPDATED_LABEL', 'Atualizado');
define('_SOBI2_HOT_LABEL', 'Especial');

/*
 * added 16.08.2007 (RC 2.8)
 */

//to get it working in this language you need the language files of the calender too
define("_SOBI2_CALENDAR_LANG", "pt-br");
define("_SOBI2_CALENDAR_FORMAT", "dd-mm-y");

define("_SOBI2_USER_OWN_LISTING", "Listagem %name%");
// use this line if  user (login) name should be used in "Show users listings" instead of the real name
//define("_SOBI2_USER_OWN_LISTING", "%username%'s listings");
define("_SOBI2_USER_OWN_NO_LISTING", "Nenhuma lista deste usuário foi encontrada");

define('_SOBI2_FIELDLIST_SELECT', '&nbsp;---- selecione ----&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');

define('_SOBI2_ALPHA_HEADER', 'Letter ');
define('_SOBI2_ALPHA_CATS_WITH_LETTER', 'Categorias começando com ');
define('_SOBI2_ALPHA_ITEMS_WITH_LETTER', 'Entradas começando com ');
define('_SOBI2_ALPHA_LETTER', 'Entradas e Categorias começando com ');

define('_SOBI2_TAGGED_HEADER', 'Entradas identificadas como ');
define('_SOBI2_ENTRIES_TAGGED_WITH', 'Entradas identificadas como ');
define('_SOBI2_ENTRY_TAGGED_WITH', 'Identificação: ');

define('_SOBI2_POPULAR_HEADER', 'Populares');
define('_SOBI2_POPULAR_LISTING', 'Entradas Populares');
define('_SOBI2_POPULAR_CATS', 'Categorias Populares');

define('_SOBI2_UPDATED_HEADER', 'Entradas Atualizadas Recentemente');
define('_SOBI2_UPDATED_LISTING', 'Entradas Atualizadas Recentemente');

define('_SOBI2_NEW_LISTINGS_HEADER', 'Novas Entradas');
define('_SOBI2_NEW_LISTINGS_LISTING', 'Novas Entradas');

defined('_SEARCH_BOX') or define('_SEARCH_BOX', 'Pesquisar ... ');
define('_SOBI2_SEARCH_RESET_FORM', 'Limpar Pesquisa');
define('_SOBI2_SEARCH_RESET_FORM_TITLE', 'Limpar formulário de Pesquisa');

/*
 * added 26.07.2007 (RC 2.7.4)
 */
DEFINE('_SOBI2_SEARCH_CAT_REMOVED', 'A Categoria selecionada foi removida');
DEFINE('_SOBI2_SEARCH_TOOGLE_EXTENDED', 'Opções para Pesquisa Extendida');
DEFINE('_SOBI2_SEARCH_TOOGLE_CATS', 'Selecione Categoria');
DEFINE('_SOBI2_SEARCH_CATBOX_SELECT', '&nbsp;---- selecione ----&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
DEFINE('_SOBI2_SEARCH_BOX_SELECT', '&nbsp;---- selecione ----&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');

/*
 * added 16.06.2007 (RC 2.7.2)
 */
DEFINE('_SOBI2_FILE_NOT_UPLOADED', 'Não foi possível enviar o arquivo, por favor tente novamente.');
DEFINE('_SOBI2_FILE_UPLOADED', 'Arquivo enviado');
DEFINE('_SOBI2_UPLOAD_FILE', 'Envio de Arquivo: ');
DEFINE('_SOBI2_UPLOAD', 'Enviar');
DEFINE('_SOBI2_UPLOAD_DISSALLOWED_FILETYPE', 'Não é um tipo de arquivo permitido');


/*
 * added 11.11.2006 (RC 2.5.4)
 */
DEFINE('_SOBI2_NEW_ENTRY_AWAITING_APP', " Sua entrada foi adicionada e esta aguardando aprovação.");

/*
 * added 26.10.2006 (RC 2.5)
 */
DEFINE('_SOBI2_CHECKBOX_YES', 'Sim');
DEFINE('_SOBI2_CHECKBOX_NO', 'N&atilde;o');
DEFINE('_SOBI2_FORM_SELECT_BG', 'Selecione imagem de fundo');
DEFINE('_SOBI2_FORM_SELECT_BG_EXPL', 'Selecione a imagem de fundo a ser utilizada na listagem de categorias e na área de Detalhes.');
DEFINE('_SOBI2_FORM_BG_PREVIEW', 'Pre-visualização da imagem de fundo');
DEFINE('_SOBI2_NOT_LOGGED_FOR_DETAILS', 'Você deve ser um usuário registrado para acessar este recurso');
DEFINE('_SOBI2_JS_NOT_LOGGED_FOR_DETAILS', 'Você deve ser um usuário registrado e estar logado ao site para acessar este recurso');

/*
 * added 11.10.2006 (RC 2)
 */
DEFINE('_SOBI2_FORM_JS_CAT_NO_PARENT_CAT', 'Você não pode adicionar uma Entrada a uma Categoria que possui sub-categorias relacionadas. Por favor, selecione uma das sub-categorias relacionadas.');
DEFINE('_SOBI2_SUBCATS_IN_THIS_CAT', 'Número de Sub-Categorias desta Categoria: ');
DEFINE('_SOBI2_SUBCATS_IN_CAT', 'Sub-Categorias em ');
DEFINE('_SOBI2_ITEMS_IN_THIS_CAT', 'Número de Entradas nesta Categoria: ');
DEFINE('_SOBI2_ITEMS_IN_CAT', 'Entradas em ');
DEFINE('_SOBI2_ITEMS_CATS_SEPARATOR', '/');

/*
 * added 02.10.2006 (RC 1)
 */
DEFINE('_SOBI2_GOOGLEMAPS_GET_DIR', 'Obter Direções');
DEFINE('_SOBI2_GOOGLEMAPS_FROM', 'Ponto Inicial');
DEFINE('_SOBI2_GOOGLEMAPS_TO', 'Ponto Final');
DEFINE('_SOBI2_GOOGLEMAPS_ADDR', 'Endereço: ');
DEFINE('_SOBI2_GOOGLEMAPS_DIR', 'Direções: ');

/*
 * added 26.09.2006 (Beta 2.2)
 */
 DEFINE('_SOBI2_CANCEL', 'Cancelar');

/*
 * added 23.09.2006 (Beta 2.1)
 */
DEFINE('_SOBI2_SAVE_IMG_TO_BIG', 'Falha no Envio do Arquivo de Imagens! O Arquivo é muito grande. Este arquivo possui: ');
DEFINE('_SOBI2_EF_MAX_FILE_SIZE', ' E o tamanho máximo permitido é de  ');
DEFINE('_SOBI2_EF_KB_FILE_SIZE', ' kB');

/*
 * General Labels
 */
DEFINE('_SOBI2_SEND_L', 'Enviar');
DEFINE('_SOBI2_ADD_U', 'Adicionar');
DEFINE('_SOBI2_CATEGORY_L', 'categoria');
DEFINE('_SOBI2_CATEGORY_H', 'Categoria');
DEFINE('_SOBI2_CATEGORIES_L', 'categorias');
DEFINE('_SOBI2_CATEGORIES_H', 'Categorias');
DEFINE('_SOBI2_IS_FREE_L', 'é grátis');
DEFINE('_SOBI2_IS_NOT_FREE_L', 'é tarifado. ');
DEFINE('_SOBI2_COST_L', 'Isso custa');
DEFINE('_SOBI2_NOT_AUTH', 'Você não está autorizado a ver esta página.');
DEFINE('_SOBI2_SELECT', 'selecionar');
DEFINE('_SOBI2_SEARCH_H', 'Pesquisar');
DEFINE('_SOBI2_ADD_NEW_ENTRY', 'Adicionar Entrada');
DEFINE('_SOBI2_NUMBER_H', 'Número');
DEFINE('_SOBI2_CONFIRM_DELETE', 'Você realmente deseja excluir este item? \n' .
								'Atenção: Não é possivel recuperar itens excluídos!');
DEFINE('_SOBI2_SEND_MAIL', 'Enviar Email');
DEFINE('_SOBI2_VISIT_WEBSITE', 'Visitar Website');
DEFINE('_SOBI2_HITS', 'Acessos: ');
DEFINE('_SOBI2_DATE_ADDED', 'Adicionado em:');

DEFINE('_SOBI2_NOT_LOGGED', '<h4>Você não acessou o site com a sua senha. Desta forma não lhe será permitida a inclusão de novas entradas.</h4>');
DEFINE('_SOBI2_NOT_LOGGED_CANNOT_EDIT', '<h4>Você não efetuou o acesso</h4>' .
		'<h4>Você poderá incluir uma nova entrada, mas não lhe será permitido altera-la no futuro..</h4>');
DEFINE('_SOBI2_PLEASE_REGISTER_OR_LOGIN', '<h4>Por favor, efetue o acesso ou registre-se no site</h4>');


/*
 * Formular Labels
 */
DEFINE('_SOBI2_FORM_TITLE_ADD_NEW_ENTRY', 'Incluir Nova Entrada');
DEFINE('_SOBI2_FORM_TITLE_EDIT_ENTRY', 'Editar Entrada');


DEFINE('_SOBI2_FORM_YOUR_IMG_LABEL', 'Sua ');
DEFINE('_SOBI2_FORM_IMG_CHANGE_LABEL', 'Alterar ');
DEFINE('_SOBI2_FORM_IMG_REMOVE_LABEL', 'Remover ');
DEFINE('_SOBI2_FORM_IMG_EXPL', 'Esta imagem será exibida na visualização de detalhes.');
DEFINE('_SOBI2_FORM_YOUR_ICO_LABEL', 'Sua ');
DEFINE('_SOBI2_FORM_ICO_CHANGE_LABEL', 'Alterar ');
DEFINE('_SOBI2_FORM_ICO_REMOVE_LABEL', 'Remover ');

DEFINE('_SOBI2_FORM_ICO_EXPL', 'Está imagem será exibida na visualização por categorias.');
DEFINE('_SOBI2_FORM_SAFETY_CODE', 'Código de Segurança&nbsp;');
DEFINE('_SOBI2_FORM_ENTER_SAFETY_CODE', 'Por favor informe o código de segurança');
DEFINE('_SOBI2_FORM_NOT_FREE_OPTION', 'Esta opção é tarifada.');
DEFINE('_SOBI2_FORM_SELECT_CATEGORY', 'Por favor, selecione uma categoria');
DEFINE('_SOBI2_FORM_CAN_ADD_TO_NR_CATS', "Você poderá incluir esta entrada em {$config->maxCatsForEntry} categoria");
DEFINE('_SOBI2_FORM_CAT_1', 'Primeira Categoria');
DEFINE('_SOBI2_FORM_ADD_CAT_BT', _SOBI2_ADD_U.' '._SOBI2_CATEGORY_H);
DEFINE('_SOBI2_FORM_REMOVE_CAT_BT','Remover '._SOBI2_CATEGORY_H);
DEFINE('_SOBI2_FORM_SELECTED_CAT_DESC', _SOBI2_CATEGORY_H.' Descrição:');
DEFINE('_SOBI2_FORM_PRICE_IS', 'O preço é ');
DEFINE('_SOBI2_FORM_FIELD_REQ_MARK', ' * ');
DEFINE('_SOBI2_FORM_FIELD_REQ_INFO', 'Todos os campos com '._SOBI2_FORM_FIELD_REQ_MARK.' são obrigatórios.');
DEFINE('_SOBI2_FORM_META_KEYS_LABEL', 'Chaves Meta');
DEFINE('_SOBI2_FORM_META_KEYS_EXPL', 'As palavras chaves informadas serão incluídas na lista de Meta Tags.');
DEFINE('_SOBI2_FORM_META_DESC_LABEL', 'Descrição Meta');
DEFINE('_SOBI2_FORM_META_DESC_EXPL', 'O texto informado será adicionado à descrição do Meta Tag.');
DEFINE('_SOBI2_FORM_JS_SELECT_CAT', 'Por favor, selecione ao menos uma categoria.');
DEFINE('_SOBI2_FORM_JS_ACC_ENTRY_RULES', 'Você deve aceitar os termos de uso.');
DEFINE('_SOBI2_FORM_JS_ALL_REQUIRED_FIELDS', 'Por favor, preencha todos os campos obrigatórios.');
DEFINE('_SOBI2_FORM_JS_CAT_ALLREADY_ADDED', 'Esta categoria já foi adicionada.');
DEFINE('_SOBI2_SEC_CODE_WRONG', 'Erro no código de segurança');
DEFINE('_SOBI2_LISTING_CHECKED_OUT', 'Esta entrada está sendo alterada agora por um outro usuário');


/*
 * On Saving
 */
DEFINE('_SOBI2_SAVE_DUPLICATE_ENTRY', 'Já existe uma entrada com este nome.');
DEFINE('_SOBI2_SAVE_NOT_ALLOWED_IMG_EXT', 'O arquivo enviado possui uma extensão não aceita pelo sistema, desta forma o mesmo não foi adicionado.');
DEFINE('_SOBI2_SAVE_UPLOAD_IMG_FILED', 'Falha no envio da imagem!');
DEFINE('_SOBI2_SAVE_UPLOAD_IMG_OK', 'Arquivo de imagem do logotipo da empresa enviado!');
DEFINE('_SOBI2_SAVE_UPLOAD_ICO_OK', 'Arquivo de imagem de ícone da empresa enviado!');
DEFINE('_SOBI2_SAVE_UPLOAD_IMG_FAILED', 'Erro no envio do arquivo de imagem do logotipo da empresa!');
DEFINE('_SOBI2_SAVE_UPLOAD_ICO_FAILED', 'Erro no envio do arquivo de imagem do ícone da empresa!');
DEFINE('_SOBI2_SAVE_NOT_ALL_REQ_FIELDS_FILLED', 'Não foram preenchidos todos os campos obrigatórios!');
DEFINE('_SOBI2_SAVE_ICON_FEES', 'Ícone da Empresa');
DEFINE('_SOBI2_SAVE_IMAGE_FEES', 'Logotipo da Empresa');
DEFINE('_SOBI2_CHANGES_SAVED', 'Todas as alterações salvas');


/*
 * Entry Labels
 */
DEFINE('_SOBI2_LISTING_EDIT_PROMOTED_ITEMS', 'Itens Promovidos');
DEFINE('_SOBI2_LISTING_EDIT_ENTRY_BT', 'Editar');
DEFINE('_SOBI2_LISTING_DELET_ENTRY_BT', 'Deletar');
DEFINE('_SOBI2_LISTING_GO_UP_ICO', '');
DEFINE('_SOBI2_LISTING_GO_UP_TXT', '');


/*
 * Payment Class
 */
DEFINE('_SOBI2_PAY_CHOSEN_OPTIONS', 'Você selecionou as seguintes opções tarifadas');
DEFINE('_SOBI2_PAY_TOTAL_AMOUNT', 'Valor Total: ');
DEFINE('_SOBI2_PAY_WITH_BANK', 'Eu pagarei através de transferência bancária');
DEFINE('_SOBI2_PAY_WITH_PAYPAL', 'Eu pagarei através do sistema PayPal');
DEFINE('_SOBI2_PAY_BANK_DATA_SEND_EMAIL', 'Detalhes da nossa conta bancária foram enviados para o seu email');
DEFINE('_SOBI2_PAY_BANK_DATA_JS_HEADER', 'Por favor, faça o depósito/transferência para a seguinte Conta Corrente: ');
DEFINE('_SOBI2_PAY_BANK_DATA_JS_TITLE', 'Referência: ');


/*
 * search form
 */
DEFINE('_SOBI2_SEARCH_FOR', _SOBI2_SEARCH_H.' para: ');
DEFINE('_SOBI2_SEARCH_ANY', 'Qualquer Palavra');
DEFINE('_SOBI2_SEARCH_ALL', 'Todas as Palavras');
DEFINE('_SOBI2_SEARCH_EXACT', 'Frase Exata');
DEFINE('_SOBI2_SEARCH_RESULTS', 'Pesquisar Resultados');
DEFINE('_SOBI2_SEARCH_RESULTS_FOUND', 'Encontrado');
DEFINE('_SOBI2_SEARCH_RESULTS_FOUND_RESULTS', 'resultados encontrados na busca por');

/*
 *  Deleting
 */
DEFINE('_SOBI2_DEL_UNPUBLISHED', 'Esta entrada foi despublicada agora!');
DEFINE('_SOBI2_DEL_NOT_DELETED', 'Esta entrada não pode ser excluída. Por favor contate o administrador do site.');
DEFINE('_SOBI2_DEL_DELETED', 'Entrada Excluída!');
?>
