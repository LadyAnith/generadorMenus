::Eliminar archivos de migracion previos
::del /S migrations\*.php

::Esto crea la base de datos
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create

::Esto crea la migracion
::php bin/console make:migration

::Esto aplica la migracion
php bin/console doctrine:migrations:migrate --no-interaction