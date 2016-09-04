This is SLM.

#Migration Sequence :

    
User Module

    php artisan migrate --path="app/modules/user/database/migrations/"


SLM Module

    php artisan migrate --path="app/modules/slm/database/migrations/"
    
    For every new user need permission to 'user-logout' routes