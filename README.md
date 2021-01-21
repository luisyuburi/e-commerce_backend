

## Requerimientos

- PHP
    - PHP >= 7.3
    - BCMath PHP Extension
    - Ctype PHP Extension
    - Fileinfo PHP Extension
    - JSON PHP Extension
    - Mbstring PHP Extension
    - OpenSSL PHP Extension
    - PDO PHP Extension
    - Tokenizer PHP Extension
    - XML PHP Extension
- Composer

## Despliegue

- Clonar el repositorio
- Copiar el archivo `.env.example` a `.env` en la carpeta raíz del proyecto y modificar las variables según los credenciales de conexión a su base de datos
- Ejecutar `composer install` en la carpeta del proyecto
- Ejecutar `php artisan passport:install` para generar el private key y public key
- Ejecutar el comando `php artisan migrate` para instalar las migraciones
- Ejecutar el comando `php artisan passport:client --personal` para generar el token de Passport
- Ejecutar el comando `php artisan db:seed` para agregar datos de prueba a la base de datos
- Eejcutar el comando `php artisan serve` para lanzar el servidor en modo desarrollo (local)
- Ingresar a la ruta [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation) para ver la documentación y probar los endpoints del API

## Pruebas
 
 Comando de pruebas API REST: `php vendor/bin/codecept run`

