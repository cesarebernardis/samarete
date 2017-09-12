DOCKER
Per emulare un server WEB � stato utilizzato Docker
Date le molte limitazioni in termini di compatibilit� della versione completa,
� consigliato scaricare la Docker Toolbox (https://www.docker.com/products/docker-toolbox).

Una volta scaricata e installata, baster� creare la vostra build:
- Aprite la docker toolbox
- Da linea di comando raggiungete la cartella default di questa directory
ad esempio: "cd C:/Users/nomeutente/Documents/GitHub/samarete/docker/default"
- Lanciare il comando "docker-build" e attendere che termini (� necessaria una connessione a internet)

A questo punto la vostra build � pronta per l'uso.
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
Una volta creata, non sar� pi� necessario ricrearla (salvo malfunzionamenti).
Al contrario, ogni volta che la macchina viene arrestata, volontariamente o involontariamente
(per esempio dopo un riavvio o uno spegnimento del computer), deve essere avviata.