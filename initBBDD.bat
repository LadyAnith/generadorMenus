::Ahora con que pongas en la consola initBBDD.bat

::Esto crea la base de datos
php bin/console doctrine:database:create

::Esto crea la migracion
php bin/console make:migration

::Esto aplica la migracion
php bin/console doctrine:migrations:migrate