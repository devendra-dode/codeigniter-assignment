# Step 1: Clone the project from GitHub
git clone https://github.com/devendra-dode/codeigniter-assignment.git

# Step 2: Navigate to the project folder
cd codeigniter-assignment

# Step 3: Import the database
# 1. Open phpMyAdmin or your MySQL client
# 2. Create a new database (e.g., ci_assignment_db)
# 3. Import the 'ci_assignment.sql' file located in the project folder

# Step 4: Configure the database
# Open application/config/database.php and update your MySQL credentials:
# $db['default']['username'] = 'your_db_username';
# $db['default']['password'] = 'your_db_password';
# $db['default']['database'] = 'ci_assignment_db';

# Step 5: Configure base URL
# Open application/config/config.php and update:
# $config['base_url'] = 'http://localhost/ci-ass/';

# Step 6: Start your local server
# Ensure Apache and MySQL services are running in XAMPP/WAMP
# Copy the project folder into 'htdocs' if using XAMPP

# Step 7: Run the project in browser
# Open your browser and visit:
# http://localhost/ci-ass/
