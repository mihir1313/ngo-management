# NGO Management System



## Front End

![FrontEnd](https://github.com/mihir1313/Digital-card/assets/121492298/7d397752-e938-4fc2-86b7-ed450c3b21db)

![FrontEnd-2](https://github.com/mihir1313/Digital-card/assets/121492298/3fc2d1af-a82e-4a2a-b238-f07e96cb89c1)

## Admin Login

![Login](https://github.com/mihir1313/Digital-card/assets/121492298/56afb43d-a8bb-47e7-a0c3-5560d087be25)

## Back End

![BackEnd](https://github.com/mihir1313/Digital-card/assets/121492298/2a51507e-67d8-47a4-8559-01b41a85ae77)

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
