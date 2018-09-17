## Cómo resetear la contraseña del usuario root de MySQL Server

**Para Windows realizar lo siguiente:**

1. Sí MySQL Server está instalado como servicio. Detener el servicio
2. Abrir una consola de comandos `cmd`
3. Ir al directorio de instalación de MySQL Server `C:\Program Files\MySQL\MySQL Server 5.7\bin`
4. Ejecutar el siguiente comando: 

~~~    	
mysqld --skip-grant-tables & 
~~~

5. Abrir otra consola de comandos `cmd`
6. Ingresar a la consola de administración de MySQL con el comando:

~~~
mysql -u root
mysql>use mysql;
mysql>update user set password=PASSWORD("nuevaClave") where user='root';
mysql>flush privileges;
mysql>quit;
~~~

7. Finalmente, cerrar la consola de comandos abierta en el paso 2 e iniciar nuevamente el servicio de MySQL Server.
