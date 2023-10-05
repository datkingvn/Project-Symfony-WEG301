# Project Web Advertisements - Symfony

## Initialize the Project

Use the code below to initialize the project

```bash
composer install
```

## Initialize the DATABASE_URL in the .env file

In the `.env` file, make sure to update the `DATABASE_URL`

```bash
# .env
DATABASE_URL=mysql://root:@127.0.0.1:3306/product_store?serverVersion=mariadb-10.4.11
```

## Create the Database

Run the following command to create the database:
```bash
php bin/console doctrine:database:create
```

## Update the Database
````bash
php bin/console doctrine:migrations:migrate
````
Check `PHPMyAdmin` to see the table

![alt](https://i.imgur.com/w8I8r6U.png)

## Start Server
After completing the above steps, start the server
````bash
symfony serve
````
When you see the interface like below, it means you have successfully installed:

![alt](https://i.imgur.com/3SxEhgU.png)

## Set Role Admin

Access `PHPMyAdmin` and select Database and choose `Users` table and follow as below:

![alt](https://i.imgur.com/QAE0xxJ.png)

## Below is the link for Admin
Control `Advertisements`
````bash
https://localhost:8000/admin/advertisements/ 
````
Control `Categories`
````bash
https://localhost:8000/admin/categories/ 
````

## Below is the link for User
Login
````bash
https://localhost:8000/login
````
Register
````bash
https://localhost:8000/register
````
Profile
````bash
https://localhost:8000/users
````
Post New Advertisement
````bash
https://localhost:8000/users/advertisements/add
````
## API Show List Advertisements
````bash
https://localhost:8000/api/advertisements/
````

This is a project with `Symfony`, you can improve it to make it more modern. Have a nice day! 