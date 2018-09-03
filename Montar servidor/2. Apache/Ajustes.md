## Ajustes

Estos ajustes son recomendaciones de seguridad y personalizacion. Son de caracter opcional y se realizan en el archivo de configuracion `C:\Program Files\Apache\conf\httpd.conf`

### Seguridad: Evitar mostrar la versión de PHP

Descomentar la siguiente linea

~~~
LoadModule headers_module modules/mod_headers.so
~~~

Agregar las siguientes lineas

~~~
Header unset X-Powered-By
#Header unset Expires
#Header unset Cache-Control
#Header unset Last-Modified
~~~

http://www.alcancelibre.org/staticpages/index.php/18-como-apache-htaccess


### Seguridad: Evito que se acceda a ciertos archivos

Reviso que no sea accesible el archivo de configuración `.htaccess`

~~~
#
# The following lines prevent .htaccess and .htpasswd files from being 
# viewed by Web clients. 
#
<Files ".ht*">
    Require all denied
</Files>
~~~

Agregamos la siguiente linea

~~~
# Evito que se pueda acceder directamente a los archivos que inicien con _ 
<Files "_*">
    Require all denied
</Files>
~~~

http://httpd.apache.org/docs/2.4/en/mod/core.html#files

### Personalización: Definimos nuestras páginas de error

~~~
#ErrorDocument 500 "The server made a boo boo."
#ErrorDocument 404 /missing.html
#ErrorDocument 404 "/cgi-bin/missing_handler.pl"
#ErrorDocument 402 http://127.0.0.1/subscription_info.html
~~~

http://httpd.apache.org/docs/2.4/es/custom-error.html

### Personalización: Redirección transparente

~~~
Redirect permanent /rss/comentarios.xml http://feeds.feedburner.com/my_feef_url
~~~

http://httpd.apache.org/docs/2.4/mod/mod_alias.html

## Personalización: Redirijo las paginas

**Simbolos**

| Simbolo | Descripción |
| --- | --- |
| ^ | Señala el inicio del patron |
| $ | Señala que se termino de escribir un patron |
| ([A-Z]) | Señala que solo acepta un caracter en mayuscula |
| ([A-Z]+) | Señala que acepta varios caracteres mayusculas |
| ([0-9]+) | Señala que acepta varios caracteres numericos |
| (.+) | Señala que acepta varios tipos de caracteres |
| (.*) | Señala que acepta varios tipos de caracteres |
| [R] | Redirecciona "302 Found" |
| [R=permanent,L] | Redirecciona las direcciones de salida "301 Moved Permanently"  |

~~~
<IfModule rewrite_module>
 Options +FollowSymLinks
 RewriteEngine On
 RewriteCond %{HTTP_HOST} ^(localhost|127.0.0.1)$
 #http://localhost/empleos
 # RewriteRule ^empleos$ /empleos/ [R=permanent]
 #http://localhost/empleos/
 # RewriteRule ^empleos/$ /empleos/navi.php [L]
 #http://localhost/empleos/533
 # RewriteRule ^empleos/([0-9]+)$ /empleos/offer.php?id=$1 [L]
 #http://localhost/empleos/Distrito-Federal
 # RewriteRule ^empleos/([A-Za-z-]+)$ /empleos/$1/ [R=permanent]
 #http://localhost/empleos/Distrito-Federal/
 # RewriteRule ^empleos/([A-Za-z-]+)/$ /empleos/navi.php?stateStr=$1 [L]
 #http://localhost/empleos/Distrito-Federal/533
 # RewriteRule ^empleos/([A-Za-z-]+)/([0-9]+)$ /empleos/offer.php?stateStr=$1&id=$2 [L]
 #http://localhost/empleos/Distrito-Federal/Iztacalco
 # RewriteRule ^empleos/([A-Za-z-]+)/([A-Za-z-]+)$ /empleos/$1/$2/ [R=permanent]
 #http://localhost/empleos/Distrito-Federal/Iztacalco/
 # RewriteRule ^empleos/([A-Za-z-]+)/([A-Za-z-]+)/$ /empleos/navi.php?stateStr=$1&cityStr=$2 [L]
 #http://localhost/empleos/Distrito-Federal/Iztacalco/533
 # RewriteRule ^empleos/([A-Za-z-]+)/([A-Za-z-]+)/([0-9]+)$ /empleos/offer.php?stateStr=$1&cityStr=$2&id=$3 [L]
 #http://localhost/email/imagenes/001/banner01.jpg
 # RewriteRule ^email/imagenes/([0-9]+)/(.+)$ /email/imagenes.php?id=$1&name=$2 [L] 
</IfModule>
~~~

### Fuentes

* http://httpd.apache.org/docs/2.4/rewrite/intro.html#regex
* http://httpd.apache.org/docs/2.0/misc/rewriteguide.html#url (depreciado)
* http://httpd.apache.org/docs/2.4/en/howto/access.html#rewrite
* http://httpd.apache.org/docs/2.4/mod/mod_rewrite.html
* http://www.widexl.com/tutorials/mod_rewrite.html#rewriterule

## Autores

* [Angel González](https://github.com/mgrc45)

## Licencia

Este proyecto está licenciado bajo la licencia GNU General Public License v2.0.

## Modulos PHP 5

~~~
<IfModule mod_php5.c>
# Deshabilita el uso de variables globales
php_flag register_globals Off

# Habilita la compresion gzip
php_flag zlib.output_compression on
php_value zlib.output_compression_level 9

# Tamaño maximo del archivo
php_value upload_max_filesize 8M

# Magic Quotes
php_flag magic_quotes_gpc Off
php_flag magic_quotes_runtime Off
#php_admin_flag magic_quotes_sybase = Off
</IfModule>
~~~
