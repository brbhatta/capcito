<?php

namespace App\Services\Factories;

use App\Enum\ERP;
use App\Exceptions\InvalidERP;
use App\Services\RemoteInvoices\FortStocksInvoice;
use App\Services\RemoteInvoices\VizmaInvoice;
use App\Services\Contracts\HasRemoteInvoice;

class RemoteInvoiceFactory
{
    /**
     * @throws \Exception
     */
    public static function create(string $provider, string $id): HasRemoteInvoice
    {
        return match ($provider) {
            ERP::FORT_SOCKS->value => new FortStocksInvoice($id),
            ERP::VIZMA->value => new VizmaInvoice($id),
            default => throw new InvalidERP('Invalid Provider'),
        };
    }
}
