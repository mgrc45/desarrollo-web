# Cómo resetear la contraseña del usuario root de MySQL Server

## Desde windows

Para Windows realizar lo siguiente:

- Sí MySQL Server está instalado como servicio. Detener el servicio
- Abrir una consola de comandos `cmd`
- Ir al directorio de instalación de MySQL Server `C:\Program Files\MySQL\MySQL Server 5.7\bin`
- Ejecutar el siguiente comando: 

~~~    	
mysqld --skip-grant-tables & 
~~~

- Abrir otra consola de comandos `cmd`
- Ingresar a la consola de administración de MySQL con el comando:

~~~
mysql -u root
mysql>use mysql;
mysql>update user set password=PASSWORD("nuevaClave") where user='root';
mysql>flush privileges;
mysql>quit;
~~~

Finalmente, cerrar la consola de comandos abierta en el paso 2 e iniciar nuevamente el servicio de MySQL Server.
