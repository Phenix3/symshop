<?php

namespace App\Service\Shipping;

use App\Repository\ColissimoRepository;
use App\Repository\CountryRepository;
use App\Repository\RangeRepository;
use App\Service\Cart\CartService;

class ShippingService
{
    public function __construct(protected CartService $cartService, protected RangeRepository $rangeRepository, protected CountryRepository $countryRepository, protected ColissimoRepository $colissimoRepository)
    {
    }

    public function compute($country_id)
    {
        $cartItems = $this->cartService->getContent();

        $cartItems->sum(fn($item) => $item->quantity * $item->model->getWeight());

        
        // $range = $this->rangeRepository->findAndOrderByMax($weight, [$country_id]);
        $country = $this->countryRepository->findOneBy(['id' => $country_id]);
        // dd($country);
        $colissimos = $this->colissimoRepository->findBy(['country' => $country]);
        /* dd($range, $country, $colissimos);
        $colissimo = $colissimos->filter(function ($col) use ($country, $range) {
            return $col->getCountry() === $country;
        });
        */
        collect($colissimos)->first();

        // dd($col->getPrice());

        return (collect($colissimos)->first())->getPrice();
    }
}
