<?php

namespace App\Providers;

use App\Models\Order;
use Coroowicaksono\ChartJsIntegration\LineChart;
//use InteractionDesignFoundation\HtmlCard\HtmlCard;
use IDF\HtmlCard\HtmlCard;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Carbon\Carbon;

use Laravel\Nova\Nova;
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
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
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
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        $ordersData = [];
        $combined = [];
        $orders = Order::whereNotNull('completed_at')->get()
            ->groupBy(function ($order) {
                return Carbon::parse($order->date)->format('Y/m');
            })->map->count();


        foreach ($orders as $key => $value) {
            $exists = array_key_exists($key, $combined);
            if ($exists) {
                $combined[$key] = $combined[$key] + $value;
            } else {
                $combined[$key] = $value;
            }
        }

        $months = array_keys($combined);

        sort($months);
        sort($combined);

        foreach ($months as $month) {
            /** @var Collection $orders */
            $ordersData[] = $orders->has($month) ? $orders[$month] : 0;
        }

        return [
            (new LineChart())
                ->title('Orders per month')
                ->animations([
                    'enabled' => true,
                    'easing' => 'easeinout',
                ])
                ->series(array([
                        'barPercentage' => 1,
                        'label' => 'Orders',
                        'borderColor' => '#EA4B1B',
                        'data' => $ordersData,
                    ])
                )
                ->options([
                    'layout' => [
                        'padding' => [
                            'left' => 8,
                            'right' => 8,
                            'top' => 8,
                            'bottom' => 8
                        ],
                    ],
                    'xaxis' => [
                        'categories' => $months
                    ],
                ])
                ->width('2/3'),
            (new HtmlCard())->width('1/3')->view('products'),
            (new HtmlCard())->width('1/3')->view('orders'),
            (new HtmlCard())->width('1/3')->view('dispatchedOrders'),
            (new HtmlCard())->width('1/3')->view('completedOrders'),

        ];

    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
//            new NovaSidebarIcons,
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Nova::sortResourcesBy(function ($resource) {
            return $resource::$priority ?? 99999;
        });
    }
}
