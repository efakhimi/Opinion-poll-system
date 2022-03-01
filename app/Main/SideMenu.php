<?php

namespace App\Main;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        return [
            'dashboard' => [
                'type' => 'all',
                'icon' => 'home',
                'route_name' => 'dashboard',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'داشبورد'
            ],
            'admin-users' => [
                'type' => 'admin',
                'icon' => 'users',
                'title' => 'مدیریت کاربران',
                'sub_menu' => [
                    'new-user' => [
                        'icon' => 'user-plus',
                        'route_name' => 'new-user.index',
                        'params' => [
                        ],
                        'title' => 'ساخت کاربر جدید'
                    ],
                    'users-list' => [
                        'icon' => 'user-check',
                        'route_name' => 'users-list.showList',
                        'params' => [
                        ],
                        'title' => 'لیست کاربران'
                    ]
                ]
                
            ],
            'survey-all-users' => [
                'type' => 'all',
                'icon' => 'edit',
                'title' => 'مدیریت پرسشنامه ها',
                'sub_menu' => [
                    'new-survey' => [
                        'icon' => 'plus',
                        'route_name' => 'new-survey.index',
                        'params' => [
                        ],
                        'title' => 'ساخت پرسشنامه جدید'
                    ],
                    'surveys-list' => [
                        'icon' => 'list',
                        'route_name' => 'surveys-list.showList',
                        'params' => [
                        ],
                        'title' => 'لیست پرسشنامه های شما'
                    ],
                ]
                
            ],
            'devider',
            'profile' => [
                'type' => 'all',
                'icon' => 'user',
                'route_name' => 'profile.index',
                'params' => [
                ],
                'title' => 'پروفایل'
            ],
            'devider',
            'logout' => [
                'type' => 'all',
                'icon' => 'log-out',
                'route_name' => 'logout',
                'params' => [
                ],
                'title' => 'خروج'
            ],
        ];
    }
}
