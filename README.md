# Installationsguide

1. Dateien Entpacken/Klonen
1. schema.sql in Datenbank importieren
1. Benutzer für Datenbank erstellen
1. cronjobs/credentials-sample.php kopieren und in credentials.php umbenennen
1. in der credentials.php die richtigen Werte eintragen
1. in der bootstrap.php den basePath anpassen
1. in die crontab **php /cronjobs/load_flats.php** hinzufügen zum täglichen aktualisieren
1. node.js mit npm installieren
1. in den Ordner client gehen und **npm run build .** ausführen