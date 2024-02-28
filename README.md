# Laravel 11 REST API

Modern REST API built with Laravel 11 and PHP 8.3, featuring latest framework features.

## Features

- ✅ Laravel 11 (Slim application structure)
- ✅ PHP 8.3 (Typed class constants, readonly amendments)
- ✅ API Resources & Collections
- ✅ Laravel Sanctum authentication
- ✅ Rate limiting
- ✅ API versioning
- ✅ Database migrations & seeders
- ✅ Form Request validation
- ✅ Job queues with Redis
- ✅ Event & Listeners
- ✅ Telescope for debugging
- ✅ Pest PHP for testing

## Technologies

- **PHP 8.3** (Typed class constants, readonly amendments, #[\Override])
- **Laravel 11**
- **MySQL 8.0**
- **Redis 7**
- **Laravel Sanctum**
- **Pest PHP**
- **Laravel Octane** (optional)

## PHP 8.3 Features Used

### Typed Class Constants
```php
class ProductStatus
{
    public const string ACTIVE = 'active';
    public const string INACTIVE = 'inactive';
    public const int MAX_QUANTITY = 1000;
}
```

### readonly Amendments
```php
readonly class ProductDTO
{
    public function __construct(
        public string $name,
        public float $price,
        public int $stock,
    ) {}
}
```

### #[\Override] Attribute
```php
class ProductRepository extends BaseRepository
{
    #[\Override]
    public function find(int $id): ?Product
    {
        return Product::find($id);
    }
}
```

### json_validate()
```php
if (json_validate($jsonString)) {
    $data = json_decode($jsonString);
}
```

## Laravel 11 New Features

- **Slim application structure**
- **Per-second rate limiting**
- **Health routing**
- **Model casts improvements**
- **SQLite driver improvements**

## Installation

```bash
# Install dependencies
composer install

# Configure environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate --seed

# Start server
php artisan serve

# Or with Octane (high performance)
php artisan octane:start
```

## API Endpoints

### Authentication
```
POST   /api/register
POST   /api/login
POST   /api/logout
POST   /api/refresh
```

### Products
```
GET    /api/v1/products
POST   /api/v1/products
GET    /api/v1/products/{id}
PUT    /api/v1/products/{id}
DELETE /api/v1/products/{id}
PATCH  /api/v1/products/{id}/stock
```

### Orders
```
GET    /api/v1/orders
POST   /api/v1/orders
GET    /api/v1/orders/{id}
PUT    /api/v1/orders/{id}/status
```

## Example Requests

### Register
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "secret123",
    "password_confirmation": "secret123"
  }'
```

### Get Products (Authenticated)
```bash
curl -H "Authorization: Bearer {token}" \
  http://localhost:8000/api/v1/products
```

## Project Structure

```
laravel-api/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       └── V1/
│   │   ├── Requests/
│   │   ├── Resources/
│   │   └── Middleware/
│   ├── Models/
│   ├── Services/
│   ├── Repositories/
│   ├── Events/
│   ├── Listeners/
│   └── Jobs/
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── routes/
│   └── api.php
└── tests/
    ├── Feature/
    └── Unit/
```

## Testing with Pest

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter ProductTest

# With coverage
php artisan test --coverage
```

Example test:
```php
test('can create product', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->postJson('/api/v1/products', [
            'name' => 'New Product',
            'price' => 99.99,
            'stock' => 100,
        ]);

    $response->assertStatus(201)
        ->assertJson([
            'data' => [
                'name' => 'New Product',
            ],
        ]);
});
```

## Rate Limiting

```php
// routes/api.php
Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    // 60 requests per minute
});
```

## Background Jobs

```php
// Dispatch job
ProcessOrderJob::dispatch($order);

// Run queue worker
php artisan queue:work
```

## Performance

- With **Laravel Octane**: Handle 1000+ requests/second
- Response time: p50 < 50ms
- Database query optimization with eager loading
- Redis caching for frequently accessed data

## Author

David Badell - 2024

## License

MIT
