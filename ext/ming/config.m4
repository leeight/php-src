dnl
dnl $Id$
dnl

PHP_ARG_WITH(ming, for MING support,
[  --with-ming[=DIR]       Include MING support])

if test "$PHP_MING" != "no"; then
  for i in $PHP_MING /usr/local /usr; do
    if test -f $i/lib/libming.$SHLIB_SUFFIX_NAME -o -f $i/lib/libming.a; then
      MING_DIR=$i
    fi
  done

  if test -z "$MING_DIR"; then
    AC_MSG_ERROR(Please reinstall ming distribution. libming.(a|so) not found.)
  fi

  PHP_CHECK_LIBRARY(ming, Ming_useSWFVersion, [
    AC_DEFINE(HAVE_MING,1,[ ])
  ],[
    AC_MSG_ERROR([Ming library 0.2a or greater required.])
  ],[
    -L$MING_DIR/lib -lm -ldl
  ])

  PHP_ADD_INCLUDE($MING_DIR/include)
  PHP_ADD_LIBRARY_WITH_PATH(ming, $MING_DIR/lib, MING_SHARED_LIBADD)

  PHP_EXTENSION(ming, $ext_shared)
  PHP_SUBST(MING_SHARED_LIBADD)
fi
