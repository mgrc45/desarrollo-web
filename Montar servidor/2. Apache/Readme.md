## Instalación de Apache en Windows 10

Apache es uno de los servidores web más utilizados a nivel mundial por su estabilidad y desempeño. Es nativo en la mayoría de distribuciones linux y da origen a diferentes proyectos como **ApacheHaus**, **Apache Lounge**, **BitNami WAMP Stack**, **WampServer**, **XAMPP** entre otros.

La ultima version del proyecto se puede descargar desde la pagina [apache.org](http://httpd.apache.org/download.cgi) sin embargo dentro de las [versiones archivadas](http://archive.apache.org/dist/httpd/binaries/win32/) el ultimo binario compilado para windows [httpd-2.2.25-win32-x86-openssl-0.9.8y.msi](http://archive.apache.org/dist/httpd/binaries/win32/httpd-2.2.25-win32-x86-openssl-0.9.8y.msi) corresponde a la version 2.2.25 que si bien ofrece un paquete de instalacion MSI. Es una version compilada en el 2013 y no es conveniente por cuestiones de seguridad.

Motivo por el cual usaremos una version compilada de terceros [apachelounge.com](http://www.apachelounge.com/download/) esta version requiere instalar un componente de Visual Studio para tener las librerias de C++ disponibles, ademas de una instalacion manual. Sin embargo es una version mas reciente 2.4.34 compilada para sistemas de 64 bits y con las ultimas actualizaciones de seguridad.

## Descargar

* VC15: [Visual C++ Redistributable for Visual Studio 2017](https://go.microsoft.com/fwlink/?LinkId=746572)
* Paquete de Apache 2.4 compilado para windows [httpd-2.4.34-win64-VC15.zip](http://home.apache.org/~steffenal/VC15/binaries/httpd-2.4.34-win64-VC15.zip)

## Instalar

1. Creamos el directorio de Apache en windows `C:\Program Files\Apache\`

2. Descomprimimos el contenido de `httpd-2.4.34-win64-VC15.zip\Apache24\` en el directorio recien creado

3. Cambiamos la ruta del servidor dentro del archivo de configuracion `C:\Program Files\Apache\conf\httpd.conf`

~~~
Define SRVROOT "C:/Program Files/Apache"
~~~

4. Ejecutamos la consola `cmd` como administrador

5. Entramos al directorio de Apache `C:\Program Files\Apache\`

6. Instalamos apache como servicio de windows, para desinstalar puede usar `bin\httpd.exe -k uninstall`

~~~
bin\httpd.exe -k install -n "Apache Server"
~~~

7. De forma automatica el instalador crea una excepcion para el firewall sin embargo agrego (Opcional)

~~~
NETSH advfirewall firewall add rule name="Apache Server 2.4" program="C:\Program Files\Apache\bin\httpd.exe" protocol=TCP localport=80 dir=in action=allow enable=yes
~~~

## Configurar

1. Entrar al directorio de Apache `C:\Program Files\Apache\`

2. Editar el archivo de configuración como administrador  `conf\httpd.conf`

3. Cambiar la ubicación del directorio raiz

~~~
#
# DocumentRoot: The directory out of which you will serve your
# documents. By default, all requests are taken from this directory, but
# symbolic links and aliases may be used to point to other locations.
#
DocumentRoot "${SRVROOT}/htdocs"
~~~

~~~
DocumentRoot "C:/Users/Usuario/Google Drive/www"
~~~

4. Cambiar la ubicación de la carpeta donde tomara los archivos

~~~
<Directory "${SRVROOT}/htdocs">
    #
    # Possible values for the Options directive are "None", "All",
    # or any combination of:
    #   Indexes Includes FollowSymLinks SymLinksifOwnerMatch ExecCGI MultiViews
    #
    # Note that "MultiViews" must be named *explicitly* --- "Options All"
    # doesn't give it to you.
    #
    # The Options directive is both complicated and important.  Please see
    # http://httpd.apache.org/docs/2.4/mod/core.html#options
    # for more information.
    #
    Options Indexes FollowSymLinks

    #
    # AllowOverride controls what directives may be placed in .htaccess files.
    # It can be "All", "None", or any combination of the keywords:
    #   AllowOverride FileInfo AuthConfig Limit
    #
    AllowOverride None

    #
    # Controls who can get stuff from this server.
    #
    Require all granted
</Directory>
~~~

~~~
<Directory "C:/Users/Usuario/Google Drive/www">
    Options +FollowSymLinks -ExecCGI -Includes -Multiviews -Indexes
    AllowOverride All
    Require all granted
    #Require not ip 10.252.46.165
</Directory>
~~~

| Configuración | Descripción |
| --- | --- |
| Require | Controla el acceso de a los clientes filtrando por ip o host |
| AllowOverride | Cuando el valor de esta directiva es None, entonces los ficheros .htaccess son ignorados |

**Options**

| Configuración | Descripción |
| --- | --- |
| ExecCGI | Permite la ejecución de scripts CGI usando mod_cgi |
| FollowSymLinks | El servidor seguirá los enlaces simbólicos en este directorio sin revisar en el sistema de archivos, implica el uso de "Alias" y "RewriteEngine" |
| Includes | Permite el uso de Server-side usando mod_include. Permite agregar variables que serán remplazados por valores del servidor |
| Indexes | Devolverá una lista con los contenidos del directorio usando mod_autoindex |
| MultiViews | Devuelve contenido diferente de forma transparente usando mod_negotiation su uso se puede observar en el header "Content-Location:" |

5. Por seguridad evitamos mostrar la version del servidor

~~~
ServerTokens ProductOnly
~~~

6. Podemos elegir la codificación predeterminada de caracteres

~~~
AddDefaultCharset utf-8
~~~

**Referencias**
* http://httpd.apache.org/docs/2.4/howto/ssi.html
* http://httpd.apache.org/docs/2.4/platform/windows.html
* http://httpd.apache.org/docs/2.4/mod/core.html#options
* http://httpd.apache.org/docs/2.4/en/howto/access.html#host

## Autores

* [Angel González](https://github.com/mgrc45)

## Licencia

Este proyecto está licenciado bajo la licencia GNU General Public License v2.0.
