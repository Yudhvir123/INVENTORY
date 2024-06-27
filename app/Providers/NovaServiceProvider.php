<?php

namespace App\Providers;

use App\Nova\Dashboards\Main;
use App\Nova\IpPhone;
use App\Nova\Monitor;
use App\Nova\Mouse;
use App\Nova\SmartPhone;
use App\Nova\Keyboard;
use App\Nova\Laptop;
use App\Nova\Manufacturer;
use App\Nova\Printer;
use App\Nova\Processor;
use Laravel\Nova\Nova;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::withBreadcrumbs();
        Nova::mainMenu(fn($request)=>[
        MenuSection::dashboard(Main::class)->icon('chart-bar'),
            MenuSection::make('Inventory',[
                MenuItem::resource(Laptop::class),
                MenuItem::resource(Monitor::class),
                MenuItem::resource(Mouse::class),
                MenuItem::resource(SmartPhone::class),
                MenuItem::resource(IpPhone::class),
                MenuItem::resource(Keyboard::class),
                MenuItem::resource(Printer::class),
            ])->icon('user-group')->collapsable(),
            MenuSection::make('Employee',[
                MenuItem::resource(Printer::class),
            ])->icon('user-group')->collapsable(),
            MenuSection::make('Quick Actions',[
                MenuItem::resource(Printer::class),
            ])->icon('user-group')->collapsable(),
            MenuSection::make('Others',[
                MenuItem::resource(Manufacturer::class),
                MenuItem::resource(Processor::class),
            ])->icon('user-group')->collapsable(),
        ]);

        Nova::footer(function(){
            return Blade::render('<div><section class="">
  <!-- Footer -->
  <footer class="text-center text-white" style="background-color: #E30016;">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: CTA -->
      <section class="">
        <p class="d-flex justify-content-center align-items-center">
          <span class="me-3">Inventory Management Software </span>
          <button data-mdb-ripple-init type="button" class="btn btn-outline-light btn-rounded">

          </button>
        </p>
      </section>
      <!-- Section: CTA -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2024 Copyright:
      <a class="text-white" href="https://atulaya.com/">Atulaya.Com</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</section></div>');
        });

    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes(default: true)
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}


