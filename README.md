# Laravel 11 - Installation & Deployment Guide

This guide covers the initial configuration, installation, and deployment of a Laravel 11 application.

## Prerequisites

Before you begin, make sure you have the following installed:

- **PHP**: Version 8.2 or higher
- **Composer**: Dependency management tool
- **Node.js**: Version 18.x or higher with npm or yarn
- **PostgreSQL**: Version 13.x or higher (or another compatible database)

### Server Requirements

- **Web Server**: Apache/Nginx
- **PHP Extensions**:
  - OpenSSL
  - PDO
  - Mbstring
  - Tokenizer
  - XML
  - Ctype
  - JSON
  - BCMath
  - pgsql
  - pdo_pgsql

## Installation

### Step 1: Clone the Repository
```bash
git clone https://github.com/sendy452/sendy_crm.git
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Set Up Environment Variables
```bash
cp .env.example .env
php artisan key:generate
```

### Step 4: Run Migrations and Seed Database
```bash
php artisan migrate
php artisan db:seed
```