<?php

namespace App\Services;


use GuzzleHttp\Client;
use Illuminate\Database\DatabaseManager as DB;

class TokenDistributor
{
    private $http;

    private $db;

    public function __construct(Client $httpClient, DB $db)
    {
        $this->http = $httpClient;
        $this->db = $db;
    }

    public function getTokens($email, $password)
    {
        $response = $this->requestTokens($email, $password);

        return json_decode((string) $response->getBody(), true);
    }

    private function requestTokens($email, $password)
    {
        $client = $this->getPasswordGrantClient();

        return $this->http->post(env('APP_URL') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ],
        ]);
    }

    private function getPasswordGrantClient()
    {
        return $this->db->table('oauth_clients')
            ->select('id', 'secret')
            ->where('password_client', true)
            ->first();
    }
}
