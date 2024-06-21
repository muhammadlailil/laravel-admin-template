<?php

namespace App\Providers;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\URL;

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
        // URL::forceScheme('https');
        if(config('app.env')!="local"){
            Debugbar::disable();
        }
        
        Paginator::useTailwind();
        $this->registerBuilderMarco();
    }


    private function registerBuilderMarco()
    {
        Builder::macro("whereLike", function ($attributes, $searchTerm) {
           $this->when($searchTerm,function(Builder $query) use($attributes,$searchTerm){
            $query->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        !($attribute instanceof \Illuminate\Contracts\Database\Query\Expression) && str_contains((string) $attribute, "."),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            [$relation, $relationAttribute] = explode(".", $attribute);
                            $query->orWhereHas($relation, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        },
                        function(Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute,"LIKE",  "%{$searchTerm}%");
                        }
                    );
                }
            });
           });
           return $this;
        });
    }
}
