<main class="m-6 lg:grid grid-cols-2 justify-center gap-14 bg-white" 
x-data='{
    rating: {{ $product->rating ?? 0 }},
    selectedSize: "M",
    selectedIndex: 0,
    images: @json($product->images),
    quantity: 1
}'>

<div class="flex flex-col-reverse items-center gap-4 md:flex-row md:justify-center md:items-start">
  <div class="flex flex-row w-[327.33px] md:flex-col md:justify-center md:w-[70px] lg:flex-col gap-2 overflow-x-auto" 
       style="-ms-overflow-style: none; scrollbar-width: none;">
      <template x-for="(image, index) in images" :key="index">
          <img 
              :src="image" 
              alt="{{ $product->name }}" 
              @click="selectedIndex = index" 
              :class="selectedIndex === index ? 'border-2 border-black p-1 bg-white' : ''" 
              class="cursor-pointer max-w-[70px] max-h-[93.33px] object-cover mt-4 lg:mt-0">
      </template>
  </div>
  <div class="max-w-[491px] max-h-[655px] lg:ml-4">
      <img :src="images[selectedIndex]" alt="{{ $product->name }}" class="object-cover w-full h-full lg:max-w-[400px] lg:max-h-[600px]">
  </div>
</div>

<div class="mt-4 lg:w-[400px] flex flex-col gap-2">
  <div>
      <p class="font-[Volkhov] text-sm text-stone-500">{{ $product->brand }}</p>
      <div class="flex items-center justify-between mt-2">
          <span class="font-semibold text-3xl font-[Volkhov]">{{ $product->name }}</span>
          <button class="border border-zinc-300 rounded-full p-2">
              <img src="/images/productpage/favorite.svg" alt="Favorite">
          </button>
      </div>
      <div class="flex items-center mt-2">
          <template x-for="i in 5" :key="i">
              <button class="focus:outline-none">
                  <img 
                      :src="i <= rating ? '/images/productpage/star-solid.svg' : '/images/productpage/star-regular.svg'" 
                      alt="rating" 
                      class="w-4 h-4">
              </button>
          </template>
          <span x-text="'(' + rating + ')'" class="text-sm text-gray-600 ml-1"></span>
      </div>
  </div>
  <div class="mt-2">
      <span class="font-[Volkhov] text-2xl">$ {{ $product->sale_price ?? $product->price }}</span>
      @if ($product->sale_price)
          <span class="font-[Jost] line-through text-stone-500 ml-2">$ {{ $product->price }}</span>
          <span class="bg-red-500 text-white rounded-xl px-1 ml-2 font-medium font-[Jost] text-xs">{{ __('SAVE') }} 33%</span>
      @endif
  </div>
  <div class="flex justify-between text-red-500 bg-rose-50 border border-red-300 rounded-lg p-2">
      <span class="font-[Volkhov]">{{ __('Hurry up! Sale ends in') }} :</span>
      <span class="font-[]">00 : 05 : 59 : 47</span>
  </div>
  <div class="font-[Jost] text-stone-500 mt-2">
      <span>{{ __('Only') }}</span>
      <span class="font-semibold">{{ $product->stock }}</span>
      <span>{{ __('item(s) left in stock!') }}</span>
      <span class="invisible ml-2">[{{ implode(', ', $product->sizes) }}]</span>
  </div>
  <div class="mt-4">
      <div class="flex items-center gap-2">
          <span class="font-bold">{{ __('Size') }}:</span>
          <span x-text="selectedSize" class="font-semibold"></span>
      </div>
      <div class="flex flex-wrap mt-2">
          @foreach ($product->sizes as $size)
              <button type="button"
                  @click="selectedSize = '{{ $size }}'"
                  :class="selectedSize === '{{ $size }}' ? 'bg-black text-white' : 'bg-white text-black hover:bg-zinc-400 hover:text-zinc-200'"
                  class="w-[45px] h-[45px] p-2 mr-2 rounded border border-zinc-500 font-[Jost]">
                  {{ $size }}
              </button>
          @endforeach
      </div>
  </div>
  <div>
      <p>{{ __('Quantity') }}</p>
      <div class="flex gap-4">
          <div class="flex justify-around w-[126px] h-[46px] gap-4 border outline-zinc-100 rounded-lg">
              <button @click="if(quantity > 1) quantity--" class="flex items-center justify-center">
                  <img src="/images/productpage/-.svg" alt="decrease">
              </button>
              <span x-text="quantity" class="flex items-center justify-center"></span>
              <button @click="quantity++" class="flex items-center justify-center">
                  <img src="/images/productpage/plus.svg" alt="increase">
              </button>
          </div>
          <button wire:click="addToCart(quantity)" class="rounded-lg border border-black text-black font-[Volkhov] w-full">
              {{ __('Add to cart') }}
          </button>
      </div>
  </div>
  <div class="flex gap-6 my-6 pb-2 w-full border-b outline-zinc-100">
      <div class="flex gap-2">
          <button><img src="/images/productpage/compare.svg" alt="compare"></button>
          <p class="text-sm lg:text-base">{{ __('Compare') }}</p>
      </div>
      <div class="flex gap-2">
          <button><img src="/images/productpage/question.svg" alt="question"></button>
          <p class="text-sm lg:text-base">{{ __('Ask a question') }}</p>
      </div>
      <div class="flex gap-2">
          <button><img src="/images/productpage/share.svg" alt="share"></button>
          <p class="text-sm lg:text-base">{{ __('Share') }}</p>
      </div>
  </div>
  <div class="mb-4">
      <div class="flex mb-2 gap-2 text-sm lg:text-base" >
          <img src="/images/productpage/delivery.svg" alt="delivery">
          <span class="font-[Volkhov] font-bold">{{ __('Estimated Delivery') }}:</span>
          <span class="font-[Jost]">{{ __('Jul 30 - Aug 03') }}</span>
      </div>
      <div class="flex b gap-2 text-sm lg:text-base">
          <img src="/images/productpage/shipping.svg" alt="shipping">
          <span class="font-[Volkhov] font-bold">{{ __('Free Shipping & Returns') }}:</span>
          <span class="font-[Jost]">{{ __('On all orders over $75') }}</span>
      </div>
  </div>
  <div class="flex flex-col gap-4 bg-zinc-100 p-6">
      <img src="/images/productpage/cards.png" alt="cards">
      <p class="text-center font-[Volkhov]">{{ __('Guarantee safe & secure checkout') }}</p>
  </div>
</div>
</main>