<?php

return [
    'paths' => ['api/*'], // Permet les requêtes sur les routes API
    'allowed_methods' => ['*'], // Autorise toutes les méthodes HTTP (GET, POST, PUT, DELETE, etc.)
    'allowed_origins' => ['http://localhost:5174'], // Ajoute ici l'URL de ton frontend
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Autorise tous les en-têtes HTTP
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];

