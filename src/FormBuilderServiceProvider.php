<?php

namespace RealCahsowan\LaravelBulmaForm;

use Illuminate\Support\ServiceProvider;
use RealCahsowan\LaravelBulmaForm\Console\FormBuilderMakeCommand;

class FormBuilderServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
    	if ($this->app->runningInConsole()) {
	        $this->commands([
	            FormBuilderMakeCommand::class,
	        ]);
	    }

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/form_builder'),
        ], 'public');

    	$this->loadViewsFrom(
            __DIR__.'/../resources/views', 'form_builder'
        );
    }
}
