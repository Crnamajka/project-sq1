<button @click="$dispatch('toggle-minicart')" class="relative focus:outline-none">
    <x-svg-shopping-cart class="w-6 h-6 text-black hover:text-primary transition-colors duration-200" />
    <span class="absolute top-0 right-0 flex items-center justify-center px-1 py-0.5 text-xs font-bold text-white bg-red-600 rounded-full">1</span>
</button>