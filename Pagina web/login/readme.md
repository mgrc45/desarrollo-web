## Seguridad

El objetivo de la seguridad informatica es mantener los datos alejados de aquellos que no les corresponda, como regla general: "Darles solo la informacion necesaria para trabajar". 

> La seguridad cambia con el tiempo y se adapta al contexto

Hace algunos años con 4 caracteres era suficiente para una aplicacion web, pero actualmente se requiere almenos 6 caracteres para considerar una contraseña segura.

Los niveles de seguridad implementados varian deacuerdo a la importancia de la informacion a resguardar. No es lo mismo la seguridad de un foro web, que el uso de la banca en linea.

Usabilidad vs Seguridad

El estandar es diseñar un inicio de sesion basado en nombre de usuario y contraseña. Pero si una empleada es una persona mayor debera ser tan sencillo que unicamente requiera de una contraseña debil.

Es por este motivo que este ejemplo maneja diferentes caracteristicas/niveles de seguridad para poder volverla tan simple o tan segura como usted requiera.

### Horas habiles

Entre las medidas de seguridad especificas, implemente una que permitiria acceder unicamente en horarios especificos de trabajo. Bajo la premisa de que al disminuir el umbral de tiempo, disminuiria el riezgo.

Sin embargo, esta medida fue depreciada por requerir la constante intervencion de un administrador para realizar cambios.
* Actualizar los valores de inicio y fin de la sesion para cubrir los cambios de turnos
* Contemplar las horas extra en el valor de fin de cada sesion

En caso de justificar la implementacion de esta caracteristica, dejo a continuacion el esquema de la tabla y codigo

| Campo | Tipo | Nulo | Predefinido | Descripción |
|---|---|---|---|---|
| enable_days | SET('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado') | 0 | "" | |
| enable_Ihrs | TINYINT UNSIGNED | 0 | 8 | |
| enable_Fhrs | TINYINT UNSIGNED | 0 | 16 |	|
| duration_hrs | TINYINT UNSIGNED | 0 | 3 | Tiempo limite unicamente para la sesion del portal web. Es una precaucion para evitar que 3ras personas revisen su perfil cuando no cierran su sesion. |

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

