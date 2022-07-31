# invitation-systems
This project runs on PHP 8.1*

This is a customised <**JWT Token**> based php REST API framework for sending and reacting with this request.

### Create .env
```bash 
    1.  change .env.example to ".env".
```

### Composer Update :
```bash
composer update
```

### System run :
```bash
php -S localhost:8000
```

### API end point :
Login and get Token POST
```bash
localhost:8000/login
```

Logout and destroy Token POST
```bash
localhost:8000/logout
```

Sending Request POST
```bash
localhost:8000/invite
```

Update Request PUT
```bash
localhost:8000/invite
```
