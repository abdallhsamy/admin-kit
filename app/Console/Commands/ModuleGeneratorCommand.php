<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class ModuleGeneratorCommand extends Command
{
    protected $signature = 'generate:module
                            {--p|plain : Generate a plain module (without some resources).}
                            {--api : Generate an api module.}
                            {--web : Generate a web module.}
                            {--d|--disabled : Do not enable the module at creation.}
                            {--force : Force the operation to run when the module already exists.}';

    protected $description = 'Generate Module';

    protected bool $translatable = false;

    protected array $entities;

    protected string $module;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->askForDetails();

        $this->generateData();

        return 0;
    }

    protected function askForDetails()
    {
        $this->askModuleName();

        $this->askEntities();

        if (count($this->entities) > 0) {
            $this->askTranslation();
        }
    }

    protected function askModuleName()
    {
        do {
            $module = $this->ask('Please enter ModuleName');
            if ($module == '') {
                $this->error('ModuleName name is required');
            }
        } while (!$module);

        $this->module = Str::studly($module);
    }

    protected function askEntities()
    {
        $this->entities = [];

        do {
            $entity = $this->ask('Please enter EntityName');
            if ($entity != '') {
                $this->entities[] = Str::studly($entity);
            }
        } while ($entity != '');

    }

    protected function askTranslation()
    {
        if ($this->confirm('Do you want to activate translations?', false)) {
            $this->translatable = true;
        }
    }

    protected function generateData()
    {
        $this->generateModule();

        $this->generateEntities();
    }

    protected function generateModule()
    {
        $command = 'module:make ' . $this->module;

        $options = $this->options();

        foreach($options as $option=> $val){
            if ($val) {
                $command .= ' --' . $option;
            }
        }

        Artisan::call($command);
    }

    protected function generateEntities()
    {
        foreach ($this->entities as $model) {
            $this->generateModel($model);
            $this->generateController($model);
            $this->generateFactory($model);
            $this->generateRequests($model);
            $this->generateApiResources($model);
            $this->generateSeed($model);
            $this->generateTest($model);
        }
    }

    protected function generateModel($model)
    {
        $command = "module:make-model -m {$model} {$this->module}";

        Artisan::call($command);
    }

    protected function generateController($model)
    {
        $command = "module:make-controller {$model}Controller {$this->module}";

        Artisan::call($command);
    }

    protected function generateFactory($model)
    {
        $command = "module:make-factory {$model}Factory {$this->module}";

        Artisan::call($command);
    }

    protected function generateRequests($model)
    {
        $actions = ['Store', 'Update'];

        foreach ($actions as $action) {
            $command = "module:make-request {$model}/$action{$model}Request {$this->module}";

            Artisan::call($command);
        }
    }

    protected function generateApiResources($model)
    {
        $resources = [
            "{$model}Resource",
            "{$model}Collection",
        ];

        foreach ($resources as $resource) {
            $command = "module:make-resource {$model}/$resource {$this->module}";

            Artisan::call($command);
        }
    }

    protected function generateSeed($model)
    {
        $command = "module:make-seed {$model}Seeder {$this->module}";

        Artisan::call($command);
    }

    protected function generateTest($model)
    {
        $command = "module:make-test {$model}Test {$this->module}";

        Artisan::call($command);
    }
}
