## Servicios

Algunos de los siguientes servicios no estan disponibles debido a la compatibilidad de la compilacion con windows. En caso de presentar errores recomiendo habilitar `display_startup_errors` dentro del archivo de configuracion de PHP. Asi como tambien borrar el archivo `logs\httpd.pid` del directorio de Apache tras cada intento fallido.

| Extensiones | Descripcion |
| --- | --- |
| bzip | Funciones de compresion |
| -Curl | Funciones URL - Comprueba que exista la direccion |
| -Enchant | Ubica librerias de idiomas |
| EXIF | Funciones para imagen. (tamaño alto x ancho) |
| Fileinfo | Funciones para informacion de un archivo. (Tipo mime) |
| GD2 | Funciones para manipulacion de imagenes. (Dibuja caracteres) |
| -Gettext | Establece la ruta del dominio |
| -GMP | Funciones matematicas |
| IMAP | Funciones de correo |
| intl | Librerias internacionales |
| Multi-Byte Strings | Manejo de cadenas [mb_ereg_match] |
| MySQL | Funciones Mysql. [Basicas] |
| MySQLi | Funciones Mysql. [Incluye stored procedures] |
| -Oracle (10) | Funciones de oracle |
| -Oracle (11g) | Funciones de oracle |
| PDO | Objetos de conexion [MySql] |
| -PostgreSQL | Funciones de Postgre SQL |
| Shared Memory | Puedo guardar variables en memoria RAM |
| -SOAP | Conexiones [HTML Como Winsock de .net] |
| Sockets | Conexiones |
| -SQLite | Funciones para SQL lite |
| -SQLite3 | Funciones para SQL lite |
| -Sybase | Funciones para Sybase |
| Tidy | Nodos, HTML y XML |
| XML-RPC | Funciones de XML |
| XLS | Manejo de hojas de excel, XML y DOM Document |

Al interior del archivo de configuracion `php.ini` puede habilitar las extensiones unicamente removiendo el signo `;` que sirve para definir los comentarios.

~~~
;;;;;;;;;;;;;;;;;;;;;;
; Dynamic Extensions ;
;;;;;;;;;;;;;;;;;;;;;;

; If you wish to have an extension loaded automatically, use the following
; syntax:
;
;   extension=modulename
;
; For example:
;
;   extension=mysqli
; 
; When the extension library to load is not located in the default extension
; directory, You may specify an absolute path to the library file:
;
;   extension=/path/to/extension/mysqli.so
;
; Note : The syntax used in previous PHP versions ('extension=<ext>.so' and
; 'extension='php_<ext>.dll') is supported for legacy reasons and may be
; deprecated in a future PHP major version. So, when it is possible, please
; move to the new ('extension=<ext>) syntax.
;
; Notes for Windows environments :
;
; - Many DLL files are located in the extensions/ (PHP 4) or ext/ (PHP 5+)
;   extension folders as well as the separate PECL DLL download (PHP 5+).
;   Be sure to appropriately set the extension_dir directive.
;
;extension=bz2
;extension=curl
;extension=fileinfo
;extension=gd2
;extension=gettext
;extension=gmp
;extension=intl
;extension=imap
;extension=interbase
;extension=ldap
;extension=mbstring
;extension=exif      ; Must be after mbstring as it depends on it
;extension=mysqli
;extension=oci8_12c  ; Use with Oracle Database 12c Instant Client
;extension=odbc
;extension=openssl
;extension=pdo_firebird
;extension=pdo_mysql
;extension=pdo_oci
;extension=pdo_odbc
;extension=pdo_pgsql
;extension=pdo_sqlite
;extension=pgsql
;extension=shmop

; The MIBS data available in the PHP distribution must be installed.
; See http://www.php.net/manual/en/snmp.installation.php
;extension=snmp

;extension=soap
;extension=sockets
;extension=sqlite3
;extension=tidy
;extension=xmlrpc
;extension=xsl
~~~

Las extensiones que recomiendo descomentar son las siguientes

~~~
extension=imap
extension=mbstring
extension=exif      ; Must be after mbstring as it depends on it
extension=mysqli
extension=openssl
extension=snmp
~~~
