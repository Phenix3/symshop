<?php

namespace App\Service\Shipping;

use App\Entity\Colissimo;
use App\Repository\ColissimoRepository;
use App\Repository\CountryRepository;
use App\Repository\RangeRepository;
use App\Service\Cart\CartService;

class ShippingService
{
    protected $cartService;
    protected $rangeRepository;
    protected $countryRepository;
    protected $colissimoRepository;

    public function __construct(
        CartService $cartService,
        RangeRepository $rangeRepository,
        CountryRepository $countryRepository,
        ColissimoRepository $colissimoRepository
    ) {
        $this->cartService     = $cartService;
        $this->rangeRepository = $rangeRepository;
        $this->countryRepository = $countryRepository;
        $this->colissimoRepository = $colissimoRepository;
    }

    public function compute($country_id)
    {
        $cartItems = $this->cartService->getContent();

        $weight = $cartItems->sum(function ($item) {
            return $item->quantity * $item->model->getWeight();
        });

        
        // $range = $this->rangeRepository->findAndOrderByMax($weight, [$country_id]);
        $country = $this->countryRepository->findOneBy(['id' => $country_id]);
        // dd($country);
        $colissimos = $this->colissimoRepository->findBy(['country' => $country]);
        /* dd($range, $country, $colissimos);
        $colissimo = $colissimos->filter(function ($col) use ($country, $range) {
            return $col->getCountry() === $country;
        });
        */
        $col = collect($colissimos)->first();

        // dd($col->getPrice());

        return (collect($colissimos)->first())->getPrice();
    }
}
