<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class Detail extends Component
{
    public $product ;


    public function render()
    {
        return view('livewire.detail');
    }

    public function mount($productId){
        $this->product=Product::where('id', $productId)->first();
    }

    public function addToCart($nCantidad){
        $shoppingCart=Session::get('shoppingCart');  
        if(!$shoppingCart){
            $shoppingCart=[];
        }

        $position=0;
        $productFounded=false;

        foreach($shoppingCart as $value){
            if($value['productId']==$this->product->id){
                $productFounded=true;
                break;
            }
            $position+=1;
        }


        if($productFounded){
            $shoppingCart[$position]['quantity']+=$nCantidad;        
        } else{
            $shoppingCart[]=[
                'productId'=>$this->product->id,
                'quantity'=>$nCantidad
            ];
        }
        
        Session::put('shoppingCart', $shoppingCart);
    }

}
