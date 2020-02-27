## Visión general

El proyecto consiste en poder realizar ordenes de pizzas, teniendo la posibilidad de personalizar pizzas y poder realizar la orden con pizzas personalizadas.

También hay una parte de administración, donde se puede ver los clientes más frecuentes, los que más gastan en la pizzería, los ingredientes más populares y se pueden administrar usuarios, así mismo, generar un reporte en Excel de los usuarios.

El proyecto se ha realizado con 

[Laravel]: https://laravel.com/

 y 

[Vue.js]: https://vuejs.org/



## Instrucciones 

Después de haber clonado el proyecto se procede a realizar la instalación de las dependencias

```powershell
composer install
```

```
npm install
```

Se debe configurar el archivo `.env` para establecer la conexión a la base de datos. Además, se debe generar la clave del proyecto.

```
php artisan key:generate
```

Luego, se deben ejecutar las migraciones junto con los seeders para que se genere la estructura de la base de datos y hayan registros para poder manipular.

```
php artisan migrate --seed
```



Los datos de los usuarios son:

**Principal:** (Administrador)

​	Usuario: admin@mail.com

​	Contraseña: admin

**Andrea Orellana** (Cliente)

​	Usuario: andrea@mail.com

​	Contraseña: secret

**Jimmy Rosales** (Cliente)

​	Usuario: jimmy@mail.com

​	Contraseña: secret