<?php

if (!function_exists('getInvitationStatus')) {
    function getInvitationStatus($status)
    {
        return match ($status) {
            "SIR" => SEND_INVITE_REQUEST,
            "AIR" => ACCEPT_INVITE_REQUEST,
            "CIR" => CANCEL_INVITE_REQUEST,
            "RIR" => REJECT_INVITE_REQUEST,
            default => null,
        };   
    }
}