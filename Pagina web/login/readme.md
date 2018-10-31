## Seguridad

El objetivo de la seguridad informática es mantener los datos alejados de aquellos que no les corresponda, como regla general "Darles solo la información necesaria para trabajar". 

**La seguridad cambia con el tiempo y se adapta al contexto**

Hace algunos años con 4 caracteres era suficiente para una aplicación web, pero actualmente se requiere al menos 6 caracteres para considerar una contraseña segura.

Los niveles de seguridad implementados varían de acuerdo a la importancia de la información a resguardar. No es lo mismo la seguridad de un foro web, que el uso de la banca en línea.

**Usabilidad vs Seguridad**

El estándar es diseñar un inicio de sesión basado en nombre de usuario y contraseña. Pero si una empleada es una persona mayor deberá ser tan sencillo que únicamente requiera de una contraseña débil.

Es por este motivo que este ejemplo maneja diferentes características/niveles de seguridad para poder volverla tan simple o tan segura como usted requiera.

### Horas hábiles

Entre las medidas de seguridad específicas, implemente una que permita acceder únicamente en horarios específicos de trabajo. Bajo la premisa que al disminuir el umbral de tiempo, disminuira el riesgo.

Sin embargo, esta medida fue depreciada por requerir la constante intervención de un administrador para realizar cambios.
* Actualizar los valores de inicio y fin de la sesión para cubrir los cambios de turnos
* Contemplar las horas extra en el valor de fin de cada sesión

En caso de justificar la implementación de esta característica, dejo a continuación el esquema de la tabla y código.

| Campo | Tipo | Nulo | Predefinido | Descripción |
|---|---|---|---|---|
| enable_days | SET('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado') | 0 | "" | |
| enable_Ihrs | TINYINT UNSIGNED | 0 | 8 | |
| enable_Fhrs | TINYINT UNSIGNED | 0 | 16 |	|
| duration_hrs | TINYINT UNSIGNED | 0 | 3 | Tiempo límite para la sesión |

**login.php**

```php
$convert_toDay = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
$diaSemana = $convert_toDay[date("w")];

if (strrpos($row["enable_days"], $diaSemana) === false)
{
$error.="Error : El dia de hoy no puede acceder.";
$check = false;
}
if (date("G")<$row["enable_Ihrs"] || date("G")>$row["enable_Fhrs"])
{
$error.="Error : A esta hora no puede acceder.";
$check = false;
}
```

### Bloqueo por IP

Esta medida fue realizada para impedir que equipos de origen desconocido accedieran al sistema, sin embargo, no fue puesta en producción debido a que era una medida que tenía muchos requisitos y en la práctica da más problemas que los que evita.

* El cambio constante de equipos de cómputo, dificulta mantener actualizada una lista de direcciones físicas.
* Se ha demostrado que la dirección IP y MAC son alterables para ciertos especialistas informáticos.

| Campo | Tipo | Nulo | Predefinido | Descripción |
|---|---|---|---|---|
| secure_ip | VARCHAR(33) | 0 | "" |	Rango de IPs permitidas para el acceso. Dejar este campo vacio y dejar "network_access=1".  Implica un acceso desde cualquier IP. |
| remote_ip | VARCHAR(33) | 0 | "" |	Implica un segundo rango de IP s desde el cual podra tener acceso. Posiblemente internet, escribir "%" permite el acceso desde cualquier IP. |
| access_places | VARCHAR(100) | 0 | Sucursales asignadas para iniciar sesión. |

### Permisos

La capacidad de hacer y dejar de hacer algunas funciones. Por ejemplo, para un sistema de cobranza diseñe una propiedad especial para las gestiones de terceros.

| Campo | Tipo | Nulo | Predefinido | Descripción |
|---|---|---|---|---|
| gestiones | SET('read', 'write', 'del') | 1 |	NULL |	Rango de IPs permitidas para el acceso. Dejar este campo vacio y dejar "network_access=1". Implica un acceso desde cualquier IP. |

### Llave de acceso

Este sistema fue realizado para evitar los robots ya que normalmente usan "sistemas tontos" los cuales son muy mecánicos y no aceptan cambios como javascript ó cookies de sesión.

**login.php**

```php
session_start();
if (isset($_SESSION["ses"]["key"])==false)
{//Llave publica de paso
  $_SESSION["ses"]["key"] = randomText(12);
}
```

```php
if (strlen($_POST["key"])<12) {$error.="Error : Llave publica demasiado corta."; $check = false;}
```

```php
if ($_POST["key"] != $_SESSION["ses"]["key"])
{
  $error.="Error : Llave publica incorrecta.";
  sleep(5); //Para evitar robots
  $check = false;
}
```

```php
<body onload="document.getElementsByName('key')[0].value='< ?php
echo htmlentities($_SESSION["ses"]["key"]);
?>';">
```

```php
< input type="hidden" value="" name="key" readonly="true" />
```
