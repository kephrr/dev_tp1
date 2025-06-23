# Utilise l'image officielle PHP en version 8.2 avec serveur CLI
FROM php:8.2-cli

# Copie les fichiers du projet dans /app
WORKDIR /app
COPY . /app

# Expose le port 10000 pour Render
EXPOSE 10000

# Commande pour démarrer le serveur PHP intégré sur le port 10000
CMD ["php", "-S", "0.0.0.0:10000", "-t", "/app"]
