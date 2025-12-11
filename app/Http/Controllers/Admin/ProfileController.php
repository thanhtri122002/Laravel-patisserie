<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Services\admin\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileController extends BaseController
{   
    private function admin()
    {
        return request()->user();
    }

    public function getProfilesOwner(Request $request)
    {
        Log::info($this->admin());
        Log::info('request user', [$request->user()]);
        Log::info('auth user', [auth()->user()]);
        $data = ProfileService::getInstance()->withUser($this->admin())->getProfileOwner();

        return $this->sendSuccessResponse($data, "Retrieved data successfully", Response::OK);
    }
    public function detail()
    {   
        $data = ProfileService::getInstance()->withUser($this->admin())->detail();

        return $this->sendSuccessResponse($data, "Retrieved data successfully", Response::OK);
    }
    public function create(ProfileRequest $request)
    {
        $validated = $request->validated();
        $data = ProfileService::getInstance()->withUser($this->admin())->create($validated);

        return $this->sendSuccessResponse($data, "Retrieved data successfully", Response::OK);
    }
    public function update(ProfileRequest $request)
    {
        $validated = $request->validated();
        $data = ProfileService::getInstance()->withUser($this->admin())->update($validated);

        return $this->sendSuccessResponse($data, "Updated data successfully", Response::OK);
    }

    public function getAvatarImg()
    {
        $data = ProfileService::getInstance()->withUser($this->admin())->getAvatartPicture();

        return $this->sendSuccessResponse($data, "Retrived avatar image successfully", Response::OK);
    }

    public function getProfileImages()
    {
        $data = ProfileService::getInstance()->withUser($this->admin())->getProfileImages();

        return $this->sendSuccessResponse($data, 'Retrieved data successfully', Response::OK);
    }
    public function delete()
    {

    }
}
