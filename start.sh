#!/bin/bash

# Crear enlace simbólico para la carpeta storage/public (solo si no existe)
if [ ! -L public/storage ]; then
    php artisan storage:link
fi

# Iniciar el servidor Laravel
php artisan serve --host=0.0.0.0 --port=8000
