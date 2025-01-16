# Laravel Docker Setup Usecase Netflix, Data Processing

Group: Bram Huiskes, Gideon Dijkhuis & Yunus Karakoç

To share your Laravel project with the Docker setup on GitHub and ensure others can set it up easily, you need to do the following:

---

## **Prerequisites**

1. Install [Docker](https://www.docker.com/).
2. Install [Composer](https://getcomposer.org/).
3. (Optional) Install a code editor like [PHPStorm](https://www.jetbrains.com/phpstorm/).

---

## **Setup Instructions**

### **Step 1: Clone the Repository**

Clone this repository to your local machine:

```bash
git clone https://github.com/yourusername/laravel-docker-setup.git
cd laravel-docker-setup
```

### **Step 2: Configure Environment Variables**

1. Update the `.env` file with your desired settings if needed.

---

### **Step 3: Start Docker Containers**

Build and start the Docker containers:

```bash
docker-compose up -d
```

---

### **Step 4: Install PHP Dependencies**

Run the following command to install Laravel dependencies:

```bash
docker-compose exec app composer install
```

---

### **Step 5: Run Database Migrations**

Run migrations to create the database structure:

```bash
docker-compose exec app php artisan migrate
```

---

### **Step 6: Run script files**

- If you use Windows, run the file in the root named `WIN_clearCacheAndServe.bat`
- If you use MacOS or Linux, run the scripts inside the file named `MAC_LIN_clearCacheAndServe.sh`

---

### **Step 7: Access the Application**

The application will be available at [http://localhost:8000](http://localhost:8000).

---

## **Additional Commands**

- **Stop Containers**:
  ```bash
  docker-compose down
  ```

- **Run Laravel Artisan Commands**:
  ```bash
  docker-compose exec app php artisan <command>
  ```

- **Access the Docker App Container**:
  ```bash
  docker-compose exec app bash
  ```

---
