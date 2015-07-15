<?php namespace KodiCMS\Notifications\Providers;

use Event;
use KodiCMS\Users\Model\User;
use KodiCMS\Notifications\Model\Notification;
use KodiCMS\ModulesLoader\Providers\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider {

	public function boot()
	{
		Event::listen('view.navbar.right.before', function ()
		{
			echo view('notifications::navbar')->render();
		});

		User::addRelation('notifications', function (User $model)
		{
			return $model->belongsToMany(Notification::class, 'notifications_users', 'user_id');
		});

		User::addRelation('newNotifications', function (User $model)
		{
			return $model->notifications()->wherePivot('is_read', 0);
		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

	}
}