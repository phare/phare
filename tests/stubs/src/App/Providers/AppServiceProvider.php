<?php

namespace Stub\App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Spatie\QueryString\QueryString;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(QueryString::class, function () {
            /** @var \Illuminate\Http\Request $request */
            $request = $this->app->get(Request::class);

            return new QueryString(urldecode($request->getRequestUri()));
        });
    }

    public function boot()
    {
        Model::unguard(true);
    }
}
