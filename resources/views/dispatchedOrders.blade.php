<?php

use App\Models\Order;


$orders = Order::whereNull('completed')->whereNotNull('dispatched_at')->get()->count();


?>
<script src="https://cdn.tailwindcss.com"></script>

<style>
    .text-4xl {
        font-size: 2.25rem;
        line-height: 2.5rem;
    }

    .mt-2 {
        margin-top: 0.5rem;
    }

    .w-20 {
        width: 6rem;
    }

    .py-6 {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }

    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .justify-around {
        justify-content: space-around;
    }

    .flex {
        display: flex;
    }

    .h {
        height: 8rem;
    }
</style>


<div class="flex justify-around items-center px-4 py-6 h">
    <div>
        <svg class="w-20" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <g clip-rule="evenodd" fill="var(--sidebar-icon)" fill-rule="evenodd">
                <path
                    d="m1.5 4c0-1.38071 1.11929-2.5 2.5-2.5h16c1.3807 0 2.5 1.11929 2.5 2.5v7h-1v-7c0-.82843-.6716-1.5-1.5-1.5h-16c-.82843 0-1.5.67157-1.5 1.5v16c0 .8284.67157 1.5 1.5 1.5h7v1h-7c-1.38071 0-2.5-1.1193-2.5-2.5z"/>
                <path
                    d="m8.5 2c0-.27614.22386-.5.5-.5h6c.2761 0 .5.22386.5.5v7c0 .16072-.0773.31165-.2076.40562-.1304.09398-.298.11955-.4505.06872l-2.8419-.94729-2.84189.94729c-.15247.05083-.32008.02526-.45047-.06872-.13038-.09397-.20764-.2449-.20764-.40562zm1 .5v5.80629l2.3419-.78063c.1026-.03421.2136-.03421.3162 0l2.3419.78063v-5.80629z"/>
                <path
                    d="m17 12.5c-2.4853 0-4.5 2.0147-4.5 4.5s2.0147 4.5 4.5 4.5 4.5-2.0147 4.5-4.5-2.0147-4.5-4.5-4.5zm-5.5 4.5c0-3.0376 2.4624-5.5 5.5-5.5s5.5 2.4624 5.5 5.5-2.4624 5.5-5.5 5.5-5.5-2.4624-5.5-5.5z"/>
                <path d="m19.5 17.5h-5v-1h5z"/>
                <path d="m17.5 14.5v5h-1v-5z"/>
            </g>
        </svg>
    </div>
    <div>
        <h1 class="text-4xl mt-2">
            {{ $orders }}
        </h1>
        <p>
            Number of orders to be dispatched
        </p>

    </div>
</div>


{{--<div class="flex justify-around items-center px-4 py-6 h">--}}
{{--    <div>--}}
{{--        <h1 class="text-4xl mt-2 text-center text-red-500">--}}
{{--            {{ $orders }}--}}
{{--        </h1>--}}
{{--        <p class="text-center">--}}
{{--            Number of orders to be dispatched--}}
{{--        </p>--}}

{{--    </div>--}}

{{--</div>--}}
