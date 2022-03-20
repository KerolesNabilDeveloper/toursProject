<?php

function afterCurrency($price): string
{

    return afterCurrencyRate($price) . " " . getCurrencyCode();

}

function getCurrencyObj()
{

    $selected_currency = Session::get('selected_currency_for_agent', null);
    if ($selected_currency !== null) {
        return $selected_currency;
    }

    return Session::get('selected_currency');

}

function afterCurrencyRate($price)
{

    $selected_currency = getCurrencyObj();

    if (!is_object($selected_currency)) {
        return $price;
    }

    return round(($price) * $selected_currency->rate, 2);

}

function reverseCurrencyRate($price)
{

    $selected_currency = getCurrencyObj();

    if (!is_object($selected_currency)) {
        return $price;
    }

    return round(($price) / $selected_currency->rate, 2);

}

function getCurrencyCode()
{

    $selected_currency = getCurrencyObj();

    return $selected_currency->code;

}


function returnPriceAndCurrencyInArray($price) :array
{
    return [
        "amount"    => afterCurrencyRate($price),
        "code"      => "ريال", // TODO bk: to be replaced with getCurrencyCode()
    ];
}
