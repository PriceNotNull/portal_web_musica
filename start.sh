#!/bin/bash
echo "🚀🚀🚀🚀 Ejecutando start.sh..🚀🚀🚀🚀"

php artisan storage:link || echo "⚠️ Falló al crear el symlink"
php artisan config:cache
php artisan serve --host=0.0.0.0 --port=8000