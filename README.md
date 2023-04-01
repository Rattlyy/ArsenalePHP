# ArsenalePHP
Piccolo progetto che ho realizzato per un compito scolastico.

Tutti i file in "public/scuola" sono commentati, il sito è una pagina informativa per l'Arsenale di Taranto, contenente la storia e una descrizione.

Ho scritto un sistema modulare per caricare le pagine richieste, usando un singolo file php con un router che importa poi codice PHP da altri file in base al parametro query "pagina" per evitare di ripetere il codice base per layout e footer.

## Stack
- [Caddy](https://caddyserver.com/): Reverse Proxy + PHP (FastCGI) + SSL impostato in automatico, inoltre si configura molto piu semplicemente di altre alternative (NGINX, Apache).
- [Docker & Docker-Compose](https://www.docker.com/): Semplifica l'installazione di tutti i programmi (Caddy, FastCGI etc.) installando tutto su una Virtual Machine, docker-compose serve per configurare ogni container in modo molto piu semplice di docker normale. 
- [MariaDB](https://mariadb.org/): Non utilizzato al momento sul progetto, verrà usato in futuro.
- [Redis](https://redis.io/): Non utilizzato al momento sul progetto, verrà usato in futuro.
- [Adminer](https://www.adminer.org/): PHPMyAdmin ma meno pesante.
- [Hydra](https://github.com/Niyko/Hydra-Dark-Theme-for-Adminer): Tema material per adminer, si trova in config/adminer/adminer.css.
- [Bulma](https://bulma.io/): Framework CSS che mi ha semplificato la vita, include tantissimi componenti e layout già stilati.
