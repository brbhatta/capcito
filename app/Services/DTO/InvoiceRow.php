<?php

namespace App\Services\DTO;

final class InvoiceRow
{
    private string $articleName;
    private string $quantity;
    private int $price;

    public function __construct(
        int $quantity,
        int $price,
        string $articleName
    )
    {
        $this->quantity = $quantity;
        $this->price = $price;
        $this->articleName = $articleName;
    }

    /**
     * @return string
     */
    public function getArticleName(): string
    {
        return $this->articleName;
    }

    /**
     * @return int|string
     */
    public function getQuantity(): int|string
    {
        return $this->quantity;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }
}
