Para ejecutar el Framework
==========================


1) Cambiar permisos en carpetas
-------------------------------

	chmod -R 777 s2project/app/cache

	chmod -R 777 s2project/app/logs

2) Iniciar el servidor
----------------------

### Apache

 * Habilitar virtual host:
		 
	Verificar que la linea `Include conf/extra/httpd-vhosts.conf` esta descomentada en el archivo httpd.conf en el directorio `apache/conf`
		
 * Agregar el virtual host en el archivo `httpd-vhosts.conf` en la carpeta de `apache/conf/extra/`
	
	<code>
	NameVirtualHost *:80

	<VirtualHost *:80>
		DocumentRoot "<path-to-s2project>/web"
		ServerName nombre.virtual.host
		<Directory  "<path-to-s2project>/web"				
			Options Indexes FollowSymlinks
			AllowOverride All
			Order allow,deny
			Allow from all
		</Directory>
		ErrorLog "logs/project-error_log"
		CustomLog "logs/project-access_log" common
	</VirtualHost>
	</codecode>

 * Iniciar el servidor:
 
	sudo apachectl -k start

 * Confirmar que el servidor arranco: 

	http://localhost

 * Entrar a la aplicacion `http://nombre.virtual.host/app_dev.php`

		
### Built-in server (PHP 5.4)

 * Iniciar el servidor
 	
	php app/console server:run 

 * Entrar a la aplicacion `http://localhost/s2project/web/app_dev.php/`
