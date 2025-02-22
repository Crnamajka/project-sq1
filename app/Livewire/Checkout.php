<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    

    public $productos=[];
    public $totalPagar=0;
    public $wrap=false;
    public $email;
    public $country;
    public $firstName;
    public $lastName;
    public $address;
    public $city;
    public $postalCode;

    public $productId;
    
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


    public function buy(){
        $order=Order::create([
            'user_id'=>Auth::user()->id,
            'email'=>$this->email,
            'total_amount'=>$this->totalPagar,
            'country'=>$this->country,
            'first_name'=>$this->firstName,
            'last_name'=>$this->lastName,
            'address'=>$this->address,
            'city'=>$this->city,
            'postal_code'=>$this->postalCode
        ]);

        foreach($this->productos as $value){
            OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>$value['producto']->id,
                'quantity'=>$value['cantidad'],
                'unit_price'=>$value['producto']->price
            ]);
        }
    }

}
