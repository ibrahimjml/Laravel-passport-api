<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
      return [
        'data' => $this->collection->map(function ($product) {
            return [
                'ID' => $product->id,
                'title' => $product->title,
                'description' => $product->description,
                'slug'=>$product->slug,
                'price' => $product->price,
                'stock' => $product->stock === 0 ? 'out of stock' : $product->stock,
                'discount' => $product->discount,
                'size' => $product->size,
            ];
        }),
    ];
    }
}
