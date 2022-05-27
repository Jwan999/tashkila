<?php

namespace App\Nova;

use App\Nova\Actions\CompleteOrder;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class DispatchedOrder extends Resource
{

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }
    public static function icon()
    {
        return '

<svg class="sidebar-icon" viewBox="0 0 466 466" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Page-1" stroke="none" stroke-width="16" fill="none" fill-rule="evenodd">
        <g id="search" transform="translate(0.999938, 1.000000)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)">
            <path d="M378.720188,235.231797 L378.720188,112.751797 C378.73158,109.882319 377.205261,107.226524 374.720188,105.791797 L193.360188,1.07179677 C190.884979,-0.35726559 187.835397,-0.35726559 185.360188,1.07179677 L4.0001879,105.791797 C1.51511435,107.226524 -0.0112041557,109.882319 6.19396706e-05,112.751797 L6.19396706e-05,322.191797 C-0.0112041557,325.061275 1.51511435,327.717069 4.0001879,329.151797 L185.360188,433.791797 C187.835397,435.220859 190.884979,435.220859 193.360188,433.791797 L291.360188,377.151797 C293.751833,381.023456 296.425752,384.713464 299.360188,388.191797 L237.200188,450.351797 C234.063211,453.466683 234.045302,458.534819 237.160188,461.671797 C240.275074,464.808774 245.34321,464.826683 248.480188,461.711797 L310.720188,399.471797 C348.968389,431.282955 405.450171,427.480506 439.089401,390.829763 C472.728631,354.179021 471.68619,297.578989 436.720188,262.191797 C421.20056,246.604494 400.641062,237.047872 378.720188,235.231797 Z M189.360188,17.2317968 L354.720188,112.751797 L272.000188,160.031797 L118.800188,58.0317968 L189.360188,17.2317968 Z M24.0001879,112.751797 L103.360188,66.9117968 L256.880188,169.231797 L189.360188,208.031797 L24.0001879,112.751797 Z M16.0001879,126.591797 L181.360188,222.031797 L181.360188,412.991797 L16.0001879,317.551797 L16.0001879,126.591797 Z M197.360188,412.991797 L197.360188,222.031797 L264.000188,183.551797 L264.000188,240.991797 C264.000188,245.410075 267.58191,248.991797 272.000188,248.991797 C276.418466,248.991797 280.000188,245.410075 280.000188,240.991797 L280.000188,174.351797 L362.720188,126.351797 L362.720188,235.151797 C333.20471,237.689628 306.645355,254.084971 291.149239,279.333227 C275.653122,304.581482 273.059546,335.685821 284.160188,363.151797 L197.360188,412.991797 Z M425.360188,382.751797 C395.181663,412.924565 346.258712,412.924565 316.080188,382.751797 C310.151776,376.877746 305.232463,370.066391 301.520188,362.591797 C287.327068,334.042581 292.123306,299.707564 313.596508,276.140554 C335.06971,252.573544 368.811677,244.612578 398.554524,256.095845 C428.297371,267.579111 447.935235,296.149229 448.001621,328.031797 C448.125982,348.575519 439.964131,368.302396 425.360188,382.751797 L425.360188,382.751797 Z" id="Shape"></path>
        </g>
    </g>
</svg>




';
    }




    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereNull('completed_at')->whereNotNull('dispatched_at')->get();

//        return $query->whereNotNull('dispatched_at')->get();
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
            ID::make(__('ID'), 'id')->sortable(),
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
        return [
            (new CompleteOrder())->showOnTableRow(),

        ];
    }
}
