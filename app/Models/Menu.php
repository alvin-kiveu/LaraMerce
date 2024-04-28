<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public static function getCommonMenuItems()
    {
        return [
            [
                'text' => 'Control Panel', // Section for managing the website
                'icon' => 'feather icon-monitor',
                'url' => '/laradmin/controlpanel',
            ],
            [
                'text' => 'Products', // Section for managing products
                'icon' => 'feather icon-box',
                'submenu' => [
                    [
                        'text' => 'Add Product',
                        'url' => '/laradmin/ecommerce/product/add',
                    ],
                    [
                        'text' => 'View Products',
                        'url' => '/laradmin/ecommerce/product/list',
                    ],
                    [
                        'text' => 'Categories',
                        'url' => '/laradmin/ecommerce/category/list',
                    ],
                    [
                        'text' => 'Units',
                        'url' => '/laradmin/ecommerce/unit/list',
                    ],
                    [
                        'text' => 'Brands',
                        'url' => '/laradmin/ecommerce/brand/list',
                    ],
                ],
            ],
            [
                'text' => 'Orders', // Section for managing orders
                'icon' => 'feather icon-shopping-cart',
                'url' => '/laradmin/ecommerce/orders',
            ],
            [
                'text' => 'Customers', // Section for managing customers
                'icon' => 'feather icon-users',
                'url' => '/laradmin/ecommerce/customers',
            ],
            [
                'text' => 'Themes', // Section for installing and managing themes
                'icon' => 'feather icon-layers',
                'submenu' => [
                    [
                        'text' => 'Install Theme',
                        'url' => '/laradmin/theme/install',
                    ],
                    [
                        'text' => 'Installed Themes',
                        'url' => '/laradmin/theme/list',
                    ],
                ],
            ],
            [
                'text' => 'Plugins', // Section for managing plugins
                'icon' => 'feather icon-package',
                'url' => '/laradmin/plugins/list',
            ],
            [
                'text' => 'User Management', // Section for managing users and roles
                'icon' => 'feather icon-users',
                'submenu' => [
                    [
                        'text' => 'Add Role',
                        'url' => '/laradmin/role/add',
                    ],
                    [
                        'text' => 'Roles',
                        'url' => '/laradmin/role/list',
                    ],
                    [
                        'text' => 'Add User',
                        'url' => '/laradmin/user/add',
                    ],
                    [
                        'text' => 'View Users',
                        'url' => '/laradmin/user/list',
                    ],
                ],
            ],
            [
                'text' => 'Settings', // Section for general settings
                'icon' => 'feather icon-settings',
                'submenu' => [
                    [
                        'text' => 'General Settings',
                        'url' => '/laradmin/settings/general',
                    ],
                    [
                        'text' => 'LaraMerce Settings',
                        'url' => '/laradmin/settings/version',
                    ],

                ],
            ],
            [
                'text' => 'Logs', // Section for viewing system logs
                'icon' => 'feather icon-list',
                'url' => '/laradmin/logs',
            ],
            [
                'text' => 'Backup', // Section for managing backups
                'icon' => 'feather icon-download-cloud',
                'url' => '/laradmin/backup',
            ],
        ];
    }
}
