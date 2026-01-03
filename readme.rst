CodeIgniter Assignment Project
==============================

Project Overview
----------------
Ye project CodeIgniter framework par bana hai. Isme ek SQL database file included hai jiska naam ``ci_assignment.sql`` hai. Is project ko aap locally run kar sakte ho after cloning and importing the database.

Requirements
------------
- PHP >= 7.x
- MySQL / MariaDB
- Apache / XAMPP / WAMP
- Git (optional, but recommended)

Step-by-Step Installation
-------------------------

Step 1: Clone the project from GitHub
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Run the following command in terminal or command prompt::

    git clone https://github.com/devendra-dode/codeigniter-assignment.git

Step 2: Navigate to the project folder
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
::

    cd codeigniter-assignment

Step 3: Import the database
~~~~~~~~~~~~~~~~~~~~~~~~~~~
1. Open phpMyAdmin or your MySQL client.
2. Create a new database (e.g., ``ci_assignment_db``).
3. Import the ``ci_assignment.sql`` file located in the project folder::

    # Example using MySQL CLI
    mysql -u your_db_username -p ci_assignment_db < ci_assignment.sql

Step 4: Configure the database
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Open ``application/config/database.php`` and update your MySQL credentials::

    $db['default']['username'] = 'your_db_username'
    $db['default']['password'] = 'your_db_password'
    $db['default']['database'] = 'ci_assignment_db'

Step 5: Configure base URL
~~~~~~~~~~~~~~~~~~~~~~~~~~
Open ``application/config/config.php`` and update::

    $config['base_url'] = 'http://localhost/codeigniter-assignment/'

Step 6: Start your local server
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
- Make sure Apache and MySQL services are running (XAMPP/WAMP).
- Copy the project folder into ``htdocs`` if using XAMPP.

Step 7: Run the project in browser
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Open your browser and visit::

http://localhost/codeigniter-assignment/


Features
--------
- Fully working CodeIgniter project
- SQL file included (``ci_assignment.sql``)
- Easy to configure and run locally
- CRUD functionality (as per assignment requirements)

Troubleshooting
---------------
- Agar database errors aaye, check karein:
  - Database name
  - MySQL username/password
  - ``$config['base_url']`` in ``config.php``
- Ensure PHP version >= 7.x and MySQL service is running
- Clear browser cache if changes not reflecting

Author
------
Devendra Dode
