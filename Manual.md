# API Manual

## Authentication Routes

### POST `/login`
- **Description**: Authenticate a user and generate a token.
- **Controller Method**: `AuthController@login`
- **Request Body**:
    - `email` (string, required): The email address of the user.
    - `password` (string, required): The user's password.
- **Response**:
    - `200 OK`: Returns a token on successful authentication.
    - `422 Unprocessable Entity`: Validation errors, e.g., invalid email or password.

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
- **Description**: Log in a user without password verification.
- **Controller Method**: `AuthController@loginWithoutPasswordCheck`
- **Response**:
    - `200 OK`: User successfully logged in.

**Example Response**:
```json
{
  "message": "Login successful",
  "user": {
    "id": 1,
    "email": "user@example.com"
  }
}
```

### POST `/register`
- **Description**: Register a new user.
- **Controller Method**: `AuthController@register`
- **Request Body**:
    - `name` (string, required): The full name of the user.
    - `email` (string, required): The email address of the user.
    - `password` (string, required): The user's password.
- **Response**:
    - `201 Created`: User successfully registered.
    - `422 Unprocessable Entity`: Validation errors.

**Example Request**:
```json
{
  "name": "John Doe",
  "email": "john.doe@example.com",
  "password": "securepassword"
}
```
**Example Response**:
```json
{
  "message": "User registered successfully",
  "user": {
    "id": 2,
    "name": "John Doe",
    "email": "john.doe@example.com"
  }
}
```

### POST `/password-reset`
- **Description**: Reset the user’s password.
- **Controller Method**: `AuthController@passwordReset`
- **Request Body**:
    - `email` (string, required): The email address of the user.
    - `new_password` (string, required): The new password.
    - `confirm_password` (string, required): Confirmation of the new password.
- **Response**:
    - `200 OK`: Password reset successfully.
    - `422 Unprocessable Entity`: Validation errors.

**Example Request**:
```json
{
  "email": "user@example.com",
  "new_password": "newpassword123",
  "confirm_password": "newpassword123"
}
```
**Example Response**:
```json
{
  "message": "Password reset successful"
}
```

### POST `/activate-account`
- **Description**: Activate a user account. Requires authentication.
- **Controller Method**: `AuthController@activateAccount`
- **Middleware**: `auth:sanctum`
- **Response**:
    - `200 OK`: Account activated.
    - `401 Unauthorized`: Invalid or missing token.

**Example Request**:
```json
{
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9"
}
```
**Example Response**:
```json
{
  "message": "Account activated successfully"
}
```

### POST `/block-account`
- **Description**: Block a user account. Requires authentication.
- **Controller Method**: `AuthController@blockAccount`
- **Middleware**: `auth:sanctum`
- **Response**:
    - `200 OK`: Account blocked.
    - `401 Unauthorized`: Invalid or missing token.

**Example Request**:
```json
{
  "user_id": 3
}
```
**Example Response**:
```json
{
  "message": "Account blocked successfully"
}
```

---

## User Routes

### GET `/user/{user?}`
- **Description**: Fetch details of a specific user or the authenticated user if no parameter is provided. Requires authentication.
- **Controller Method**: `UserController@getUserDetails`
- **Middleware**: `auth:sanctum`
- **URL Parameter**:
    - `user` (integer, optional): User ID.
- **Response**:
    - `200 OK`: Returns user details.
    - `404 Not Found`: User not found.

**Example Request**:
```
GET /user/2
Authorization: Bearer {token}
```
**Example Response**:
```json
{
  "id": 2,
  "name": "Jane Doe",
  "email": "jane.doe@example.com"
}
```

---

## Movie Routes

### GET `/movies`
- **Description**: Retrieve a list of movies. Requires authentication.
- **Controller Method**: `MovieController@getMovies`
- **Middleware**: `auth:sanctum`
- **Response**:
    - `200 OK`: List of movies.
    - `401 Unauthorized`: Invalid or missing token.

**Example Response**:
```json
[
  {
    "id": 1,
    "title": "Inception",
    "description": "A mind-bending thriller",
    "release_year": 2010
  },
  {
    "id": 2,
    "title": "The Matrix",
    "description": "A sci-fi classic",
    "release_year": 1999
  }
]
```

### POST `/movies`
- **Description**: Add a new movie to the collection. Requires authentication.
- **Controller Method**: `MovieController@addMovie`
- **Middleware**: `auth:sanctum`
- **Request Body**:
    - `title` (string, required): The movie's title.
    - `description` (string, optional): A short description of the movie.
    - `release_year` (integer, optional): The year the movie was released.
- **Response**:
    - `201 Created`: Movie successfully added.
    - `422 Unprocessable Entity`: Validation errors.

**Example Request**:
```json
{
  "title": "Interstellar",
  "description": "A journey through space and time",
  "release_year": 2014
}
```
**Example Response**:
```json
{
  "message": "Movie added successfully",
  "movie": {
    "id": 3,
    "title": "Interstellar",
    "description": "A journey through space and time",
    "release_year": 2014
  }
}
```

### DELETE `/movies`
- **Description**: Delete a movie from the collection. Requires authentication.
- **Controller Method**: `MovieController@deleteMovie`
- **Middleware**: `auth:sanctum`
- **Request Body**:
    - `movie_id` (integer, required): The ID of the movie to delete.
- **Response**:
    - `200 OK`: Movie successfully deleted.
    - `404 Not Found`: Movie not found.

**Example Request**:
```json
{
  "movie_id": 2
}
```
**Example Response**:
```json
{
  "message": "Movie deleted successfully"
}
```

