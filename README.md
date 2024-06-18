
## Installation

Follow these instructions to set up and run the project locally on your Machine.

### Prerequisites

- [Git](https://git-scm.com/)
- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/)
- [Stripe Account](https://stripe.com/in)
- [MySQL](https://www.mysql.com/)

### Installation

1. Clone the repository:

```bash
   git clone https://github.com/mihir1313/ngo-management.git
```
 ```bash
   cd ngo-management
```

 ```bash
composer install
```
 ```bash
cp .env.example .env
```
```bash
php artisan key:generate
 ```
```bash
php artisan storage:link
```
 ```bash
 php artisan migrate:fresh --seed
```
 ```bash
 php artisan serve
```

## Admin Credentials
Admin: 
```bash 
admin@gmail.com
```
Password: 
```bash
12345678
```

## If you like our project please leave a star ❤
