<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
//use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Text;

class User extends Resource
{

    public static function icon()
    {
        return '


<svg class="sidebar-icon" viewBox="0 0 514 386" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Page-1" stroke="none" stroke-width="16" fill="none" fill-rule="evenodd">
        <g id="group" transform="translate(1.000000, 1.000000)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)">
            <path d="M437.76,131.421 C452.321,117.16 460.8,97.679 460.8,76.8 C460.8,34.454 426.35,0 384,0 C370.008,0 356.242,3.846 344.175,11.125 C340.142,13.563 338.842,18.804 341.275,22.842 C343.708,26.88 348.958,28.167 352.992,25.742 C362.4,20.067 373.117,17.067 384,17.067 C416.933,17.067 443.733,43.863 443.733,76.8 C443.733,97.083 433.575,115.779 416.525,126.837 C402.208,136.229 384.058,138.937 367.483,134.216 C363,132.924 358.233,135.541 356.933,140.074 C355.641,144.607 358.266,149.328 362.8,150.624 C369.7,152.599 376.833,153.599 384,153.599 C397.418,153.599 410.388,149.939 421.903,143.329 C465.709,159.202 494.933,200.561 494.933,247.466 L494.933,290.133 L417.121,290.133 C411.077,233.137 375.219,183.261 322.916,159.578 C339.56,142.632 349.866,119.44 349.866,93.867 C349.867,42.108 307.758,0 256,0 C204.242,0 162.133,42.108 162.133,93.867 C162.133,119.448 172.445,142.647 189.098,159.595 C171.496,167.592 155.171,178.78 141.325,192.547 C114.782,219.166 98.63,253.331 94.796,290.135 L17.067,290.135 L17.067,247.468 C17.067,217.918 28.609,190.056 49.534,169.043 C61.053,157.597 75.077,148.865 90.177,143.377 C101.694,149.96 114.625,153.6 128,153.6 C135.167,153.6 142.3,152.6 149.2,150.625 C153.733,149.329 156.358,144.608 155.067,140.075 C153.767,135.542 149,132.929 144.517,134.217 C127.95,138.946 109.809,136.242 95.434,126.817 C78.426,115.779 68.267,97.084 68.267,76.8 C68.267,43.863 95.067,17.067 128,17.067 C138.883,17.067 149.6,20.067 159.008,25.742 C163.058,28.167 168.283,26.867 170.725,22.842 C173.158,18.805 171.858,13.563 167.825,11.125 C155.758,3.846 141.992,0 128,0 C85.65,0 51.2,34.454 51.2,76.8 C51.2,97.663 59.665,117.129 74.184,131.377 C60.651,137.668 48.152,146.353 37.467,156.967 C13.308,181.233 0,213.371 0,247.467 L0,298.667 C0,303.38 3.817,307.2 8.533,307.2 L93.866,307.2 L93.866,375.467 C93.866,380.18 97.683,384 102.399,384 L409.599,384 C414.316,384 418.132,380.179 418.132,375.467 L418.132,307.2 L503.465,307.2 C508.182,307.2 511.998,303.379 511.998,298.667 L511.998,247.467 C511.998,197.012 482.678,152.128 437.76,131.421 Z M179.2,93.867 C179.2,51.521 213.65,17.067 256,17.067 C298.35,17.067 332.8,51.521 332.8,93.867 C332.8,136.213 298.35,170.667 256,170.667 C213.65,170.667 179.2,136.212 179.2,93.867 Z M401.067,366.933 L110.933,366.933 L110.933,307.2 C110.933,268.508 126.016,232.071 153.383,204.621 C167.8,190.281 185.278,179.158 204.017,171.962 C218.912,181.909 236.784,187.733 256,187.733 C275.248,187.733 293.151,181.892 308.06,171.915 C363.838,193.346 401.067,247.12 401.067,307.2 L401.067,366.933 Z" id="Shape"></path>
        </g>
    </g>
</svg>


';
    }



//    public static function label()
//    {
//        return 'Accounts';
//    }


//    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

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
        'id', 'name', 'email',
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
            ID::make()->sortable(),
//            Avatar::make('Avatar'),
            Gravatar::make()->maxWidth(50),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),
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
