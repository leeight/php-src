/*
  +----------------------------------------------------------------------+
  | PHP Version 5                                                        |
  +----------------------------------------------------------------------+
  | Copyright (c) 1997-2004 The PHP Group                                |
  +----------------------------------------------------------------------+
  | This source file is subject to version 3.0 of the PHP license,       |
  | that is bundled with this package in the file LICENSE, and is        |
  | available through the world-wide-web at the following url:           |
  | http://www.php.net/license/3_0.txt.                                  |
  | If you did not receive a copy of the PHP license and are unable to   |
  | obtain it through the world-wide-web, please send a note to          |
  | license@php.net so we can mail you a copy immediately.               |
  +----------------------------------------------------------------------+
  | Author: Wez Furlong <wez@php.net>                                    |
  |         Marcus Boerger <helly@php.net>                               |
  |         Sterling Hughes <sterling@php.net>                           |
  +----------------------------------------------------------------------+
*/

/* $Id$ */

/* Stuff private to the PDO extension and not for consumption by PDO drivers
 * */
extern zend_class_entry *pdo_exception_ce;
int php_pdo_list_entry(void);

extern zend_object_value pdo_dbh_new(zend_class_entry *ce TSRMLS_DC);
extern function_entry pdo_dbh_functions[];
extern zend_class_entry *pdo_dbh_ce;
extern ZEND_RSRC_DTOR_FUNC(php_pdo_pdbh_dtor);

extern zend_object_value pdo_dbstmt_new(zend_class_entry *ce TSRMLS_DC);
extern function_entry pdo_dbstmt_functions[];
extern zend_class_entry *pdo_dbstmt_ce;
void pdo_dbstmt_free_storage(zend_object *object TSRMLS_DC);
zend_object_iterator *pdo_stmt_iter_get(zend_class_entry *ce, zval *object TSRMLS_DC);
extern zend_object_handlers pdo_dbstmt_object_handlers;
int pdo_stmt_describe_columns(pdo_stmt_t *stmt TSRMLS_DC);
int pdo_stmt_setup_fetch_mode(INTERNAL_FUNCTION_PARAMETERS, pdo_stmt_t *stmt, int skip_first_arg);

extern zend_object_value pdo_row_new(zend_class_entry *ce TSRMLS_DC);
extern function_entry pdo_row_functions[];
extern zend_class_entry *pdo_row_ce;
void pdo_row_free_storage(zend_object *object TSRMLS_DC);
extern zend_object_handlers pdo_row_object_handlers;


extern pdo_driver_t *pdo_find_driver(const char *name, int namelen);

extern void pdo_handle_error(pdo_dbh_t *dbh, pdo_stmt_t *stmt TSRMLS_DC);

#define PDO_DBH_CLEAR_ERR()		dbh->error_code = PDO_ERR_NONE
#define PDO_STMT_CLEAR_ERR()	stmt->error_code = PDO_ERR_NONE
#define PDO_HANDLE_DBH_ERR()	if (dbh->error_code) { pdo_handle_error(dbh, NULL TSRMLS_CC); }
#define PDO_HANDLE_STMT_ERR()	if (stmt->error_code) { pdo_handle_error(stmt->dbh, stmt TSRMLS_CC); }


/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
