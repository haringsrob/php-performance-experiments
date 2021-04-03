FROM php:8.0-apache

RUN apt-get update -y
RUN apt-get install -y gnuplot

RUN cp $APACHE_CONFDIR/mods-available/rewrite.load $APACHE_CONFDIR/mods-enabled/rewrite.load

# install rust
RUN curl https://sh.rustup.rs -sSf | bash -s -- -y

RUN echo "memory_limit=512M" >> $PHP_INI_DIR/php.ini;

#RUN echo "zend_extension=opcache" >> $PHP_INI_DIR/php.ini;
#RUN echo "[opcache]" >> $PHP_INI_DIR/php.ini;
#RUN echo "opcache.enable=1" >> $PHP_INI_DIR/php.ini;
#RUN echo "opcache.enable_cli=1" >> $PHP_INI_DIR/php.ini;
#RUN echo "opcache.preload_user=root" >> $PHP_INI_DIR/php.ini;
