## Getting Started

### Installation

1. Clone the repository:
2. Install PHP dependencies:
   ```bash
    composer install
3. Copy the example environment file and generate app key:
   ```bash
    cp .env.example .env
    php artisan key:generate
4. Run database migrations and Seed the database with test data:
   ```bash
    php artisan migrate
    php artisan migrate:fresh --seed
   This will:

It will create: 

Admin user with email "vlad_admin@test.com" and password "1234".

User types - admin/client

Create test 15 products

5. Install front-end dependencies:
   ```bash
    npm install
    npm run dev     
Local Development Setup

The project uses Laravel Herd for PHP runtime.

For the database, a Docker container is used.

6. To start the MySQL container:
   ```bash
     docker-compose up --build
Note: You can create additional test users via the registration form.
All new users will be assigned the client type and will not have access to the admin panel.
