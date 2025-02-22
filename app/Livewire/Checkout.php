<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class Checkout extends Component
{
    

    public $productos=[];
    public $totalPagar=0;
    public $wrap=false;

    
    public function render()
    {
        return view('livewire.checkout');
    }
    public function mount(){
        $this->wrap=Session::get('wrap');
        $this->updateInfoProduct();
    }

    public function updateInfoProduct(){
        $totalPagar=$this->wrap ? 10 : 0;
        $productosSession=Session::get('shoppingCart'); 
        if(!$productosSession){
            $productosSession=[];
        }
        $productos=[];
        foreach($productosSession as $value){
            $productoBD=Product::where('id', $value['productId'])->first();
            $totalPagar+=$productoBD->price*$value['quantity'];
            $productos[]=[
                'producto'=>$productoBD,
                'cantidad'=>$value['quantity']
            ];
        }

        $this->productos=$productos;
        $this->totalPagar=$totalPagar;
    }

}
