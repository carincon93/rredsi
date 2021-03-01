<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use File;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {className : Class name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create crud resources';

    protected $className;
    protected $folderName;
    protected $pageTitle;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->gatherParameters();
    }

    protected function gatherParameters()
    {
        $this->className    = $this->argument('className');
        $this->folderName   = $this->ask('What is the folder name (in lowercase, slug and plural)?');
        $this->pageTitle    = $this->ask('What is the name for the page title (in lowercase and singular)?');

        Artisan::call("make:model $this->className -c -r");
        Artisan::call("make:request $this->className"."Request");
        Artisan::call("make:policy $this->className"."Policy --model=".$this->className);
        File::makeDirectory(base_path()."/resources/views/{$this->folderName}", 0777, true);
        File::put(base_path()."/resources/views/{$this->folderName}/index.blade.php", "<x-app-layout pageTitle=\"{{ __('Index {$this->pageTitle}s') }}\">\n</x-app-layout>");
        File::put(base_path()."/resources/views/{$this->folderName}/show.blade.php", "<x-app-layout pageTitle=\"{{ __('Show {$this->pageTitle}') }}\">\n</x-app-layout>");
        File::put(base_path()."/resources/views/{$this->folderName}/edit.blade.php", "<x-app-layout pageTitle=\"{{ __('Edit {$this->pageTitle}') }}\">\n</x-app-layout>");
        File::put(base_path()."/resources/views/{$this->folderName}/create.blade.php", "<x-app-layout pageTitle=\"{{ __('Create {$this->pageTitle}') }}\">\n</x-app-layout>");
        $this->info(__('Copy and paste the following code in the return view App\Http\Controllers\:controllerName : :folderName', ['controllerName' => $this->className.'Controller;', 'folderName' => $this->folderName]));
        $this->info(__('Copy and paste the following code in the App\Policies\:classNamePolicy : :pageTitle', ['classNamePolicy' => $this->className.'Policy', 'pageTitle' => $this->pageTitle]));
        $this->info(__("Copy and paste the following code in AuthServiceProvider.php: 'App\Models\:className' => 'App\Policies\:classNamePolicy',", ['classNamePolicy' => $this->className.'Policy', 'className' => $this->className]));
        $this->info('Copy and paste the following code in web.php:');
        $this->info(__('use App\Http\Controllers\:controllerName', ['controllerName' => $this->className.'Controller;']));
        $this->info("Route::resource('/{$this->folderName}', {$this->className}Controller::class);");
    }
}
