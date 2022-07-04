<?php

namespace App\Http\Controllers;

use App\Core\Request;
use App\Http\Requests\InvitationRequest;
use App\Http\Requests\InvitationUpdateRequest;
use App\Services\InvitationService;

class InvitationController
{
    public function __construct(protected InvitationService $invitationService)
    {
        # code...
    }

    public function create()
    {
        $validated = (new InvitationRequest())->validated();

        return $this->invitationService->create($validated);
    }

    public function update()
    {
        $validated = (new InvitationUpdateRequest())->validated();

        return $this->invitationService->update($validated);
    }
}