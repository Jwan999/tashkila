<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class DispatchedOrder extends Resource
{


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereNotNull('dispatched_at')->get();
    }

//    todo add fields and approprote stuff
    public static $model = \App\Models\Order::class;

    public static $priority = 2;


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
//            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__("Full Name"), "full_name"),
            Text::make(__("First Phone Number"), "phone_one"),
            Text::make(__("Second Phone Number"), "phone_two"),
            Text::make(__("Email Address"), "email"),
            Text::make(__("Location"), "address"),
            Text::make(__("Closest Landmark"), "closest_mark"),
            Text::make(__("Payment Type"), "payment_type"),
            Text::make(__("Dispatched At"), "dispatched_at"),
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
