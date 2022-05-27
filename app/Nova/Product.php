<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;

//use Laravel\Nova\Fields\Currency;
//use Pifpif\NovaTextCurrency\Currency;
use Davidpiesse\NovaToggle\Toggle;
use Laravel\Nova\Fields\Currency;
use OwenMelbz\RadioField\RadioButton;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Vyuldashev\NovaMoneyField\Money;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Product extends Resource
{
//showing only user products
    public static function indexQuery(NovaRequest $request, $query)
    {
//        todo add email not name
        if ($request->user()->name == 'jwan') {
            return true;
        } else {
            return $query->where('user_id', $request->user()->id);

        }
    }


    public static function icon()
    {
        return '

<svg class="sidebar-icon" viewBox="0 0 384 395" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Page-1" stroke="none" stroke-width="14" fill="none" fill-rule="evenodd">
        <g id="box" transform="translate(1.000000, 1.000000)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)">
            <path d="M382,99.4 C381.6,98.6 381.6,98.2 380.8,97.4 C380.4,96.6 379.6,96.2 378.4,95.8 L286.8,48.2 L194,0.6 C192.4,-0.2 190.4,-0.2 188.8,0.6 L95.6,48.2 L3.6,95.8 C2.4,96.2 1.2,97.4 0.8,98.6 C0.4,99.4 0.4,99.8 0,100.6 L0,101 L0,291.4 C0,293.4 1.2,295.4 3.2,296.6 L188.4,391.4 C188.4,391.4 188.8,391.4 188.8,391.8 C188.8,391.8 189.2,391.8 189.2,392.2 C190,392.6 190.4,392.6 191.2,392.6 C192,392.6 192.4,392.6 193.2,392.2 C193.2,392.2 193.6,392.2 193.6,391.8 C193.6,391.8 194,391.8 194,391.4 L379.2,296.6 C381.2,295.4 382.4,293.4 382.4,291.4 L382.4,101 C382.4,100.2 382.4,99.8 382,99.4 Z M191.2,12.2 L281.2,58.6 L364,101 L307.2,130.2 L134.4,41.4 L191.2,12.2 Z M266.4,163.8 L286.4,153.4 L299.6,146.6 L299.6,171.4 L288.8,166.6 C286.4,165.4 283.6,166.2 282,168.2 L266.8,187 L266.8,163.8 L266.4,163.8 Z M101.2,58.6 L121.6,48.2 L294.4,136.6 L260.8,154.2 L88,65.4 L101.2,58.6 Z M185.6,377.4 L11.6,287.8 L11.6,110.6 L96,153.8 L185.6,199.8 L185.6,377.4 Z M191.2,189.8 L101.2,143.4 L18.4,101 L75.2,71.8 L248,160.6 L191.2,189.8 Z M370.8,288.2 L196.8,377 L196.8,199.8 L255.2,169.8 L255.2,203.4 C255.2,206.6 257.6,209 260.8,209 C262.8,209 264.4,208.2 265.6,206.6 L288,179 L303.2,185.4 C306,186.6 309.6,185.4 310.8,182.2 C311.2,181.8 311.2,181 311.2,180.2 L311.2,141 L370.8,110.6 L370.8,288.2 Z" id="Shape"></path>
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
    public static $model = \App\Models\Product::class;

    public static $priority = 4;


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
            Text::make(__("Name"), 'name')->rules("required", "max:255")->sortable(),

            Textarea::make(__("Description"), 'description'),
            Image::make(__("Image"), "preview_img")->creationRules("required", "image")->disk('public'),
            Number::make(__("Price"), 'price'),
//            Currency::make('Price')->currency('IQD'),

//            Checkboxes::make( 'top_picks'),

            Toggle::make(__('Top picks'), 'top_picks')
                ->trueValue('true')
                ->falseValue('false')
                ->showLabels()->canSee(function ($request) {
                    if ($request->user()->name == 'jwan') {
                        return $value = true;
                    } else if ($request->user()->can('add_top_picks', $this)) {
                        return $value = false;
                    }
//                    return $value;
                }),
//                ->trueColor('#EA4B1B')
//                ->falseColor('#343440')
//                ->editableIndex()->canSee(function ($request) {
//                    $value = false;
////                    todo change name to email
//                }),

//            RadioButton::make()
//                ->options([
//                    'true' => 'Add to top pick',
//                    'false' => 'Remove from top picks',
//                ])
//                ->stack() // optional (required to show hints)
//                ->marginBetween() // optional
//                ->skipTransformation() // optional
//                ->toggle([  // optional
//                    1 => ['max_skips', 'skip_sponsored'] // will hide max_skips and skip_sponsored when the value is 1
//                ])->hideFromDetail()->required()->canSee(function ($request) {
//                    $value = true;
////                    todo change name to email
//                    if ($request->user()->name == 'jwan') {
//                        return $value = true;
//                    } else if ($request->user()->can('add_top_picks', $this)) {
//                        return $value = false;
//                    }
//                }),


            RadioButton::make(__('Sold out'), 'sold_out')
                ->options([
                    'true' => 'This product is sold out',
                    'false' => 'This product is available',
                ])
                ->stack() // optional (required to show hints)
                ->marginBetween() // optional
                ->skipTransformation() // optional
                ->toggle([  // optional
                    1 => ['max_skips', 'skip_sponsored'] // will hide max_skips and skip_sponsored when the value is 1
                ])->hideFromDetail()->required(),

            BelongsTo::make(__("Shop"), "shop", Shop::Class)->showCreateRelationButton(),

            Number::make('user_id')->canSee(function ($request) {
                return false;
            }),

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
