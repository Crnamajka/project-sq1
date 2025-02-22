<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class Products extends Component
{
    // Escuchamos el filtro de talla vía método directo (si se quiere emitir desde JS, se puede ajustar)
    protected $listeners = [
        'filterSize'
    ];

    public $sizeSelected = [];
    public $colorSelected = [];
    public $priceSelected = [];
    public $brandSelected = [];

    public $products = [];

    public $sizes = ['S', 'M', 'L', 'XL'];

    public $colors = [
        [
            "key" => "Red",
            "color" => "bg-red-500",
        ],
        [
            "key" => "Orange",
            "color" => "bg-orange-500",
        ],
        [
            "key" => "Yellow",
            "color" => "bg-yellow-500",
        ],
        [
            "key" => "Green",
            "color" => "bg-green-500",
        ],
        [
            "key" => "Blue",
            "color" => "bg-blue-500",
        ],
        [
            "key" => "Purple",
            "color" => "bg-purple-500",
        ],
        [
            "key" => "Pink",
            "color" => "bg-pink-500",
        ],
    ];

    public $brands = [
        'Minimog',
        'Retrolie',
        'Brook',
        'Learts',
        'Vagabond',
        'Abby',
    ];

    public $prices = [
        '$0-$50',
        '$50-$100',
        '$100-$150',
        '$150-$200',
        '$300-$400',
    ];

    public $collections = [
        'All products',
        'Best sellers',
        'New Arrivals',
        'Accessories',
    ];

    // --- Métodos para filtrado de color basado en HUE ---
    public function getHueRangeForColor($colorKey)
    {
        $ranges = [
            'Red'    => [[340, 360], [0, 20]],
            'Orange' => [[20, 40]],
            'Yellow' => [[40, 70]],
            'Green'  => [[70, 170]],
            'Blue'   => [[170, 250]],
            'Purple' => [[250, 300]],
            'Pink'   => [[300, 340]],
        ];
        return $ranges[$colorKey] ?? null;
    }

    public function hexToHsl($hex)
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        $r = hexdec(substr($hex, 0, 2)) / 255;
        $g = hexdec(substr($hex, 2, 2)) / 255;
        $b = hexdec(substr($hex, 4, 2)) / 255;
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $l = ($max + $min) / 2;

        if ($max === $min) {
            $h = 0;
            $s = 0;
        } else {
            $delta = $max - $min;
            $s = $l > 0.5 ? $delta / (2 - $max - $min) : $delta / ($max + $min);
            if ($max === $r) {
                $h = ($g - $b) / $delta + ($g < $b ? 6 : 0);
            } elseif ($max === $g) {
                $h = ($b - $r) / $delta + 2;
            } else {
                $h = ($r - $g) / $delta + 4;
            }
            $h *= 60;
        }
        return ['h' => $h, 's' => $s, 'l' => $l];
    }

    public function hueInRange($hue, $ranges)
    {
        foreach ($ranges as $range) {
            if ($hue >= $range[0] && $hue <= $range[1]) {
                return true;
            }
        }
        return false;
    }

    // --- Métodos de filtrado ---
    public function filterSize($sSize)
    {
        if (in_array($sSize, $this->sizeSelected)) {
            $this->sizeSelected = array_diff($this->sizeSelected, [$sSize]);
        } else {
            $this->sizeSelected[] = $sSize;
        }
        $this->getProductsFilter();
    }

    public function filterColor($colorKey)
    {
        if (in_array($colorKey, $this->colorSelected)) {
            $this->colorSelected = array_diff($this->colorSelected, [$colorKey]);
        } else {
            $this->colorSelected[] = $colorKey;
        }
        $this->getProductsFilter();
    }

    public function filterPrice($price)
    {
        if (in_array($price, $this->priceSelected)) {
            $this->priceSelected = array_diff($this->priceSelected, [$price]);
        } else {
            $this->priceSelected[] = $price;
        }
        $this->getProductsFilter();
    }

    public function filterBrand($brand)
    {
        if (in_array($brand, $this->brandSelected)) {
            $this->brandSelected = array_diff($this->brandSelected, [$brand]);
        } else {
            $this->brandSelected[] = $brand;
        }
        $this->getProductsFilter();
    }

    public function mount()
    {
        $this->getProductsFilter();
    }

    public function getProductsFilter()
    {
        $query = Product::query();

        // Filtrado por tallas
        if (!empty($this->sizeSelected)) {
            $query->where(function ($q) {
                foreach ($this->sizeSelected as $size) {
                    $q->orWhereJsonContains('sizes', $size);
                }
            });
        }

        // Filtrado por marcas
        if (!empty($this->brandSelected)) {
            $query->whereIn('brand', $this->brandSelected);
        }

        // Filtrado por precios (interpretando el rango "$min-$max")
        if (!empty($this->priceSelected)) {
            $query->where(function ($q) {
                foreach ($this->priceSelected as $priceRange) {
                    $range = explode('-', str_replace('$', '', $priceRange));
                    if (count($range) == 2) {
                        $min = (float) trim($range[0]);
                        $max = (float) trim($range[1]);
                        $q->orWhereBetween('price', [$min, $max]);
                    }
                }
            });
        }

        // Se obtienen los productos que cumplen las condiciones anteriores
        $products = $query->get();

        // Filtrado por colores (se procesa en PHP)
        if (!empty($this->colorSelected)) {
            $filtered = [];
            foreach ($products as $product) {
                $match = false;
                foreach ($product->colors as $hex) {
                    $hsl = $this->hexToHsl($hex);
                    foreach ($this->colorSelected as $colorKey) {
                        $ranges = $this->getHueRangeForColor($colorKey);
                        if ($ranges && $this->hueInRange($hsl['h'], $ranges)) {
                            $match = true;
                            break 2;
                        }
                    }
                }
                if ($match) {
                    $filtered[] = $product;
                }
            }
            $this->products = collect($filtered)->toArray();
        } else {
            $this->products = $products->toArray();
        }
    }

    public function render()
    {
        return view('livewire.products', [
            'sizes'         => $this->sizes,
            'colors'        => $this->colors,
            'brands'        => $this->brands,
            'prices'        => $this->prices,
            'collections'   => $this->collections,
            'products'      => $this->products,
            'colorSelected' => $this->colorSelected,
            'priceSelected' => $this->priceSelected,
            'brandSelected' => $this->brandSelected,
        ]);
    }
}
