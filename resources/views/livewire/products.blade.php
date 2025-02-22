<div>
    <main x-data="{ 
            showFiltersMenu: false, 
            columns: 3, 
            cardSize: 'w-[400px]', 
            cardHeight: 'h-[400px]' 
        }" class="flex flex-col lg:flex-row gap-6">
        
        <!-- Sidebar de Filtros -->
        <aside x-bind:class="showFiltersMenu ? 'block' : 'hidden'" 
               class="bg-white p-4 w-full lg:w-[250px] lg:block lg:sticky lg:top-16 overflow-y-auto max-h-[calc(100vh-64px)]">
            <div class="flex justify-between">
                <span class="font-[Volkhov] text-3xl">{{ __('Filters') }}</span>
                <button class="invisible lg:visible font-[Jost] text-red-500 text-base font-normal">
                    {{ __('Delete filters') }}
                </button>
                <button @click="showFiltersMenu = !showFiltersMenu" class="lg:hidden">
                    <img src="/images/minicart/Cancel.svg" alt="">
                </button>
            </div>
            <div class="flex flex-col gap-4">
                <!-- Filtro de Tallas -->
                <div class="flex flex-col gap-4">
                    <h3 class="text-lg font-[Volkhov]">{{ __('Sizes') }}</h3>
                    <div class="flex flex-wrap">
                        @foreach ($sizes as $size)
                            <div class="size-6 p-6 mx-2 my-2 rounded border hover:bg-zinc-400 hover:text-zinc-200 border-zinc-500 text-zinc-500 font-[Jost]
                                {{ in_array($size, $sizeSelected ?? []) ? 'bg-black text-white' : '' }}">
                                <button wire:click="filterSize('{{ $size }}')" translate="no" class="flex justify-center items-center w-full h-full">
                                    {{ $size }}
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Filtro de Colores -->
                <div class="flex flex-col gap-4 mt-4">
                    <h3 class="text-lg font-[Volkhov]">{{ __('Colors') }}</h3>
                    <div class="flex flex-wrap">
                        @foreach ($colors as $color)
                            <div wire:click="filterColor('{{ $color['key'] }}')"
                                 class="cursor-pointer mx-1 my-1 size-6 rounded-full border 
                                 {{ in_array($color['key'], $colorSelected ?? []) ? 'border-black' : 'border-transparent' }}
                                 {{ $color['color'] }}">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Filtro de Precios -->
                <div class="flex flex-col gap-4 mt-4">
                    <h3 class="text-lg font-[Volkhov]">{{ __('Prices') }}</h3>
                    <div class="block">
                        @foreach ($prices as $price)
                            <div wire:click="filterPrice('{{ $price }}')" 
                                 class="text-zinc-500 cursor-pointer
                                 {{ in_array($price, $priceSelected ?? []) ? 'font-bold' : '' }}">
                                {{ $price }}
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Filtro de Marcas -->
                <div class="flex flex-col gap-4 mt-4">
                    <h3 class="text-lg font-[Volkhov]">{{ __('Brands') }}</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($brands as $brand)
                            <div wire:click="filterBrand('{{ $brand }}')" 
                                 class="text-zinc-500 cursor-pointer
                                 {{ in_array($brand, $brandSelected ?? []) ? 'font-bold' : '' }}">
                                {{ $brand }}
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Filtro de Colecciones (opcional) -->
                <div class="flex flex-col gap-4 mt-4">
                    <h3 class="text-lg font-[Volkhov]">{{ __('Collections') }}</h3>
                    <div>
                        @foreach ($collections as $collection)
                            <div class="text-zinc-500">{{ $collection }}</div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4">
                    <button class="lg:hidden font-[Jost] text-red-500 text-base font-normal">
                        {{ __('Delete filters') }}
                    </button>
                </div>
            </div>
        </aside>
        
        <!-- Sección de Productos -->
        <section class="flex-1 overflow-y-auto" style="max-height: calc(100vh - 128px);">
            <!-- Botón para desplegar filtros en mobile -->
            <button @click="showFiltersMenu = !showFiltersMenu" class="w-6 h-6 lg:hidden mt-4 ml-6 text-zinc-400">
                <img src="/images/productpage/filter.svg" alt="Filter">
            </button>
            <!-- Controles de visualización (solo en lg) -->
            <div class="hidden lg:flex justify-between items-center mt-8">
                <div>
                    <span class="text-black font-normal text-base font-[Volkhov]">{{ __('Best selling') }}</span>
                    <button>
                        <img src="/images/img-product/display.svg" alt="">
                    </button>
                </div>
                <span class="flex gap-2">
                    <button @click="columns = 2; cardSize = 'w-[400px]'; cardHeight = 'h-[400px]'" 
                            :class="{'bg-zinc-100': columns === 2, 'bg-zinc-200': columns !== 2}" 
                            class="p-2 rounded">
                        <img src="/images/img-product/vertical1.svg" alt="">
                    </button>
                    <button @click="columns = 3; cardSize = 'w-[300px]'; cardHeight = 'h-[350px]'" 
                            :class="{'bg-zinc-100': columns === 3, 'bg-zinc-200': columns !== 3}" 
                            class="p-2 rounded">
                        <img src="/images/img-product/vertical2.svg" alt="">
                    </button>
                    <button @click="columns = 4; cardSize = 'w-[250px]'; cardHeight = 'h-[300px]'" 
                            :class="{'bg-zinc-100': columns === 4, 'bg-zinc-200': columns !== 4}" 
                            class="hidden lg:block p-2 rounded">
                        <img src="/images/img-product/vertical3.svg" alt="">
                    </button>
                    <button @click="columns = 5; cardSize = 'w-[200px]'; cardHeight = 'h-[250px]'" 
                            :class="{'bg-zinc-100': columns === 5, 'bg-zinc-200': columns !== 5}" 
                            class="hidden lg:block p-2 rounded">
                        <img src="/images/img-product/vertical4.svg" alt="">
                    </button>
                </span>
            </div>
            <!-- Grid de Productos: 1 tarjeta por fila en pantallas pequeñas; en md+ se usa el valor de columns -->
            <div :class="{
                    'grid grid-cols-1 gap-4': true,
                    'md:grid-cols-2': columns === 2,
                    'md:grid-cols-3': columns === 3,
                    'md:grid-cols-4': columns === 4,
                    'md:grid-cols-5': columns === 5
            }">
                @foreach ($products as $product)
                    <div class="w-full h-full bg-white p-4 py-5 box-border hover:shadow transition flex flex-col">
                        <!-- Imagen de la Tarjeta -->
                        <a href="{{ route('products.show', ['productId'=>$product['id']]) }}" class="w-full h-[70%] aspect-square bg-neutral-800 block">
                            <img src="{{ $product['images'][0] }}" alt="{{ $product['name'] }}" class="object-cover w-full h-full">
                        </a>
                        <!-- Contenido Textual -->
                        <a href="{{ route('products.show', ['productId'=>$product['id']]) }}" class="block mt-2 flex-1">
                            <h3 class="font-[Volkhov] font-normal text-black text-base capitalize">
                                {{ $product['name'] }}
                            </h3>
                            <div class="flex justify-start items-baseline mt-2 gap-1">
                                <span class="font-[Jost] text-black font-normal text-base">
                                    $ {{ $product['sale_price'] ?? $product['price'] }}
                                </span>
                            </div>
                            <!-- Sección de Colores: muestra hasta 3 y, si hay más, muestra “+X” -->
                            <div class="mb-6 flex items-center gap-2 mt-4">
                                @php $colors = $product['colors']; @endphp
                                @foreach(array_slice($colors, 0, 3) as $color)
                                    <div class="size-6 rounded-full border border-transparent" style="background-color: {{ $color }};"></div>
                                @endforeach
                                @if(count($colors) > 3)
                                    <span class="text-sm text-gray-600">+{{ count($colors) - 3 }}</span>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <!-- Paginación o Navegación -->
            <div class="flex justify-center items-center my-4 gap-2">
                <button class="rounded-full bg-zinc-200 w-8 h-8 p-2">1</button>
                <button class="rounded-full w-8 h-8 p-2">2</button>
                <button class="rounded-full w-8 h-8 p-2">3</button>
            </div>
        </section>
    </main>
</div>


