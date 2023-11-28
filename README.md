Для работы маршрутизации на Apache понадобится указать следующие директивы:

    <VirtualHost 127.0.0.4:80>
        ServerAdmin webmaster@localhost
        DocumentRoot /path_to_cloned_repository*/testing_task/src
        ServerName testing_task

        <Directory /path_to_cloned_repository*/testing_task/src>
            Options Indexes FollowSymlinks
            AllowOverride All
            Require all granted
            FallbackResource /index.php
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
    </VirtualHost>

path_to_cloned_repository* - полный путь к папке которая появилась после клонирования репозитория.

Например

    если клонировать репозиторий находясь в папке /var/www/
    - то путь должен быть таким /var/www/testing_task/src

    P.S. для клонирования репозитория в /var/www может понадобиться использовать команду sudo.

Выбор имени сервера и его IP c портом, зависит от ваших предпочтений, но рекомендуется 127.0.0.1:80

Если есть желание обращаться к серверу по имени то необходимо будет прописать в файле hosts расположенному по адресу /etc/hosts следующую строку

    127.0.0.1       testing_task

Для обращения по имени может понадобиться перезапустить устройство.