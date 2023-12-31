<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ModelingDirectory extends Command
{
    protected $signature = 'make:module {module_name}';
    protected $description = 'Create a folder and files in the app directory';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $moduleName = $this->argument('module_name');
        $baseDirectory = app_path("Modules/");
        $format_dir = explode('/', $moduleName);
        $module_dir = null;

        if (count($format_dir) > 1) {
            $moduleName = end($format_dir);
            array_pop($format_dir); //if do not make last name folder
            $module_dir = implode('/', $format_dir);
            if (!File::isDirectory($baseDirectory . $module_dir)) {
                mkdir($baseDirectory . $module_dir, 0777, true);
            }
            $baseDirectory = $baseDirectory . $module_dir;
        }

        $table = Str::plural((Str::snake($moduleName)));

        $actionsDirectory = $baseDirectory . '/Actions';

        if (!File::isDirectory($baseDirectory)) {
            File::makeDirectory($baseDirectory);
        }
        if (!File::isDirectory($actionsDirectory)) {
            File::makeDirectory($actionsDirectory);
        }

        $actionFiles = ['All.php',  'Store.php', 'Show.php', 'Update.php', 'Delete.php',  'Validation.php', 'Seeder.php'];

        if ($module_dir != null) {

            $module_name = $module_dir . '/' . $moduleName;
        } else {
            $module_name = $moduleName;
        }

        // dd($module_name);
        foreach ($actionFiles as $file) {
            if ($file == 'All.php') {
                File::put($actionsDirectory . '/' . $file, all($module_name));
            }
            if ($file == 'Store.php') {
                File::put($actionsDirectory . '/' . $file, store($module_name));
            }
            if ($file == 'Show.php') {
                File::put($actionsDirectory . '/' . $file, show($module_name));
            }
            if ($file == 'Update.php') {
                File::put($actionsDirectory . '/' . $file, update($module_name));
            }
            if ($file == 'Delete.php') {
                File::put($actionsDirectory . '/' . $file, delete($module_name));
            }
            if ($file == 'Validation.php') {
                File::put($actionsDirectory . '/' . $file, validation($module_name));
            }
            if ($file == 'Seeder.php') {
                File::put($actionsDirectory . '/' . $file, seeder($module_name));
            }
        }

        File::put($baseDirectory . '/Controller.php', controller($module_name));
        File::put($baseDirectory . '/Model.php', model($module_name, $moduleName));
        File::put($baseDirectory . '/create_' . $table . '_table.php', migration($moduleName));
        File::put($baseDirectory . '/Route.php', routeContent($module_name, $moduleName));
        File::put($baseDirectory . '/api.http', api($moduleName));
        File::put($baseDirectory . '/Seeder.php', seeder($module_name, $moduleName));
    }
}
