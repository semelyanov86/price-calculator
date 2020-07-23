<?php

return [
    'userManagement'   => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'       => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Title',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'role'             => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Title',
            'title_helper'       => '',
            'permissions'        => 'Permissions',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'             => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Name',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'roles'                    => 'Roles',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
        ],
    ],
    'scanQueue'        => [
        'title'          => 'Scan Queue',
        'title_singular' => 'Scan Queue',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => '',
            'scan_url'               => 'Scan Url',
            'scan_url_helper'        => 'Enter URL for scanning',
            'scan_parameters'        => 'Scan Parameters',
            'scan_parameters_helper' => 'Parameters for scanning URL',
            'scan_finished'          => 'Scan Finished',
            'scan_finished_helper'   => 'Is scanning was finished',
            'scan_datetime'          => 'Scan Datetime',
            'scan_datetime_helper'   => '',
            'request'                => 'Request',
            'request_helper'         => '',
            'response_code'          => 'Response Code',
            'response_code_helper'   => '',
            'response_html'          => 'Response Html',
            'response_html_helper'   => '',
            'type'                   => 'Type',
            'type_helper'            => '',
            'created_at'             => 'Created at',
            'created_at_helper'      => '',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => '',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => '',
            'proxy'                  => 'Proxy',
            'proxy_helper'           => '',
        ],
    ],
    'scanProxy'        => [
        'title'          => 'Scan Proxy',
        'title_singular' => 'Scan Proxy',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'proxy_ip'          => 'Proxy Ip',
            'proxy_ip_helper'   => '',
            'proxy_port'        => 'Proxy Port',
            'proxy_port_helper' => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'userData'         => [
        'title'          => 'User Data',
        'title_singular' => 'User Data',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'type'              => 'Type',
            'type_helper'       => '',
            'data'              => 'Data',
            'data_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'scanDataCellular' => [
        'title'          => 'Scan Data Cellular',
        'title_singular' => 'Scan Data Cellular',
        'fields'         => [
            'id'                                  => 'ID',
            'id_helper'                           => '',
            'date'                                => 'Date',
            'date_helper'                         => '',
            'html'                                => 'Html',
            'html_helper'                         => '',
            'html_changed'                        => 'Html Changed',
            'html_changed_helper'                 => '',
            'html_changed_datetime'               => 'Html Changed Datetime',
            'html_changed_datetime_helper'        => '',
            'provider_name'                       => 'Provider Name',
            'provider_name_helper'                => '',
            'package_name'                        => 'Package Name',
            'package_name_helper'                 => '',
            'package_minutes'                     => 'Package Minutes',
            'package_minutes_helper'              => '',
            'package_sms'                         => 'Package Sms',
            'package_sms_helper'                  => '',
            'package_gb'                          => 'Package Gb',
            'package_gb_helper'                   => '',
            'package_month'                       => 'Package Month',
            'package_month_helper'                => '',
            'package_sim_price'                   => 'Package Sim Price',
            'package_sim_price_helper'            => '',
            'package_sim_connection_price'        => 'Package Sim Connection Price',
            'package_sim_connection_price_helper' => '',
            'package_min_lines'                   => 'Package Min Lines',
            'package_min_lines_helper'            => '',
            'package_change_price'                => 'Package Change Price',
            'package_change_price_helper'         => '',
            'created_at'                          => 'Created at',
            'created_at_helper'                   => '',
            'updated_at'                          => 'Updated at',
            'updated_at_helper'                   => '',
            'deleted_at'                          => 'Deleted at',
            'deleted_at_helper'                   => '',
        ],
    ],
];
