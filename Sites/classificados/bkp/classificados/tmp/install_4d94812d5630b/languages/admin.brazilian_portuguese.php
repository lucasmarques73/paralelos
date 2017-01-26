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
define('_SOBI2_ADM_EXPERIMENTAL_OPT', ' (Experimental)');

/*
 * added (RC 2.9)
 */
define('_SOBI2_INSTALLER_TPL_DELETE_ERROR', 'Não pude remover alguns arquivos ou diretórios');
define('_SOBI2_INSTALLER_TPL_DELETE_OK', 'O Template %name% foi removido');
define('_SOBI2_TPL_INSTALLED_OK', 'O Template %name% foi instalado');
define('_SOBI2_CONFIG_TPL_INSTALLED', 'Templates Instalados');
define('_SOBI2_CONFIG_TPL_PACK_UPLOAD', 'Envie um novo Pacote de Template');
define('_SOBI2_MENU_TPL_MANAGER', 'Gerenciador de Templates');
define('_SOBI2_MENU_TEMPLATES', 'Gerenciador de Templates');
define('_SOBI2_CAT_TPL', 'Template');
define('_SOBI2_CAT_CHOOSE_TPL', 'Sobrescreva Template');
define('_SOBI2_AVAILABLE_TPL', 'Templates Disponíveis:');
define('_SOBI2_CAT_CHOOSE_TPL_EXPL', 'Você poderá sobrescrever o template padrão bem como diversas configurações nesta categoria.');
define('_SOBI2_CHOOSE_TPL_TO_EDIT', 'Selecione o template que deseja editar:');

/*
 * added (RC 2.8.7)
 */
define('_SOBI2_APPLY', 'Aplicar');

/*
 * added (RC 2.8.5)
 */
define('_SOBI2_DEFAULT_TOOLTIP_TITLE', 'Tip');

define('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_RENEW', 'Informar Administradores sobre Renovação');
define('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_RENEW_EXPL', 'Informe os administradores se o cliente ou o autor renovou o seu registro.');
define('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_RENEW', 'Enviar Email de Confirmação de Renovação');
define('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_RENEW_EXPL', 'Enviar um email de confirmação sobre a renovação de registro para o cliente / autor.');

define('_SOBI2_EMAIL_ON_SUBMIT_OPTGR', 'Na Adição de Entrada');
define('_SOBI2_EMAIL_ON_UPDATE_OPTGR', 'Na Edição de Entrada');
define('_SOBI2_EMAIL_ON_APPROVE_OPTGR', 'Na Aprovação de Entrada');
define('_SOBI2_EMAIL_ON_PAYMENT_OPTGR', 'Email de Pagamento');
define('_SOBI2_EMAIL_ON_RENEW', 'Na Renovação de Entrada (usuário)');
define('_SOBI2_EMAIL_ON_RENEW_ADMIN', 'Na Renovação de Entrada (administrador)');
define('_SOBI2_EMAIL_ON_RENEW_OPTGR', 'Na Renovação de Entrada');

define('_SOBI2_TOOLBAR_GEN_DEB_REP', '<small>Checar Sistema</small>');
define('_SOBI2_MENU_GEN_DEB_REP', 'Executar procedimento de checagem do sistema');
define('_SOBI2_MENU_GEN_SYSCHECK_EXPL', 'Checar se todos os pré-requisitos para utilizar o SOBI2 estão ativos'. _SOBI2_ADM_EXPERIMENTAL_OPT);

define('_SOBI2_TOOLBAR_RECOUNT_NEEDED', 'Há uma série de alterações desde que o número de sub categorias e suas respectivas entradas foram recontadas. Talvez seja necessário reconta-las novamente.');
define('_SOBI2_TOOLBAR_RECOUNTED_SOFAR', ' Categorias recontadas até o momento');
define('_SOBI2_TOOLBAR_RECOUNT_WAIT', ' Por favor aguarde. Servidor em processamento.');
define('_SOBI2_TOOLBAR_RECOUNT_RESTART', 'Por favor aguarde. Reiniciando ... ');
define('_SOBI2_TOOLBAR_RECOUNT_DONE', 'Recontagem Finalizada. Recontagem: ');
define('_SOBI2_TOOLBAR_RECOUNT_DONE_C', ' Categorias');
define('_SOBI2_TOOLBAR_RECOUNT_CATS', 'Recontar');
define('_SOBI2_RECOUNT_LAST_DATE', 'Última Recontagem');
define('_SOBI2_TOOLBAR_RECOUNT_CATS_F', 'Recontagem de Categorias');
define('_SOBI2_RECOUNT_NOW', 'Recontar Agora');
define('_SOBI2_RECOUNT_CATS_HEADER', 'Recontar o número de Sub-Categorias e suas respectivas Entradas');

define('_SOBI2_CONFIG_L2CACHE_ON', 'Segundo nível de cache habilitado');
define('_SOBI2_CONFIG_L2CACHE_DV_ON', 'Visualização de detalhes com o cache ativo (não recomendado)');
define('_SOBI2_CONFIG_L2CACHE_EXPL', '<b>Segundo Nível de Cache</b> - Permite o cache de toda a saída HTML do site (a lista de categorias e entradas é processada separadamente). ');
define('_SOBI2_CONFIG_L2CACHE_LIFETIME', 'Tempo de vida do Segundo Nível de Cache');
define('_SOBI2_CONFIG_L2CACHE_LIFETIME_SECONDS', 'Segundos');
define('_SOBI2_CONFIG_L2CACHE_STRLEN', 'Tamanho máximo de string permitido');
define('_SOBI2_CONFIG_L2CACHE_STRLEN_EXPL', 'Se você está encontrando problemas no retorno do conteúdo do seu site quando o sistema de cache esá ativo (por exemplo: partes do site não aparece), seria interessante reduzir este valor.');

define('_SOBI2_CONFIG_L3CACHE_EXPL', '<b>Terceiro Nível de Cache</b> - Voltado ao cache de atributos de objetos no site. Este cache será atualizado para cada objeto caso ocorra alguma atualização de categoria e/ou registro.');
define('_SOBI2_CONFIG_L3CACHE_STRLEN', 'Tamanho máximo de string permitido');
define('_SOBI2_CONFIG_L3CACHE_ON', 'O Terceiro Nível de Cache está habilitado');
define('_SOBI2_CONFIG_L3CACHE_CLEAR', 'Limpar o Terceiro Nível de Cache');

/*
 * added (RC 2.8.4)
 */
define('_SOBI2_QFIELD_ALLOW', 'Permitir Utilização \'Edição Rápida\'');
define('_SOBI2_QFIELD_ALLOW_ADM', 'Apenas para Administradores');
define('_SOBI2_QFIELD_ALLOW_EXPL', 'Se está função estiver habilitado, o usuário registrado estará apto a alterar seus dados diretamente nas entradas. Desta forma, através de um clique duplo do mouse será possível editar diversos campos customizados na própria tela de visualização detalhada. Atenção: Se um usuário utilizar esta opção, nenhum email será enviado informando o ocorrido!');

define('_SOBI2_CONFIG_ENTRY_RENEWAL', 'Renovação');
define('_SOBI2_CONFIG_ENTRY_ALLOW_RENEWAL', 'Permitir Renovação');
define('_SOBI2_CONFIG_ENTRY_ALLOW_RENEWAL_EXPL', 'Se está função estiver habilitada, o usuário registrado poderá renovar suas entradas quando os mesmos expirarem.');
define('_SOBI2_CONFIG_ENTRY_ALLOW_REN_DAYS', 'Dias antes do vencimento');
define('_SOBI2_CONFIG_ENTRY_ALLOW_REN_DAYS_EXPL', 'Informe quantos dias de antecedencia ao vencimento do registro, o usuário poderá utilizar a função de renovação.');
define('_SOBI2_CONFIG_ENTRY_RENEW_DISCOUNT', 'Desconto');
define('_SOBI2_CONFIG_ENTRY_RENEW_DISCOUNT_EXPL', 'Informe o percentual de desconto a ser aplicado (0-100).');
define('_SOBI2_CONFIG_ENTRY_RENEW_DAYS', 'Renovar por mais');
define('_SOBI2_CONFIG_ENTRY_RENEW_DAYS_EXPL', 'Selecione o período de extensão em dias que uma renovação adicionará ao registro. Se o número informado for 0, o período padrão será utilizado.');
define('_SOBI2_CONFIG_DAYS', 'Dias');
define('_SOBI2_CONFIG_ENTRY_RENEWAL_HEADER', 'Opções para Renovação');
define('_SOBI2_CONFIG_ENTRY_RENEW_DELETE_FEES', 'Excluir Taxas Antigas');
define('_SOBI2_CONFIG_ENTRY_RENEW_DELETE_FEES_EXPL', 'Se está função estiver habilitada, todas as taxas selecionadas do valor total do último período serão excluídas. Caso esta função esteja desabilitada, então todos os totais serão resumidos.');

define('_SOBI2_LISTING_MANAGER_STATUS_FILTER', 'Status: ');
define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_ALL', 'Todos');
define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_UP', 'Despublicado');
define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_P', 'Publicado');
define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_UA', 'Desaprovado');
define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_A', 'Aprovado');
define('_SOBI2_LISTING_MANAGER_STATUS_FILTER_E', 'Vencido');

define('_SOBI2_REG_MANAGER_SAVE_ERR', 'O registro não pode ser salvo. Por favor, edite-o manualmente.');
define('_SOBI2_REG_MANAGER_NEW_PAIR', 'Nova Chave: ');
define('_SOBI2_REG_MANAGER_ADD_PAIR', 'Adicione Nova Chave');
define('_SOBI2_REG_MANAGER_NEW_SECTION', 'Nova Sessão:');
define('_SOBI2_REG_MANAGER_ADD_SECTION', 'Adicione Nova Sessão');
define('_SOBI2_REG_MANAGER_WARNING', 'Opções Adicionais. Em Fase Experimental - Sua utilização representa risco no uso!');
define('_SOBI2_MENU_REG_MANAGER', 'Editor de Entrada');
define('_SOBI2_MENU_EDIT_FORM_TEMPLATE', 'Entrada em Formulário Template');
define('_SOBI2_FORM_TEMPLATE_ENABLE', 'Use o Template ao invés da Função Padrão de entrada');
define('_SOBI2_FORM_TEMPLATE_ENABLE_EXPL', 'Habilitando está função, você deverá adicionar cada campo customizado manualmente em seu formulário template.');

define('_SOBI2_CONFIG_DEBUG_TMPL', 'Templates de Depuração');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_CAT_FIELS_DEPEND', 'Visualizar Campos Dependentes da Categoria');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_CAT_FIELS_DEPEND_EXPL', 'Visualizar o conteúdo dos campos dependentes no box de listagem para pesquisa da categoria préviamente selecionada.');

/*
 * added (RC 2.8.3)
 */
define('_SOBI2_MENU_PLUGINS_DATATABLES', 'Tabela no Banco de Dados para Plugins');
define('_SOBI2_PLUGINS_DATATABLES_NAME', 'Nome da Tabela');
define('_SOBI2_PLUGINS_DATATABLES_PNAME', 'Nome do Plugin');
define('_SOBI2_PLUGINS_DATATABLES_INFO', 'Info');
define('_SOBI2_PLUGINS_DATATABLES_ROWS', 'Linhas');
define('_SOBI2_PLUGINS_DATATABLES_CREATED', 'Criado');
define('_SOBI2_PLUGINS_DATATABLES_UPD', 'Atualizado');
define('_JS_SOBI2_PLUGINS_DATATABLE_DELETE', 'Você realmente deseja excluir esta tabela? \nAtenção: Todos os dados serão excluídos sem a produção de qualquer cópia de segurança! ');
define('_SOBI2_PLUGINS_DATATABLE_DELETED', 'A Tabela foi removida');

define('_SOBI2_MENU_TEMPLATES_AND_CSS', 'Templates &amp; CSS');

define('_SOBI2_CONFIG_GENERAL_SHOW_SUBCATS_UNDER_CAT', 'Visualizar Lista de Subcategorias');
define('_SOBI2_CONFIG_GENERAL_SHOW_SUBCATS_UNDER_CAT_EXPL', 'Visualizar lista de subcategorias abaixo da Categoria principal (Estilo Yahoo!).');
define('_SOBI2_CONFIG_GENERAL_SHOW_NUMBER_SUBCATS', 'Número de Sub-Categorias');
define('_SOBI2_CONFIG_GENERAL_SORT_SUBCATS_BY', 'Ordenar Sub-Categorias por');

/* !!!!! alterado - por favor remova o antigo */
define('_SOBI2_FIELD_USE_WYSIWYG_EXPL', 'Selecione se deseja habilitar o editor de textos TinyMCE na adição e/ou edição de entradas. Está opção será utilizada apenas nos campos do tipo TEXTAREA. <strong>ATENÇÃO: ESTE TIPO DE CAMPO NÃO DEVE SER DEFINIDO COM O ATRIBUTO DE PREENCHIMENTO OBRIGATÓRIO!!</strong>');

/*
 * added (RC 2.8.2)
 */
define('_SOBI2_ABOUT_ADDONS', 'Add-Ons para SOBI2');
define('_SOBI2_ABOUT_PBY', '"Powered by" Link');
define('_SOBI2_ABOUT_NEWS', 'Sigsiu.NET News');
define('_SOBI2_ABOUT_PBY_SHOW', 'Visualizar o Link "Powered by"');
define('_SOBI2_ABOUT_PBY_SUPPORT', '<br /><strong>Se você decidir remover o link "powered by" do nosso componente, é justo que você nos faça uma doação.</strong><br /><br />Desenvolver e manter o SOBI2 requer muito trabalho e é justo que tenhamos uma recompensa adequada por todo o serviço feito.<br />Clique no botão do Paypal abaixo para fazer a sua doação agora mesmo.<br /><br /><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=sigsiu%2enet%40sigsiu%2enet&item_name=SOBI%202&item_number=SOBI2-CAB&no_shipping=2&lc=US&no_note=1&tax=0&currency_code=EUR&bn=PP%2dDonationsBF&charset=UTF%2d8" title="Doação para o SOBI2" target="_blank"><img src="components/com_sobi2/images/donate_button.png" alt="Donate for SOBI2 via Paypal" title="Doação para o SOBI2 via Paypal" border="0"/></a><br /><br />Muito Obrigado!.<br /><br />');
define('_SOBI2_ABOUT_PBY_JS_SUPPORT', "Não esqueça de fazer a sua doação!");
define('_SOBI2_CODEPRESS_TOGGLE', 'Toggle Editor');

/*
 * added (RC 2.8.1)
 */
define('_SOBI2_FPERMS_HEADER', 'Sistema de Arquivos');
define('_SOBI2_FPERMS_ON', 'Altere as permissões de arquivos e diretórios quando forem necessárias<br/>Se você encontrar problemas na execução deste procedimento, desabilite esta função e proceda com as alterações manualmente!');
define('_SOBI2_FPERMS_FMOD', 'Permissões Para Arquivos');
define('_SOBI2_FPERMS_DMOD', 'Permissões Para Diretórios');
define('_SOBI2_FPERMS_WRITABLE', 'Escrita');
define('_SOBI2_FPERMS_NWRITABLE', 'Apenas Leitura');
define('_SOBI2_CURRENT_FPERMS_HEADER', 'Atuais Permissões de Diretórios');
define('_SOBI2_FIELDLIST_CSV_LIST', 'Adicione uma lista CSV de valores');
define('_SOBI2_FIELDLIST_CSV_LIST_EXPL', 'Você pode adicionar uma lista CSV (com valores separados por virgula) com opções de valores para o formulário no seguinte formato: <ul><li>Apenas as opções do campo: <b>opção 1; opção 2; opção 3;</b></li><li>Opções do campo e valores: <b>valor_1:Opção 1; valor_2:Opção 2; valor_3:Opção 3;</b></li></ul>');
define('_SOBI2_FIELDLIST_CSV_SAVE', 'Salvar Lista CSV');
define('_SOBI2_FIELDLIST_CSV_SAVE_EXPL', 'Salvar a lista CSV ao invés da lista de opções mostrada abaixo.');

/*
 * added 14.08.2007 (RC 2.8)
 */
//para que esta função funcione você precisará também do arquivo de idioma para o calender
defined("_SOBI2_CALENDAR_LANG") || define("_SOBI2_CALENDAR_LANG", "pt_br");
defined("_SOBI2_CALENDAR_FORMAT") || define("_SOBI2_CALENDAR_FORMAT", "dd-mm-y");

/* !!!!! alterado - por favor remova o antigo */
define('_SOBI2_FIELD_COLS_EXPL', 'Número de colunas para o campo de entrada. Válido apenas para inputs do tipo TEXTAREA ou grupo de checkbox. Este número também pode ser utilizado para expressar a largura em pixels quando o campo estiver relacionado á um link do tipo mídia.');
/* !!!!! alterado - por favor remova o antigo */
define('_SOBI2_FIELD_PREFERRED_SIZE_EXPL', 'Tampo do campo de entrada ou lista de seleção. Válido apenas nestas condições (campo de entrada / lista de seleção).');
/* !!!!! alterado - por favor remova o antigo */
define('_SOBI2_TOOLBAR_ADD_NEW_CAT', 'Adicionar Nova Categoria');
/* !!!!! alterado - por favor remova o antigo */
define('_SOBI2_TOOLBAR_ADD_NEW_ITEM', 'Adicionar Nova Entrada');


define('_SOBI2_CHECKBOX_YES', 'Sim');
define('_SOBI2_CHECKBOX_NO', 'Não');

define('_SOBI2_CONFIG_GENERAL_FORCE_MENUID', 'Forçar ID Único para Menu');
define('_SOBI2_CONFIG_GENERAL_FORCE_MENUID_EXPL', 'Se habilitado, o SOBI2 utilizará uma URL com um número de ID único para os menus. Caso contrário, o número de ID atual do menu será utilizado.');

define('_SOBI2_FIELD_ADM_ONLY', 'Campos Administrativos');
define('_SOBI2_FIELD_ADM_ONLY_EXPL', 'Apenas os administradores do componente estarão habilitados a entrarem com informações neste campo na área administrativa do site.');

define('_SOBI2_ALLOW_FE_ENTRIES', 'Permitir Registros de Entrada');
define('_SOBI2_TOOLBAR_ADD_CATS_SERIE', 'Adicionar Múltiplas Categorias');
define('_SOBI2_ADD_CATS_SERIE_NAMES', 'Insira um sinal de ponto e virgula para separar a lista de categorias');
define('_SOBI2_ADD_CATS_SERIE_NAMES_EXPL', 'Insira um sinal de ponto e virgula(;) na lista de categorias separando nome da categoria, texto de introdução e ícones para inserir multiplas categorias de uma única vez. Os campos da categoria nome, introdução e ícone devem ser separados pelo sinal de dois pontos(:).<br/><strong>As categorias serão inseridas na como sub-categorias da categoria préviamente selecionada.</strong><br/><br/>Exemplos:<br />Inserindo apenas nomes de categorias: categoria nome 1; categoria nome 2; categoria nome 3;<br />Inserindo Nome de Categorias e suas respectivas introduções e/ou ícones: categoria nome 1 : texto de introdução 1; categoria nome 2 : texto de introdução 2; categoria nome 3 : texto de introdução 3 : icone.png;<br />Para adicionar apenas Nomes de Categorias e seus respectivos Ícones use a seguinte sintaxe: categoria nome qualquer :: icone.png; ');

define('_SOBI2_LANG_REMOVED', 'Idioma removido');
define('_SOBI2_LANG_REM_ERROR', 'Idioma removido, mas ocorreu um erro');
define('_SOBI2_LANG_NOT_REM_ERROR', 'Idioma não pode ser removido');
define('_SOBI2_LANG_FOR_VER', 'Para a Versão');
define('_SOBI2_CONFIG_LANGMAN_LIST_CREATED', 'Data de Criação');
define('_SOBI2_CONFIG_LANGMAN_INSTALLED_LANGS', 'Idiomas Instalados');
define('_SOBI2_CONFIG_LANG_PACK_UPLOAD', 'Envie um Novo Pacote de Idioma');
define('_SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR_NO_FILE', 'O arquivo Setup XML não existe neste pacote');

define('_SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION_ON_SEARCHPAGE', 'Visualizar descrição do componente nos resultados de busca');

define('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_RETURL', 'URL de Retorno');
define('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_RETURL_EXPL', 'Informe o URL no qual o usuário será redirecionado após o pagamento ter sido realizado.');
define('_SOBI2_CONFIG_PAYMENTS_CURRENCY_TEXT', 'Código da Moeda');

define('_SOBI2_CONFIG_GENERAL_EXSEARCH_CATCONT_HEIGHT', 'Altura do Container de Categorias');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_CATCONT_HEIGHT_EXPL', 'Se você usa o botão para visualizar ou esconder a opção de pesquisa extendida. você deve definir a altura deste container. Note no entanto que a altura deve ser grande o suficiente para encapsular toda a estrutura das sub-categorias. Leve em conta que um campo do tipo combobox mede em torno de 25pixels de altura (dependendo da configuração customizada do seu CMS).');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE', 'Ordenação');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE_FIELD_FIRST', 'Campos Customizados Primeiro');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE_CAT_FIRST', 'Categorias Primeiro');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE_EXPL', 'Selecione a indexação de categorias e campos comboboxes customizados no container de pesquisa extendida.');

define('_SOBI2_CONFIG_ENTRY_WS_HEADER', 'Modo de Pesquisa');
define('_SOBI2_CONFIG_ENTRY_WS_FIELDS_ASSIGMENT', 'Campos Assinalados');

define('_SOBI2_CONFIG_SYSTEM_MAILS', 'Emails do Sistema');
define('_SOBI2_CONFIG_SYSTEM_MAILS_ADM_MAIL_USERS', 'Enviar emails do sistema para');
define('_SOBI2_CONFIG_SYSTEM_MAILS_ADM_MAIL_USERS_EXPL', 'Selecione qual o grupo de usuários deve receber os emails de notificação do sistema.');
define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL', 'Use como endereço eletrônico de cliente');
define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL_EXPL', 'Qual é o email de cliente padrão a ser utilizado? Selecione entre SOBI2 e o gerenciador de usuários do CMS. Mas atenção: se você selecionar a segunda opção, a inclusão de Entradas no sistema somente será permitida para usuários registros no CMS.');
define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL_SOBI', 'Endereço informado na Entrada do SOBI2');
define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL_CMS', 'Endereço definido no registro do usuário');
define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_FID', 'Campo no qual o endereço de email é salvo');
define('_SOBI2_CONFIG_SYSTEM_MAILS_USER_FID_EXPL', 'Selecione o campo no qual o endereço eletrônico (email) é salvo. Esta opção é válida apenas quando o email padrão utilizado é o da Entrada do SOBI2.');

define('_SOBI2_ALL_LISTING_NON_FREE_OPT', 'Valor Total');
define('_SOBI2_CONFIG_SEARCH_OPT', 'Opções de Busca');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_USE_SLIDER', 'Use o Botão para Pesquisa Extendida');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_USE_SLIDER_EXPL', 'Quando habilitado, um botão será utilizado para disponibilizar ou esconder o container contendo as opções de busca extendida.');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_ON_START', 'Inicializar com Fade Out');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_ON_START_EXPL', 'Se habilitado, o container de opções de busca extendida estará escondido no ínicio (apenas válido quando o botão para pesquisa extendida estiver habilitado).');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_AFTER_SEARCH', 'Fade out após Pesquisa');
define('_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_AFTER_SEARCH_EXPL', 'Se habilitado, o container de opções de busca extendida será escondido após a execução da busca (apenas válido quando o botão para pesquisa extendida estiver habilitado).');

define('_SOBI2_LISTING_MANAGER_SEARCH_ONLY_START', 'Visualizar apenas itens que iniciam com');
define('_SOBI2_CONFIG_GENERAL_SHOW_ALPHA', 'Visualizar Índice-Alpha');

define('_SOBI2_FORM_JS_CAT_NO_PARENT_CAT', 'Você não pode inserir uma Entrada em uma categoria que possui sub-categorias. Por favor, defina uma sub-categoria para a sua Entrada.');
define('_SOBI2_FIELDLIST_SELECT', '&nbsp;---- selecione ----&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
define('_SOBI2_FIELDLIST_LIST_OF_VALUES', 'Lista de valores pré-definidos para campos do tipo select list e grupos de checkbox');
define('_SOBI2_FIELDLIST_NEW_VALUE_PAIR', 'Adicione um novo par de variáveis');
define('_SOBI2_FIELDLIST_OPT_NAME', 'Nome da Opção');
define('_SOBI2_FIELDLIST_OPT_VALUE', 'Valor da Opção');
define('_SOBI2_FIELDLIST_DELETE_VALUE_PAIR', 'Remover par de variáveis');
define('_SOBI2_FIELDLIST_SORT_VALUES', 'Indexar Opções');
define('_SOBI2_FIELDLIST_SORT_VALUES_EXPL', 'Ordernar alfabéticamente as opções no formulário de Entradas ou não.');
define('_SOBI2_FIELDLIST_ADD_SELECT_LABEL', 'Adicionar Seleção');
define('_SOBI2_FIELDLIST_ADD_SELECT_LABEL_EXPL', 'Selecione se alguma opção irá ser adicionada ao texto "Seleção" que será mostrado.');

define('_SOBI2_SAVE_IMG_TO_BIG', 'Erro no envio do arquivo de imagem! O arquivo selecionado é muito grande. Tamanho: ');
define('_SOBI2_EF_MAX_FILE_SIZE', ' O arquivo não pode ser maior que ');
define('_SOBI2_EF_KB_FILE_SIZE', ' kB');

/*
 * added 24.07.2007 (RC 2.7.4)
 */
DEFINE('_SOBI2_MENU_EULA', 'Licença de Uso');
DEFINE('_SOBI2_CONFIG_GENERAL_USE_EXSEARCH', 'Use a função de Pesquisa Extendida');
DEFINE('_SOBI2_CONFIG_GENERAL_USE_EXSEARCH_EXPL', 'Use a função de pesquisa extendida ao invés da função convencional de busca. A função extendida permite que os visitantes do seu site também executem buscas em categorias específicas.');
DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_NOTICE', 'Google Maps (será requisitado às coordenadas geográficas em cada entrada)');

/*
 * added 8.06.2007 (RC 2.7.2)
 */
DEFINE('_SOBI2_CONFIG_GENERAL_USE_ATREE', 'Usar SigsiuTree');
DEFINE('_SOBI2_CONFIG_GENERAL_USE_ATREE_EXPL', 'Usar SigsiuTree ao invés da função dTree. Esta opção é util quando existe muitas categorias e o seu navegador está tendo dificuldades em processar o código javascript.');
DEFINE('_SOBI2_CONFIG_GENERAL_ATREE_IMAGES', 'Imagens SigsiuTree');

/*
 * added 18.05.2007 (RC 2.7.1)
 */
DEFINE('_SOBI2_CONFIG_CUSTOM_FIELD_CUSTOM_CODE', 'Código de Texto');
DEFINE('_SOBI2_CONFIG_CUSTOM_FIELD_CUSTOM_CODE_EXPL', '
Em um campo convencional de código de textos, tags html podem ser visualizadas no "formulário de inserção/edição de Entradas". Desta maneira você poderá customizar alguns textos descritivos.<br/><br/><strong>Os textos serão visualizados APENAS nos Formulários de Entrada. E nenhuma destas informações extras serão salvas na tabela!</strong><br/><br/>
Insira o seu código de texto na caixa de texto. Desta forma o conteúdo destes textos serão dinamicamente alterado no formulário. Os códigos de textos que você pode usar são: <br/>
<ul>
<li>{componentName} - será substituído pelo nome do SOBI2 (configurável em Configurações Gerais - Nome do Componente)</li>
<li>{sitename} - será substituído pelo nome do site</li>
<li>{sobi2Lang} - será substituído pelo idioma selecionado</li>
<li>{currency} - será substituído pela moeda (configurável em Opções para Pagamento - Simbolo da Moeda)</li>
<li>{entryExpirationTime} - será substituído pelo número de dias no qual será publicado</li>
<li>{imgLabel} - será substituído pelo título da imagem (configurável em Configurações de Entrada - Titulo de Imagem) </li>
<li>{priceForImg} - será substituído pelo preço da imagem (configurável em Configurações de Entrada - Preço da Imagem)</li>
<li>{icoLabel} - será substituído pelo título do ícone (configurável em Configurações de Entrada - Título do Ícone) </li>
<li>{priceForIco} - será substituído pelo preço do ícone (configurável em Configurações de Entrada - Preço do Ícone)</li>
<li>{bankData} - será substituído pelas informações bancárias para pagamentos</li>
<li>{payPalMail} - será substituído pelo email PayPal (configurável em Opções para Pagamento - Endereço de Email no Paypal) </li>
<li>{payPalUrl} - será substituído pela URL do PayPal (configurável em Opções para Pagamento - URL do Paypal) </li>
<li>{paymentReference} - será substituído por referência de pagamento (configurável em Opções para Pagamento - Referência de Pagamento)</li>
<li>{basicPrice} - será substituído pela taxa para Entrada básica (configurável em Configurações de Entrada - Taxa básica de registro de Entrada)</li>
<li>{basicPriceLabel} - será substituído pelo título da Entrada básica (configurável em Configurações de Entrada - Título p/ Entrada Básica)</li>
<li>{googleApiKey} - será substituído pela API(chave) do Google (configurável em Configurações de Visualização - Google Maps - Chave API)</li>
</ul>
');

/*
 * added 17.04.2007 (RC 2.7.0)
 */
DEFINE('_SOBI2_CONFIG_CACHE_DESCRIPTION_TEXT', 'Opções de Aceleração de Cache');
DEFINE('_SOBI2_CONFIG_CACHE_ON', 'Cache Habilitado');
DEFINE('_SOBI2_CONFIG_CACHE_LIFETIME', 'Tempo de Vida do Cache');
DEFINE('_SOBI2_CONFIG_CACHE_LIFETIME_EXPL', 'O tempo de vida do cache pode ser definido por um alto valor, pois o mesmo será atualizado todas as vezes em que alguma informação for alterada no SOBI2. Por exemplo, quando um usuário alterar sua Entrada ou um administrador definir uma nova configuração.');
DEFINE('_SOBI2_CONFIG_CACHE_LIFETIME_SEC', 'Segundos');
DEFINE('_SOBI2_CONFIG_CACHE_LIFETIME_MIN', 'Minutos');
DEFINE('_SOBI2_CONFIG_CACHE_LIFETIME_HOURS', 'Horas');
DEFINE('_SOBI2_CONFIG_CACHE_LIFETIME_DAYS', 'Dias');
DEFINE('_SOBI2_CONFIG_CACHE_EMPTY', 'Atualizar');
DEFINE('_SOBI2_CONFIG_CACHE_REMOVED', 'Cache Atualizado');
DEFINE('_SOBI2_CONFIG_CACHE_DIR', 'Diretório de Cache');
DEFINE('_SOBI2_CONFIG_CACHE_DIR_EXPL', 'Onde as informações de cache devem ser salvas. Para um caminho de diretório absoluto, o endereço para o diretório deve ser inicializado com /. Caso contrário o sistema utilizará o endereço relativo ao diretório raiz do CMS.');
DEFINE('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_URL', 'URL do Paypal');
DEFINE('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_URL_EXPL', 'Você pode alterar aqui a URL de destino para o Paypal. Por exemplo: Se você deseja que a navegador seja redirecionado diretamente para o modo Paypal sandbox. A URL padrão é https://www.paypal.com/cgi-bin/webscr');

DEFINE('_SOBI2_MENU_EDIT_VC_TEMPLATE', 'Templates de V-Card');
DEFINE('_SOBI2_VC_TEMPLATE_ENABLE', 'Use o Template ao invés da Função Padrão');
DEFINE('_SOBI2_VC_TEMPLATE_ENABLE_EXPL', 'Se você quiser usar um template, deverá adicionar manualmente todos os novos campos customizados. As configurações do New-Line para o gerenciamento de campos não tem qualquer efeito quando o modo template for habilitado para V-Card.');
DEFINE('_SOBI2_CONFIG_GENERAL_USE_RSS', 'Use RSS Feeds');


/*
 * added 16.02.2007 (RC 2.6.1)
 */
DEFINE('_SOBI2_MENU_ERRLOG', 'Logfile Erros');
DEFINE('_SOBI2_ERRLOG_FILE_SIZE', 'Tamanho do Arquivo Logfile Erros: ');
DEFINE('_SOBI2_ERRLOG_FILE_TOO_BIG', '<big>O tamanho do arquivo logfile é muito grande (acima de 500 kB). Isso pode provocar congelamentos no processamento do seu navegador e/ou servidor.</big>');
DEFINE('_SOBI2_ERRLOG_FILE_SHOW', 'Visualizar o arquivo assim mesmo');
DEFINE('_SOBI2_ERRLOG_FILE_DOWNLOAD_FULL', 'Download Logfile');
DEFINE('_SOBI2_ERRLOG_FILE_DELETE', 'Delete');
DEFINE('_SOBI2_ERRLOG_FILE_DOWNLOAD', 'Download');
DEFINE('_SOBI2_ERRLOG_NO_FILE', '<big>Não foi possível abrir o logfile. O arquivo não pode ser criado ou simplesmente não ocorreu nenhum erro para que o arquivo fosse gerado</big>');
DEFINE('_SOBI2_ERRLOG_FILE_DELETED', 'O arquivo Logfile foi apagado');
DEFINE('_SOBI2_ERRLOG_FILE_NOT_DELETED', 'Não foi possível apagar o arquivo Logfile ');

DEFINE('_SOBI2_ERR_NOTICE', 'Nota PHP - Nada de panico. Esta situação pode te(nos) ajudar a encontrar a solução do que aconteceu de errado');
DEFINE('_SOBI2_ERR_WARNING', 'Atenção PHP - Você deve nos notificar sobre este ocorrido no Forum do SOBI2');
DEFINE('_SOBI2_ERR_ERROR', 'Erro PHP - Erro Crítico. Por favor, informe-nos sobre o ocorrido no Forum do SOBI2');
DEFINE('_SOBI2_ERR_INTERN', 'Erro Interno SOBI2 -  Está informação é valiosa para nos auxiliar a encontrar a solução do que aconteceu de errado');
DEFINE('_SOBI2_CONFIG_DEBUG_DESCRIPTION_TEXT', 'Opções de Erros de Log e Debug');
DEFINE('_SOBI2_CONFIG_DEBUG_LEVEL', 'Nível de Debug');
DEFINE('_SOBI2_CONFIG_DEBUG_SHOW_ERR', 'Visualizar Erros');
DEFINE('_SOBI2_CONFIG_DEBUG_LEVEL_0', 'Nenhum');
DEFINE('_SOBI2_CONFIG_DEBUG_LEVEL_7', 'Apenas Erros Críticos');
DEFINE('_SOBI2_CONFIG_DEBUG_LEVEL_8', 'Erros e Atenções (recomendado)');
DEFINE('_SOBI2_CONFIG_DEBUG_LEVEL_9', 'Todo e qualquer Erro, Atenção e Nota');

/*
 * added 19.11.06 (RC 2.5.7)
 */
DEFINE('_SOBI2_FIELD_VIDEO', 'link p/ arquivo de midia');
DEFINE('_SOBI2_BASE_ENTRY_FEES', 'Taxa para Registro Básico');
DEFINE('_SOBI2_BASE_ENTRY_FEES_EXPL', 'Deixa em branco ou preencha com zero caso deseja definir as registros básicos como gratuitos.');
DEFINE('_SOBI2_BASE_ENTRY_FEES_LABEL', 'Título para Registro Basico');
DEFINE('_SOBI2_BASE_ENTRY_FEES_LABEL_EXPL', 'Este titulo será visualizado na tela de resumo de pagamento.');
DEFINE('_SOBI2_FIELD_IS_URL_EXPL', 'Selecione se este campo será utilizado para URL, endereço de email, link para arquivo de imagem, audio e/ou video.');
DEFINE('_SOBI2_FIELD_ROWS_EXPL', 'Número de linhas/altura para o campo de entrada. Válido apenas se o campo for do tipo área de texto ou player para midia.');

/*
 * added 28.10.06 (RC 2.5)
 */
DEFINE('_SOBI2_FIELD_IMG', 'imagem');
DEFINE('_SOBI2_LISTING_FILTER', 'Filtro: ');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_BACKGROUND', 'Permitir seleção de imagem de fundo');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_BACKGROUND_EXPL', 'Permitir que o usuário defina a imagem de fundo a ser utilizada na visualização na listagem e de detalhe.');
DEFINE('_SOBI2_CONFIG_VIEW_ALLOW_ANO', 'Usuários não registrados acessam a área de Detalhes');
DEFINE('_SOBI2_CONFIG_VIEW_ALLOW_ANO_EXPL', 'Permitir que visitantes do site acessem a área de Detalhes da Entrada.');

DEFINE('_SOBI2_PLUGIN_ENABLED', 'Plugin habilitado');
DEFINE('_SOBI2_PLUGIN_DISABLED', 'Plugin desabilitado');
DEFINE('_SOBI2_PLUGINS_INSTALLER_PI_DELETE_FILES_ERROR', 'Alguns arquivos/diretórios não puderam ser removidos');
DEFINE('_SOBI2_PLUGINS_INSTALLER_PI_DELETE_ERROR', 'Não foi possivel remover dados do plugin do banco de dados');
DEFINE('_SOBI2_PLUGINS_INSTALLER_PI_DROP_ERROR', 'Não foi possível remover tabela do plugin');
DEFINE('_SOBI2_PLUGINS_INSTALLER_PI_NOT_FOUND', 'Não foi possível encontrar dados do plugin no banco de dados');
DEFINE('_SOBI2_PLUGINS_INSTALLER_REMOVED', ' Plugin removido com sucesso');
DEFINE('_SOBI2_PLUGINS_INSTALLER_PID_MISSING', 'Por favor, selecione um item da lista');
DEFINE('_SOBI2_PLUGINS_INSTALLER_COPY_ERROR', 'Houve um erro enquanto copiava arquivos');
DEFINE('_SOBI2_PLUGINS_INSTALLER_INSTALLED', ' Plugin instalado com sucesso');
DEFINE('_SOBI2_PLUGINS_INSTALLER_ERROR', 'Houve um erro enquanto instalava o novo plugin');
DEFINE('_SOBI2_PLUGINS_INSTALLER_ALLREADY_EXISTST', 'Já existe um plugin com este nome');
DEFINE('_SOBI2_PLUGINS_ENABLED', 'Habilitado');
DEFINE('_SOBI2_PLUGINS_POSITION', 'Posição');
DEFINE('_SOBI2_PLUGINS_INIT_FILE', 'Arquivo Inicial');
DEFINE('_SOBI2_PLUGINS_AUTHOR', 'Autor');
DEFINE('_SOBI2_PLUGINS_AUTHOR_URL', 'Link para Autor');
DEFINE('_SOBI2_PLUGINS_VER', 'Versão');
DEFINE('_SOBI2_CONFIG_PLUGINS_INSTALLED_PLUGINS', 'Plugins atualmente instalados');
DEFINE('_SOBI2_CONFIG_PLUGINS_INSTALL_NEW', 'Instalar novo plugin');
DEFINE('_SOBI2_CONFIG_PLUGINS_UPLOAD', 'Enviar arquivo de pacote de plugin');
DEFINE('_SOBI2_MENU_PLUGINS_HEADER', 'Plugins');
DEFINE('_SOBI2_MENU_PLUGINS_MANAGER', 'Gerenciador de Plugin');
DEFINE('_SOBI2_PLUGIN_HEADER', 'Plugin');

/*
 * added 10.10.2006 (RC 2)
 */

DEFINE('_SOBI2_MENU_EDIT_TEMPLATE', 'Editar visualização de Modelos');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_COUNTER', 'Ver No. de Entradas e Sub-categorias');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_COUNTER_EXPL', 'Visualizar o número de Entradas e Sub-Categorias abaixo do nome da Categoria na listagem de Categorias.');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_ADDING_TO_PARENT', 'Permitir a adição de Entradas em Categorias mestres');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_ADDING_TO_PARENT_EXPL', 'Permitir a adição de Entradas em Categorias que possuem Sub-Categorias');

DEFINE('_SOBI2_MENU_VER_CHECKER', 'Checador de Versão');
DEFINE('_SOBI2_CONFIG_CHECK_VER', 'Checar sua versão do SOBI2');
DEFINE('_SOBI2_CONFIG_ACT_VER', 'Sua versão é : ');
DEFINE('_SOBI2_CONFIG_VER_CHECK', 'Checar por nova versão');
DEFINE('_SOBI2_CONFIG_VER_CHECK_ERROR', 'Não foi possível conectar-se ao servidor remoto. Tente novamente mais tarde!');

DEFINE('_SOBI2_MENU_EMAILS', 'Modelos para Email');
DEFINE('_SOBI2_CONFIG_MAIL_LINK_MARKERS', 'Descrição dos Códigos de Substituição');
DEFINE('_SOBI2_CONFIG_MAIL_ABOUT_MARKERS', 'Os códigos a seguir poderão ser utilizados no texto dos emails para composição dinamica de conteúdo: ' .
		'<ul>' .
		'<li>{sobi} - será substituído pelo nome SOBI2 (ajustável na opção de Configuração Geral - Nome do Componente junto ao seu site)</li>' .
		'<li>{sitename} - será substituído pelo nome do site</li>' .
		'<li>{user} - será substituído pelo nome do usuário</li>' .
		'<li>{id} - será substituído pelo código de identificação do SOBI2</li>' .
		'<li>{title} - será substituído pelo titulo da Entrada</li>' .
		'<li>{link_details} - será substituído pelo link (URL) para a visualização detalhada da Entrada</li>' .
		'<li>{link_edit} - será substituído pelo link (URL) para a função de edição</li>' .
		'<li>{expiration_date} - será substituído pela data de expiração de publicação da Entrada</li>' .
		'<li>{expiration_time} - será substituído pelo número de dias de publicação</li>' .
		'<li>{selected_options}  - será substituído pelas opções tarifadas selecionadas na Entrada (apenas para cobranças via email)</li>' .
		'<li>{total}  - será substituído pelo total a ser pago pelas opções tarifadas selecionadas (apenas para cobranças via email)</li>' .
		'<li>{paypal_url}  - será substituído pelo link Paypal (apenas para cobranças via email)</li>' .
		'<li>{bank_data}  - será substituído pelos dados bancários para pagamentos via depósito, transferências ou DOCs (apenas para cobranças via email)</li>' .
		'</ul>' .
		'Além destes códigos, também é possivel utilizar qualquer campo de preenchimento no texto de emails. Por exemplo: {field_email} será substituído pelo conteúdo do campo field_email. Neste caso o endereço de email.');

DEFINE('_SOBI2_CONFIG_EMAILS', 'Textos de Email');
DEFINE('_SOBI2_CONFIG_FOOTER', 'Assinaturas de Email');
DEFINE('_SOBI2_CONFIG_FOOTER_EXPL', 'Este texto será adicionado em todos os emails.');
DEFINE('_SOBI2_PLEASE_WAIT', 'Por favor aguarde ... ');
DEFINE('_SOBI2_READY', 'Pronto: ');
DEFINE('_SOBI2_SELECT_OPTION_TO_EDIT', 'Selecione o Modelo de Email para Edição: ');
DEFINE('_SOBI2_EMAIL_ON_SUBMIT', 'Na adição de Entradas (usuário)');
DEFINE('_SOBI2_EMAIL_ON_UPDATE', 'Na edição de Entradas (usuário)');
DEFINE('_SOBI2_EMAIL_ON_APPROVE', 'Na aprovação de Entradas (usuários)');
DEFINE('_SOBI2_EMAIL_ON_PAYMENT', 'Email de Cobrança (usuário)');
DEFINE('_SOBI2_EMAIL_ON_SUBMIT_ADMIN', 'Na adição de Entradas (admin)');
DEFINE('_SOBI2_EMAIL_ON_UPDATE_ADMIN', 'Na edição de Entradas (admin)');
DEFINE('_SOBI2_EMAIL_ON_PAYMENT_ADMIN', 'Email de Cobrança (admin)');
DEFINE('_SOBI2_EMAIL_TEXT', 'Texto do Email: ');
DEFINE('_SOBI2_EMAIL_TITLE', 'Assunto para Email: ');
DEFINE('_SOBI2_CONFIG_MAIL_LANG_EXPL', 'Selecione o idioma para editar os campos.');
DEFINE('_SOBI2_CONFIG_MAIL_LANG', 'Selecione Idioma ');

DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_PAYMENT_EXPL', 'Enviar email para o admin caso ocorra novas entradas tarifadas foram adicionadas.');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_PAYMENT', 'Envie Email de Cobrança para o admin');


/*
 * added 02.10.2006 (RC 1)
 */
 DEFINE('_SOBI2_CONFIG_FIELDS_EDIT_TO_CHANGE', 'Você deve editar o campo para alterar esta opção');
 DEFINE('_SOBI2_CONFIG_FIELDS_CANNOT_BE_CHANGE', 'Esta opção não pode ser alterada');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_ON', 'Visualizar Mapa do Google');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_ON_EXPL', 'Ver/Esconder mapa (requer chave do Google Api)');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_API', 'Chave API');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_API_EXPL', 'Chave API do Google para este site');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_W', 'Largura do Mapa');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_W_EXPL', 'A largura da imagem do mapa a ser visualizado (em pixels).');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_H', 'Altura do Mapa');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_H_EXPL', 'A altura da imagem do mapa a ser visualizado (em pixels).');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_LAT', 'Latitude');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_LAT_EXPL', 'Selecione o campo onde a latitude do mapa será salva.');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_LON', 'Longitude');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_LON_EXPL', 'Selecione o campo no qual a longitude no mapa será salva.');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE', 'Bolha Info');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_EXPL', 'Abre a bolha de informações para o formulário \'Get Directions\'.');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_DISABLE', 'Desabilitar Direções na Bolha Info');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_EN_WAIT', 'Habilitar, mas apenas abrir a Bolha Info se a opção para marcação estiver clicada');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_EN_OPEN', 'Habilitar e abrir a Bolha Info quando o mapa for carregado');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_ZOOM', 'Nivel de Zoom');
 DEFINE('_SOBI2_CONFIG_ENTRY_GMAPS_ZOOM_EXPL', 'Nivel inicial do zoom para o mapa.');

/*
 * added 26.09.2006 (Beta 2.2)
 */
 DEFINE('_SOBI2_CONFIG_SECIMG_USING_FAILED', 'Seu servidor não possui qualquer ferramenta ou script instalado para criar com segurança imagens. Desta forma, esta função foi desabilitada.');

/*
 * added 23.09.2006 (Beta 2.1)
 */
 DEFINE('_SOBI2_CONFIG_ENTRY_MAX_FILE_SIZE', 'Tamanho Max. para o Envio de Imagens');
 DEFINE('_SOBI2_CONFIG_ENTRY_FILE_SIZE_BYTES', 'kB');

/*
 * added 18.09.2006
 */
DEFINE('_SOBI2_MENU_LANG_MANAGER', 'Gerenciador de Idiomas');
DEFINE('_SOBI2_CONFIG_LANGMAN_INSTALL_NEW', 'Instalar Novo Pacote de Idioma');
DEFINE('_SOBI2_CONFIG_LANGMAN_INSTALL_BT', 'Instalar');
DEFINE('_SOBI2_CONFIG_LANGMAN_NO_FILE', 'Erro: pacote de idiomas perdido');
DEFINE('_SOBI2_CONFIG_LANGMAN_FILE_EXT_ERROR', 'Erro: Extensão de arquivo não permitida. Instalação abortada.');
DEFINE('_SOBI2_CONFIG_LANGMAN_FILE_UPLOAD_ERROR', 'Erro: Não foi possivel copiar o pacote de idiomas para o diretório de instalação. Instalação abortada.');
DEFINE('_SOBI2_CONFIG_LANGMAN_FILE_EXTRACT_ERROR', 'Erro: Não foi possivel extrair o pacote. Instalação abortada.');
DEFINE('_SOBI2_CONFIG_LANGMAN_XML_PARSE_ERROR', 'Erro: Não foi possivel processar o arquivo XML. Instalação abortada.');
DEFINE('_SOBI2_CONFIG_LANGMAN_FP_FILE_COPY_ERROR', 'Erro: Não foi possivel copiar o arquivo de frontend. Instalação abortada.');
DEFINE('_SOBI2_CONFIG_LANGMAN_BE_FILE_COPY_ERROR', 'Arquivo para a área administrativa não foi encontrado. ');
DEFINE('_SOBI2_CONFIG_LANGMAN_LABELS_MISSING_ERROR', 'Atenção: Titulos dos campos customizados foram perdidos. ');
DEFINE('_SOBI2_CONFIG_LANGMAN_ALL_LABELS_INSTALLED', 'Novo idioma instalado corretamente.');
DEFINE('_SOBI2_CONFIG_LANGMAN_NOT_ALL_LABELS_INSTALLED', 'Atenção: Alguns títulos perdidos. ');

/*
 * added 14.09.2006
 */
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EDIT', 'Informar Administradores sobre Altera&ccedil;&otilde;es');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EDIT_EXPL', 'Informar Administradores se algum cliente/autor alterou seu registro.');

DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_NEW', 'Enviar Email de Confirma&ccedil;&atilde;o');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_NEW_EXPL', 'Enviar Email de Confirma&ccedil;&atilde;o de nova entrada para o Cliente/Autor do registro.');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_EDIT', 'Enviar Email de Confirma&ccedil;&atilde;o sobre
Altera&ccedil;&otilde;es');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_EDIT_EXPL', 'Enviar Email de Confirma&ccedil;&atilde;o sobre altera&ccedil;&otilde;es no registro do Cliente/Autor. Nenhum email ser&aacute; enviado se a altera&ccedil;&atilde;o foi realizada na &aacute;rea Administrativa.');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_APPROVED', 'Enviar Email de Confirma&ccedil;&atilde;o sobre Aprova&ccedil;&atilde;o');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_APPROVED_EXPL', 'Informar ao Cliente/Autor se sua respectiva entrada/registro foi aprovada.');

/*
 * general labels
 */

DEFINE('_SOBI2_SEND_L', 'enviar');
DEFINE('_SOBI2_YES_U', 'Sim');
DEFINE('_SOBI2_NO_U', 'N&atilde;o');
DEFINE('_SOBI2_ADD_U', 'Adicionar');
DEFINE('_SOBI2_ALL_U', 'Todos');
DEFINE('_SOBI2_CATEGORY_L', 'categoria');
DEFINE('_SOBI2_CATEGORY_H', 'Categoria');
DEFINE('_SOBI2_CATEGORIES_L', 'categorias');
DEFINE('_SOBI2_CATEGORIES_H', 'Categorias');
DEFINE('_SOBI2_IS_FREE_L', 'é de graça');
DEFINE('_SOBI2_IS_NOT_FREE_L', 'é tarifado');
DEFINE('_SOBI2_COST_L', 'Isso custa');
DEFINE('_SOBI2_NOT_AUTH', 'Você não é autorizado a ver esta página');
DEFINE('_SOBI2_SELECT', 'selecione');
DEFINE('_SOBI2_SEARCH_H', 'Pesquisar');
DEFINE('_SOBI2_ADD_NEW_ENTRY', 'Incluir nova entrada');
DEFINE('_SOBI2_NUMBER_H', 'Número');
DEFINE('_SOBI2_NEVER_U', 'Nunca');
DEFINE('_SOBI2_CONFIRM_DELETE', 'Você realmente deseja excluir este item? \n' .
'Atenção: Não será possível recuperar esta informação!');
DEFINE('_SOBI2_PUBLISHED', 'Publicado');
DEFINE('_SOBI2_CONFIRMED', 'Confirmado');
DEFINE('_SOBI2_APPROVED', 'Aprovado');
DEFINE('_SOBI2_REORDER', 'Reordenar');
DEFINE('_SOBI2_ORDER', 'Ordem');
DEFINE('_SOBI2_GUEST', 'Convidado');
DEFINE('_SOBI2_LANGUAGE_L', 'idioma');
DEFINE('_SOBI2_CANCEL', 'Cancelar');
DEFINE('_SOBI2_SAVE', 'Salvar');
DEFINE('_SOBI2_IMAGE_U', 'Imagem');
DEFINE('_SOBI2_IMAGES_U', 'Imagens');
DEFINE('_SOBI2_META_U', 'Meta Info');
DEFINE('_SOBI2_PUBLISHING_U', 'Publicando');
DEFINE('_SOBI2_MOVE_UP', 'Para Cima');
DEFINE('_SOBI2_MOVE_DOWN', 'Para Baixo');
DEFINE('_SOBI2_MENU', 'SOBI2 Menu');
DEFINE('_SOBI2_SAVING_ERROR', 'Ocorreu um erro ao salvar a informação. Por favor tente novamente');
DEFINE('_SOBI2_GENERAL_FILE_ERROR', 'Não pude abrir ');
DEFINE('_SOBI2_DAYS_L', 'dias');
/*
 * menu
 */
DEFINE('_SOBI2_MENU_LISTING_AND_CATS', 'Entradas e Categorias');
DEFINE('_SOBI2_LISTING_ALL_ENTRIES','Listar todas as Entradas');
DEFINE('_SOBI2_MENU_AWAITING_APPR', 'Aguardando Aprovação');
DEFINE('_SOBI2_MENU_CONFIG', 'Configuração');
DEFINE('_SOBI2_MENU_GENERAL_CONFIG', 'Configuração Geral');
DEFINE('_SOBI2_MENU_GENERAL_NEW_ENTRIES_CONFIG', 'Configuração de Entradas');
DEFINE('_SOBI2_MENU_GENERAL_NEW_VIEW_CONFIG', 'Configuração de Visualização');
DEFINE('_SOBI2_MENU_FIELDS_DATA', 'Campos & Dados');
DEFINE('_SOBI2_MENU_EDIT_CSS', 'Editar Arquivo CSS');
DEFINE('_SOBI2_MENU_ABOUT', 'Sobre');
DEFINE('_SOBI2_MENU_UNINSTALL_SOBI', 'Desinstalar SOBI2');
DEFINE('_SOBI2_MENU_ABOUT_SOBI', 'Sobre SOBI2');
/*
 * tabs
 */
DEFINE('_SOBI2_TABHR_CATS', 'Categorias');
DEFINE('_SOBI2_TABHR_ITEMS', 'Entradas');

/*
 * Category Manager
 */
DEFINE('_SOBI2_CATS_MANAGER', 'Gerenciador de Categorias');
DEFINE('_SOBI2_CAT_NAME', 'Nome da Categoria');
DEFINE('_SOBI2_CAT_INTROTEXT', 'Texto de Introdução');
DEFINE('_SOBI2_CAT_INTROTEXT_EXPL', 'Curto texto sobre a categoria. Este texto também será utilizado nas Descrições Meta Tag. Por favor, não utilize códigos HTML.');
DEFINE('_SOBI2_CAT_DESCRIPTION', 'Descrição da Categoria');
DEFINE('_SOBI2_NO_CATS_IN_CAT', '<h3>&nbsp; &nbsp; Não há (sub)categorias nesta categoria</h3>');

/*
 * Entry Manager
 */
DEFINE('_SOBI2_LISTING_MANAGER', 'Gerenciamento de Entradas');
DEFINE('_SOBI2_NO_ITEMS_IN_CAT', '<h3>&nbsp; &nbsp; Não há entradas nesta categoria</h3>');
DEFINE('_SOBI2_LISTING_TITLE', 'Título da Entrada');
DEFINE('_SOBI2_LISTING_ADDED', 'Criado em');
DEFINE('_SOBI2_NEW_ORDERING_SAVED', 'Nova indexação foi salva');
DEFINE('_SOBI2_UNAPPROVED_MANAGER', 'Entradas não aprovadas');
DEFINE('_SOBI2_NO_ITEMS_AW_APP', '<h3>Não há entradas em estado de espera de aprovação</h3>');
DEFINE('_SOBI2_LISTING_OWNER', 'Criador');
DEFINE('_SOBI2_LISTING_OWNER_TYPE', 'Grupo de Usuários');
DEFINE('_SOBI2_LISTING_UPDATING_USER', 'Última Alteração em');
/*
 * toolbar
 */
DEFINE('_SOBI2_TOOLBAR_EDIT', 'Editar');
DEFINE('_SOBI2_TOOLBAR_ADD_NEW', 'Adiconar Nova: ');
DEFINE('_SOBI2_TOOLBAR_REMOVE', 'Remover');
DEFINE('_SOBI2_TOOLBAR_DEL', 'Deletar');
DEFINE('_SOBI2_TOOLBAR_REMOVE_EXPL', 'Removendo item da categoria');
DEFINE('_SOBI2_TOOLBAR_DEL_EXPL', 'Excluíndo item permanentemente');
DEFINE('_SOBI2_TOOLBAR_MOVE', 'Mover');
DEFINE('_SOBI2_TOOLBAR_COPY', 'Copiar');
DEFINE('_SOBI2_TOOLBAR_PUBLISH', 'Publicar');
DEFINE('_SOBI2_TOOLBAR_UNPUBLISH', 'Despublicar');
DEFINE('_SOBI2_TOOLBAR_APPROVE', 'Aprovar');
DEFINE('_SOBI2_TOOLBAR_UNAPPROVE', 'Desaprovar');
DEFINE('_SOBI2_TOOLBAR_CONFIRMED', 'Confirmado');
DEFINE('_SOBI2_TOOLBAR_UNCONFIRMED', 'Não Confirmado');

/*
 * edit / delete etc
 */
DEFINE('_SOBI2_ITEM_REMOVED_FROM_CAT', 'Itens removidos desta categoria');
DEFINE('_SOBI2_CANNOT_REMOVE_CAT', 'Esta Categoria não pode ser removidam, apenas deletada.');
DEFINE('_SOBI2_CAT_DELETED', 'Categorias Deletadas');
DEFINE('_SOBI2_ITEM_DELETED', 'Entradas Deletadas');
DEFINE('_SOBI2_ITEM_MOVE', 'Mover itens');
DEFINE('_SOBI2_ITEM_COPY', 'Copiar itens');
DEFINE('_SOBI2_ITEMS_MOVED', 'Todos os itens movidos');
DEFINE('_SOBI2_NOT_ALL_ITEMS_MOVED', 'Nem todos os itens puderam ser movidos. Alguns destes itens já encontram-se na categoria destino');
DEFINE('_SOBI2_ITEMS_COPIED', 'Todos os itens copiados');
DEFINE('_SOBI2_NOT_ALL_ITEMS_COPIED', 'Nem todos os itens puderam ser copiados. Alguns destes itens já encontram-se na categoria destino');
DEFINE('_SOBI2_ITEMS_TO_MOVE', 'Itens sendo movidos:');
DEFINE('_SOBI2_ITEMS_TO_COPY', 'Itens sendo copiados:');
DEFINE('_SOBI2_SELECT_TARGER_CAT', 'Selecione Categoria Destino');
DEFINE('_SOBI2_CATS_MOVED', 'Todas as categorias movidas');
DEFINE('_SOBI2_NOT_ALL_CATS_MOVED', 'Nem todas as categorias foram movidas');
DEFINE('_SOBI2_CAT_COPY', 'Copiar Categorias');
DEFINE('_SOBI2_CATS_TO_COPY', 'Categorias sendo copiados:');
DEFINE('_SOBI2_CAT_COPY_ITEMS_TOO', 'Copiar entradas também');
DEFINE('_SOBI2_CAT_MOVE', 'Mover Categorias');
DEFINE('_SOBI2_CATS_TO_MOVE', 'Categorias sendo movidas:');
DEFINE('_SOBI2_CATS_COPIED', 'Todas as categorias copiadas');
DEFINE('_SOBI2_NOT_ALL_CATS_COPIED', 'Nem todas as categorias puderam ser copiadas.');

/*
 * editing entry
 */
DEFINE('_SOBI2_FORM_TITLE_ADD_NEW_ENTRY', 'Adicionar nova Entrada');
DEFINE('_SOBI2_FORM_TITLE_EDIT_ENTRY', 'Editar Entrada');
DEFINE('_SOBI2_FORM_ENTRY_DETAILS', 'Detalhes da Entrada');
DEFINE('_SOBI2_FORM_IMG_LABEL', 'Logotipo da Empresa');
DEFINE('_SOBI2_FORM_YOUR_IMG_LABEL', 'O Logo da sua empresa: ');
DEFINE('_SOBI2_FORM_IMG_CHANGE_LABEL', 'Alterar logo da empresa: ');
DEFINE('_SOBI2_FORM_IMG_REMOVE_LABEL', 'Remover logo da empresa');
DEFINE('_SOBI2_FORM_IMG_EXPL', 'esta imagem será mostrada na visualização de detalhes');
DEFINE('_SOBI2_FORM_ICO_LABEL', 'Icone para a visualização do cartão');
DEFINE('_SOBI2_FORM_YOUR_ICO_LABEL', 'Seu Icone: ');
DEFINE('_SOBI2_FORM_ICO_CHANGE_LABEL', 'Alterar Icone: ');
DEFINE('_SOBI2_FORM_ICO_REMOVE_LABEL', 'Remover Icone');
DEFINE('_SOBI2_FORM_ICO_EXPL', 'esta imagem será visualizada na listagem de categorias');
DEFINE('_SOBI2_FORM_SAFETY_CODE', 'código de segurança');
DEFINE('_SOBI2_FORM_ENTER_SAFETY_CODE', 'por favor, entre com o código de segurança');
DEFINE('_SOBI2_FORM_NOT_FREE_OPTION', 'esta opção é tarifada.');
DEFINE('_SOBI2_FORM_SELECT_CATEGORY', 'Por favor, selecione as categorias desta Entrada');
DEFINE('_SOBI2_FORM_CAN_ADD_TO_NR_CATS', "Você pode relacionar esta Entrada a até {$config->maxCatsForEntry} categoria");
DEFINE('_SOBI2_FORM_CAT_1', 'Primeira Categoria');
DEFINE('_SOBI2_FORM_ADD_CAT_BT', _SOBI2_ADD_U.' '._SOBI2_CATEGORY_L);
DEFINE('_SOBI2_FORM_REMOVE_CAT_BT','Remover '._SOBI2_CATEGORY_L);
DEFINE('_SOBI2_FORM_SELECTED_CAT_DESC', _SOBI2_CATEGORY_H.' Descrição:');
DEFINE('_SOBI2_FORM_PRICE_IS', 'O preço é');
DEFINE('_SOBI2_FORM_FIELD_REQ_MARK', ' * ');
DEFINE('_SOBI2_FORM_FIELD_REQ_INFO', 'Todos os campos marcados com '._SOBI2_FORM_FIELD_REQ_MARK.' são obrigatórios.');
DEFINE('_SOBI2_FORM_ENTRY_TITLE', 'Nome da Empresa'._SOBI2_FORM_FIELD_REQ_MARK);
DEFINE('_SOBI2_FORM_META_KEYS_LABEL', 'Entre as palavras chaves de busca para o Meta Keywords: ');
DEFINE('_SOBI2_FORM_META_KEYS_EXPL', 'Estas palavras serão utilizadas como chaves para sites buscadores da internet');
DEFINE('_SOBI2_FORM_META_DESC_LABEL', 'Entre com a descrição para o Meta Description: ');
DEFINE('_SOBI2_FORM_META_DESC_EXPL', 'Este texto será exibido nos sites de busca na internet como descrição do conteúdo da página.');
DEFINE('_SOBI2_FORM_JS_SELECT_CAT', 'Por favor, selecione primeiro uma categoria');
DEFINE('_SOBI2_FORM_JS_ACC_ENTRY_RULES', 'Você deve primeiramente concordar com os nossos termos de uso');
DEFINE('_SOBI2_FORM_JS_ALL_REQUIRED_FIELDS', 'Por favor, preencha todos os campos de preenchimento obrigatório');
DEFINE('_SOBI2_FORM_JS_CAT_ALLREADY_ADDED', 'Esta categoria já foi adicionada');
DEFINE('_SOBI2_SEC_CODE_WRONG', 'Código de Segurança Errado');
DEFINE('_SOBI2_LISTING_EXPIRES', 'Vence em');
DEFINE('_SOBI2_UPDATED_AT', 'Ultima Modificação em');
DEFINE('_SOBI2_HITS', 'Acessos');
DEFINE('_SOBI2_HITS_RESET', 'Zere o contador de acessos');
DEFINE('_SOBI2_SELECTED_CATS', 'Categorias Selecionadas');
DEFINE('_SOBI2_EDITING_LISTING', 'Editando Entrada SOBI2');
DEFINE('_SOBI2_CHANGES_SAVED', 'Todas as alterações foram salvas');
DEFINE('_SOBI2_LISTING_CHECKED_OUT', 'Esta lista esta sendo atualmente editada por um outro usuário');

/*
 * editing category
 */
DEFINE('_SOBI2_CAT_DETAILS', 'Detalhes da Categoria');
DEFINE('_SOBI2_IMAGE_POS', 'Posição da Imagem');
DEFINE('_SOBI2_ICON', 'Icone');
DEFINE('_SOBI2_CAT_ICON_EXPL', 'Icone é um arquivo de imagem menor visualizado na listagem de categorias');
DEFINE('_SOBI2_PREVIEW', 'Pre-Visualização de Imagens');
DEFINE('_SOBI2_CAT_WITHOUT_NAME', 'A Categoria deve possuir um nome');
DEFINE('_SOBI2_CAT_WITHOUT_PARENT', 'Por favor, selecione a categoria mãe');
DEFINE('_SOBI2_CATEGORY_CHECKED_OUT', 'Esta categoria esta atualmente sendo editada por um outro administrador');
DEFINE('_SOBI2_ADD_NEW_CAT', 'Adicionar nova categoria');
DEFINE('_SOBI2_SELECTED_PARENT_ID', 'ID Categoria Mãe');
DEFINE('_SOBI2_NOT_ALL_CHANGES_SAVED', 'Não foi possivel salvar todas as alterações');
DEFINE('_SOBI2_PARENT_CAT', 'Categoria Mãe');
DEFINE('_SOBI2_SELECT_PARENT_CAT', 'Selecione Categoria Mãe');
DEFINE('_SOBI2_EDITING_CAT', 'Categoria sendo editada');

/*
 * fields manager
 */
 DEFINE('_SOBI2_FIELDS_MANAGER', 'Gerenciamento de Campos Customizados');
 DEFINE('_SOBI2_FIELD_NAME', 'Nome do Campo');
 DEFINE('_SOBI2_FIELD_LABEL', 'Nome');
 DEFINE('_SOBI2_FIELD_TYPE', 'Tipo');
 DEFINE('_SOBI2_FIELD_FREE', 'Grátis');
 DEFINE('_SOBI2_FIELD_ENABLED', 'Publicado');
 DEFINE('_SOBI2_FIELD_REQUIRED', 'Obrigatório');
 DEFINE('_SOBI2_FIELD_IN_VCARD', 'Ver em Categorias');
 DEFINE('_SOBI2_FIELD_IN_DETAILS', 'Ver em Detalhes');
 DEFINE('_SOBI2_ALL_FIELDS_NAMES', 'Descrição do Campo em ');
 DEFINE('_SOBI2_ALL_FIELDS_NAMES2', '. Se você desejar alterar a descrição do campo para outros idiomas, basta alterar o idioma utilizado pelo SOBI2.');
 DEFINE('_SOBI2_FIELD_CONSTANT', 'Deletável');
 DEFINE('_SOBI2_FIELD_NOT_FREE', 'Tarifado');
 DEFINE('_SOBI2_FIELD_DISABLED', 'Despublicado');
 DEFINE('_SOBI2_FIELD_NOT_REQUIRED', 'Opcional');
 DEFINE('_SOBI2_TOOLBAR_ADD_NEW_FIELD', 'Incluir Novo');
 DEFINE('_SOBI2_FIELD_CHECKED_OUT', 'Este campo está sendo atualmente editado por um outro administrador');
 DEFINE('_SOBI2_FIELD_DETAILS', 'Detalhes do Campo');
 DEFINE('_SOBI2_FIELD_HELP', 'Descrição/Explanação');
 DEFINE('_SOBI2_FIELD_NOT_EDITABLE_EXPL', 'Campo Pré-Definido. Desta forma, algumas opções estão desabilitadas.');
 DEFINE('_SOBI2_FIELD_CSS_CLASS', 'Classe CSS');
 DEFINE('_SOBI2_FIELD_PREFERRED_SIZE', 'Tamano Preferencial');
 DEFINE('_SOBI2_FIELD_MAX_LENGTH', 'Tamanho Max');
 DEFINE('_SOBI2_FIELD_PAYMENT', 'Taxa');
 DEFINE('_SOBI2_FIELD_DISPLAYING', 'Ver Campo');
 DEFINE('_SOBI2_FIELD_DO_NOT_DISPLAY', 'Esconder');
 DEFINE('_SOBI2_FIELD_IS_URL', 'Campo Link');
 DEFINE('_SOBI2_FIELD_IN_NEW_LINE', 'Adicionar nova linha');
 DEFINE('_SOBI2_FIELD_WITH_LABEL', 'Ver Título');
 DEFINE('_SOBI2_FIELD_IN_SEARCH', 'Método de Busca');
 DEFINE('_SOBI2_FIELD_SEARCH_SELECT_BOX', 'Selecione a Caixa');
 DEFINE('_SOBI2_FIELD_SEARCH_SEARCH_IN', 'Pesquisa Geral');
 DEFINE('_SOBI2_FIELD_DESCRIPTION', 'Descrição do Campo');
 DEFINE('_SOBI2_FIELD_WITHOUT_NAME', 'O campo deve ter um nome');
 DEFINE('_SOBI2_FIELD_USE_WYSIWYG', 'Usar editor WYSIWYG');
 DEFINE('_SOBI2_FIELD_ROWS', 'Linhas');
 DEFINE('_SOBI2_FIELD_COLS', 'Colunas');
 DEFINE('_SOBI2_ADD_NEW_FIELD', 'Adicionar novo Campo');
 DEFINE('_SOBI2_FIELD_NAME_DUPLICAT', 'Já existe um campo com este nome. Um novo nome foi gerado automáticamente. Por favor, cheque o nome');
 DEFINE('_SOBI2_FIELDS_DELETED', 'Campos deletados');
 DEFINE('_SOBI2_NOT_ALL_FIELDS_DELETED', 'Nem todos os campos puderam ser excluídos');
 DEFINE('_SOBI2_FIELD_NAME_EXPL', 'Nome unico do campo.');
 DEFINE('_SOBI2_FIELD_LABEL_EXPL', 'Descrição do Campo. Visualizado no formulário de Inclusão/Edição e em listagem de categorias e detalhes da entrada, caso estejam selecionados.');
 DEFINE('_SOBI2_FIELD_DESCRIPTION_EXPL', 'Se a descrição do campo for informada, está será visualizada como dica de informação no formulário de Inclusão/Exclusão de Entradas.');
 DEFINE('_SOBI2_FIELD_TYPE_EXPL', 'Selecione o tipo do campo.');
 DEFINE('_SOBI2_FIELD_CSS_CLASS_EXPL', 'Classe CSS usada no Formulário de Inclusão/Edição de Entradas.<br />As classes CSS para Categorias e Detalhes serão criados automáticamente utilizando o nome do campo.<br />Para a visualização de Categorias: span.sobi2Listing_field_xxx<br />Para a visualização de Detalhes: span#sobi2Details_field_xxx');
 DEFINE('_SOBI2_FIELD_IN_NEW_LINE_EXPL', 'Uma nova linha será inserida em frente a este campo.');
 DEFINE('_SOBI2_FIELD_WITH_LABEL_EXPL', 'Esta descrição será visualizada em Categorias e Detalhes.');
 DEFINE('_SOBI2_FIELD_MAX_LENGTH_EXPL', 'Número máximo de caracteres. Válido apenas se o tipo do campo selecionado for do tipo Caixa de Entrada.');
 DEFINE('_SOBI2_FIELD_REQUIRED_EXPL', 'Selecione se o preenchimento deste campo é obrigatório.');
 DEFINE('_SOBI2_FIELD_ENABLED_EXPL', 'Defina se este campo será publicado ou não.');
 DEFINE('_SOBI2_FIELD_FREE_EXPL', 'Informe se o preenchimento deste campo é gratuíto ou não.');
 DEFINE('_SOBI2_FIELD_PAYMENT_EXPL', 'Valor referente ao armazenamento deste campo (caso o mesmo seja tarifado).');
 DEFINE('_SOBI2_FIELD_DISPLAYING_EXPL', 'Informe a área no qual este campo será visualizado. Selecione Escondido caso o mesmo não deva ser visualizado em lugar algum.');
 DEFINE('_SOBI2_FIELD_IN_SEARCH_EXPL', 'Procure por este campo na Pesquisa Geral ou na Caixa de Seleção. Se a opção Não for selecionada, este campo não será incluido no conteúdo a ser pesquisado.');

/*
 * configuration
 */
DEFINE('_SOBI2_CONFIG', 'Configuração');
DEFINE('_SOBI2_CONFIG_GEN', 'Geral');
DEFINE('_SOBI2_CONFIG_GEN_OPTION', 'Opções Gerais');
DEFINE('_SOBI2_CONFIG_COMPONENT_NAME', 'Nome do Componente');
DEFINE('_SOBI2_CONFIG_COMPONENT_NAME_EXPL', 'Será visualizado no menu SOBI2 como link de componente. Também será adicionado em Meta Tags, etc.');
DEFINE('_SOBI2_CONFIG_FRONTPAGE', 'Pg.Principal');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION', 'Ver Descrição do Componente');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION_TEXT', 'Descrição do Componente');
DEFINE('_SOBI2_CONFIG_GENERAL_IMG_FOR_DESCRIPTION', 'Imagem para a Descrição');
DEFINE('_SOBI2_CONFIG_LANGUAGE', 'Idioma SOBI2');
DEFINE('_SOBI2_CONFIG_LANGUAGE_EXPL', 'Defina o idioma padrão se deseja utilizar a linguagem padrão do Joomla.');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_HP_LINK', 'Ver Link do Componente');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_NEW_ENTRY_LINK', 'Ver Link "Adicionar Entrada"');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_SEARCH_LINK', 'Ver Link "Pesquisar"');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_LISTING_ON_FP', 'Ver Entradas do SOBI2 na página principal (frontend)');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_LISTING_ON_FP_EXPL', 'Se SIM, todas as entradas serão visualizadas na primeira página do componente SOBI2 (Vista Geral).');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_ENTRIES_IN_LINE', 'Número de Entradas por Linha');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_LINES_IN_SITE', 'Número de linhas por página');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_CAT_LISTING_ON_FP', 'Ver categorias na página principal (frontend) para o SOBI2');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_CAT_LISTING_ON_FP_EXPL', 'Se SIM, todas as categorias serão visualizadas na página principal (frontend) quando o componente SOBI2 for selecionado (Vista Geral).');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_CATS_IN_LINE', 'Número de Categorias por linha');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_FROM_SUBCATS', 'Ver Entradas em Sub Categorias');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_FROM_SUBCATS_EXPL', 'Se SIM, todas as entradas realizadas em subcategorias serão visualizadas também na categoria mãe.');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_ICO_IN_VC', 'Visualizar ícone na listagem de Categorias');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_LOGO_IN_VC', 'Ver imagem na visualização de Categorias');
DEFINE('_SOBI2_CONFIG_GENERAL_USE_META', 'Usar Meta Tags');
DEFINE('_SOBI2_CONFIG_GENERAL_USE_META_EXPL', 'Permite aos usuários adicionar suas próprias chaves e descrições Meta.');
DEFINE('_SOBI2_CONFIG_GENERAL_SHOW_CAT_INFO', 'Ver descrição da Categoria');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_TITLE_ASC', 'Titulo Crescente');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_TITLE_DESC','Titulo Decrescente');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_ADDED_ASC', 'Data de Criação Crescente');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_ADDED_DESC','Data de Criação Decrescente');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_HITS_ASC',  'Acessos Crescente');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_HITS_DESC', 'Acessos Decrescente');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_NAME_ASC', 'Nome Crescente');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_NAME_DESC','Nome Decrescente');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_COUNT_ASC', 'Acessos Crescente');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_COUNT_DESC','Acessos Decrescente');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_ORDER_ASC', 'Indexação Crescente');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_ORDER_DESC','Indexação Descrescente');
DEFINE('_SOBI2_CONFIG_GENERAL_PERMS','Editar Permissões');
DEFINE('_SOBI2_CONFIG_GENERAL_PERMS_EDIT','Permitir usuários a edição de suas próprias Entradas');
DEFINE('_SOBI2_CONFIG_GENERAL_PERMS_DEL','Permitir Exclusões');
DEFINE('_SOBI2_CONFIG_GENERAL_PERMS_DEL_EXPL','Selecione se o usuário poderá excluir ou deletar suas próprias entradas.');
DEFINE('_SOBI2_CONFIG_GENERAL_PERMS_UNPUBLISH','Apenas despublicar');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_LISTING_BY','Ordenar Entradas por');
DEFINE('_SOBI2_CONFIG_GENERAL_SORT_CATS_BY','Ordenar Categorias por');
DEFINE('_SOBI2_CONFIG_GENERAL_BACKGROUNDS','Fundo');
DEFINE('_SOBI2_CONFIG_GENERAL_BACKGROUNDS_AND_BORDERS','Configuração das cores utilizadas em Bordas e Fundos');
DEFINE('_SOBI2_CONFIG_GENERAL_BORDERS','Cor da Borda');
DEFINE('_SOBI2_CONFIG_GENERAL_BORDER_EXPL','Cor da Borda das Entradas na visualização de Categorias e Detalhes');
DEFINE('_SOBI2_CONFIG_GENERAL_BACKGROUND','Imagem de Fundo');
DEFINE('_SOBI2_CONFIG_GENERAL_BACKGROUND_EXPL','Imagem de Fundo das Entradas na visualização de Categorias e Detalhes');
DEFINE('_SOBI2_CONFIG_FIELDS', 'Campos');
DEFINE('_SOBI2_CONFIG_FIELDS_DESC', 'Configuração de campos fixos (Título, imagem e ícone)');
DEFINE('_SOBI2_CONFIG_ENTRY_T_LABEL', 'Descrição do Título');
DEFINE('_SOBI2_CONFIG_ENTRY_T_LABEL_EXPL', 'Descrição da primeira caixa de entrada no formulário de inclusão/edição de entradas (título).');
DEFINE('_SOBI2_CONFIG_ENTRY_T_LENGTH', 'Tamanho do título na caixa de entrada');
DEFINE('_SOBI2_CONFIG_ENTRY_T_LENGTH_EXPL', 'Tamanho do campo da caixa de entrada no formulário de inclusão/edição de entradas (título)');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_MULTI', 'Permitir Títulos Duplicados');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_MULTI_EXPL', 'Permitir mais de uma entrada com o mesmo título');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_IMG', 'Permitir adição de imagens');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_ICO', 'Permitir adição de ícones');
DEFINE('_SOBI2_CONFIG_ENTRY_RESIZE_IMG', 'Redimensionar Imagem para');
DEFINE('_SOBI2_CONFIG_ENTRY_RESIZE_IMG_EXPL', 'Defina o tamanho máximo de altura e largura da imagem. Se a imagem enviada for maior que o definido, esta será redimensionada.');
DEFINE('_SOBI2_CONFIG_ENTRY_W', 'Largura: ');
DEFINE('_SOBI2_CONFIG_ENTRY_H', 'Altura: ');
DEFINE('_SOBI2_CONFIG_ENTRY_RESIZE_ICO', 'Redimensionar Ícone para');
DEFINE('_SOBI2_CONFIG_ENTRY_RESIZE_ICO_EXPL', 'Defina o tamanho máximo de altura e largura do ícone. Se o ícone enviado for maior que o definido, esta será redimensionado.');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_NOT_FREE', 'Sim, mas não é gratuíto ');
DEFINE('_SOBI2_CONFIG_ENTRY_IMG_LABEL', 'Título da Imagem');
DEFINE('_SOBI2_CONFIG_ENTRY_IMG_LABEL_EXPL', 'Titulo para a caixa de entrada de imagens no formulário de inclusão/edição de entradas.');
DEFINE('_SOBI2_CONFIG_ENTRY_PRICE_IMG', 'Preço para Imagem');
DEFINE('_SOBI2_CONFIG_ENTRY_PRICE_ICO', 'Preço para Ícone');
DEFINE('_SOBI2_CONFIG_ENTRY_ICO_LABEL', 'Título do Ícone');
DEFINE('_SOBI2_CONFIG_ENTRY_ICO_LABEL_EXPL', 'Título para a caixa de entrada para a pequena imagem/ícone a ser visualizado no formulário de inclusão/edição de entradas. Este ícone é geralmente visualizado em Categoria.');
DEFINE('_SOBI2_CONFIG_ENTRY_UP_TO_CATS', 'Permite o relacionamento de Entradas até');
DEFINE('_SOBI2_CONFIG_ENTRY_2_CAT', 'Entrada em uma Segunda Categoria');
DEFINE('_SOBI2_CONFIG_ENTRY_2_CAT_PRICE', 'Preço para relacionar Entrada em uma 2a.Categoria');
DEFINE('_SOBI2_CONFIG_ENTRY_3_CAT', 'Entrada em uma Terceira Categoria');
DEFINE('_SOBI2_CONFIG_ENTRY_3_CAT_PRICE', 'Preço para relacionar Entrada em uma 3a.Categoria');
DEFINE('_SOBI2_CONFIG_ENTRY_4_CAT', 'Entrada em uma Quarta Categoria');
DEFINE('_SOBI2_CONFIG_ENTRY_4_CAT_PRICE', 'Preço para relacionar Entrada em uma 4a.Categoria');
DEFINE('_SOBI2_CONFIG_ENTRY_5_CAT', 'Entrada em uma Quinta Categoria');
DEFINE('_SOBI2_CONFIG_ENTRY_5_CAT_PRICE', 'Preço para relacionar Entrada em uma 5a.Categoria');
DEFINE('_SOBI2_CONFIG_ENTRY_SAFETY', 'Segurança');
DEFINE('_SOBI2_CONFIG_ENTRY_SAFETY_OPTIONS', 'Opções de Segurança');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_ANO', 'Permitir Inclusão de Entradas por Anônimos');
DEFINE('_SOBI2_CONFIG_ENTRY_ALLOW_ANO_EXPL', 'Permite a inclusão de novas entradas por internautas não registrados ao site.');
DEFINE('_SOBI2_CONFIG_ENTRY_AUTOPUBLISH', 'Publicar Entradas Automáticamente');
DEFINE('_SOBI2_CONFIG_ENTRY_AUTOPUBLISH_EXPL', 'Todas as Entradas realizadas serão disponibilizadas automáticamente no site sem uma pré aprovação do administrador.');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN', 'Informar Administradores');
DEFINE('_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EXPL', 'Informar os Administradores do site sobre novas Entradas realizadas.');
DEFINE('_SOBI2_CONFIG_ENTRY_EXP_TIME', 'Duração da Publicação');
DEFINE('_SOBI2_CONFIG_ENTRY_EXP_TIME_EXPL', 'Defina para quantos dias a Entrada (/registro) estará disponível no site. Configure para 0 ou deixe o campo em branco para que a exibição seja por tempo indeterminado.');
DEFINE('_SOBI_CONFIG_ENTRY_USE_SEC_IMG', 'Usar Código de Segurançca');
DEFINE('_SOBI_CONFIG_ENTRY_SEC_IMG', 'Código de Segurança');
DEFINE('_SOBI_CONFIG_ENTRY_USE_SEC_IMG_EXPL', 'Ativar esta função para impedir que ocorram cadastramentos feitos de maneira automática e/ou robotizadas por programas externos.');
DEFINE('_SOBI_CONFIG_ENTRY_SEC_IMG_FONTCOLOR', 'Cor da Fonte');
DEFINE('_SOBI_CONFIG_ENTRY_SEC_IMG_LINECOLOR', 'Cor da Tabela');
DEFINE('_SOBI_CONFIG_ENTRY_SEC_IMG_BGCOLOR', 'Cor de Fundo');
DEFINE('_SOBI_CONFIG_ENTRY_SEC_IMG_BORDERCOLOR', 'Cor da Borda');
DEFINE('_SOBI_CONFIG_ENTRY_ACCEPT_RULES', 'Termos de Uso');
DEFINE('_SOBI_CONFIG_ENTRY_NEED_TO_ACCEPT_RULES', 'Usuários devem aceitar o termo de uso na inclusão de Entradas');
DEFINE('_SOBI_CONFIG_ENTRY_NEED_TO_ACCEPT_RULES_EXPL', 'Defina se os usuários deverão concordar com um termo de uso do sistema na inclusão de Entradas no componente.');
DEFINE('_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_1', 'Título para o Termos de Uso Parte 1');
DEFINE('_SOBI_CONFIG_ENTRY_ENTRY_RULES_URL', 'Link para o Termos de Uso');
DEFINE('_SOBI_CONFIG_ENTRY_ENTRY_RULES_TXT', 'Texto utilizado no Link para o Termos de Uso');
DEFINE('_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_2', 'Título para o Termos de Uso Parte 2');
DEFINE('_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABELS_EXPL', '<h4>Esta opção criará um título como este: &nbsp;&nbsp;&nbsp;&nbsp;<span class="editlinktip">' .
		sobiHTML::toolTip(addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_1),addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_1),'','','Eu aceito os', '#',0 )
		.'</span>&nbsp;&nbsp;<span class="editlinktip"><a href="#">' .
		sobiHTML::toolTip(addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_URL),addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_TXT),'','','Termos de Uso', '#',0 )
		.'</a></span>&nbsp;&nbsp;<span class="editlinktip">' .
		sobiHTML::toolTip(addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_2),addslashes(_SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_2),'','','deste site.', '#',0 )
		.'</h4>');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS', 'Configurações da Visualização de Detalhes');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_ICO', 'Ver Ícone na Visualização de Detalhes');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_ICO_EXPL', 'Se SIM, a pequena imagem (ícone) será habilitada na visualização dos detalhes da entrada.');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_IMG', 'Ver Imagem na Visualização de Detalhes');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_IMG_EXPL', 'Se SIM, a imagem relacionada à Entrada será habilitada na visualização de Detalhes.');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_ADDED_DATE', 'Ver a Data de Criação');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_HITS', 'Ver número de Acessos');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH', 'Ver Link para Site de Mapas/Rotas');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_URL', 'Link do Site de Mapas/Rotas');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_LABEL', 'Texto do Link');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_LABEL_EXPL', 'Como o link deve ser mostrado. Examplo: Ver no Mapa. Insira imagens utilizando o img-tag.');
DEFINE('_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_URL_VAR_EXPL', 'Normalmente um Link é visualizado desta forma:' .
		'<div align="left">http://route.com/index.php?tocity=samplecity&toplz=12345&tostreet=sample%20street%2099</div><br />' .
		'As seguinte varições estão disponíveis:' .
		'<ul>' .
		'<li>STREET - rua</li>' .
		'<li>ZIPCODE - cep</li>' .
		'<li>CITY - cidade</li>' .
		'<li>COUNTRY - pais</li>' .
		'<li>FEDSTATE - estado</li>' .
		'<li>COUNTY - região</li>' .
		'</ul>' .
		'Para acessar o link como demonstrado acima, ele deve estar configurado como:' .
		'<div align="left">http://route.com/index.php?tocity=CITY&toplz=ZIPCODE&tostreet=STREET</div>');
DEFINE('_SOBI2_CONFIG_PAYMENTS_OPTIONS', 'Opções para Pagamento');
DEFINE('_SOBI2_CONFIG_PAYMENTS_CURRENCY', 'Simbolo Monetário');
DEFINE('_SOBI2_CONFIG_PAYMENTS_CURRENCY_SEPARATOR', 'Separador Decimal');
DEFINE('_SOBI2_CONFIG_PAYMENTS_CURRENCY_SEPARATOR_EXPL', 'Pode ser definido como "." (ponto) ou "," (virgula). Exemplo: $ 100.99 or $ 100,99');
DEFINE('_SOBI2_CONFIG_PAYMENTS_TITLE', 'Referência de Pagamento');
DEFINE('_SOBI2_CONFIG_PAYMENTS_TITLE_EXPL', 'Texto para informações relacionadas a transferência/depósito bancário ou pagamentos através do Paypal. O número de identificação SOBI2 será adicionado.');
DEFINE('_SOBI2_CONFIG_PAYMENTS_BANK_TRANSFER', 'Opções para Transferência Bancária');
DEFINE('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER', 'Usar Transferência Bancária');
DEFINE('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER_EXPL', 'Se SIM, o usuário poderá efetuar o pagamento através de transferência/depósito bancário. Os Dados Bancários serão exibidos no final da inclusão da Entrada ou enviados por email.');
DEFINE('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER_YES_OVER_EMAIL', 'Sim, mas envie os dados bancários por email');
DEFINE('_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER_YES_ON_PAGE', 'Sim, mas informe os dados bancários serão exibidos ao final do processo de inclusão');
DEFINE('_SOBI2_CONFIG_PAYMENTS_BANK_DATA', 'Dados da Conta do Banco');
DEFINE('_SOBI2_CONFIG_PAYMENTS_BANK_DATA_EXPL', 'Informe os detalhes da sua Conta do Banco aqui');
DEFINE('_SOBI2_CONFIG_PAYMENTS_PAY_PAL', 'Opções no Paypal');
DEFINE('_SOBI2_CONFIG_PAYMENTS_USE_PAY_PAL', 'Usar PayPal');
DEFINE('_SOBI2_CONFIG_PAYMENTS_USE_PAY_PAL_EXPL', 'Se SIM, usuários poderão efetuar o pagamento através do sistema PayPal.');
DEFINE('_SOBI2_CONFIG_PAYMENTS_PAY_PAL_EMAIL', 'Seu Endereço de email no PayPal');
DEFINE('_SOBI2_GENERAL_FILE_IS', 'com_sobi2.css esta ');
DEFINE('_SOBI2_GENERAL_FILE_WRITABLE', '<span style="color: rgb(0, 128, 0); font-weight: bold;">com permissão de escrita</span>');
DEFINE('_SOBI2_GENERAL_FILE_UNWRITABLE', '<span style="color: rgb(255, 0, 0); font-weight: bold;">sem permissão de escrita</span>');
DEFINE('_SOBI2_GENERAL_DO_FILE_UNWRITABLE', 'Tornar indisponivel para escrita após salvar');
DEFINE('_SOBI2_GENERAL_DO_FILE_WRITABLE', 'Ignorar proteção de escrita');

DEFINE('_SOBI2_UNINSTALL_DB_TXT', '<div style="text-align:left">' .
		'<h2>Remoção das Tabelas SOBI2</h2>' .
		'Existem duas formas para desinstalar o componente SOBI2:<br />' .
		'<ul>' .
		'  <li>Apenas o componente: neste caso, apenas o script SOBI2 será' .
		' desinstalado enquanto as tabelas utilizadas no banco de dados serão preservadas.' .
		' Este meio é o mais indicado para atualizar o componente. ' .
		' É possivel efetuar a desinstalação apenas do componente' .
		' utilizando a função Instalar/Desinstalar do Joomla!.<br /></li>' .
		'  <li>Desinstalação Completa: esta opção primeiramente removerá'.
		' todas as tabelas correspondentes do banco dados para que então ' .
		' o componente possa ser desinstalado através da função' .
		' Instalar/Desinstalar do Joomla!.' .
		' </li>' .
		'</ul>' .
		'</div>');
DEFINE('_SOBI2_UNINSTALL_DB_LINK', 'Remover tabelas do SOBI2 do Banco de Dados');
DEFINE('_SOBI2_UNINSTALL_DB_CONFIRM', 'Você tem CERTEZA que deseja remover as tabelas do SOBI2 do Banco de Dados?');
DEFINE('_SOBI2_DB_REMOVED_MSG', 'As tabelas do SOBI2 foram removidas com sucesso do Banco de Dados. Desinstale o componente agora.');
DEFINE('_SOBI2_DB_REMOVE_ERROR_MSG', 'As tabelas do SOBI2 não foram removidas do Banco de Dados. Será necessários remove-las manualmente para então efetuar a desinstalação do componente.');
?>
