# 📦 Laravel Shop Application – Setup Guide

This guide provides step-by-step instructions for setting up and running the Laravel Shop application using Docker.

---

## ✅ Step 1: Build Docker Containers

Build all necessary containers using:

```bash
docker-compose build
```

This command compiles the Docker environment as defined in the `docker-compose.yml` file.

---

## 🚀 Step 2: Start the Application

Start all containers and run the application with:

```bash
docker-compose up
```

---

## 🛠 Step 3: Run Database Migrations

Access the application container by running:

```bash
docker exec -it shop-app-1 bash
```

Inside the container, run the following command to reset and migrate the database:

```bash
php artisan migrate:fresh
```

After the migrations complete, you can exit the container:

```bash
exit
```

---

## 🧪 Step 4: Generate Dummy Shop Data

From your **host machine**, generate sample products, variants, and images using the following Artisan command:

```bash
php artisan app:generate-dummy-shop-data --products=100 --variants=2000 --images=200
```

This command will create:
- 100 products
- 2000 variants
- 200 images

---

### 🌐 5. View the Local Application

You can access the application in your browser via:

```
http://localhost:8080/
```

---

## 🧹 Step 6: Clear Shop Data (Optional)

To remove all generated data from the database, run:

```bash
php artisan app:clear-shop-data
```

This will delete all products, variants, and related images.

---

✅ Your Laravel Shop application is now ready with sample data or cleaned up using the optional command.  
Feel free to contribute, test, or explore the project further!