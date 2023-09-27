# Requirements

* PHP version 8.1
* Laravel version 10
* MySQL version 8.0.32
* Docker and Docker Compose (if used)

---

# Setup

1. Clone the repository to your local computer:

`git clone https://github.com/PavelFesenkoFirst/test-task.git`

2. Go to the project directory:

`cd your-project/test-task/src/posts`

3. Install dependencies (if necessary):

`composer install`

4. Create an `.env `environment file and customize it according to your configuration.

5. Start the project (if you are using `Docker`):

`docker-compose up -d`

6. Start migrating and populating the database:

`php artisan migrate --seed` 

or 

`docker-compose exec web bash` them `cd posts` and them `php artisan migrate --seed`

