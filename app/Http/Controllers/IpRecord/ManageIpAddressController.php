<?php

namespace App\Http\Controllers\IpRecord;

use App\Helpers\JsonResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\IpRecord\{
    CreateIpRecordRequest,
    EditIpRecordRequest,
};
use App\Http\Resources\IpRecord\IpAddressResource;
use App\Models\IpRecord;
use App\Services\IpRecord\ManageIpAddressService;

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

    /**
     * Edit IP Record
     *
     * @param \App\Models\IpRecord $ipRecord
     * @param \App\Http\Requests\IpRecord\EditIpRecordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(IpRecord $ipRecord, EditIpRecordRequest $request)
    {
        $this->authorize('update', $ipRecord);

        $input = $request->validated();
        $updateIpRecord = $this->manageIpAddressService->update($ipRecord, $input);

        $data = new IpAddressResource($updateIpRecord);

        return JsonResponseHelper::success($data, 'Updated Ip Record Successfully');
    }

    /**
     * Delete Ip Record
     *
     * @param \App\Models\IpRecord $ipRecord
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(IpRecord $ipRecord)
    {
        $this->authorize('delete', $ipRecord);

        $this->manageIpAddressService->delete($ipRecord);

        return JsonResponseHelper::success(null, 'Ip Record Deleted');
    }
}
