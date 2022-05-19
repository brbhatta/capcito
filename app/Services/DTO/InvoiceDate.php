<?php

namespace App\Services\DTO;

use Carbon\Carbon;

final class InvoiceDate
{
    const DATE_FORMAT = 'Y-m-d H:i:s';

    private string $createdAt;
    private string $updatedAt;
    private string $issueDate;
    private string $dueDate;

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getIssueDate(): string
    {
        return $this->issueDate;
    }

    /**
     * @return string
     */
    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    private function __construct(string $invoiceDate, string $dueDate)
    {
        $this->issueDate = Carbon::createFromTimestamp(strtotime($invoiceDate))->format(self::DATE_FORMAT);
        $this->dueDate = Carbon::createFromTimestamp(strtotime($dueDate))->format(self::DATE_FORMAT);

        $this->createdAt = Carbon::now()->format(self::DATE_FORMAT);
        $this->updatedAt = Carbon::now()->format(self::DATE_FORMAT);
    }


    public static function build(string $invoiceDate, string $dueDate): self
    {
        return (new self($invoiceDate, $dueDate));
    }
}
