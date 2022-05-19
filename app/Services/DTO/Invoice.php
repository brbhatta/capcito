<?php

namespace App\Services\DTO;

use App\Services\Contracts\Actions\FetchesERPInvoice;

class Invoice
{
    private int $id;
    private string $invoiceNumber;
    private InvoiceDate $dates;
    private string $currency;
    private int $totalAmount;
    private string $customNotes;
    private array $rows;

    public function __construct(
        string $id,
        string $invoiceNumber,
        InvoiceDate $dates,
        string $currency,
        string $totalAmount,
        array $rows,
        string $customNotes = '',
    )
    {
        $this->id = (int) $id;
        $this->invoiceNumber = (int) $invoiceNumber;
        $this->dates = $dates;
        $this->currency = $currency;
        $this->totalAmount = $totalAmount;
        $this->rows = $rows;
        $this->customNotes = $customNotes;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getInvoiceNumber(): int
    {
        return $this->invoiceNumber;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }

    /**
     * @return string
     */
    public function getCustomNotes(): string
    {
        return $this->customNotes;
    }

    /**
     * @return InvoiceDate
     */
    public function getDates(): array
    {
        $date = $this->dates;

        return [
            'created_at' => $date->getCreatedAt(),
            'updated_at' => $date->getUpdatedAt(),
            'issue_date' => $date->getIssueDate(),
            'due_date' => $date->getDueDate()
        ];
    }

    /**
     * @return array
     */
    public function getRows(): array
    {
        $rows = [];

        foreach ($this->rows as $row) {
            $rows[] = [
                'article_name' => $row->getArticleName(),
                'quantity' => $row->getQuantity(),
                'price' => $row->getPrice()
            ];
        }

        return $rows;
    }
}
