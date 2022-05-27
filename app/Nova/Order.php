<?php

namespace App\Nova;

use App\Nova\Actions\DispatchOrder;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use OwenMelbz\RadioField\RadioButton;


class Order extends Resource
{
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }


    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereNull('dispatched_at')->get();
    }

    public static function icon()
    {
        return '

<svg class="sidebar-icon"  viewBox="0 0 406 466" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Page-1" stroke="none" stroke-width="16" fill="none" fill-rule="evenodd">
        <g id="package" transform="translate(1.000000, 1.000000)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)">
            <path d="M400.000126,113.071797 L206.000126,1.07179677 C203.524917,-0.35726559 200.475335,-0.35726559 198.000126,1.07179677 L4.00012596,113.071797 C1.51505241,114.506524 -0.0112660954,117.162319 6.26278375e-05,120.031797 L6.26278375e-05,344.031797 C-0.0112660954,346.901275 1.51505241,349.557069 4.00012596,350.991797 L198.000126,462.991797 C200.475335,464.420859 203.524917,464.420859 206.000126,462.991797 L400.000126,350.991797 C402.485199,349.557069 404.011518,346.901275 404.000189,344.031797 L404.000189,120.031797 C404.011518,117.162319 402.485199,114.506524 400.000126,113.071797 Z M202.000126,17.2317968 L380.000126,120.031797 L290.720126,171.551797 L125.440126,61.4717968 L202.000126,17.2317968 Z M24.000126,120.031797 L110.000126,70.3517968 L275.280126,180.511797 L202.000126,222.831797 L24.000126,120.031797 Z M16.000126,133.871797 L194.000126,236.671797 L194.000126,442.191797 L16.000126,339.391797 L16.000126,133.871797 Z M210.000126,442.191797 L210.000126,236.671797 L282.000126,194.831797 L282.000126,257.151797 C282.000126,261.570075 285.581848,265.151797 290.000126,265.151797 C294.418404,265.151797 298.000126,261.570075 298.000126,257.151797 L298.000126,185.631797 L387.600126,133.871797 L387.600126,339.391797 L210.000126,442.191797 Z" id="Shape"></path>
        </g>
    </g>
</svg>




';
    }

    public static $priority = 1;


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Order::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__("Full Name"), "full_name"),
            Text::make(__("First Phone Number"), "phone_one"),
            Text::make(__("Second Phone Number"), "phone_two"),
            Text::make(__("Email Address"), "email"),
            Text::make(__("Location"), "address"),
            Text::make(__("Closest Landmark"), "closest_mark"),
//            Text::make(__("Payment Type"), "payment_type"),
//            Text::make(__("Dispatched At"), "dispatched_at"),
            RadioButton::make(__('Payment Type'), 'payment_type')
                ->options([
                    'Cash' => 'Cash',
                    'Zain Cash' => 'Zain Cash'
                ])
                ->stack() // optional (required to show hints)
                ->marginBetween() // optional
                ->skipTransformation() // optional
                ->toggle([  // optional
                    1 => ['max_skips', 'skip_sponsored'] // will hide max_skips and skip_sponsored when the value is 1
                ])->hideFromDetail()->required(),
            Text::make(__("Total"), "total"),
            HasMany::make(__("Items"), "items", OrderItem::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new DispatchOrder)->showOnTableRow(),

        ];
    }
}
