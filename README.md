# Laravel Modulizer

A Laravel 12-compatible package that helps you organize your app into feature-based modules. Quickly scaffold routes, controllers, models, views, and service providers in isolated modules.

## ✨ Features

- Modular directory structure
- Artisan command to generate new modules
- Automatically registers routes and views
- Easy configuration and customization

## 📦 Installation

Require via Composer:

```bash
composer require carlcandels/laravel-modulizer


Then publish the configuration file:

php artisan vendor:publish --provider="YourName\\Modulizer\\ModulizerServiceProvider" --tag=modulizer-config

🚀 Usage
Generate a module:

php artisan module:make Blog

This will create:

modules/
└── Blog/
    ├── Http/Controllers/ExampleController.php
    ├── Models/Example.php
    ├── Routes/web.php
    ├── Views/index.blade.php
    ├── Providers/BlogServiceProvider.php
    └── module.json


⚙️ Configuration
Edit config/modulizer.php to change module paths or namespace.


return [
    'path' => base_path('modules'),
    'namespace' => 'Modules',
];
🛠 Requirements
PHP 8.2+

Laravel 12+

📝 License
MIT License © Your Name


---

✅ Once your package is on Packagist, you (and others!) can install it easily using:

```bash
composer require carlcandels/laravel-modulizer