echo "Actualizando IspControl"
git reset --hard
git pull
composer=$1
if [ "$composer" == "composer" ]; then
               echo "Se Actualizara Composer"
               php composer.phar self-update
               php composer.phar update
fi
#php app/console doctrine:schema:update --dump-sql --force
#php app/console doctrine:fixtures:load --append
php bin/console cache:clear --env prod
chmod 755 index.php
chmod 755 web/app.php
chmod 755 web/app_dev.php
chmod 755 update.sh
