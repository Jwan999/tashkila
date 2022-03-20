<?php

use App\Models\Order;


$orders = Order::whereNotNull('completed_at')->get()->count();


?>
{{--<style>--}}
{{--    .text-4xl {--}}
{{--        font-size: 2.25rem;--}}
{{--        line-height: 2.5rem;--}}
{{--    }--}}

{{--    .mt-2 {--}}
{{--        margin-top: 0.5rem;--}}
{{--    }--}}

{{--    .w-20 {--}}
{{--        width: 6rem;--}}
{{--    }--}}

{{--    .py-6 {--}}
{{--        padding-top: 1.5rem;--}}
{{--        padding-bottom: 1.5rem;--}}
{{--    }--}}

{{--    .px-4 {--}}
{{--        padding-left: 1rem;--}}
{{--        padding-right: 1rem;--}}
{{--    }--}}

{{--    .justify-around {--}}
{{--        justify-content: space-around;--}}
{{--    }--}}

{{--    .flex {--}}
{{--        display: flex;--}}
{{--    }--}}
{{--    .h{--}}
{{--        height: 8rem;--}}
{{--    }--}}
{{--</style>--}}

<link rel="stylesheet" href="css/app.css">
<div class="flex justify-around items-center px-4 py-6 h">
    <div class="w-6/12">
        <svg class="w-20" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <g clip-rule="evenodd" fill="var(--sidebar-icon)" fill-rule="evenodd">
                <path
                    d="m12 2.5c-5.24671 0-9.5 4.25329-9.5 9.5 0 5.2467 4.25329 9.5 9.5 9.5 5.2467 0 9.5-4.2533 9.5-9.5 0-5.24671-4.2533-9.5-9.5-9.5zm-10.5 9.5c0-5.79899 4.70101-10.5 10.5-10.5 5.799 0 10.5 4.70101 10.5 10.5 0 5.799-4.701 10.5-10.5 10.5-5.79899 0-10.5-4.701-10.5-10.5z"/>
                <path
                    d="m16.8678 9.33786-5.5 6.00004c-.1822.1987-.4892.2172-.694.0417l-3.49997-3 .65079-.7592 3.13278 2.6852 5.1732-5.64346z"/>
            </g>
        </svg>
    </div>
    <div class="w-6/12">
        <h1 class="text-4xl mt-2">
            {{ $orders }}
        </h1>
        <p>
            Number of completed orders
        </p>
    </div>
</div>

{{--<div class="flex justify-around items-center px-4 py-6 h">--}}
{{--    <div>--}}
{{--        <h1 class="text-4xl mt-2 text-center text-red-500">--}}
{{--            {{ $orders }}--}}
{{--        </h1>--}}
{{--        <p class="text-center">--}}
{{--            Number of Completed Orders--}}
{{--        </p>--}}

{{--    </div>--}}

{{--</div>--}}
