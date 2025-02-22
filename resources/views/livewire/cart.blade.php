<main class="m-6">
    <div class="text-center">
        <p class="text-2xl font-[Volkhov] lg:text-4xl">{{ __('Shopping Cart') }}</p>
        <div class="mt-2 text-base font-[Jost]">
            <span class="text-base font-[Jost]"><a href="">{{ __('Home') }}</a></span>
            <span class="mx-2 text-base font-[Jost]">></span>
            <span class="text-base font-[Jost]">{{ __('Your Shopping Cart') }}</span>
        </div>
    </div>

    <div class="m-6">
        <div class="hidden lg:grid lg:grid-cols-4 lg:text-center text-xl border-b border-zinc-900 py-4">
            <p class="font-[Volkhov]">{{ __('Product') }}</p>
            <p class="font-[Volkhov]">{{ __('Price') }}</p>
            <p class="font-[Volkhov]">{{ __('Quantity') }}</p>
            <p class="font-[Volkhov]">{{ __('Total') }}</p>
        </div>
        @foreach ($productos as $producto)
        <div class="hidden lg:grid lg:grid-cols-4 text-center text-xl border-b border-zinc-900 py-6">
            <div class="min-w-[330.83px] flex gap-4">
                <img src="{{ $producto['producto']->images[0] }}" alt="" class="max-w-[200px] max-h-[300px] lg:w-[300.67px]"> 
                <div class="flex flex-col gap-4 text-start">
                    <p class="font-[Volkhov]">{{ $producto['producto']->name }}</p>
                    <div class="flex flex-col gap-6">
                        <p>Color: Red</p>
                        <button class="text-end text-red-500 text-sm lg:text-start" wire:click="deleteProductInfo('{{ $producto['producto']->id }}')">Remove</button>
                    </div>
                </div>
            </div>
            <div>
                <p>$ {{$producto['producto']->price }}</p>
            </div>
            <div class="flex justify-center">
                <div class="flex justify-around w-[126px] h-[46px] gap-4 border border-zinc-100 rounded-lg">
                    <button class="flex items-center justify-center">
                        <img src="/images/productpage/-.svg" alt="decrease">
                    </button>
                    <span class="flex text-center justify-center">{{ $producto['cantidad'] }}</span>
                    <button class="flex items-center justify-center">
                        <img src="/images/productpage/plus.svg" alt="increase">
                    </button>
                </div>
            </div>
            <div class="text-center">
                <p>$ {{$producto['producto']->price * $producto['cantidad'] }}</p>
            </div>
        </div>
        @endforeach
        
        <div class="lg:hidden flex flex-col border-b border-zinc-900 py-4">
            <div class="flex">
                <div class="w-1/3 flex-shrink-0">
                    <img src="/images/cartpage/image.png" alt="" class="object-cover w-full h-full">
                </div>
                <div class="w-2/3 pl-4 text-left flex flex-col justify-between">
                    <div>
                        <p class="text-xl font-[Volkhov]">Mini Dress With Ruffled Straps</p>
                        <p class="text-base">Color: Red</p>
                    </div>
                    <div class="mt-2">
                        <p class="text-xl">$14.90</p>
                        <div class="flex items-center mt-2">
                            <div class="flex justify-around w-[126px] h-[46px] gap-4 border border-zinc-100 rounded-lg">
                                <button class="p-1">
                                    <img src="/images/productpage/-.svg" alt="decrease">
                                </button>
                                <span class="px-2">01</span>
                                <button class="p-1">
                                    <img src="/images/productpage/plus.svg" alt="increase">
                                </button>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button class="text-red-500 text-sm">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:flex ml-[50%] border-b border-zinc-900 lg:py-6 mt-6">
            <div class="flex flex-col gap-2 w-full">
                <div class="flex gap-2 border-b border-zinc-900 py-4">
                    <div class="flex items-center h-5">
                        <input id="helper-checkbox" aria-describedby="helper-checkbox-text" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:white dark:border-gray-600"
                        {{ $wrap  ? 'checked':''}} wire:click='selectWrap()'>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>{{ __('For') }}</span>
                        <span>$10.00</span>
                        <span>{{ __('Please Wrap The Product') }}</span>
                    </div>
                </div>
                <div class="mt-8">
                    <div class="flex justify-between">
                        <span>{{ __('Subtotal') }}</span>
                        <span class="number">$ {{ $totalPagar }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>{{ __('Shipping') }}</span>
                        <span class="number">{{ __('Free') }}</span>
                    </div>
                </div>
                <button class="text-center bg-red-600 text-white rounded py-5 mt-2">
                    {{ __('Buy') }}
                </button>
            </div>
        </div>
    </div>
</main>
