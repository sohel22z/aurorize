## Laravel 10 with Shreyu Theme

### Push notification types

-   1 => Account created
-   2 => Account approved

### Status codes

-   0 - Error / Message
-   200 - Success
-   401 - Unauthorization (While user account is deactivated)
-   403 - User deleted or Token miss or Token invalid or Token expired or Token required
-   404 - Not found
-   422 - Validation message
-   426 - Force Update
-   500 - Server internal error
-   503 - Under maintenance

### Commands

-   `php artisan schedule:run`
