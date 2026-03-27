<?php

namespace App\Http\Controllers\IpRecord;

use App\Http\Controllers\Controller;
use App\Http\Requests\IpRecord\IpAddressListRequest;
use App\Http\Resources\IpRecord\IpAddressCollection;
use App\Services\IpRecord\ViewIpAddressService;
use Illuminate\Http\Request;

class ViewIpAddressController extends Controller
{
    /**
     * ViewIpAddressService instance
     *
     * @var \App\Services\IpRecord\ViewIpAddressService $viewIpAddressService
     */
    protected ViewIpAddressService $viewIpAddressService;

    /**
     * ViewIpAddressService initialization
     */
    public function __construct(ViewIpAddressService $viewIpAddressService)
    {
        $this->viewIpAddressService = $viewIpAddressService;
    }

    /**
     * Retrieve list of IP Addresses. (Retrieves all records when no search query)
     *
     * @param \App\Http\Requests\IpRecord\IpAddressListRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(IpAddressListRequest $request)
    {
        $input = $request->all();
        $data = $this->viewIpAddressService->search($input);

        $ipAddresses = IpAddressCollection::make($data)
            ->response()
            ->getData(true);

        return response()->json($ipAddresses);
    }

    public function view()
    {
        return response()->json('view');
    }
}
