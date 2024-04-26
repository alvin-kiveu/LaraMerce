# LaraMerce - Revolutionizing Ecommerce CMS

[![Latest Version on Packagist](https://img.shields.io/packagist/v/LaraMerce/LaraMerce.svg?style=flat-square)](https://packagist.org/packages/LaraMerce/LaraMerce)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/LaraMerce/LaraMerce/Tests?label=tests)](
[![Total Downloads](https://img.shields.io/packagist/dt/LaraMerce/LaraMerce.svg?style=flat-square)](https://packagist.org/packages/LaraMerce/LaraMerce)


![LaraMerce Banner](public/images/LaraLMerce_github_banner.png)

LaraMerce  is a dynamic and innovative Laravel-based eCommerce CMS designed to empower businesses with a seamless and efficient online selling experience.

With LaraMerce, managing plugins, themes, dashboards, menus, widgets, pages, and settings becomes intuitive and seamless. Embracing the philosophy that dynamism is key to effective admin panel design, LaraMerce empowers developers to create and customize with unparalleled ease.

Unlock the potential of your projects with LaraMerce - the ultimate solution for streamlined admin panel creation.

Vibrant Community: Join a thriving community of developers and enthusiasts who contribute to LaraMerce's evolution. Benefit from the collective knowledge and experience of fellow users worldwide.

Endless Possibilities: With LaraMerce, your imagination is the only limit. Transform your admin panel into anything you envision, from simple dashboards to complex enterprise solutions.

Open Source Freedom: LaraMerce is open source, meaning it's free to use and modify according to your requirements. Whether you're building a personal blog or a corporate website, LaraMerce is your license-free solution.

Seamless Integration: Integrate LaraMerce effortlessly into your existing projects. Its flexible architecture ensures compatibility with a wide range of frameworks and technologies.

Join over [current_user_count] developers who have chosen LaraMerce for their admin panel needs. Start your journey with LaraMerce today, and experience the power of dynamic admin panel creation like never before.

Website: [https://laramerce.com](https://laramerce.com)


## Features

- **Dynamic Plugins**: Create and manage plugins with ease.

- **Dynamic Themes**: Create and manage themes with ease.

- **Dynamic Dashboards**: Create and manage dashboards with

- **Dynamic Menus**: Create and manage menus with ease.

- **Dynamic Widgets**: Create and manage widgets with ease.

- **Dynamic Pages**: Create and manage pages with ease.

- **Dynamic Settings**: Create and manage settings with ease.




## Installation

You can install the package via composer:

```bash
composer require LaraMerce/LaraMerce
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="LaraMerce\LaraMerceServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
    'name' => 'LaraMerce'
];
```

## Usage

```php
// In your routes file
Route::LaraMerce();
```

## Testing

```bash
composer test
```

## Credits

- [LaraMerce](Alvin Kiveu)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
```

