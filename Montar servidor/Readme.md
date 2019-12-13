## Montar servidor WAMP

Al definir la arquitectura de un servidor web, se puede recurrir a software privado como Microsoft IIS, o 
en su defecto a software libre como Apache. Siendo este último de una mayor popularidad en servicios de
alojamiento web por el ahorro que representa el pago de licencias.

Quizas una de las configuraciones más usadas para montar un servidor con Apache sea:

| Software | Descripción |
| --- | --- |
| Linux | Sistema Operativo |
| Apache | Servidor de paginas web |
| PHP | Lenguaje de procesamiento |
| MySQL | Base de datos |

Esta configuración es mejor conocida en la industria por el acrónimo **LAMP** (Linux, Apache, Mysql, Php).
La cual servirá como referencia para determinar las versiones a utilizar buscando.

* **Compatibilidad**: Debe existir una correspondencia entre versiones para poder integrarse. 
Por citar un ejemplo, no podemos elegir una versión de MySQL tan nueva que no sea soportada por PHP.

* **Disponibilidad**: Las versiones elegidas deben estar disponibles para los principales sistemas operativos.
Para el caso específico de este documento consideramos Ubuntu, Debian y Windows.

* **Estabilidad**: Para determinar las versiones más estables consideramos su fecha de lanzamiento, fecha de modificación y
valor de la subversión.

Tras superar las anteriores consideraciones, buscamos la version mas reciente para poder disfrutar de las ultimas innovaciones, 
así como procurar el menor impacto al código que puedan presentar futuros cambios en la sintaxis o la depreciación de 
alguna librería.

### Revisión de versiones

La presente revisión se realizó el **12 de diciembre de 2019** bajo los criterios publicados en el apartado anterior.
Tomando inicialmente **Ubuntu LTS 18.04.2** por ser una distribución de Linux ampliamente utilizada, además de estar
orientada a la estabilidad por ser una versión con soporte de largo plazo **LTS** (Long Term Support).

Por ultimo cabe destacar que empleamos únicamente los repositorios soportados oficialmente **main**, evitando *restricted*, 
*universe* y *multiverse*.

1. Obtener las últimas versiones estables disponibles para Linux

```
apt search apache

apache2/bionic-updates 2.4.29-1ubuntu4.11 amd64
  Servidor HTTP Apache

apache2-ssl-dev/bionic-updates 2.4.29-1ubuntu4.11 amd64
  Apache HTTP Server (mod_ssl development headers)

apt search php

php/bionic,bionic 1:7.2+60ubuntu1 all
  server-side, HTML-embedded scripting language (default)

php-mysql/bionic,bionic 1:7.2+60ubuntu1 all
  MySQL module for PHP [default]

php7.2/bionic-updates,bionic-updates 7.2.24-0ubuntu0.18.04.1 all
  server-side, HTML-embedded scripting language (metapackage)

php7.2-mysql/bionic-updates 7.2.24-0ubuntu0.18.04.1 amd64
  MySQL module for PHP

apt search mysql

mysql-client-5.7/bionic-updates 5.7.28-0ubuntu0.18.04.4 amd64
  Binarios del cliente de bases de datos MySQL

mysql-server/bionic-updates,bionic-updates 5.7.28-0ubuntu0.18.04.4 all
  Servidor de base de datos MySQL (metapquete que depende de la última versión)

mysql-server-5.7/bionic-updates 5.7.28-0ubuntu0.18.04.4 amd64
  datos binarios de la base de datos del servidor MySQL y base de datos de configuración del sistema
```
2. Comparamos las ultimas versiones

| Versión | Windows x64 | Ubuntu | Debian 10 |
| --- | --- | --- | --- |
| Apache 2.4 | 41 | 29 | 38 |
| MySQL 5.7 | 28 | 28 | 27 |
| PHP 7 | 3.9 | 2.24 | 3.69 |

Con la finalidad de incrementar la compatibilidad usaremos la versión **7.2.24** de PHP mismo que continua en revision.

3. Examinamos la fecha de última modificación de cada paquete para **Windows x64**

| Apache 2.4.41 | MySQL 5.7.28 | PHP 7.2.24 |
| --- | --- | --- |
| [2019-08-14](https://www.apachelounge.com/download/VS16/binaries/httpd-2.4.41-win64-VS16.zip) | [2019-09-30](http://mirror.csclub.uwaterloo.ca/mysql/Downloads/MySQL-5.7/mysql-5.7.28-winx64.zip) | [2019-10-22](https://windows.php.net/downloads/releases/archives/php-7.2.24-Win32-VC15-x64.zip) |

Paquetes necesarios
> [Microsoft Visual C++ 2015-2019 Redistributable](https://aka.ms/vs/16/release/vc_redist.x64.exe)

## Referencias

* https://packages.debian.org/search?keywords=php
* https://packages.ubuntu.com/search?keywords=php
* https://windows.php.net/downloads/releases/archives/
* http://mirror.csclub.uwaterloo.ca/mysql/Downloads/MySQL-5.7/

## Autores

* [Angel González](https://github.com/mgrc45)

## Licencia

Este proyecto está licenciado bajo la licencia GNU General Public License v2.0.
