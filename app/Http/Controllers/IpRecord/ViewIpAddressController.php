<?php

namespace App\Http\Controllers\IpRecord;

use App\Helpers\JsonResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\IpRecord;
use App\Http\Requests\IpRecord\IpAddressListRequest;
use App\Http\Resources\IpRecord\{
    IpAddressCollection,
    IpAddressResource,
};
use App\Services\IpRecord\ViewIpAddressService;

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
        $input = $request->validated();
        $data = $this->viewIpAddressService->search($input);

        $ipAddresses = IpAddressCollection::make($data)
            ->response()
            ->getData(true);

        return JsonResponseHelper::successList($ipAddresses, 'Retrieved IP Record Lists Successfully');
    }

    /**
     * Retrieve single IP Address record
     *
     * @param \App\Models\IpRecord $ipRecord
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(IpRecord $ipRecord)
    {
        $ipAddress = new IpAddressResource($ipRecord);

       return JsonResponseHelper::success($ipAddress, 'Retrieved IP Record Successfully');
    }
}
