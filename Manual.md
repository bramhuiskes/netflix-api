# API Manual

## Database
### Database Login
 - **Root User**:
   - Username: `root`
   - Password: `root`
 - **Netflix User** (With Privileges):
   - Username: `netflix_user`
   - Password: `netflix_password`
 - **Movies and Series Added** (With Privileges):
   - Username: `movies_series_added`
   - Password: `password1`
 - **User manager** (With Privileges):
   - Username: `user_manager`
   - Password: `password2`
 - **Viewer data analyst** (With Privileges):
   - Username: `viewer_analyst`
   - Password: `password3`
 - **Admin Auditor** (With Privileges):
   - Username: `admin_auditor`
   - Password: `password4`
 - **Junior** (With Privileges):
   - Username: `junior`
   - Password: `password5`
 - **Medium** (With Privileges):
   - Username: `medium`
   - Password: `password6`
 - **Senior** (With Privileges):
   - Username: `senior`
   - Password: `password7`
 
### Database Implementation
 - **Login with Root User**:
   - Username: `root`
   - Password: `root`
 - **Delete all current tables**:
   - Warning! Be sure that the checkbox named 'Check for external key fields' is turned off!
 - **Importeer the file named** `netflix_def.sql`
---
## Postman Basic Routes and Tests
We added some basic routes (like user routes and some model routes), and some has test methods, end to end and regression testing. The following routes has test methods:
- `POST` /login (regression)
- `GET` /login (regression)
- `POST` /register (end to end)
- `GET` /movie (regression)
- `POST` /movie (regression)

To import the routes and tests to Postman, download the file named 'API.postman_collection.json' and import it in Postman.
---

## Isolation Levels 

### **1. `AddUser` Procedure: Isolation Level - `SERIALIZABLE`**
**Reasoning:**
- The `AddUser` procedure involves checking if an email already exists in the `users` table before inserting a new record. This requires the highest level of isolation to prevent **phantom reads** or concurrent transactions adding a user with the same email after the check but before the insert.
- The `SERIALIZABLE` isolation level ensures that no other transactions can insert or modify rows in the `users` table that would affect the result of the `EXISTS` check. This guarantees that if the procedure determines an email does not exist, no other transaction can insert it until the current transaction is complete.

**Effect:**
- Prevents race conditions where two transactions might simultaneously check and insert the same email.
- Ensures data integrity at the cost of reduced concurrency, which is acceptable in this scenario as adding a user is typically not a high-frequency operation.

---

### **2. `AddMovie` Procedure: Isolation Level - `REPEATABLE READ`**
**Reasoning:**
- The `AddMovie` procedure also performs a check (whether a movie with the same title and release year already exists) before inserting a new record. However, in this case, the `REPEATABLE READ` isolation level is sufficient.
- This level prevents **non-repeatable reads**, ensuring that if the procedure reads the `movies` table to check for duplicates, the result of that read cannot change for the duration of the transaction.
- Unlike `SERIALIZABLE`, `REPEATABLE READ` allows other transactions to insert new rows as long as they do not match the criteria being checked by the current transaction (e.g., same title and release year). This provides a balance between consistency and concurrency.

**Effect:**
- Ensures that the procedure sees a consistent snapshot of the `movies` table for the duration of its transaction, avoiding the risk of inserting duplicate movies.
- Offers better concurrency compared to `SERIALIZABLE`, which is suitable for scenarios where movie additions are more frequent than user registrations.

---

### Comparison of Isolation Levels:
| Isolation Level   | Description                                                                                           | Applied To  |
|-------------------|-------------------------------------------------------------------------------------------------------|-------------|
| **SERIALIZABLE**  | Ensures that no other transactions can read or modify the data being checked or written during the transaction. Prevents phantom reads. | `AddUser`   |
| **REPEATABLE READ** | Ensures that the data read during the transaction cannot change, but new rows that don't affect the current read can still be added. | `AddMovie`  |

---

## Authentication Routes

### POST `/login`
- **Description**: Authenticate a user and generate a token.
- **Controller Method**: `AuthController@login`
- **Request Body**:
    - `email` (string, required): The email address of the user.
    - `password` (string, required): The user's password.
- **Response**:
    - `200`: Returns a token on successful authentication.
    - `400`: Validation errors or missing data.
    - `404`: User not found or invalid password.

**Example Request**:
```json
{
  "email": "user@example.com",
  "password": "password123"
}
```
**Example Response**:
```json
{
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9"
}
```

### GET `/login`
- **Description**: Get the password of given user.
- **Controller Method**: `AuthController@loginWithoutPasswordCheck`
- **URL Parameter**:
  - `email` (string, required): Email of user
- **Response**:
  - `200`: Returns a token on successful authentication.
  - `400`: Validation errors or missing data.
  - `404`: User not found.
  
**Example URL**:
```url
/login?email=test@example.com
```
**Example Response**:
```json
{
  "psw": "$2y$12$qlR0L3TxrZ.Omb6jZZX5luxJhJ7oVxFZSpbJ53QPP6rSrzat9T.1O"
}
```

### POST `/register`
- **Description**: Register a new user and log in automatically
- **Controller Method**: `AuthController@register`
- **Request Body**:
    - `email` (string, required): The email address of the user.
    - `password` (string, required): The user's password.
- **Response**:
    - `200`: User successfully registered.
    - `400`: Validation errors or missing data.
    - `409`: Email already exists.

**Example Request**:
```json
{
  "email": "user@example.com",
  "password": "securepassword"
}
```
**Example Response**:
```json
{
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9"
}
```

### POST `/password-reset`
- **Description**: Reset the user’s password.
- **Controller Method**: `AuthController@passwordReset`
- **Request Body**:
    - `email` (string, required): The email address of the user.
    - `password` (string, required): The new password.
    - `newPassword` (string, required): Confirmation of the new password.
- **Response**:
    - `200`: Password reset successfully.
    - `400`: Validation errors.
    - `404`: User not found.

**Example Request**:
```json
{
  "email": "user@example.com",
  "password": "newpassword123",
  "newPassword": "newpassword123"
}
```
**Example Response**:
```json
{
  "msg": "Password reset successful"
}
```

### POST `/activate-account`
- **Description**: Activate a user account. Requires authentication.
- **Controller Method**: `AuthController@activateAccount`
- **Middleware**: `auth:sanctum`
- **Response**:
    - `200`: Account succesfully activated.
    - `400`: Validation errors.
    - `404`: User not found.

**Header Data**:
```json
{
    "Authorization": "Bearer 35|Sr5XRcouIzKsB0mL0rb9Bh0PawI6cbZTLFPRViKb89da7fb6"
}
```

**Example Request**:
```json
{
  "email": "user@example.com"
}
```
**Example Response**:
```json
{
  "msg": "Data successfully updated"
}
```

### POST `/block-account`
- **Description**: Block a user account. Requires authentication.
- **Controller Method**: `AuthController@blockAccount`
- **Middleware**: `auth:sanctum`
- **Response**:
    - `200`: Account succesfully blocked.
    - `400`: Validation errors.
    - `404`: User not found

**Header Data**:
```json
{
    "Authorization": "Bearer 35|Sr5XRcouIzKsB0mL0rb9Bh0PawI6cbZTLFPRViKb89da7fb6"
}
```

**Example Request**:
```json
{
  "email": "user@example.com"
}
```
**Example Response**:
```json
{
  "msg": "Data successfully updated"
}
```

### POST `/block-account`
- **Description**: Block a user account. Requires authentication.
- **Controller Method**: `AuthController@unblockAccount`
- **Middleware**: `auth:sanctum`
- **Response**:
    - `200`: Account succesfully unblocked.
    - `400`: Validation errors.
    - `404`: User not found

**Header Data**:
```json
{
    "Authorization": "Bearer 35|Sr5XRcouIzKsB0mL0rb9Bh0PawI6cbZTLFPRViKb89da7fb6"
}
```

**Example Request**:
```json
{
  "email": "user@example.com"
}
```
**Example Response**:
```json
{
  "msg": "Data successfully updated"
}
```

---

## User Routes

### GET `/user/{user?}`
- **Description**: Fetch details of a specific user or the authenticated user if no parameter is provided. Requires authentication.
- **Controller Method**: `UserController@getUserDetails`
- **Middleware**: `auth:sanctum`
- **URL Parameter**:
    - `user` (string, required): User email.
- **Response**:
    - `200`: Returns user details.
    - `400`: Validation errors.
    - `404`: User not found.

**Header Data**:
```json
{
    "Authorization": "Bearer 35|Sr5XRcouIzKsB0mL0rb9Bh0PawI6cbZTLFPRViKb89da7fb6"
}
```
**Example URL**:
```url
/user/user@example.com
```
**Example Response**:
```json
{
    "Email": "user@example.com",
    "AccountStatus": "PendingActivation",
    "TrialStatus": "Active",
    "CreatedAt": "2025-01-08T09:16:00.000000Z",
    "UpdatedAt": "2025-01-08T15:20:47.000000Z"
}
```

---

## Model Routes

All database tables, except for the basic Laravel tables including users, uses the same methods and request data. Please note, the models are named like the database table, but in singular. 

### GET `/{model name}`
- **Description**: Gets a list of rows found within the query
- **Controller Method**: `Controller@get`
- **Middleware**: `auth:sanctum`
- **URL Parameters**:
    - `id`: id of model.
    - `/movie` & `/serie`
      - title
      - release_year
      - movie_quality_id
      - viewer_indications
      - genres
    - `/view_history`
      - profile_id
      - content_id
      - content_type
      - watch_date
      - watch_duration
      - complete_status
    - `/watchlist`
      - profile_id
      - content_id
      - content_type
    - `/profile`
      - user_id
      - name
      - profile_picture
      - age
      - language
      - preference_id
    - `/subscription`
      - user_id
      - subscription_type_id
      - price
      - billing_date
    - `/subscription_type`
      - name
      - price
    - `/referral`
      - referrer_user_id
      - referred_user_id
      - discount_amount
      - status
    - `/preference`
      - profile_id
      - key
      - value
    - `/episode`
      - series_id
      - episodes_number
      - title
      - duration
    - `/movie_quality`
      - movie_id
      - quality_type_id
    - `/subtitle`
      - content_id
      - content_type
      - language
    - `/quality_type`
      - name
      - resolution
    - `/role`
      - name

- **Response**:
    - `200`: List of rows.
    - `400`: Validation errors.
    - `404`: User not found.

**Example URL**:
```url
/movie?title=Inception&release_year=2010
```

**Example Response**:
```json
[
  {
    "id": 1,
    "title": "Inception",
    "description": "A mind-bending thriller",
    "release_year": 2010
  }
]
```

### POST `/{model name}`
- **Description**: Post new data to the database.
- **Controller Method**: `Controller@add`
- **Middleware**: `auth:sanctum`
- **Request Body**:
    - `/movie` & `/serie` (Admin rights required)
        - title (Required)
        - release_year (Required)
        - movie_quality_id
        - viewer_indications
        - genres
    - `/view_history`
        - profile_id (Required)
        - content_id (Required)
        - content_type (Required)
        - watch_date (Required)
        - watch_duration (Required)
        - complete_status (Required)
    - `/watchlist`
        - profile_id (Required)
        - content_id (Required)
        - content_type (Required)
    - `/profile`
        - user_id (Required)
        - name (Required)
        - profile_picture
        - age (Required)
        - language
        - preference_id
    - `/subscription`
        - user_id (Required)
        - subscription_type_id (Required)
        - price (Required)
        - billing_date (Required)
    - `/subscription_type` (Admin rights required)
        - name (Required)
        - price (Required)
    - `/referral` (Admin rights required)
        - referrer_user_id (Required)
        - referred_user_id (Required)
        - discount_amount (Required)
        - status (Required)
    - `/preference`
        - profile_id (Required)
        - key (Required)
        - value (Required)
    - `/episode` (Admin rights required)
        - series_id (Required)
        - episodes_number (Required)
        - title (Required)
        - duration (Required)
    - `/movie_quality` (Admin rights required)
        - movie_id (Required)
        - quality_type_id (Required)
    - `/subtitle` (Admin rights required)
        - content_id (Required)
        - content_type (Required)
        - language (Required)
    - `/quality_type` (Admin rights required)
        - name (Required)
        - resolution (Required)
    - `/role` (Admin rights required)
        - name (Required)

- **Response**:
    - `200`: Successfully added.
    - `400`: Validation errors.

**Example Request**:
```json
{
  "title": "Interstellar",
  "release_year": 2014
}
```
**Example Response**:
```json
{
    "msg": "Successfully saved", 
    "model": {
        "title": "Interstellar",
        "release_year": 2014
    }
}
```

### DELETE `/{model name}`
- **Description**: Delete data from the database.
- **Controller Method**: `Controller@delete`
- **Middleware**: `auth:sanctum`
- **Request Body**:
    - `id`: id of model (Required)
- **Response**:
    - `200 `: Model successfully deleted.
    - `400 `: Validation errors.
    - `404`: Model not found.

**Example URL**:
```url
/movie?id=1
```
**Example Response**:
```json
{
  "msg": "Succesfully deleted"
}
```
### PATCH `/{model name}`
- **Description**: Updates a model by given ID
- **Controller Method**: `Controller@update`
- **Middleware**: `auth:sanctum`
- **URL Parameters**:
    - `id`: id of model (Required)
    - `/movie` & `/serie` (Admin rights required)
        - title
        - release_year
        - movie_quality_id
        - viewer_indications
        - genres
    - `/view_history`
        - profile_id
        - content_id
        - content_type
        - watch_date
        - watch_duration
        - complete_status
    - `/watchlist`
        - profile_id
        - content_id
        - content_type
    - `/profile`
        - user_id
        - name
        - profile_picture
        - age
        - language
        - preference_id
    - `/subscription`
        - user_id
        - subscription_type_id
        - price
        - billing_date
    - `/subscription_type` (Admin rights required)
        - name
        - price
    - `/referral` (Admin rights required)
        - referrer_user_id
        - referred_user_id
        - discount_amount
        - status
    - `/preference`
        - profile_id
        - key
        - value
    - `/episode` (Admin rights required)
        - series_id
        - episodes_number
        - title
        - duration
    - `/movie_quality` (Admin rights required)
        - movie_id
        - quality_type_id
    - `/subtitle` (Admin rights required)
        - content_id
        - content_type
        - language
    - `/quality_type` (Admin rights required)
        - name
        - resolution
    - `/role` (Admin rights required)
        - name

- **Response**:
    - `200`: List of rows.
    - `400`: Validation errors.
    - `404`: User not found.

**Example URL**:
```url
/movie?id=1&title=Inception&release_year=2010
```

**Example Response**:
```json
{
    "msg": "Data succesfully updated"
}
```
