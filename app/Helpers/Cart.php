<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\Product_detail;
use App\Models\Product_color;
/**
 * summary
 */
class Cart
{
    public $items = [];
    public $total_quantity = 0;
    public $total_price = 0;
    /**
     * summary
     */
    public function __construct()
    {
        $this->items = Session('cart') ? Session('cart') : [];
        if ($this->items!='') {
            foreach ($this->items as $pro_detail) {
                foreach ($pro_detail as $pro_color) {
                    $this->total_quantity += $pro_color['quantity'];
                }
            }
        }
        if ($this->items!='') {
            // dd($this->items);
            foreach ($this->items as $data) {
                foreach ($data as $value) {
                    $this->total_price += $value['quantity']*$value['price'];
                }
            }   
        }
    }

    public function addOne($pro_detail_id,$color_id){
        // dd(Session('cart'));
        // dd($this->items);
        // dd($this->total_quantity);
        $product_detail =Product_detail::find($pro_detail_id);
        // dd($product_detail->id);
        $product = [
            'name'=>$product_detail->product->name,
            'image'=>$product_detail->product->image
        ];
        // dd($product);
        //Tao ten cho san pham trong gio hang
        $cpu = $product_detail->cpu ? ' '.$product_detail->cpu : '';
        $ram = $product_detail->ram ? ' '.$product_detail->ram : '';
        $memory = $product_detail->memory ? ' '.$product_detail->memory : '';
        $name = $product['name'].$cpu.$ram.$memory;
        // dd($name);
        $product_color = Product_color::where('product_id',$product_detail->product_id)->get();
        foreach ($product_color as $value){
            $color_list[] = [
                'pro_color_id'=>$value->id,
                'color_name'=>$value->name,
                'color_image'=>$value->logo
            ];
        }

        $item = [
            'id' => $product_detail->id,
            'name' => $name,
            'quantity' => 1,
            'color' => Product_color::find($color_id)->name,
            'image' => Product_color::find($color_id)->logo,
            // 'image' => $product['image'],
            'price' => $product_detail->sale_price ? $product_detail->price-$product_detail->sale_price : $product_detail->price,
            'color_list'=>$color_list
        ];
        if ($this->items==null) {
            $this->items[$product_detail->id][$color_id] = $item;
            // dd('null');
        }else{
            // dd('not null');
            if (array_key_exists ( $product_detail->id , $this->items )) {
                if (array_key_exists ( $color_id , $this->items[$product_detail->id] )){
                    $this->items[$product_detail->id][$color_id]['quantity'] += 1;
                }else{
                    $this->items[$product_detail->id][$color_id] = $item;
                }
            }else{
                $this->items[$product_detail->id][$color_id] = $item;
            }
        }

        session(['cart' => $this->items]);
        // dd(Session('cart'));
        return true;
    }

    public function del($pro_detail_id,$pro_color_id){
         unset($this->items[$pro_detail_id][$pro_color_id]); 
         if ($this->items[$pro_detail_id]==[]) {
             unset($this->items[$pro_detail_id]); 
         }
         session(['cart' => $this->items]);
         return true;
    }

    public function clear(){
        $this->items = [];
        session(['cart' => $this->items]);
    }

    public function updateQty($pro_detail_id,$pro_color_id,$quantity){
        $this->items[$pro_detail_id][$pro_color_id]['quantity'] = $quantity;
        session(['cart' => $this->items]);
    }

    public function updateColor($pro_detail_id,$old_color_id,$new_color_id){
        // dd($this->items);
        // Nếu tồn tại prodetail co trùng màu thì sẽ gộp số lượng lại
        if (array_key_exists($new_color_id,$this->items[$pro_detail_id])) {
            $this->items[$pro_detail_id][$new_color_id]['quantity'] = $this->items[$pro_detail_id][$new_color_id]['quantity'] + $this->items[$pro_detail_id][$old_color_id]['quantity'];
            unset($this->items[$pro_detail_id][$old_color_id]);
        }else{
            //Nếu không thì đổi thành giá trị mới
            // $this->items[$pro_detail_id][$new_color_id] = $this->items[$pro_detail_id][$old_color_id];
            // foreach ($this->items[$pro_detail_id][$new_color_id]['color_list'] as $value) {
            //     if ($value['pro_color_id'] == $new_color_id) {
            //         $this->items[$pro_detail_id][$new_color_id]['image'] = $value['color_image'];
            //     }
            // }
            // unset($this->items[$pro_detail_id][$old_color_id]);
            $this->items[$pro_detail_id] = $this->array_replace_key($old_color_id, $new_color_id, $this->items[$pro_detail_id]);
        }
        session(['cart' => $this->items]);
    }

    // Hàm đổi tên key của array
    public function array_replace_key($search, $replace, array $subject) {
    $updatedArray = [];
    foreach ($subject as $key => $value) {
        if ($key == $search) {
            $updatedArray[$replace] = $value;
            foreach ($value['color_list'] as $color) {
                if($color['pro_color_id']==$replace){
                    $updatedArray[$replace]['color'] = $color['color_name'];
                    $updatedArray[$replace]['image'] = $color['color_image'];
                    break;
                }
            }
            // dd('ád');
        }else{
            $updatedArray[$key] = $value;
        }
    }
    // dd($updatedArray);
    return $updatedArray;
    } 

}