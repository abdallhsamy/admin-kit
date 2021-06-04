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

        $this->info($this->module);

        foreach ($this->entities as $entity) {
            $this->info($entity);
        }

        $this->info($this->translatable);


//
//        $module = $this->argument('module');
//        $arguments = $this->arguments();
//        $model = $this->option('model');
//        $this->info('The command was successful!');
//        $this->info("Sending email to: {$module}!");

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
        $command = 'module:make' . $this->module;

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
        $command = 'module:make ' . $this->module;

        $options = $this->options();

        foreach($options as $option=> $val){
            if ($val) {
                $command .= ' ' . $option;
            }
        }

        Artisan::call($command);
    }
}
