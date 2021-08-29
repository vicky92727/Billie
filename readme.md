# Billie Project

### **Description**

This will create a dockerized stack for a Laravel application, consisted of the following containers:
-  **app**, your PHP application container

        Nginx, PHP7.4 PHP7.4-fpm, Composer, NPM, Node.js v10.x
    
-  **mysql**, MySQL database container ([mysql](https://hub.docker.com/_/mysql/) official Docker image)

#### **Directory Structure**
```
+-- src <project root>
+-- resources
|   +-- default
|   +-- nginx.conf
|   +-- supervisord.conf
|   +-- www.conf
+-- .gitignore
+-- Dockerfile
+-- docker-compose.yml
+-- readme.md <this file>
```

### **Setup instructions**

**Prerequisites:** 

* Depending on your OS, the appropriate version of Docker Community Edition has to be installed on your machine.  ([Download Docker Community Edition](https://hub.docker.com/search/?type=edition&offering=community))

**Installation steps:** 

1. Create a new directory in which your OS user has full read/write access and clone this repository inside.

2. Create two new textfiles named `db_root_password.txt` and `db_password.txt` and place your preferred database passwords inside:

    ```
    $ echo "myrootpass" > db_root_password.txt
    $ echo "myuserpass" > db_password.txt
    ```

3. Open a new terminal/CMD, navigate to this repository root (where `docker-compose.yml` exists) and execute the following command:

    ```
    $ docker-compose up -d
    ```

    This will download/build all the required images and start the stack containers. It usually takes a bit of time, so grab a cup of coffee.

4. After the whole stack is up, enter the app container and install the Laravel framework:

    **Laravel**

    ```
    $ docker exec -it applaravel bash
    $ composer install
    $ nano .env (Change db credentials gicen below)
    $ php artisan migrate:fresh
    $ composer test 

    Important Note : after running composer test don't forget to run migration command because we are using mysql as db for testing that flushing our data on each test run, we can use sqlite for testing but for time being we are not using it.

    ```

5. That's it! Navigate to [http://localhost](http://localhost) to access the application.
    **User Register Endpoint**
    ```

    End Point =  http://localhost/api/register
    Mehtod = POST
    Request Body

    {
        "name" : "waqas",
        "email" : "waqas@gmail.com",
        "password" : 123456
    }
    ```
**User Login Endpoint** 

```
    End Point =  http://localhost/api/login
    Mehtod = POST
    Request Body

    {
        "email" : "waqas@gmail.com",
        "password" : 123456
    }

```

**Create Company Endpoint** 

```
    End Point =  http://localhost/api/companies
    Mehtod = POST
    Request Body

    {
        "title" : "WHBx",
        "email" : "whafeez25@whbx.co",
        "phone" : "+923464535533",
        "address" : "14, Mehmood Park Shahdara Town Lahore Pakistan",
        "type" : 1,
        "debtor_limit" : 5
    }

```

**Create Invoice Endpoint** 

```
    End Point =  http://localhost/api/invoices
    Mehtod = POST
    Request Body

    {
        "title" : "Purchase of Computers",
        "detail" : "purchase of laptops and computers at wholesale",
        "company_id" : "6",
        "status" : 1,
        "invoice_to" : "M/s Hafeez Ahmad, 43, Gulberg 3 Lahore, 0987879789",
        "invoice_number" : "25d55a",
        "invoice_date" : "2021-08-28",
        "invoice_due_date" : "2021-08-31",
        "invoice_total" : "1050"
    }

```

**Update Invoice Endpoint** 

```
    status = 1 means unpaid and status = 2 menas paid

    End Point =  http://localhost/api/invoices/{id}
    Mehtod = POST
    Request Body

    {
        "status" : 2
    }

```

**Default configuration values** 

The following values should be replaced in your `.env` file if you're willing to keep them as defaults:
    
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=appdb
    DB_USERNAME=user
    DB_PASSWORD=myuserpass
    
**Best Practice** 
I've used repository pattern and followed SOLID priniciples while designing and development of API for this solution.