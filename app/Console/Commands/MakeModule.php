<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModule extends Command
{
    protected $signature = 'make:module {name}';
    protected $description = 'Cria estrutura base de um módulo';

    public function handle()
    {
        $module = $this->argument('name');
        $path = base_path("app/Modules/{$module}");

        $directories = [
            'Controllers',
            'Models',
            'Services',
            'Repositories',
            'Routes',
        ];

        if (File::exists($path)) {
            $this->error("Módulo {$module} já existe!");
            return;
        }

        foreach ($directories as $dir) {
            File::makeDirectory("{$path}/{$dir}", 0755, true);
        }

        // Criar arquivo de rotas
        File::put("{$path}/Routes/api.php", "<?php\n\nuse Illuminate\\Support\\Facades\\Route;\n\nRoute::group(['prefix' => '" . strtolower($module) . "'], function () {\n    // Rotas do módulo {$module}\n});");

        $this->info("Módulo {$module} criado com sucesso!");
    }
}
