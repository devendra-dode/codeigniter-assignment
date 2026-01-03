# CodeIgniter Assignment Project

## Project Overview
Ye project CodeIgniter framework par bana hai. Isme ek SQL database file included hai jiska naam `ci_assignment.sql` hai. Is project ko aap locally run kar sakte ho after cloning and importing the database.

---

## Requirements
- PHP >= 7.x
- MySQL / MariaDB
- Apache / XAMPP / WAMP
- Git (optional, but recommended)

---

## Step-by-Step Installation

### Step 1: Clone the project from GitHub
```bash
git clone https://github.com/devendra-dode/codeigniter-assignment.git
Step 2: Navigate to the project folder
bash
Copy code
cd codeigniter-assignment
Step 3: Import the database
bash
Copy code
# 1. Open phpMyAdmin or your MySQL client
# 2. Create a new database (e.g., ci_assignment_db)
# 3. Import the 'ci_assignment.sql' file located in the project folder
Step 4: Configure the database
bash
Copy code
# Open application/config/database.php and update your MySQL credentials
# Example:
$db['default']['username'] = 'your_db_username';
$db['default']['password'] = 'your_db_password';
$db['default']['database'] = 'ci_assignment_db';
Step 5: Configure base URL
bash
Copy code
# Open application/config/config.php and update:
$config['base_url'] = 'http://localhost/ci-ass/';
Step 6: Start your local server
bash
Copy code
# Make sure Apache and MySQL services are running (XAMPP/WAMP)
# Copy the project folder into 'htdocs' if using XAMPP
Step 7: Run the project in browser
bash
Copy code
# Open your browser and visit:
http://localhost/ci-ass/
