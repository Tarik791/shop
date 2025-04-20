📦 Application Setup Guide
Follow the steps below to build and run the application using Docker:

✅ 1. Build Docker Containers
bash
docker-compose build
This command builds all the necessary containers defined in the docker-compose.yml file.

🚀 2. Start the Application
bash
docker-compose up
This starts all containers and runs the application.

🛠 3. Run Database Migrations
Open a terminal session inside the running container:

bash
docker exec -it shop-app-1 bash
Then run the following command to migrate and reset the database:

bash
php artisan migrate:fresh
After that, you can exit the container with:

bash
exit
🧪 4. Generate Dummy Shop Data
Run the following Artisan command from your host machine:

bash
php artisan app:generate-dummy-shop-data --products=100 --variants=2000 --images=200
This will generate 100 products, each with multiple variants and images.

🧹 5. Clear Shop Data (Optional)
If you want to clear all the generated shop data, you can run the following Artisan command:

bash
php artisan app:clear-shop-data
This will delete all the products, variants, and images from the database.

Your application is now ready with sample shop data, or cleared if you ran the cleanup command. ✅