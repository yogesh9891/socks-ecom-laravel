<?php

use Modules\FlashSale\Entities\FlashSale;

if (! function_exists('product_price_formatted')) {
    /**
     * Get the selling price of the given product.
     *
     * @param \Modules\Product\Entities\Product $product
     * @param \Closure $callback
     * @return string
     */
    function product_price_formatted($product, $callback = null)
    {
        if (FlashSale::contains($product)) {
            $previousPrice = $product->getSellingPrice()->convertToCurrentCurrency()->format();
            $flashSalePrice = FlashSale::pivot($product)->price->convertToCurrentCurrency()->format();

            if (is_callable($callback)) {
                return $callback($flashSalePrice, $previousPrice);
            }

            return "{$flashSalePrice} <span class='previous-price'>{$previousPrice}</span>";
        }

        $price = $product->price->convertToCurrentCurrency()->format();
        $specialPrice = $product->getSpecialPrice()->convertToCurrentCurrency()->format();

        if (is_callable($callback)) {
            return $callback($price, $specialPrice);
        }

        if (! $product->hasSpecialPrice()) {
            return $price;
        }

        return "{$specialPrice} <span class='previous-price'>{$price}</span>";
    }

    if (! function_exists('member_price_formatted')) {
    /**
     * Get the selling price of the given product.
     *
     * @param \Modules\Product\Entities\Product $product
     * @param \Closure $callback
     * @return string
     */
    function member_price_formatted($product, $callback = null)
    {
        

        if($product->member_price->amount()){

            $price = $product->member_price->convertToCurrentCurrency()->format();
            // $price = round($product->member_price->amount());
            // $currency = $product->member_price->currency();
            // return "<span class='member_price'><span class='currency_symbol'>{$currency}</span> {$price} for Udoobu Club Members</span>";
            return "<span class='member_price'>{$price} for  Members</span>";
        }else{
            return;
        }

        

    }
}

}
