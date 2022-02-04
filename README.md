# Especioficacion para desp`liegue

# Comando despliegue tablas y seed
php artisan migrate --seed
#   Ejecuta miracion de esquema de tablas (opcional)
php artisan migrate
# Ejecuta Seeders de usarios (opcional)
php artisan db:seed

# Los usarios registratos incial son: 
admin@test.com      -> rol administrador
user@test.com       -> rol usuario común

