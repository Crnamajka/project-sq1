<x-guest-layout>
    <main class="flex-1">
        <div class="bg-neutral-50 box-border">
            <livewire:recommended-products-section/>
        </div>
        <div class="py-16 box-border">
            <div class="wrapper hidden lg:flex justify-between items-center gap-4">
                @foreach(collect(File::allFiles('images/brands'))->shuffle() as $image)
                    <img src="{{ $image }}" alt="" class="w-full h-auto max-w-[196px]">
                @endforeach
            </div>

            <x-marquee class="lg:hidden">
                @foreach(collect(File::allFiles('images/brands')) as $image)
                    <img src="{{ $image }}" alt="" class="w-full h-auto max-w-[120px]">
                @endforeach
            </x-marquee>
        </div>
        <div class="bg-neutral-50 py-20 box-border">
            <livewire:components.new-arrivals :categories="$categories"/>
        </div>
        <div class="py-24">
            <div class="flex flex-wrap gap-20 justify-center w-full my-24 max-[600px]:flex-col max-[600px]:gap-8">
             
              <div class="grid grid-cols-[51px_1fr] grid-rows-[50px_30px] gap-[10px] h-[56px] w-[277px] max-[600px]:pl-[50px]">
                <img src="/images/homepage/quality.svg" alt="High Quality" class="row-span-2" />
                <div>
                  <p class="font-medium text-[20px] text-gray-800">{{ __('High Quality') }}</p>
                </div>
                <div>
                  <p class="text-[16px] text-gray-800">{{ __('crafted from top materials') }}</p>
                </div>
              </div>
          
              <div class="grid grid-cols-[51px_1fr] grid-rows-[50px_30px] gap-[10px] h-[56px] w-[277px] max-[600px]:pl-[50px]">
                <img src="/images/homepage/warrany.svg" alt="Warranty Protection" class="row-span-2" />
                <div>
                  <p class="font-medium text-[20px] text-gray-800">{{ __('Warranty Protection') }}</p>
                </div>
                <div>
                  <p class="text-[16px] text-gray-800">{{ __('Over two years') }}</p>
                </div>
              </div>
             
              <div class="grid grid-cols-[51px_1fr] grid-rows-[50px_30px] gap-[10px] h-[56px] w-[277px] max-[600px]:pl-[50px]">
                <img src="/images/homepage/quality.svg" alt="Free Shipping" class="row-span-2" />
                <div>
                  <p class="font-medium text-[20px] text-gray-800">Free Shipping</p>
                </div>
                <div>
                  <p class="text-[16px] text-gray-800">Order over $150</p>
                </div>
              </div>
              
              <div class="grid grid-cols-[51px_1fr] grid-rows-[50px_30px] gap-[10px] h-[56px] w-[277px] max-[600px]:pl-[50px]">
                <img src="/images/homepage/quality.svg" alt="24/7 Support" class="row-span-2" />
                <div>
                  <p class="font-medium text-[20px] text-gray-800">24/7 Support</p>
                </div>
                <div>
                  <p class="text-[16px] text-gray-800">Dedicated support</p>
                </div>
              </div>
            </div>
          </div>
          
        
    </main>
</x-guest-layout>
