# Instalación de PHP 7 en Windows 10

Tras instalar el sevidor de apache 2.4.x podemos instalar el interprete de PHP el cual fue compilado para windows y dependiendo de la version necesitaremos un componente de Visual Studio.

Debemos elegir es la versión **Thread Safe**, ya que es la que va con Apache, la **Non-Thread Safe** está mejorada para utilizar con Windows e IIS, pero no con Apache, por eso la elección.

La mayoria de servidores en internet usan Apache sobre linux combinacion tambien conocida como LAMP (Linux Apache MySQL Php) si bien vamos a usar un PC con Windows para desarrollar es deseable que nuestras aplicaciones corran lo más parecido posible para evitar problemas de compatibilidad al montarlo en un servidor de terceros.

## Descargar

* VC15: [Visual C++ Redistributable for Visual Studio 2017](https://aka.ms/vs/15/release/VC_redist.x64.exe)
* Paquete de PHP 7 compilado para windows [php-7.2.7-Win32-VC15-x64.zip](https://windows.php.net/downloads/releases/archives/php-7.2.7-Win32-VC15-x64.zip)

## Instalar

1. Creamos el directorio de PHP en windows `C:\Program Files\PHP\`

2. Descomprimimos el paquete `php-7.2.7-Win32-VC15-x64` en el directorio recien creado

3. Renombramos `php.ini-development` por `php.ini`

4. Agregamos la siguiente linea en el archivo `C:\Program Files\Apache\conf\httpd.conf`

~~~
#BEGIN PHP INSTALLER EDITS - REMOVE ONLY ON UNINSTALL
PHPIniDir "C:/Program Files/PHP"
LoadModule php7_module "C:/Program Files/PHP/php7apache2_4.dll"
#END PHP INSTALLER EDITS - REMOVE ONLY ON UNINSTALL
~~~

5. Remplazamos la siguiente linea

~~~
#
# DirectoryIndex: sets the file that Apache will serve if a directory
# is requested.
#
<IfModule dir_module>
    DirectoryIndex index.html
</IfModule>
~~~

~~~
<IfModule dir_module>
    DirectoryIndex index.php index.html
    AddType application/x-httpd-php .php
    AddType application/x-httpd-php-source .phps
</IfModule>
~~~

## Configurar

Para realizar las configuraciones persistentes se debera editar el archivo de configuracion  `php.ini` ubicado en el directorio  `C:\Program Files\PHP\`

**Codificación de caracteres**

~~~
default_charset = "UTF-8"
~~~

**Tamaño maximo de subida**

~~~
upload_max_filesize = 25M
~~~

**Compresion transparente**

Ahorra ancho de banda al usar el algoritmo de compression gzip, sin embargo tiene que ser habilitado de forma manual. 

~~~
zlib.output_compression = On
zlib.output_compression_level = 9
~~~
Al estar activa la compresion el servidor envia un header **Content-Encoding: gzip**

**Depuracion de errores**

Estas opciones estan definidas para para depuracion y deberan ser cambiadas para produccion

~~~
error_reporting = E_ALL & ~E_NOTICE
display_errors = On
display_startup_errors = On
~~~

## Referencias

* http://php.net/manual/es/ini.core.php
* http://php.net/manual/es/security.magicquotes.php (depreciado)
* http://php.net/manual/es/ini.core.php#ini.allow-call-time-pass-reference (depreciado)

## Autores

* [Angel González](https://github.com/mgrc45)

## Licencia

Este proyecto está licenciado bajo la licencia GNU General Public License v2.0.
