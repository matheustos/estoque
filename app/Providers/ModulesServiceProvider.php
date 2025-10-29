<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class ModulesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $modulesPath = app_path('Modules');

        // Se não existir, não faz nada
        if (!File::exists($modulesPath)) {
            return;
        }

        // Percorre todos os módulos dentro de app/Modules
        $modules = File::directories($modulesPath);

        foreach ($modules as $module) {
            $moduleName = basename($module);

            /**
             * === ROTAS API ===
             */
            $apiRoutes = $module . '/routes/api.php';
            if (File::exists($apiRoutes)) {
                Route::prefix('api') // adiciona automaticamente /api
                    ->middleware('api')
                    ->as(strtolower($moduleName) . '.') // ex: usuarios.register
                    ->group($apiRoutes);
            }

            /**
             * === ROTAS WEB ===
             */
            $webRoutes = $module . '/routes/web.php';
            if (File::exists($webRoutes)) {
                Route::middleware('web')
                    ->as(strtolower($moduleName) . '.')
                    ->group($webRoutes);
            }
        }
    }
}
