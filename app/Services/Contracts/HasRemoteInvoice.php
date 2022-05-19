<?php

namespace App\Services\Contracts;

use App\Services\DTO\Invoice;

interface HasRemoteInvoice
{
    public function fetch(): Invoice;
}
