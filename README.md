## Mon API

### Description:

- lancer "composer install"
- lancer "php artisan migrate"
- lancer "php artisan tinker"
- lancer depuis tinker "factory(App\User::class)->create();"

### sur postman :

- récupérer un jeton de connexion "http://localhost/mon-api/public/api/v1/user/login"
- dans body->form-data ajoutez les clés *email = "contact@contact.com", password = password*
- récupérer le jeton dans access-token
- dans headers ajoutez la clé *Authorization = "Bearer mon_jeton"*
- "http://localhost/mon-api/public/api/v1/pokemon/all" permet de récuperer la liste détaillé des pokemons
- "http://localhost/mon-api/public/api/v1/pokemon/{id}" permet de récuperer le détaille d'un pokemon

### Note et Amélioration

- L'authentification à été gérer avec le package laravel/passport
- Les requetes peuvent étre améliorer en utilisant les promesse de guzzle afin d'avoir des requêtes asynchrone