<?php

namespace App\Providers;

use App\Policies\ActivityPolicy;
use App\Auth\CustomSessionGuard;
use Filament\Actions\MountableAction;
use Filament\Notifications\Livewire\Notifications;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\VerticalAlignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Models\Activity;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register custom session guard: skip migrate(true) on login so
        // session ID + CSRF token stay stable across Livewire POST (fix 419).
        Auth::extend('session-custom', function ($app, $name, array $config) {
            $provider = Auth::createUserProvider($config['provider'] ?? null);

            $guard = new CustomSessionGuard(
                $name,
                $provider,
                $app['session.store'],
                $app['request'],
                $app['_timebox'] ?? new \Illuminate\Support\Timebox,
                true
            );

            $guard->setCookieJar($app->make(\Illuminate\Contracts\Cookie\QueueingFactory::class));
            $guard->setDispatcher($app->make(\Illuminate\Contracts\Events\Dispatcher::class));

            return $guard;
        });

        \Illuminate\Support\Facades\URL::forceScheme('https');

        Gate::policy(Activity::class, ActivityPolicy::class);
        Page::formActionsAlignment(Alignment::Right);
        Notifications::alignment(Alignment::End);
        Notifications::verticalAlignment(VerticalAlignment::End);
        Page::$reportValidationErrorUsing = function (ValidationException $exception) {
            Notification::make()
                ->title($exception->getMessage())
                ->danger()
                ->send();
        };
        MountableAction::configureUsing(function (MountableAction $action) {
            $action->modalFooterActionsAlignment(Alignment::Right);
        });

        // Share profile settings globally with all views safely
        $globalProfile = null;
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('profile_settings')) {
                $globalProfile = \App\Models\ProfileSetting::first();
            }
        } catch (\Exception $e) {
            // Silence exceptions during migration or console commands
        }
        \Illuminate\Support\Facades\View::share('globalProfile', $globalProfile);
    }
}
