<?php

function userHasBasicMembership($userObj) :bool
{

    // عضويه اساسية

    if (
        isValidUser($userObj) &&
        !userHasValidMembership($userObj)
    )
    {

        // valid user
        // not have membership or has expire membership

        return true;
    }


    return false;
}

function userHasPremiumMembership($userObj) :bool
{

    // عضويه مميزة فعالة

    if (
        isValidUser($userObj) &&
        userHasValidMembership($userObj)
    )
    {

        // valid user
        // has valid membership and not expired

        return true;
    }


    return false;
}


function isValidUser($userObj) :bool
{

    if (
        is_object($userObj) &&
        $userObj->is_active == 1 &&
        $userObj->user_is_blocked == 0 &&
        $userObj->user_role != "suspended"
    )
    {
        return true;
    }

    return false;
}

function userHasValidMembership($userObj) :bool
{

    if (
        $userObj->membership_id > 0 &&
        $userObj->membership_end_at >= date("Y-m-d")
    )
    {
        return true;
    }

    return false;
}



function auctionNotStarted($auctionObj) :bool
{

    if (
        $auctionObj->auction_start_at >= date("Y-m-d H:i:s")
    )
    {
        return true;
    }

    return false;
}

function auctionIsStarting($auctionObj) :bool
{

    if (
        $auctionObj->auction_start_at < date("Y-m-d H:i:s") &&
        $auctionObj->auction_is_finished == 0 &&
        $auctionObj->auction_winner_user_id == 0
    )
    {
        return true;
    }

    return false;
}

function auctionIsFinished($auctionObj) :bool
{

    if (
        $auctionObj->auction_is_finished == 1
    )
    {
        return true;
    }

    return false;
}

function dealIsFinished($dealObj) :bool
{

    if (
        $dealObj->deal_is_active == 0 &&
        ($dealObj->deal_total_quantity == $dealObj->deal_bought_quantity) &&
        $dealObj->deal_end_at < date("Y-m-d H:i:s")

    )
    {
        return true;
    }

    return false;
}

function auctionHasRulesToSubscribe($auctionObj, $isPremiumMembership = false) :bool
{

    if (
        $auctionObj->auction_require_amount_in_wallet > 0 ||
        ($auctionObj->auction_require_prequel_insurance_amount > 0 && !$isPremiumMembership)
    )
    {
        return true;
    }

    return false;
}
