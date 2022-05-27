<?php

namespace App\Nova;

use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Shop extends Resource
{
//show only user shop
    public static function indexQuery(NovaRequest $request, $query)
    {
//        todo make it email not name
        if ($request->user()->name == 'jwan') {
            return true;
        } else {
            return $query->where('dashboard_email', $request->user()->email);
        }
    }

//change name of resource
    public static function label()
    {
//        todo make it email not name
        if (Auth::user()->name == 'jwan') {
            return 'Shops';
        } else if (strpos(Auth::user()->email, 'shop') !== false) {
            return 'My Shop';
        } else {
            return 'Shops';
        }

    }

    public static function icon()
    {
        return '

<svg class="sidebar-icon" viewBox="0 0 478 478" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Page-1" stroke="none" stroke-width="16" fill="none" fill-rule="evenodd">
        <g id="shop" transform="translate(1.000000, 1.000000)" fill="var(--sidebar-icon)" fill-rule="nonzero">
            <path d="M475.544002,149.148 L475.544002,104.812 C475.544002,104.716 475.520001,104.628 475.516001,104.536 C475.506537,104.28133 475.481154,104.027501 475.440001,103.776 C475.408001,103.56 475.372001,103.344 475.320001,103.132 C475.268001,102.92 475.196001,102.704 475.120001,102.492 C475.039136,102.256482 474.945668,102.025482 474.840001,101.8 C474.796001,101.716 474.776001,101.624 474.732001,101.536 L422.888001,3.72 C421.673965,1.43110516 419.294932,0 416.704001,0 L58.8400011,0 C56.2490701,0 53.8700374,1.43110516 52.6560011,3.72 L0.812001146,101.536 C0.768001146,101.624 0.748001146,101.716 0.704001146,101.8 C0.598334747,102.025482 0.504866544,102.256482 0.424001146,102.492 C0.348001146,102.704 0.280001146,102.916 0.224001146,103.132 C0.168001146,103.348 0.136001146,103.56 0.104001146,103.776 C0.0628481146,104.027501 0.0374652324,104.28133 0.0280011458,104.536 C0.0280011458,104.628 0,104.716 0,104.812 L0,149.148 C0.034454308,169.567998 11.760753,188.164045 30.1720011,196.996 L30.1720011,422.572 L7,422.572 C3.1340079,422.572 0,425.706007 0,429.572 L0,468.548 C0,470.404841 0.736096036,472.185935 2.04908096,473.49892 C3.36206588,474.811905 5.14316036,475.548001 7,475.548001 L468.544001,475.548001 C470.400842,475.548001 472.181936,474.811905 473.494921,473.49892 C474.807906,472.185935 475.544002,470.404841 475.544002,468.548 L475.544002,429.572 C475.544002,425.706007 472.409994,422.572 468.544001,422.572 L445.392001,422.572 L445.392001,196.996 C463.795461,188.158326 475.513244,169.563457 475.544002,149.148 Z M461.544001,149.148 C461.686343,163.230676 454.25492,176.304942 442.082136,183.387691 C429.909351,190.47044 414.870651,190.47044 402.697867,183.387691 C390.525082,176.304942 383.093659,163.230676 383.236001,149.148 L383.236001,111.812 L461.544001,111.812 L461.544001,149.148 Z M106.308001,111.812 L184.616001,111.812 L184.616001,149.148 C184.758343,163.230676 177.32692,176.304942 165.154136,183.387691 C152.981351,190.47044 137.942651,190.47044 125.769867,183.387691 C113.597082,176.304942 106.165659,163.230676 106.308001,149.148 L106.308001,111.812 Z M193.744001,14 L185.288001,97.812 L108.972001,97.812 L136.484001,14 L193.744001,14 Z M267.744001,14 L276.172001,97.812 L199.372001,97.812 L207.816001,14 L267.744001,14 Z M339.076001,14 L366.572001,97.812 L290.256001,97.812 L281.800001,14 L339.076001,14 Z M198.615817,111.812 L276.928001,111.812 L276.928001,149.148 C276.928001,167.307041 264.4438,183.083671 246.771197,187.258579 C229.098594,191.433488 210.874319,182.911265 202.748001,166.672 C200.012844,161.236487 198.597243,155.232861 198.615817,149.148 L198.615817,111.812 Z M290.927788,111.812 L369.236002,111.812 L369.236002,149.148 C369.239362,167.377617 356.663276,183.198448 338.902787,187.30746 C321.142298,191.416473 302.89552,182.726725 294.892001,166.348 C292.264748,160.996075 290.908208,155.109976 290.927788,149.148 L290.927788,111.812 Z M456.928001,97.812 L381.328001,97.812 L353.796001,14 L412.492001,14 L456.928001,97.812 Z M63.0520011,14 L121.748001,14 L94.2360011,97.812 L18.6320011,97.812 L63.0520011,14 Z M14.0000011,149.148 L14.0000011,111.812 L92.3080011,111.812 L92.3080011,149.148 C92.450343,163.230676 85.0189201,176.304942 72.8461357,183.387691 C60.6733512,190.47044 45.6346511,190.47044 33.4618666,183.387691 C21.2890821,176.304942 13.8576593,163.230676 14.0000011,149.148 Z M461.544001,461.548 L14.0000011,461.548 L14.0000011,436.572 L461.544001,436.572 L461.544001,461.548 Z M203.236001,422.572 L97.7720011,422.572 L97.7720011,239.936 L203.236001,239.936 L203.236001,422.572 Z M431.392001,422.572 L217.236001,422.572 L217.236001,232.936 C217.236001,229.070007 214.101994,225.936 210.236001,225.936 L90.7800011,225.936 C86.9140079,225.936 83.7800011,229.070007 83.7800011,232.936 L83.7800011,422.572 L44.1720011,422.572 L44.1720011,201.484 C66.2141948,205.417316 88.3348125,194.989873 99.3280011,175.484 C108.781363,192.054735 126.392582,202.285848 145.470195,202.289982 C164.547807,202.294116 182.163458,192.070636 191.624001,175.504 C201.087055,192.069692 218.701964,202.293658 237.780001,202.293658 C256.858039,202.293658 274.472948,192.069692 283.936001,175.504 C293.40156,192.071582 311.020885,202.294796 330.101806,202.290663 C349.182727,202.286529 366.797622,192.055681 376.256001,175.484 C387.24919,194.989873 409.369808,205.417316 431.412001,201.484 L431.392001,422.572 Z" id="Shape" stroke="var(--sidebar-icon)"></path>
            <path d="M384.764001,225.935999 L251.932,225.935999 C250.07516,225.935999 248.294066,226.672095 246.981081,227.98508 C245.668096,229.298065 244.932,231.079159 244.932,232.935999 L244.932,325.976 C244.932,327.832841 245.668096,329.613935 246.981081,330.92692 C248.294066,332.239905 250.07516,332.976001 251.932,332.976001 L384.764001,332.976001 C388.629994,332.976001 391.764001,329.841993 391.764001,325.976 L391.764001,232.935999 C391.764001,229.070007 388.629994,225.935999 384.764001,225.935999 L384.764001,225.935999 Z M377.772001,318.972 L258.932001,318.972 L258.932001,239.936 L377.772001,239.936 L377.772001,318.972 Z" id="Shape"></path>
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
    public static $model = \App\Models\Shop::class;

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
            Image::make(__("Logo"), "logo")->creationRules("required", "image")->disk('public'),
            Text::make(__("Name"), 'name')->rules("required")->sortable(),
            Text::make(__("Dashboard Email"), 'dashboard_email')->rules("required"),
            Textarea::make(__("Overview"), 'overview')->rules("required"),

            Text::make(__('IoT Maker Percentage'), 'percentage')
                ->canSee(function ($request) {
//                    todo email instead of name
                    if ($request->user()->name == 'jwan') {
                        return $value = true;
                    } else if ($request->user()->can('percentage', $this)) {
                        return $value = false;
                    }
//                    return $value;
                }),
            HasMany::make('Products'),

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
