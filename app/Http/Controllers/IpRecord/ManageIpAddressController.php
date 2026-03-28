<?php

namespace App\Http\Controllers\IpRecord;

use App\Helpers\JsonResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\IpRecord\CreateIpRecordRequest;
use App\Http\Resources\IpRecord\IpAddressResource;
use App\Services\IpRecord\ManageIpAddressService;
use Illuminate\Http\Request;

class ManageIpAddressController extends Controller
{
    /**
     * ManageIpAddressService instance
     *
     * @var \App\Services\IpRecord\ManageIpAddressService $manageIpAddressService
     */
    protected ManageIpAddressService $manageIpAddressService;

    /**
     * Service initialization
     */
    public function __construct(ManageIpAddressService $manageIpAddressService)
    {
        $this->manageIpAddressService = $manageIpAddressService;
    }

    /**
     * Create IP Record
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateIpRecordRequest $request)
    {
        $input = $request->validated();
        $ipRecord = $this->manageIpAddressService->store($input);

        $data = new IpAddressResource($ipRecord);

        return JsonResponseHelper::success($data, 'Created IP Record Successfully');
    }

    public function edit()
    {
        return response()->json('edit');
    }

    public function delete()
    {
        return response()->json('delete');
    }
}
