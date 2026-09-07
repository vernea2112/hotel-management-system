# Hotel Management System (HMS) - Complete Documentation

## 🏨 Overview

A comprehensive **Hotel Management System** built with **Laravel 10** and **PHP 8.1+**. This system provides complete tools for managing hotel operations including guest management, room inventory, reservations, billing, and advanced analytics.

### 🌍 Bilingual Support
- **English** ✓
- **Português (Brazilian Portuguese)** ✓

---

## 📋 Features

### Core Features
- ✅ **Guest Management** - Register, update, and manage guest information
- ✅ **Room Management** - Manage room inventory, types, pricing, and status
- ✅ **Reservation System** - Create, modify, and track reservations
- ✅ **Check-in/Check-out** - Manage guest arrivals and departures
- ✅ **Billing System** - Track payments and generate invoices
- ✅ **Dashboard** - Real-time overview of hotel operations
- ✅ **Reports** - Occupancy, revenue, and guest analytics

### Advanced Features
- ✅ **RESTful API** - Complete API endpoints for mobile/external access
- ✅ **Authentication** - Role-based access control (Admin, Manager, Staff)
- ✅ **Notifications** - Email notifications for reservations and check-ins
- ✅ **Audit Logging** - Track all system changes
- ✅ **Database Seeders** - Sample data for testing
- ✅ **Responsive UI** - Bootstrap 5 with modern design

---

## 🛠️ Tech Stack

- **Backend**: Laravel 10, PHP 8.1+
- **Database**: MySQL/MariaDB
- **Frontend**: Blade Templates, Bootstrap 5, jQuery
- **API**: RESTful API with Sanctum Authentication
- **Package Manager**: Composer

---

## 📦 Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL/MariaDB
- Git

### Step 1: Clone Repository
```bash
git clone https://github.com/vernea2112/hotel-management-system.git
cd hotel-management-system
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

### Step 4: Database Setup
Update your `.env` file with database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hms
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations and seeders:
```bash
php artisan migrate
php artisan db:seed
```

### Step 5: Start Development Server
```bash
php artisan serve
```

Access the application at: `http://localhost:8000`

---

## 👤 Default Credentials

After running seeders, use these credentials to login:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@hms.com | password123 |
| Manager | manager@hms.com | password123 |
| Staff | staff@hms.com | password123 |

---

## 🗂️ Project Structure

```
hotel-management-system/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── DashboardController.php
│   │   │   ├── GuestController.php
│   │   │   ├── RoomController.php
│   │   │   ├── ReservationController.php
│   │   │   ├── PaymentController.php
│   │   │   ├── ReportController.php
│   │   │   └── Api/ (API Controllers)
│   │   └── Middleware/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Guest.php
│   │   ├── Room.php
│   │   ├── Reservation.php
│   │   └── AuditLog.php
│   └── Notifications/
│       ├── ReservationConfirmed.php
│       └── CheckInReminder.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── UserSeeder.php
│       ├── GuestSeeder.php
│       ├── RoomSeeder.php
│       └── ReservationSeeder.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── dashboard/
│   │   ├── guests/
│   │   ├── rooms/
│   │   ├── reservations/
│   │   ├── payments/
│   │   └── reports/
│   └── lang/
│       ├── en/ (English translations)
│       └── pt/ (Portuguese translations)
├── routes/
│   ├── web.php
│   └── api.php
└── config/
    └── hms.php
```

---

## 🔌 API Documentation

### Authentication

#### Register
```bash
POST /api/auth/register
Content-Type: application/json

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "role": "staff"
}
```

#### Login
```bash
POST /api/auth/login
Content-Type: application/json

{
  "email": "john@example.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Login successful",
  "access_token": "token_here",
  "token_type": "Bearer",
  "user": { ... }
}
```

#### Logout
```bash
POST /api/auth/logout
Authorization: Bearer {token}
```

### Guests API

#### List Guests
```bash
GET /api/guests
Authorization: Bearer {token}
```

#### Create Guest
```bash
POST /api/guests
Authorization: Bearer {token}
Content-Type: application/json

{
  "first_name": "João",
  "last_name": "Silva",
  "email": "joao@example.com",
  "phone": "+55 11 98765-4321",
  "address": "Rua Principal, 123",
  "city": "São Paulo",
  "country": "Brazil",
  "document_id": "12345678901",
  "document_type": "cpf"
}
```

#### Get Guest
```bash
GET /api/guests/{id}
Authorization: Bearer {token}
```

#### Update Guest
```bash
PUT /api/guests/{id}
Authorization: Bearer {token}
Content-Type: application/json

{ ... guest data ... }
```

#### Delete Guest
```bash
DELETE /api/guests/{id}
Authorization: Bearer {token}
```

### Rooms API

#### List Rooms
```bash
GET /api/rooms
Authorization: Bearer {token}
```

#### Create Room
```bash
POST /api/rooms
Authorization: Bearer {token}
Content-Type: application/json

{
  "room_number": "101",
  "room_type": "double",
  "capacity": 2,
  "price_per_night": 150,
  "status": "available",
  "description": "Comfortable double room"
}
```

### Reservations API

#### List Reservations
```bash
GET /api/reservations
Authorization: Bearer {token}
```

#### Create Reservation
```bash
POST /api/reservations
Authorization: Bearer {token}
Content-Type: application/json

{
  "guest_id": 1,
  "room_id": 1,
  "check_in_date": "2024-01-15",
  "check_out_date": "2024-01-18",
  "number_of_guests": 2,
  "status": "confirmed",
  "notes": "Guest prefers high floor"
}
```

---

## 📊 Dashboard Overview

The dashboard displays:
- Total guests registered
- Room availability and status
- Today's check-ins and check-outs
- Total and monthly revenue
- Recent reservations
- Real-time occupancy metrics

---

## 📈 Reports

### Occupancy Report
- View occupancy rate for specific dates
- Track room usage patterns
- Identify peak seasons

### Revenue Report
- Date-range revenue analysis
- Detailed reservation breakdown
- Financial performance metrics

### Guest Report
- Guest statistics
- Reservation history per guest
- Visitor frequency analysis

---

## 🔐 Security Features

- ✅ Role-based access control
- ✅ Password hashing (bcrypt)
- ✅ CSRF protection
- ✅ XSS prevention
- ✅ SQL injection prevention
- ✅ API token authentication (Sanctum)
- ✅ Audit logging for all changes

---

## 🌐 Internationalization

Switch between languages:
- **English**: `/lang/en`
- **Portuguese**: `/lang/pt`

Language files located in:
- `resources/lang/en/`
- `resources/lang/pt/`

---

## 📧 Notifications

The system sends notifications for:
- Reservation confirmations
- Check-in reminders
- Payment receipts (when integrated)

---

## 🗄️ Database Models

### User
- id, name, email, password, role, timestamps

### Guest
- id, first_name, last_name, email, phone, address, city, country, document_id, document_type, timestamps

### Room
- id, room_number, room_type, capacity, price_per_night, status, description, timestamps

### Reservation
- id, guest_id, room_id, check_in_date, check_out_date, number_of_guests, status, total_price, notes, timestamps

### AuditLog
- id, user_id, action, model, model_id, old_values, new_values, ip_address, user_agent, timestamps

---

## 🚀 Deployment

### Production Setup

1. Clone repository on production server
2. Set `APP_ENV=production` in `.env`
3. Set `APP_DEBUG=false`
4. Run migrations: `php artisan migrate --force`
5. Configure web server (Nginx/Apache)
6. Set up SSL certificate
7. Configure email service for notifications
8. Set up database backups

---

## 🐛 Troubleshooting

### Database Connection Error
- Check `.env` database credentials
- Ensure MySQL service is running
- Verify database exists

### Migration Errors
```bash
php artisan migrate:refresh
php artisan db:seed
```

### Permission Errors
```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

---

## 📝 License

MIT License - see LICENSE file for details

---

## 👨‍💻 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

---

## 📞 Support

For issues and questions:
- Open an issue on GitHub
- Check existing documentation
- Contact: vernea2112@github.com

---

## 🎉 Acknowledgments

- Laravel framework team
- Bootstrap community
- All contributors and testers

---

**Made with ❤️ by vernea2112**
