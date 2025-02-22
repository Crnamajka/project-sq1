<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class Cart extends Component
{
    public $productos=[];
    public $totalPagar=0;

    public $wrap=false;

    public function render()
    {
        return view('livewire.cart');
    }

    public function mount(){
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

    public function deleteProductInfo($productId){
        $productFounded=false;
        $productosSession=Session::get('shoppingCart'); 
        $position=0;
        if($productosSession){
            foreach($productosSession as $productoSession){
                if($productoSession['productId']==$productId){
                    $productFounded=true;
                    break;
                }
    
                $position+=1;
            }
        }
        
        if($productFounded){
            array_splice($productosSession, $position, 1);
            Session::put('shoppingCart',$productosSession);
        }
        $this->updateInfoProduct();
    }

    public function selectWrap(){
        $this->wrap=!$this->wrap;
        Session::put('wrap',$this->wrap);
        $this->updateInfoProduct();
    }
        
}
