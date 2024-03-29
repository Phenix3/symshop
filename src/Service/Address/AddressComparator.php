<?php

namespace App\Service\Address;

use App\Entity\Address;

final class AddressComparator
{
    public function equal(Address $firstAddress, Address $secondAddress): bool
    {
        dump($firstAddress, $secondAddress);
        return $this->normalizeAddress($firstAddress) === $this->normalizeAddress($secondAddress);
    }

    private function normalizeAddress(Address $address): array
    {
        return array_map(fn($value) => strtolower(is_object($value) ? $value : trim((string) $value)), [
            $address->getIsProfessionnal(),
            $address->getCivility(),
            $address->getName(),
            $address->getFirstName(),
            $address->getCompany(),
            $address->getAddress(),
            $address->getAddressbis(),
            $address->getBp(),
            $address->getPostal(),
            $address->getCity(),
            $address->getPhone(),
            $address->getCountry(),
            $address->getUser(),
        ]);
    }
}