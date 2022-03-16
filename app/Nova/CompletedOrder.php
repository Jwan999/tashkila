<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class CompletedOrder extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */

    public static $priority = 3;


    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereNotNull('completed')->whereNotNull('dispatched_at')->get();
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
            Text::make(__("Completed at"), "completed"),
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
