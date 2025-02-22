<template x-teleport="#minicart-container">
    <section id="mini-cart" class="fixed top-0 right-0 z-50 w-full sm:w-80 h-full bg-white shadow-lg overflow-y-auto p-4" x-show="minicartOpen" x-transition>
        <div class="text-primary">
            <div class="flex justify-between items-center">
                <p class="text-xl font-bold">Carrito de compras</p>
                <button @click="minicartOpen = false" class="focus:outline-none">
                    <img src="/assets/img/svg/iconos/Cancel.svg" alt="Cerrar" class="w-6 h-6">
                </button>
            </div>
            <div class="mt-2 flex justify-between text-sm">
                <span>Compra</span>
                <span><strong>122,35</strong></span>
                <span>Más y obtén</span>
                <span><strong>Envío gratis</strong></span>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-4">
            <img src="/assets/img/cart-image.png" alt="Producto" class="w-20 h-20 object-cover">
            <div class="flex-1">
                <p class="font-bold">Chaqueta vaquera</p>
                <p class="text-sm">Color: rojo</p>
                <div class="flex items-center mt-2 border border-gray-300 rounded p-1">
                    <button class="focus:outline-none">
                        <img src="/assets/img/svg/iconos/bold-.svg" alt="Disminuir" class="w-4 h-4">
                    </button>
                    <span class="mx-2">01</span>
                    <button class="focus:outline-none">
                        <img src="/assets/img/svg/iconos/bold+.svg" alt="Aumentar" class="w-4 h-4">
                    </button>
                </div>
                <button class="mt-2 text-red-500 text-sm">Quitar</button>
            </div>
        </div>
        <section class="mt-6">
            <div class="flex items-center border-t border-gray-300 pt-4">
                <img src="/assets/img/svg/iconos/check.svg" alt="Verificar" class="w-5 h-5">
                <div class="ml-2 text-sm">
                    <span>Por</span>
                    <span class="font-bold">$10.00</span>
                    <span>Envuelva el producto</span>
                </div>
            </div>
            <div class="flex justify-between items-center mt-4">
                <span class="text-lg font-semibold">Subtotal</span>
                <span class="text-lg font-bold">$100.00</span>
            </div>
            <button class="mt-4 w-full bg-red-600 text-white py-2 rounded">Ir a caja</button>
            <a href="/cartpage.html" class="mt-2 block text-center text-blue-600 underline">Ver carrito</a>
        </section>
    </section>
</template>