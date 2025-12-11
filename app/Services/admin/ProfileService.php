<?php
namespace App\Services\admin;

use App\Services\Service;

class ProfileService extends Service
{
    public function getProfileOwner()
    {   
        return $this->user;
    }

    public function detail()
    {
        return $this->user?->profile;
    }

    public function getAvatartPicture()
    {
        if (!$this->user || !$this->user->profile) {
            return null;
        }

        return $this->user
            ->profile
            ->profilePictures()
            ->first();
    }

    public function getProfileImages()
    {
        if (!$this->user || !$this->user->profile) {
            return collect();
        }

        return $this->user->profile->profilePictures;
    }

    public function create($validated)
    {   
        return $this->user->profile()->firstOrCreate(
            $validated // ✅ attributes to create
        );
    }

    public function update($validated)
    {
        if (!$this->user->profile) {
            return null;
        }

        $this->user->profile->update($validated);

        return $this->user->profile;
    }
}
