<?php

use App\Models\Product;

$products = Product::get()->count();


//if ($percentage == 0) ; $percentage = 3;

?>
<style>
    .text-4xl {
        font-size: 2.25rem;
        line-height: 2.5rem;
    }

    .mt-2 {
        margin-top: 1rem;
    }

    .w-20 {
        width: 5rem;
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


<script src="https://cdn.tailwindcss.com"></script>

<div class="flex justify-around items-center px-4 py-6 h">
    <div>
        <h1 class="text-4xl mt-2 text-center">
            {{ $products }}
        </h1>
        <p class="text-center">
            Total products
        </p>

    </div>
</div>
