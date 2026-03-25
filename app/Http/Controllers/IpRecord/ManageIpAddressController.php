<?php

namespace App\Http\Controllers\IpRecord;

use App\Http\Controllers\Controller;
use App\Services\IpRecord\ManageIpAddressService;
use Illuminate\Http\Request;

class ManageIpAddressController extends Controller
{
    /**
     * ManageIpAddressService instance
     *
     * @var \App\Service\IpRecord\ManageIpAddressService $manageIpAddressService
     */
    protected ManageIpAddressService $manageIpAddressService;

    /**
     * ManageIpAddressService initialization
     */
    public function __construct(ManageIpAddressService $manageIpAddressService)
    {
        $this->manageIpAddressService = $manageIpAddressService;
    }
}
