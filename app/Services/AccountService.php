<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AccountService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = "http://localhost:5095"; // ganti port Ocelot
    }

    public function getAccounts()
    {
        return Http::withoutVerifying()->get($this->baseUrl.'/Accounts')->json();
    }

    public function getAccount($id)
    {
        return Http::withoutVerifying()->get($this->baseUrl."/Accounts/$id")->json();
    }

    public function createAccount($data)
    {
        return Http::withoutVerifying()->post($this->baseUrl."/Accounts", $data)->json();
    }

    public function updateAccount($id, $data)
    {
        return Http::withoutVerifying()->put($this->baseUrl."/Accounts/$id", $data)->json();
    }

    public function deleteAccount($id)
    {
        return Http::withoutVerifying()->delete($this->baseUrl."/Accounts/$id")->json();
    }
}
