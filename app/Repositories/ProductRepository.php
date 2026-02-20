<?php

namespace App\Repositories;
use App\Models\Product;
use App\Models\ProductDetails;
use Arafat\LaravelRepository\Repository;
use Illuminate\Http\Request;

class ProductRepository extends Repository
{
    /**
     * base method
     */
    public static function model()
    {
        return Product::class;
    }
    public static function storeByRequest(Request $request): Product
    {
        $thumbnail = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = MediaRepository::storeByRequest(
                $request->file('thumbnail'),
                'product',
                'image'
            );
        }
        // ✅ FIX: null safe media_id
        $product = self::create([
            'name'      => $request->name,
            'sku_code'  => $request->product_sku,
            'price'     => $request->selling_price,
            'by_price'  => $request->buying_price,
            'discount'  => 0,
            'media_id'  => $thumbnail?->id,
        ]);
        ProductDetails::create([
            'product_id'        => $product->id,
            'category_id'       => $request->category,
            'sub_category_id'   => $request->sub_category,
            'brand_id'          => $request->brand,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'additional_info'   => $request->additional_information,
        ]);
        // ✅ Tags sync
        if ($request->filled('tags')) {
            $product->tags()->sync($request->tags);
        }

        // ✅ Gallery images
        $mediaIds = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $media = MediaRepository::storeByRequest($image, 'product', 'image');
                $mediaIds[] = $media->id;
            }
        }
        // ✅ Inventory
      if ($mediaIds > 0) {
        $product->galleries()->sync($mediaIds);
       }

       return $product;
    }
    public function discountPercentage($byPrice, $selPrice)
    {
        // ✅ FIX: division by zero safe
        if ($byPrice == 0) {
            return 0;
        }

        return (($byPrice - $selPrice) / $byPrice) * 100;
    }
    public static function updateByRequest(Request $request, Product $product): Product
    {
        $media = $product->media;

        // (optional) thumbnail update logic
        // if ($request->hasFile('thumbnail')) {
        //     if ($media) {
        //         $media = MediaRepository::updateByRequest(
        //             $request->file('thumbnail'),
        //             'product',
        //             'image',
        //             $media
        //         );
        //     } else {
        //         $media = MediaRepository::storeByRequest(
        //             $request->file('thumbnail'),
        //             'product',
        //             'image'
        //         );
        //     }
        // }

        // ✅ FIX: null safe media_id
        $product->update([
            'name'     => $request->name,
            'price'    => $request->selling_price,
            'by_price' => $request->buying_price,
            'media_id' => $media?->id,
        ]);
        $product->details->update([
            'category_id'       => $request->category,
            'sub_category_id'   => $request->sub_category,
            'brand_id'          => $request->brand,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'additional_info'   => $request->additional_information,
        ]);
        if ($request->filled('tags')) {
            $product->tags()->sync($request->tags);
        }
        return $product;
    }
    public static function ProductGalleryStoreOrUpdate(Request $request, int $id): Product
    {
        // ✅ FIX: safe find
        $product = Product::findOrFail($id);

        $mediaIds = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $media = MediaRepository::storeByRequest($image, 'product', 'image');
                $mediaIds[] = $media->id;
            }
        }
        if (count($mediaIds) > 0) {
            $product->galleries()->sync($mediaIds);
        }
        return $product;
    }
    }
