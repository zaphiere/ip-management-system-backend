<?php

namespace App\Http\Controllers\IpRecord;

use App\Http\Controllers\Controller;
use App\Services\IpRecord\ViewIpAddressService;
use Illuminate\Http\Request;

class ViewIpAddressController extends Controller
{
    /**
     * ViewIpAddressService instance
     *
     * @var \App\Service\IpRecord\ViewIpAddressService $viewIpAddressService
     */
    protected ViewIpAddressService $viewIpAddressService;

    /**
     * ViewIpAddressService initialization
     */
    public function __construct(ViewIpAddressService $viewIpAddressService)
    {
        $this->viewIpAddressService = $viewIpAddressService;
    }
}
