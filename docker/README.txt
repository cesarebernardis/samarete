DOCKER
Per emulare un server WEB è stato utilizzato Docker
Date le molte limitazioni in termini di compatibilità della versione completa,
è consigliato scaricare la Docker Toolbox (https://www.docker.com/products/docker-toolbox).
(NOTA: con le nuove versioni di Docker, non è più necessario l'utilizzo della toolbox)

Una volta scaricata e installata, basterà creare la vostra build:
- Aprite la docker toolbox
- Da linea di comando raggiungete la cartella default di questa directory
ad esempio: "cd C:/Users/nomeutente/Documents/GitHub/samarete/docker/default"
- Lanciare il comando "docker-build" e attendere che termini (è necessaria una connessione a internet)

A questo punto la vostra build è pronta per l'uso.
Per avviarla:
- Aprite la docker toolbox
- Da linea di comando raggiungete la cartella default di questa directory
ad esempio: cd C:/Users/nomeutente/Documents/GitHub/samarete/docker/default
- Lanciare il comando "docker-compose up -d"

Per arrestarla:
- Aprite la docker toolbox
- Da linea di comando raggiungete la cartella default di questa directory
ad esempio: cd C:/Users/nomeutente/Documents/GitHub/samarete/docker/default
- Lanciare il comando "docker-compose stop"

ATTENZIONE: la creazione della build va eseguita solo la prima volta che la utilizzate.
Una volta creata, non sarà più necessario ricrearla (salvo malfunzionamenti).
Al contrario, ogni volta che la macchina viene arrestata, volontariamente o involontariamente
(per esempio dopo un riavvio o uno spegnimento del computer), deve essere avviata.

Per la prima installazione, è inoltre necessario creare il database dell'applicazione.
- Accedere a phpmyadmin (di default l'indirizzo è http://127.0.0.1:8081) e creare un database vuoto di nome "samarete".
- Lanciare una shell sul container del server apache
  - Aprire un terminale 
  - Eseguire il seguente comando: "docker exec -it default-apache2-1 bash". (Controllare il nome del container in caso di fallimento del comando con "docker container ls".)
- Dalla shell, accedere alla cartella samarete ("cd samarete").
- Lanciare il comando "php artisan migrate".

A questo punto sarà possibile accedere al sito all'indirizzo http://127.0.0.1
