#!/bin/bash
echo "=== Creando enlace simbólico ==="
php artisan storage:link
php artisan config:cache
php artisan serve --host=0.0.0.0 --port=8000