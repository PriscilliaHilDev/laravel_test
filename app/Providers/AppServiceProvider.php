<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // (Optionnel) Forcer HTTPS en production
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Avertissements dans l’admin Filament pour éviter les soucis d’édition/prévisualisation d’images
        Filament::serving(function () {
            // 1) storage:link manquant => images non servies publiquement
            if (! is_link(public_path('storage'))) {
                Notification::make()
                    ->title('Images non accessibles (storage:link manquant)')
                    ->body("Exécutez `php artisan storage:link`.\nSans ce lien, l’aperçu et l’édition d’images dans l’admin peuvent échouer.")
                    ->warning()
                    ->persistent()
                    ->send();
            }

            // 2) APP_URL ≠ URL courante => preview “loading / waiting for size”
            $appUrl  = config('app.url');                  // valeur de APP_URL dans .env
            $current = request()->getSchemeAndHttpHost();  // ex: http://127.0.0.1:8000

            if (! empty($appUrl) && rtrim($appUrl, '/') !== rtrim($current, '/')) {
                Notification::make()
                    ->title('APP_URL est différent de l’URL actuelle')
                    ->body(
                        "APP_URL = {$appUrl}\nActuel = {$current}\n\n" .
                        "Mettez à jour APP_URL dans .env pour correspondre à l’URL utilisée, puis lancez `php artisan config:clear`.\n" .
                        "Sinon, la prévisualisation et l’édition d’images dans Filament peuvent rester en “loading”."
                    )
                    ->warning()
                    ->send();
            }
        });
    }
}
