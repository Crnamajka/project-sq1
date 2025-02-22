<main class="bg-white w-full px-12 mt-12">
  <div class="container mx-auto w-full px-4">
    <p class="text-center font-[Volkhov] lg:text-4xl lg:mb-10">
      {{ __('Checkout') }}
    </p>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 justify-items-center my-6">
      <div class="w-full lg:max-w-[607px]">
        <div class="grid">
          <div class="flex justify-between items-center mb-[30px]">
            <div class="font-[Volkhov] lg:text-4xl text-zinc-700">
              {{ __('Contact ') }}
            </div>
            <div class="flex gap-[10px] items-center font-[Poppins]  mb-[35px] self-end">
              <span class="text-zinc-700">Have an account?</span>
              <a href="#" class="no-underline text-blue-600">
                {{ __('Create Account') }}
              </a>
            </div>
          </div>
          <input
            type="text"
            name="email"
            id="email"
            placeholder="Email Address"
            class="w-full font-[Poppins] text-zinc-500 border border-zinc-500 pl-5"
          />
        </div>
        <div>
          <div class="font-[Volkhov] lg:text-4xl text-zinc-700 mt-[56px] mb-[30px]">
            {{ __('Delivery') }}
          </div>
          <div class="grid grid-cols-2 gap-x-[12px] gap-y-[14px]">
            <div class="relative flex items-center col-span-2">
              <input
                type="text"
                name="country"
                id="country"
                placeholder="Country / Region"
                class="w-full font-[Poppins] text-zinc-500 border border-zinc-500 pl-5"
              />
              <span class="absolute right-6 text-[16px] text-gray-500 pointer-events-none">
                <img src="/images/checkpage/despli.svg" alt="" />
              </span>
            </div>
            <input
              type="text"
              name="firstName"
              id="firstName"
              placeholder="First Name"
              class="w-full font-[Poppins] text-zinc-500 border border-zinc-500 pl-5"
            />
            <input
              type="text"
              name="lastName"
              id="lastName"
              placeholder="Last Name"
              class="w-full font-[Poppins] text-zinc-500 border border-zinc-500 pl-5"
            />
            <div class="col-span-2">
              <input
                type="text"
                name="address"
                id="address"
                placeholder="Address"
                class="w-full  font-[Poppins] text-zinc-500 border border-zinc-500 pl-5"
              />
            </div>
            <input
              type="text"
              name="city"
              id="city"
              placeholder="City"
              class="w-full font-[Poppins] text-zinc-500 border border-zinc-500 pl-5"
            />
            <input
              type="text"
              name="postalCode"
              id="postalCode"
              placeholder="Postal Code"
              class="w-full font-[Poppins] text-zinc-500 border border-zinc-500 pl-5"
            />
          </div>
          <div class="flex gap-[10px] items-center font-[Poppins] text-zinc-500 pt-[24px]">
            <img src="/images/cartpage/check.svg" alt="" />
            <span>{{ __('Save This Info For Future') }}</span>
          </div>
        </div>
        <div class="mb-5 w-full">
          <div class="font-[Volkhov] lg:text-4xl text-zinc-700 mt-[56px] mb-[30px]">
            {{ __('Payment') }}
          </div>
          <div class="flex flex-col">
            <div class="flex items-center relative">
              <input
                type="text"
                name="card"
                id="card"
                placeholder="Credit Card"
                class="w-full font-[Poppins] text-zinc-500 border border-zinc-500 pl-5"
              />
              <div class="flex items-center absolute right-6 pointer-events-none">
                <span>
                  <img src="/images/checkpage/card.png" alt="" />
                </span>
                <span>
                  <img src="/images/checkpage/despli.svg" alt="" />
                </span>
              </div>
            </div>
            <div class="grid bg-neutral-100 justify-center mt-4">
              <div class="grid grid-cols-2 gap-x-[6px] gap-y-[8px] mt-[24px] w-full lg:max-w-[567px]">
                <input
                  type="number"
                  name="cardNumber"
                  id="cardNumber"
                  placeholder="Card Number"
                  class="col-span-2 w-full font-[Poppins] text-zinc-500 border border-zinc-500 pl-5"
                />
                <input
                  type="date"
                  name="expirationDate"
                  id="expirationDate"
                  placeholder="Expiration Date"
                  class="w-full font-[Poppins] text-zinc-500 border border-zinc-500 pl-5"
                />
                <input
                  type="number"
                  name="securityCode"
                  id="secuirityCode"
                  placeholder="Security Code"
                  class="w-full font-[Poppins] text-zinc-500 border border-zinc-500 pl-5"
                />
                <input
                  type="text"
                  name="cardHolder"
                  id="cardHolder"
                  placeholder="Card Holder Name"
                  class="col-span-2 w-full font-[Poppins] text-zinc-500 border border-zinc-500 pl-5"
                />
              </div>
              <div class="flex gap-[10px] items-center font-[Poppins] text-zinc-500 pt-[10px] pb-[40px]">
                <img src="/images/cartpage/check.svg" alt="" />
                <span>{{ __('Save This Info For Future') }}</span>
              </div>
            </div>
          </div>
          <button class="w-full bg-red-600 text-white font-[Poppins] py-2 border-0 mt-[24px] mb-[40px] h-[66px] shadow-md rounded">
            {{ __('Pay Now') }}
          </button>
          <footer class="text-center font-[Poppins] text-[12px] text-zinc-700">
            {{ __('Copyright © 2022 FASCO . All Rights Reseved.') }}
          </footer>
        </div>
      </div>
      <div class="w-full lg:max-w-[617px]">
        <div class="grid bg-neutral-100 p-7 gap-28 max-h-[974px] h-auto ">
          @foreach ( $productos as $producto )
          <div class="flex gap-5 mt-10">
            <img src="{{ $producto['producto']->images[0] }}" alt="" class="w-[137px] h-[137px]"/>
            <div class="grid grid-rows-[23px_24px] w-full">
              <div class="text-red-600 font-[Volkhov] text-[18px]">
                {{ $producto['producto']->name }}
              </div>
              <div class="flex justify-between font-[Poppins] text-zinc-500">
                <span>{{__('Color:') }} Red</span>
                <span class="before:content-['$'] text-end">{{$producto['producto']->price }}</span>
              </div>
            </div>
          </div>
          @endforeach
          <div class="grid gap-4 font-[Poppins] text-zinc-700">
            <div class="grid grid-cols-2 justify-between">
              <span>{{ __('Subtotal') }}</span>
              <span class="before:content-['$'] text-end">{{ $totalPagar }}</span>
            </div>
            <div class="grid grid-cols-2 justify-between">
              <span>{{ __('Shipping') }}</span>
              <span class="text-end">Free</span>
            </div>
            <div class="grid grid-cols-2 justify-between">
              <span>{{ __('Total') }}</span>
              <span class="before:content-['$'] text-end">{{ $totalPagar }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
  
