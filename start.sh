#!/bin/bash

# Crear enlace simbólico para la carpeta storage
php artisan storage:link

# Iniciar el servidor Laravel
php artisan serve --host=0.0.0.0 --port=8000
