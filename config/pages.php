<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 13/07/16
 * Time: 4:18 PM
 */

return [
    'bct' => [
        'teachers' => [
            [
                'title' => '课程',
                'route' => 'lectures.index',
            ],
            [
                'title' => '设置',
                'route' => 'settings.index',
                'children' => [
                    [
                        'route' => 'settings.profile.edit',
                        'title' => '个人资料'
                    ]
                ]
            ]
        ],

        'admins' => [
            [
                'title' => '教师管理',
                'route' => 'teachers.index',
                'children' => [
                    [
                        'title' => '添加教师',
                        'route' => 'teachers.create'
                    ], [
                        'title' => '修改教师',
                        'route' => 'teachers.edit'
                    ], [
                        'title' => '教师信息',
                        'route' => 'teachers.show'
                    ], [
                        'title' => '微课',
                        'route' => 'teachers.timetables'
                    ], [
                        'title' => '直播课',
                        'route' => 'teachers.lectures'
                    ], [
                        'title' => '课表',
                        'route' => 'teachers.schedules'
                    ]
                ]
            ], [
                'title' => '课时管理',
                'route' => 'timeslots.index',
                'children' => [
                    [
                        'title' => '添加课时',
                        'route' => 'timeslots.create'
                    ], [
                        'title' => '修改课时',
                        'route' => 'timeslots.edit'
                    ]
                ]
            ], [
                'title' => '课表管理',
                'route' => 'schedules.index'
            ], [
                'title' => '直播课管理',
                'route' => 'lectures.index',
                'children' => [
                    [
                        'title' => '添加课程',
                        'route' => 'lectures.create'
                    ], [
                        'title' => '修改课程',
                        'route' => 'lectures.edit'
                    ], [
                        'title' => '课程详情',
                        'route' => 'lectures.show'
                    ]
                ]
            ], [
                'title' => '微课管理',
                'route' => 'tutorials.index',
                'children' => [
                    [
                        'title' => '添加课程',
                        'route' => 'tutorials.create'
                    ], [
                        'title' => '修改课程',
                        'route' => 'tutorials.edit'
                    ], [
                        'title' => '课程详情',
                        'route' => 'tutorials.show'
                    ]
                ]
            ]
        ]
    ],

    'menu' => [
        'admins' => [
            [
                'title' => '教师管理',
                'route' => 'teachers.index',
                'children' => [
                    [
                        'title' => '添加教师',
                        'route' => 'teachers.create',
                        'hidden' => true,
                    ], [
                        'title' => '修改教师',
                        'route' => 'teachers.edit',
                        'hidden' => true,
                    ], [
                        'title' => '教师信息',
                        'route' => 'teachers.show',
                        'hidden' => true,
                    ]
                ],
                'icon' => 'users'
            ], [
                'title' => '课时管理',
                'route' => 'timeslots.index',
                'icon' => 'clock-o'
            ], [
                'title' => '课表管理',
                'route' => 'schedules.index',
                'children' => [
                    [
                        'title' => '教师课表',
                        'route' => 'teachers.schedules',
                        'hidden' => true,
                    ]
                ],
                'icon' => 'calendar'
            ],[
                'title' => '课程管理',
                'route' => 'lectures.index',
                'children' => [
                    [
                        'title' => '直播课',
                        'route' => 'lectures.index',
                    ], [
                        'title' => '微课',
                        'route' => 'tutorials.index',
                    ]
                ],
                'icon' => 'tasks'
            ]
        ],
    ],
];