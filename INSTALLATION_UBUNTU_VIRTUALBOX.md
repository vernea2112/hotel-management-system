# Hotel Management System - Installation Guide for VirtualBox + Ubuntu Server

## 📋 Prerequisites

### On Your Host Machine
- VirtualBox installed
- At least 4GB RAM allocated to VM
- At least 20GB disk space for Ubuntu Server
- Internet connection

### On Ubuntu Server VM
- Ubuntu Server 20.04 LTS or 22.04 LTS
- Sudo access
- Terminal access

---

## 🖥️ Step 1: Create VirtualBox Machine

### 1.1 Download Ubuntu Server ISO
- Download from: https://ubuntu.com/download/server
- Choose LTS version (22.04 or 20.04)

### 1.2 Create New Virtual Machine
1. Open VirtualBox
2. Click **New**
3. Set these parameters:
   - **Name**: Ubuntu-HMS
   - **Type**: Linux
   - **Version**: Ubuntu (64-bit)
   - **Memory**: 4096 MB (4GB)
   - **Hard disk**: 20GB VDI

### 1.3 Install Ubuntu Server
1. Start the VM
2. Select the Ubuntu ISO file
3. Follow installation wizard:
   - Choose language
   - Configure network (DHCP recommended)
   - Partition disk (use default)
   - Create user account
   - Enable OpenSSH Server (important!)
   - Install updates
4. Reboot when complete

### 1.4 Configure VirtualBox Network
1. **VM Powered Off**
2. Go to **Settings → Network**
3. **Adapter 1**: NAT (for internet access)
4. **Adapter 2**: Host-only (for host machine access)
5. Click **OK** and start VM

---

## 🚀 Step 2: Initial Ubuntu Server Setup

### 2.1 Update System
```bash
sudo apt update
sudo apt upgrade -y
```

### 2.2 Install Essential Tools
```bash
sudo apt install -y \
  git \
  curl \
  wget \
  nano \
  vim \
  build-essential \
  software-properties-common
```

### 2.3 Install PHP and Dependencies
```bash
# Add PHP repository
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update

# Install PHP 8.1 and extensions
sudo apt install -y \
  php8.1 \
  php8.1-cli \
  php8.1-fpm \
  php8.1-mysql \
  php8.1-mbstring \
  php8.1-xml \
  php8.1-zip \
  php8.1-curl \
  php8.1-gd \
  php8.1-bcmath \
  php8.1-tokenizer \
  php8.1-json

# Start PHP-FPM
sudo systemctl start php8.1-fpm
sudo systemctl enable php8.1-fpm
```

### 2.4 Install MySQL Server
```bash
sudo apt install -y mysql-server mysql-client

# Secure MySQL
sudo mysql_secure_installation
```

**Follow the prompts:**
- Set root password: **yes** (enter password, e.g., `hms_root_pass`)
- Remove anonymous users: **yes**
- Disable remote login: **yes**
- Remove test database: **yes**
- Reload tables: **yes**

### 2.5 Install Nginx Web Server
```bash
sudo apt install -y nginx

# Start Nginx
sudo systemctl start nginx
sudo systemctl enable nginx
```

### 2.6 Install Composer
```bash
sudo apt install -y composer

# Verify installation
composer --version
```

---

## 📁 Step 3: Clone and Setup HMS Project

### 3.1 Create Project Directory
```bash
sudo mkdir -p /var/www/hms
sudo chown -R $USER:$USER /var/www/hms
cd /var/www/hms
```

### 3.2 Clone Repository
```bash
git clone https://github.com/vernea2112/hotel-management-system.git .
```

### 3.3 Install PHP Dependencies
```bash
composer install
```

### 3.4 Setup Environment File
```bash
cp .env.example .env
```

### 3.5 Edit .env Configuration
```bash
nano .env
```

**Update these values:**
```env
APP_NAME="Hotel Management System"
APP_ENV=local
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hms
DB_USERNAME=hms_user
DB_PASSWORD=hms_password

MAIL_MAILER=log
```

**Save**: `Ctrl + X` → `Y` → `Enter`

### 3.6 Generate Application Key
```bash
php artisan key:generate
```

### 3.7 Create Database and User
```bash
sudo mysql -u root -p
```

**Enter root password when prompted, then run:**
```sql
CREATE DATABASE hms;
CREATE USER 'hms_user'@'localhost' IDENTIFIED BY 'hms_password';
GRANT ALL PRIVILEGES ON hms.* TO 'hms_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 3.8 Run Database Migrations and Seeders
```bash
php artisan migrate
php artisan db:seed
```

### 3.9 Set Directory Permissions
```bash
sudo chown -R www-data:www-data /var/www/hms
sudo chmod -R 775 /var/www/hms/storage
sudo chmod -R 775 /var/www/hms/bootstrap/cache
```

---

## 🔧 Step 4: Configure Nginx

### 4.1 Create Nginx Configuration
```bash
sudo nano /etc/nginx/sites-available/hms
```

**Paste this configuration:**
```nginx
server {
    listen 80;
    server_name localhost;
    root /var/www/hms/public;

    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;

    index index.php index.html index.htm;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

**Save**: `Ctrl + X` → `Y` → `Enter`

### 4.2 Enable Nginx Configuration
```bash
sudo ln -s /etc/nginx/sites-available/hms /etc/nginx/sites-enabled/hms
sudo rm -f /etc/nginx/sites-enabled/default
```

### 4.3 Test and Restart Nginx
```bash
sudo nginx -t
sudo systemctl restart nginx
```

---

## 🔐 Step 5: Configure Firewall

```bash
# Enable UFW (if not enabled)
sudo ufw enable

# Allow SSH
sudo ufw allow 22/tcp

# Allow HTTP
sudo ufw allow 80/tcp

# Allow HTTPS
sudo ufw allow 443/tcp

# Check status
sudo ufw status
```

---

## 🌐 Step 6: Access Application

### 6.1 Get VM IP Address
```bash
ip addr show
```

Look for the IP address under **eth1** (Host-only adapter), typically `192.168.x.x`

### 6.2 Access from Host Machine
Open browser on your host machine and navigate to:
```
http://192.168.x.x
```

Or if using NAT:
```
http://localhost:8080
```
(Port forwarding must be configured)

### 6.3 Login Credentials

**Admin Account:**
- Email: `admin@hms.com`
- Password: `password123`

**Manager Account:**
- Email: `manager@hms.com`
- Password: `password123`

**Staff Account:**
- Email: `staff@hms.com`
- Password: `password123`

---

## 🧪 Step 7: Verify Installation

### 7.1 Check Database
```bash
mysql -u hms_user -p hms
```

Enter password: `hms_password`

```sql
SHOW TABLES;
SELECT COUNT(*) FROM guests;
SELECT COUNT(*) FROM rooms;
EXIT;
```

### 7.2 Check Laravel Status
```bash
cd /var/www/hms
php artisan tinker
>>> User::count()
>>> exit
```

### 7.3 Test API
```bash
curl -X POST http://localhost/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@hms.com","password":"password123"}'
```

---

## 📝 Step 8: Configure Port Forwarding (Optional)

If you want to access from host machine using `localhost`:

### 8.1 VirtualBox Settings
1. Power off VM
2. Go to **Settings → Network → Adapter 1 (NAT)**
3. Click **Port Forwarding**
4. Add new rule:
   - **Name**: HTTP
   - **Protocol**: TCP
   - **Host Port**: 8080
   - **Guest Port**: 80
   - **Guest IP**: Leave empty

5. Click **OK**
6. Start VM

### 8.2 Access
```
http://localhost:8080
```

---

## 🔄 Step 9: Daily Operations

### Start VM and Services
```bash
# SSH into VM
ssh username@192.168.x.x

# Services should start automatically, verify:
sudo systemctl status nginx
sudo systemctl status php8.1-fpm
sudo systemctl status mysql
```

### Running Artisan Commands
```bash
cd /var/www/hms

# Run migrations
php artisan migrate

# Run seeders
php artisan db:seed

# Clear cache
php artisan cache:clear

# Check logs
tail -f storage/logs/laravel.log
```

### Restart Services
```bash
sudo systemctl restart nginx
sudo systemctl restart php8.1-fpm
sudo systemctl restart mysql
```

---

## 🆘 Troubleshooting

### Problem: Cannot connect to database
**Solution:**
```bash
# Check MySQL is running
sudo systemctl status mysql

# Check credentials in .env
cat .env | grep DB_

# Test connection
mysql -u hms_user -p hms -h 127.0.0.1
```

### Problem: Permission denied errors
**Solution:**
```bash
sudo chown -R www-data:www-data /var/www/hms
sudo chmod -R 775 /var/www/hms/storage
```

### Problem: Page not found (404)
**Solution:**
```bash
# Check Nginx config
sudo nginx -t

# Restart Nginx
sudo systemctl restart nginx

# Check Laravel routes
php artisan route:list
```

### Problem: MySQL import/export errors
**Solution:**
```bash
# Export database
mysqldump -u hms_user -p hms > backup.sql

# Import database
mysql -u hms_user -p hms < backup.sql
```

### Problem: White page / 500 error
**Solution:**
```bash
# Check logs
tail -f /var/www/hms/storage/logs/laravel.log

# Clear cache and config
php artisan config:cache
php artisan cache:clear
php artisan view:clear
```

---

## 📊 Monitoring

### Check System Resources
```bash
# CPU and Memory
top

# Disk usage
df -h

# Memory usage
free -h

# Network
iftop
```

### Check Service Status
```bash
# All services
sudo systemctl status nginx
sudo systemctl status php8.1-fpm
sudo systemctl status mysql

# Check logs
sudo tail -f /var/log/nginx/error.log
sudo tail -f /var/log/nginx/access.log
```

---

## 🔒 Security Best Practices

### 1. Change Default Passwords
```bash
# MySQL root password
sudo mysql -u root -p
ALTER USER 'root'@'localhost' IDENTIFIED BY 'new_strong_password';
FLUSH PRIVILEGES;
EXIT;
```

### 2. Update Environment
```bash
# Set production mode
APP_ENV=production
APP_DEBUG=false
```

### 3. Enable HTTPS
```bash
# Install Certbot
sudo apt install -y certbot python3-certbot-nginx

# Get certificate
sudo certbot certonly --standalone -d your.domain.com
```

### 4. Backup Database Regularly
```bash
#!/bin/bash
# backup.sh
BACKUP_DIR="/var/backups/hms"
DATE=$(date +%Y%m%d_%H%M%S)
mysqldump -u hms_user -p hms > $BACKUP_DIR/hms_$DATE.sql
```

```bash
# Make executable
sudo chmod +x backup.sh

# Add to crontab for daily backups
sudo crontab -e
# Add: 0 2 * * * /var/www/hms/backup.sh
```

---

## 📚 Useful Commands Reference

```bash
# Project directory
cd /var/www/hms

# Laravel commands
php artisan serve                    # Development server
php artisan migrate                  # Run migrations
php artisan db:seed                  # Seed database
php artisan tinker                   # Interactive shell
php artisan route:list               # List routes
php artisan make:controller NameController  # Create controller

# Nginx commands
sudo systemctl start nginx           # Start
sudo systemctl stop nginx            # Stop
sudo systemctl restart nginx         # Restart
sudo systemctl status nginx          # Check status

# MySQL commands
sudo systemctl start mysql           # Start
mysql -u hms_user -p hms            # Connect to database
SHOW DATABASES;                      # List databases
SHOW TABLES;                         # List tables
DESC table_name;                     # Table structure

# System commands
sudo apt update                      # Update packages
sudo apt upgrade                     # Upgrade packages
whoami                               # Current user
pwd                                  # Current directory
ls -la                               # List files
cd /path                             # Change directory
```

---

## 🎯 Quick Setup Script (Optional)

If you want to automate the setup, create this script:

### setup.sh
```bash
#!/bin/bash

echo "Installing HMS Dependencies..."

# Update system
sudo apt update && sudo apt upgrade -y

# Install dependencies
sudo apt install -y php8.1 php8.1-cli php8.1-fpm php8.1-mysql \
  php8.1-mbstring php8.1-xml php8.1-zip php8.1-curl php8.1-gd \
  nginx mysql-server composer git

# Clone project
cd /var/www
sudo git clone https://github.com/vernea2112/hotel-management-system.git hms
cd hms

# Install composer
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
echo "Please setup database manually using: sudo mysql -u root -p"

# Set permissions
sudo chown -R www-data:www-data /var/www/hms
sudo chmod -R 775 /var/www/hms/storage

# Setup Nginx
sudo cp nginx.conf /etc/nginx/sites-available/hms
sudo ln -s /etc/nginx/sites-available/hms /etc/nginx/sites-enabled/hms
sudo rm -f /etc/nginx/sites-enabled/default
sudo nginx -t
sudo systemctl restart nginx

echo "Setup complete! Visit http://your-ip-address"
```

### Run Setup Script
```bash
chmod +x setup.sh
./setup.sh
```

---

## ✅ Final Checklist

- [ ] Ubuntu Server installed and updated
- [ ] PHP 8.1, MySQL, Nginx installed
- [ ] Composer installed
- [ ] HMS project cloned
- [ ] .env configured with database credentials
- [ ] Database created and migrations run
- [ ] Seeders executed
- [ ] Nginx configuration set up
- [ ] Permissions configured correctly
- [ ] Application accessible from host machine
- [ ] Login with admin credentials works
- [ ] API endpoints tested
- [ ] Firewall configured
- [ ] Backups scheduled

---

## 🆘 Need Help?

1. Check logs: `/var/www/hms/storage/logs/laravel.log`
2. Review Nginx logs: `sudo tail -f /var/log/nginx/error.log`
3. Check MySQL: `sudo systemctl status mysql`
4. GitHub Issues: https://github.com/vernea2112/hotel-management-system/issues
5. Laravel Docs: https://laravel.com/docs

---

**Congratulations! Your HMS is now running on Ubuntu Server! 🎉**
