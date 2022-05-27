<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use OwenMelbz\RadioField\RadioButton;

class CompletedOrder extends Resource
{

    public static function icon()
    {
        return '

<svg class="sidebar-icon" viewBox="0 0 466 466" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Page-1" stroke="none" stroke-width="16"  fill-rule="evenodd">
        <g id="package(1)" transform="translate(1.000000, 1.000000)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)">
            <path d="M404.000126,269.231797 L404.000126,120.031797 C404.011518,117.162319 402.485199,114.506524 400.000126,113.071797 L206.000126,1.07179677 C203.524917,-0.35726559 200.475335,-0.35726559 198.000126,1.07179677 L4.00012596,113.071797 C1.51505241,114.506524 -0.0112660954,117.162319 6.26278375e-05,120.031797 L6.26278375e-05,344.031797 C-0.0112660954,346.901275 1.51505241,349.557069 4.00012596,350.991797 L198.000126,462.991797 C200.475335,464.420859 203.524917,464.420859 206.000126,462.991797 L278.880126,420.911797 C303.777788,455.79489 347.837929,471.375886 389.129742,459.899388 C430.421554,448.422891 460.122686,412.340954 463.449485,369.613255 C466.776283,326.885557 443.01795,286.64124 404.000126,268.911797 L404.000126,269.231797 Z M202.000126,17.2317968 L380.000126,120.031797 L290.720126,171.551797 L125.440126,61.4717968 L202.000126,17.2317968 Z M202.000126,222.831797 L24.000126,120.031797 L110.000126,70.3517968 L275.200126,180.511797 L202.000126,222.831797 Z M16.000126,133.871797 L194.000126,236.671797 L194.000126,442.191797 L16.000126,339.391797 L16.000126,133.871797 Z M210.000126,442.191797 L210.000126,236.671797 L282.000126,194.831797 L282.000126,257.151797 C282.000126,261.570075 285.581848,265.151797 290.000126,265.151797 C294.418404,265.151797 298.000126,261.570075 298.000126,257.151797 L298.000126,185.631797 L387.600126,133.871797 L387.600126,263.551797 C379.126783,261.23617 370.384159,260.052553 361.600126,260.031797 C326.40347,260.121634 293.748128,278.379175 275.238961,308.316166 C256.729794,338.253157 254.990858,375.625409 270.640126,407.151797 L210.000126,442.191797 Z M362.000126,448.031797 C314.503637,448.031797 276.000126,409.528285 276.000126,362.031797 C276.000126,314.535308 314.503637,276.031797 362.000126,276.031797 C409.496614,276.031797 448.000126,314.535308 448.000126,362.031797 C447.956022,409.510005 409.478334,447.987693 362.000126,448.031797 Z" id="Shape" stroke="var(--sidebar-icon)" ></path>
            <path d="M400.000126,320.511797 L350.400126,385.951797 L324.400126,355.391797 C321.550337,351.967631 316.464291,351.502007 313.040126,354.351797 C309.615961,357.201586 309.150337,362.287631 312.000126,365.711797 L344.000126,403.951797 C345.520147,405.728899 347.741631,406.751797 350.080126,406.751797 C352.513386,406.677925 354.780618,405.500142 356.240126,403.551797 L411.840126,330.191797 C414.699595,328.289068 416.02542,324.773428 415.134462,321.456331 C414.243504,318.139234 411.334614,315.76102 407.906616,315.547078 C404.478619,315.333137 401.296604,317.331218 400.000126,320.511797 L400.000126,320.511797 Z" id="Path"></path>
        </g>
    </g>
</svg>




';
    }



    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */

    public static $priority = 3;


    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereNotNull('completed_at')->whereNotNull('dispatched_at')->get();
    }

    public static $model = \App\Models\Order::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            Text::make(__("Payment Type"), "payment_type"),
            Text::make(__("Completed at"), "completed_at"),
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
        return [];
    }
}
