<?php

namespace YourName\Modulizer\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeModuleCommand extends Command
{
    protected $signature = 'module:make {name}';
    protected $description = 'Generate a new module structure';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $kebab = Str::kebab($name);
        $modulePath = config('modulizer.path') . '/' . $name;

        if (File::exists($modulePath)) {
            $this->error("Module '{$name}' already exists.");
            return;
        }

        File::makeDirectory($modulePath . '/Http/Controllers', 0755, true);
        File::makeDirectory($modulePath . '/Models', 0755, true);
        File::makeDirectory($modulePath . '/Routes', 0755, true);
        File::makeDirectory($modulePath . '/Views', 0755, true);
        File::makeDirectory($modulePath . '/Providers', 0755, true);

        File::put($modulePath . '/Routes/web.php', "<?php

use Illuminate\\Support\\Facades\\Route;
use Modules\\$name\\Http\\Controllers\\ExampleController;

Route::get('/$kebab', [ExampleController::class, 'index']);
");

        File::put($modulePath . '/Views/index.blade.php', "<h1>Welcome to the $name module</h1>");

        File::put($modulePath . '/Http/Controllers/ExampleController.php', "<?php

namespace Modules\\$name\\Http\\Controllers;

use Illuminate\\Routing\\Controller;

class ExampleController extends Controller
{
    public function index()
    {
        return view('$kebab::index');
    }
}
");

        File::put($modulePath . '/Models/Example.php', "<?php

namespace Modules\\$name\\Models;

use Illuminate\\Database\\Eloquent\\Model;

class Example extends Model
{
    protected \$guarded = [];
}
");

        File::put($modulePath . "/Providers/{$name}ServiceProvider.php", "<?php

namespace Modules\\$name\\Providers;

use Illuminate\\Support\\ServiceProvider;

class {$name}ServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        \$this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        \$this->loadViewsFrom(__DIR__.'/../Views', '$kebab');
    }
}
");

        File::put($modulePath . '/module.json', json_encode([
            'name' => $name,
            'namespace' => "Modules\\$name"
        ], JSON_PRETTY_PRINT));

        $this->info("Module '{$name}' created successfully.");
    }
}
