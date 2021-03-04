# Test Autofact

<img alt="HTML5" src="https://img.shields.io/badge/html5%20-%23E34F26.svg?&style=for-the-badge&logo=html5&logoColor=white"/>
<img alt="CSS3" src="https://img.shields.io/badge/css3%20-%231572B6.svg?&style=for-the-badge&logo=css3&logoColor=white"/>
<img alt="PHP" src="https://img.shields.io/badge/php-%23777BB4.svg?&style=for-the-badge&logo=php&logoColor=white"/>
<img alt="Laravel" src="https://img.shields.io/badge/laravel%20-%23FF2D20.svg?&style=for-the-badge&logo=laravel&logoColor=white"/>
<img alt="Git" src="https://img.shields.io/badge/git%20-%23F05033.svg?&style=for-the-badge&logo=git&logoColor=white"/>
<img alt="GitHub" src="https://img.shields.io/badge/github%20-%23121011.svg?&style=for-the-badge&logo=github&logoColor=white"/>
<img alt="Apache" src="https://img.shields.io/badge/apache%20-%23D42029.svg?&style=for-the-badge&logo=apache&logoColor=white"/>
<img alt="MySQL" src="https://img.shields.io/badge/mysql-%2300f.svg?&style=for-the-badge&logo=mysql&logoColor=white"/>

## Instalación

### Requisitos

* OS: Ubuntu 16.04
* PHP: >= 7.2.5
* RDBMS: Mysql 8.0

Acceder a carpeta de trabajo

```sh
cd -
```

Iniciar versionamiento

```
git init
```

Añadir respositorio

```sh
git remote add origin http://github.com/alemelomeza/test-autofact.git
```

Descargar repositorio

```sh
git pull origin main
```

Instalar librerías 

```sh
rm composer.lock && composer install --no-dev --optimize-autolader
```

Configurar variables de entorno

```sh
cp .env.example .env && nano .env
```

Configurar permisos

```sh
sudo chgrp -R www-data storage/ bootstrap/cache
sudo chmod -R ug+rwx storage/ bootstrap/cache
```

Generar llave

```sh
php artisan key:generate
```

Generar enlace simbólico

```sh
php artisan storage:link
```

Ejecutar migraciones

```sh
php artisan migrate
```

Cargar `seeds`

```sh
php artisan db:seed
```

## Uso

Modo mantención

```sh
# activar
php artisan down
# mensaje
php artisan down --message="mensaje" --retry=60
# permitir IP
php artisan down --allow=127.0.0.1 --allow=192.168.0.0/16
# desactivar
php artisan up
```

Limpiar cache

```sh
# cache aplicación
php artisan cache:clear
# cache rutas
php artisan route:clear
# cache configuración
php artisan config:clear
# cache vistas
php artisan view:clear
```

## Autores

* Alejandro Melo [@alemelomeza](http://github.com/alemelomeza)