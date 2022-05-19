<?php

namespace App\Http\Controllers;

use App\Exceptions\InvoiceNotFound;
use App\Http\Resources\InvoiceResource;
use App\Services\Factories\RemoteInvoiceFactory;

class FetchInvoiceController extends Controller
{
    public function __invoke(string $provider, string $id)
    {
        try {
            $remoteInvoice = RemoteInvoiceFactory::create($provider, $id);
            return new InvoiceResource($remoteInvoice->fetch());
        } catch (InvoiceNotFound $exception) {
            return response()->json($exception->getMessage(), 404);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
