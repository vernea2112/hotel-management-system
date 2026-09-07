# Hotel Management System - API Documentation

## Base URL
```
http://localhost:8000/api
```

## Authentication

All API endpoints (except login/register) require authentication using Bearer tokens.

Include the token in request headers:
```
Authorization: Bearer {your_access_token}
```

---

## Endpoints

### Authentication Endpoints

#### 1. Register User
- **URL**: `POST /auth/register`
- **Auth Required**: No
- **Body**:
  ```json
  {
    "name": "string",
    "email": "email",
    "password": "string (min 8)",
    "password_confirmation": "string",
    "role": "admin|manager|staff"
  }
  ```
- **Success Response (201)**:
  ```json
  {
    "success": true,
    "message": "User registered successfully",
    "access_token": "string",
    "token_type": "Bearer"
  }
  ```

#### 2. Login
- **URL**: `POST /auth/login`
- **Auth Required**: No
- **Body**:
  ```json
  {
    "email": "string",
    "password": "string"
  }
  ```
- **Success Response (200)**:
  ```json
  {
    "success": true,
    "message": "Login successful",
    "access_token": "string",
    "token_type": "Bearer",
    "user": { ... }
  }
  ```

#### 3. Logout
- **URL**: `POST /auth/logout`
- **Auth Required**: Yes
- **Success Response (200)**:
  ```json
  {
    "success": true,
    "message": "Logout successful"
  }
  ```

#### 4. Get Current User
- **URL**: `GET /auth/me`
- **Auth Required**: Yes
- **Success Response (200)**:
  ```json
  {
    "success": true,
    "data": { ... user object ... }
  }
  ```

---

### Guests Endpoints

#### 1. List All Guests
- **URL**: `GET /guests?page=1`
- **Auth Required**: Yes
- **Query Parameters**:
  - `page` (optional): Page number (default: 1)
- **Success Response (200)**:
  ```json
  {
    "success": true,
    "data": {
      "data": [ ... guests ... ],
      "current_page": 1,
      "per_page": 15
    }
  }
  ```

#### 2. Get Guest by ID
- **URL**: `GET /guests/{id}`
- **Auth Required**: Yes
- **Success Response (200)**:
  ```json
  {
    "success": true,
    "data": { ... guest object ... }
  }
  ```

#### 3. Create Guest
- **URL**: `POST /guests`
- **Auth Required**: Yes
- **Body**:
  ```json
  {
    "first_name": "string",
    "last_name": "string",
    "email": "email",
    "phone": "string",
    "address": "string",
    "city": "string",
    "country": "string",
    "document_id": "string",
    "document_type": "passport|cpf|rg|driver_license"
  }
  ```
- **Success Response (201)**:
  ```json
  {
    "success": true,
    "message": "Guest created successfully",
    "data": { ... guest object ... }
  }
  ```

#### 4. Update Guest
- **URL**: `PUT /guests/{id}`
- **Auth Required**: Yes
- **Body**: Same as Create (partial update allowed)
- **Success Response (200)**:
  ```json
  {
    "success": true,
    "message": "Guest updated successfully",
    "data": { ... guest object ... }
  }
  ```

#### 5. Delete Guest
- **URL**: `DELETE /guests/{id}`
- **Auth Required**: Yes
- **Success Response (200)**:
  ```json
  {
    "success": true,
    "message": "Guest deleted successfully"
  }
  ```

---

### Rooms Endpoints

#### 1. List All Rooms
- **URL**: `GET /rooms?page=1`
- **Auth Required**: Yes
- **Success Response (200)**:
  ```json
  {
    "success": true,
    "data": { ... paginated rooms ... }
  }
  ```

#### 2. Get Room by ID
- **URL**: `GET /rooms/{id}`
- **Auth Required**: Yes
- **Success Response (200)**:
  ```json
  {
    "success": true,
    "data": { ... room object ... }
  }
  ```

#### 3. Create Room
- **URL**: `POST /rooms`
- **Auth Required**: Yes
- **Body**:
  ```json
  {
    "room_number": "string",
    "room_type": "single|double|suite|deluxe",
    "capacity": "integer",
    "price_per_night": "decimal",
    "status": "available|occupied|maintenance|reserved",
    "description": "string"
  }
  ```
- **Success Response (201)**:
  ```json
  {
    "success": true,
    "message": "Room created successfully",
    "data": { ... room object ... }
  }
  ```

#### 4. Update Room
- **URL**: `PUT /rooms/{id}`
- **Auth Required**: Yes
- **Body**: Same as Create
- **Success Response (200)**:
  ```json
  {
    "success": true,
    "message": "Room updated successfully",
    "data": { ... room object ... }
  }
  ```

#### 5. Delete Room
- **URL**: `DELETE /rooms/{id}`
- **Auth Required**: Yes
- **Success Response (200)**:
  ```json
  {
    "success": true,
    "message": "Room deleted successfully"
  }
  ```

---

### Reservations Endpoints

#### 1. List All Reservations
- **URL**: `GET /reservations?page=1`
- **Auth Required**: Yes
- **Success Response (200)**:
  ```json
  {
    "success": true,
    "data": { ... paginated reservations with guest & room ... }
  }
  ```

#### 2. Get Reservation by ID
- **URL**: `GET /reservations/{id}`
- **Auth Required**: Yes
- **Success Response (200)**:
  ```json
  {
    "success": true,
    "data": { ... reservation object with guest & room ... }
  }
  ```

#### 3. Create Reservation
- **URL**: `POST /reservations`
- **Auth Required**: Yes
- **Body**:
  ```json
  {
    "guest_id": "integer",
    "room_id": "integer",
    "check_in_date": "date",
    "check_out_date": "date",
    "number_of_guests": "integer",
    "status": "pending|confirmed|checked_in|checked_out|cancelled",
    "notes": "string"
  }
  ```
- **Note**: `total_price` is calculated automatically based on nights and room price
- **Success Response (201)**:
  ```json
  {
    "success": true,
    "message": "Reservation created successfully",
    "data": { ... reservation object ... }
  }
  ```

#### 4. Update Reservation
- **URL**: `PUT /reservations/{id}`
- **Auth Required**: Yes
- **Body**: Same as Create
- **Success Response (200)**:
  ```json
  {
    "success": true,
    "message": "Reservation updated successfully",
    "data": { ... reservation object ... }
  }
  ```

#### 5. Delete Reservation
- **URL**: `DELETE /reservations/{id}`
- **Auth Required**: Yes
- **Success Response (200)**:
  ```json
  {
    "success": true,
    "message": "Reservation deleted successfully"
  }
  ```

---

## Error Responses

### 400 Bad Request
```json
{
  "success": false,
  "message": "Validation error",
  "errors": {
    "field_name": ["Error message"]
  }
}
```

### 401 Unauthorized
```json
{
  "success": false,
  "message": "Unauthorized"
}
```

### 404 Not Found
```json
{
  "success": false,
  "message": "Resource not found"
}
```

### 422 Unprocessable Entity
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": { ... }
}
```

### 500 Internal Server Error
```json
{
  "success": false,
  "message": "Internal server error"
}
```

---

## Rate Limiting

API endpoints are rate-limited to prevent abuse. Adjust in production based on your needs.

---

## Response Headers

All responses include:
- `Content-Type: application/json`
- `X-RateLimit-Limit: number`
- `X-RateLimit-Remaining: number`
- `X-RateLimit-Reset: timestamp`

---

## Usage Examples

### cURL Examples

#### Login
```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@hms.com","password":"password123"}'
```

#### Create Guest
```bash
curl -X POST http://localhost:8000/api/guests \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
    "first_name":"João",
    "last_name":"Silva",
    "email":"joao@example.com",
    "phone":"+55 11 98765-4321",
    "document_id":"12345678901",
    "document_type":"cpf"
  }'
```

#### Get All Rooms
```bash
curl -X GET http://localhost:8000/api/rooms \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json"
```

---

## SDK/Library Support

You can use this API with popular HTTP clients:
- Postman
- Insomnia
- Thunder Client
- Axios (JavaScript)
- Requests (Python)
- Guzzle (PHP)

---

*Last Updated: September 2024*
