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

### Personalización: Redirijo las paginas

Descomentar la siguiente linea

~~~
LoadModule rewrite_module modules/mod_rewrite.so
~~~

**RewriteLogLevel 0**: Este es el nivel predefinido usado por el archivo `httpd.conf`<br/>
**RewriteLogLevel 1**: Este es el nivel obligatorio usado por un archivo `.htaccess`

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
 RewriteEngine On
 RewriteCond %{HTTP_HOST} ^(localhost|127.0.0.1)$
 
 #http://localhost/CHP
 #http://localhost/CHP/
 RewriteRule ^([A-Z]+)$ /$1/ [R=permanent]
 RewriteRule ^([A-Z]+)/$ /navi.php?estado=$1 [L]
 
 #http://localhost/CHP/001
 #http://localhost/CHP/001/
 RewriteRule ^([A-Z]+)/([0-9]+)$ /$1/$2/ [R=permanent]
 RewriteRule ^([A-Z]+)/([0-9]+)/$ /navi.php?estado=$1&mun=$2 [L]
 
 #http://localhost/CHP/001/533
 RewriteRule ^([A-Z]+)/([0-9]+)/([0-9]+)$ /post.php?estado=$1&id=$3 [L]
</IfModule>
~~~

Subdominios

~~~
# http://www.jobs.mx -> http://jobs.mx/

RewriteCond %{HTTP_HOST} ^www\.jobs\.mx$ [NC]
RewriteRule ^/?$ "http\:\/\/jobs\.mx" [R=permanent,L] 
~~~

~~~
# http://new.jobs.mx

RewriteCond %{HTTP_HOST} ^(new|s|e)\.jobs\.mx$
RewriteRule ^/$ /index.php?mode=%1 [L]
~~~

~~~
# http://e.jobs.mx/robots.txt

RewriteCond %{HTTP_HOST} !^(s.|e.|)jobs\.mx$ [NC] 
RewriteRule ^/(.*)$ - [G,NC]
~~~

~~~
# http://chp.jobs.mx -> /jobs.php?state=chp

RewriteCond %{HTTP_HOST} ^([a-z]+)\.jobs\.mx$ 
RewriteRule ^/$ /jobs.php?state=%1 [L]
~~~

~~~
# http://chp.aejobs.mx/001/ -> /aejobs.php?state=chp&city=001

RewriteCond %{HTTP_HOST} ^([a-z]+)\.aejobs\.mx$
RewriteRule ^/([0-9]+)/$ /aejobs.php?state=%1&city=$1 [L] 
~~~

Rutas

~~~
# http://127.0.0.1/BCN/filter

RewriteCond %{HTTP_HOST} jobs.mx
RewriteRule ^/([A-Z]+)/filter$ /index.php?state=$1&%{QUERY_STRING}
~~~

~~~
# http://127.0.0.1/AGS/001/533?hidden=1

RewriteCond %{HTTP_HOST} jobs.mx
RewriteCond %{QUERY_STRING} ^hidden=([0-1])$ [NC]
RewriteRule ^/([A-Z]+)/([0-9]+)/([0-9]+)$ /offer.php?state=$1&city=$2&id=$3&hidden=%1 [L]
~~~

~~~
# http://127.0.0.1/AGS/001/533?hidden=1

RewriteRule ^/([A-Z]+)/([0-9]+)/([0-9]+)$ /offer.php?state=$1&city=$2&id=$3&%{QUERY_STRING} [L] 
~~~

~~~
# http://127.0.0.1/AGS/001/533/diseñador_grafico.pdf

RewriteCond %{HTTP_HOST} jobs.mx
RewriteCond %{QUERY_STRING} ^$ [NC] 
RewriteRule ^/([A-Z]+)/([0-9]+)/([0-9]+)/(.+).pdf$ /shared/pdf/offer_pdf.php?state=$1&city=$2&id=$3&pdf_name=$4 [L] 
~~~

~~~
# http://www.elfos.mx

RewriteCond %{HTTP_HOST} "elfos.mx" [OR]
RewriteCond %{HTTP_HOST} "www.elfos.mx"
RewriteRule ^(.*)$ http://www.wix.com/xpublicidad/elfos [P,L]
~~~

http://httpd.apache.org/docs/2.4/mod/mod_rewrite.html<br/>
http://httpd.apache.org/docs/2.0/misc/rewriteguide.html#url (depreciado)<br/>
http://httpd.apache.org/docs/2.4/en/howto/access.html#rewrite<br/>
http://www.widexl.com/tutorials/mod_rewrite.html#rewriterule<br/>

Regex<br/>
https://regex101.com/<br/>
http://httpd.apache.org/docs/2.4/rewrite/intro.html#regex<br/>

## Autores

* [Angel González](https://github.com/mgrc45)

## Licencia

Este proyecto está licenciado bajo la licencia GNU General Public License v2.0.
