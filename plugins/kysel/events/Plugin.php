<?php namespace Kysel\Events;

use Backend;
use System\Classes\PluginBase;
use kysel\events\Models\Event as EventModel;
use kysel\events\Models\Event as Event;
use Rainlab\User\Models\User as User;
use kysel\events\Models\Following as FollowingModel;


/**
 * Events Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Events',
            'description' => 'No description provided yet...',
            'author'      => 'Kysel',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        EventModel::extend(function($model){
            $model->hasOne['User'] = ['Rainlab\User\Models\User'];
        });

        FollowingModel::extend(function($model){
            $model->hasOne['User'] = ['Rainlab\User\Models\User'];
        });
        
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Kysel\Events\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'kysel.events.some_permission' => [
                'tab' => 'Events',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'events' => [
                'label'       => 'Events',
                'url'         => Backend::url('kysel/events/events'),
                'icon'        => 'icon-leaf',
                'permissions' => ['kysel.events.*'],
                'order'       => 500,

                'sideMenu'    => [
                    'events' => [
                        'label'       => 'Events',
                        'url'         => Backend::url('kysel/events/events'),
                        'icon'        => 'icon-leaf',
                        'permissions' => ['kysel.events.*'],
                        'order'       => 500,
                    ],

                    'following' => [
                        'label'       => 'Following',
                        'url'         => Backend::url('kysel/events/following'),
                        'icon'        => 'icon-user',
                        'permissions' => ['kysel.events.*'],
                        'order'       => 501,
                    ]
                ],
            ],
        ];
    }
}
