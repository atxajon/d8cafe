Custom Drupal 8 migrate plugin to import drupal cafe 7 entities.

Run the migrations with the following drush command:

drush migrate-manifest manifest.yml --legacy-db-url=mysql://{dbuser}:{dbpass}@localhost/{dbname}

drush migrate-manifest /Applications/MAMP/htdocs/d8cafe/modules/custom/migrate_custom/manifest.yml --legacy-db-url=mysql://root:root@localhost/d7cafe