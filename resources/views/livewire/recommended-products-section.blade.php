<div class="wrapper space-y-10">
    <div class="py-16 bg-panel-back grid grid-cols-2 gap-4 py-15">
        <div class="flex justify-center items-center">
            <img src="{{ asset('images/image 2.png') }}" alt="Discount image">
        </div>
        <div class="flex flex-col justify-center">
          <p class=" mb-[16px] font-poppin text-panel-second text-lg">
            {{ __('HOT DEALS THIS WEEK') }}
          </p>
          <div>
            <p class="font-roboto text-panel-first text-4xl font-semibold mb-[30px]">
                {{ __('SALE UP 50%')}} <br> {{ __('MODERN FURNITURE') }}
            </p>
              <button class=" font-sans font-bold mt-[6px] ml-4 w-auto self-start focus:outline-none border border-panel text-panel focus:ring-4 focus:ring-zinc-400  rounded text-sm px-5 py-2.5 mb-2 dark:hover:bg-zinc-500 dark:hover:text-white">
                {{ __('View now') }}
              </button>
          </div>
        </div>
      </div>
</div>
