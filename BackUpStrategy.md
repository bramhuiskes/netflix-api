# MariaBackup Handleiding

## Cron-Job Instellen
Alle stappen worden gedaan in de terminal van Docker. Om in die terminal te komen, voer volgende commando in:
```bash
docker exec -it c4e817aa3666 bash
```

Mogelijk moet 'cron' worden geïnstalleerd in de terminal van Docker. Voer volgend commando uit.
```bash
apt install cron
```

Daarnaast moet er ook een text-editor worden geïnstalleerd.
```bash
apt install vim
```

### 1. Cron-Job Aanmaken
Open de crontab om een nieuwe taak in te stellen:
```bash
crontab -e
```

De volgende regel is toegevoegd, zodat er een backup elke nacht om 02:00 wordt gemaakt:
```bash
0 2 * * * /usr/bin/mariabackup --backup --target-dir=/usr/bin/backup --user=netflix_user --password=netflix_password

```

Sla het bestand op en sluit de editor. Cron zal nu automatisch de back-ups uitvoeren.

---

## Back-up Terugzetten
Volg deze stappen om een back-up terug te zetten:

### 1. Database Voorbereiden
Stop de MariaDB-server:
```bash
systemctl stop mariadb
```

### 2. Back-up Voorbereiden
Bereid de back-up voor met de volgende opdracht:
```bash
mariabackup --prepare --target-dir=/usr/bin/backup
```

### 3. Back-up Terugzetten
Kopieer de back-up naar de MariaDB-datalocatie:
```bash
mariabackup --copy-back --target-dir=/usr/bin/backup
```

Pas de juiste rechten toe:
```bash
chown -R mysql:mysql /var/lib/mysql
```

### 4. Start de Server
Start de MariaDB-server opnieuw:
```bash
systemctl start mariadb
```

De database zou nu hersteld moeten zijn!
