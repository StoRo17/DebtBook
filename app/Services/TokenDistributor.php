<?php

namespace App\Services;


use GuzzleHttp\Client;
use Illuminate\Database\DatabaseManager as DB;

class TokenDistributor
{
    /**
     * GuzzleHttp\Client instance.
     * @var Client
     */
    private $http;

    /**
     * DatabaseManager instance.
     * @var DB
     */
    private $db;

    /**
     * TokenDistributor constructor.
     * @param Client $httpClient
     * @param DB $db
     */
    public function __construct(Client $httpClient, DB $db)
    {
        $this->http = $httpClient;
        $this->db = $db;
    }

    /**
     * Returns the requested tokens.
     *
     * @param string $email
     * @param string $password
     * @return array
     */
    public function getTokens($email, $password)
    {
        $response = $this->requestTokens($email, $password);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Request tokens for given email and password.
     *
     * @param string $email
     * @param string $password
     * @return \Psr\Http\Message\ResponseInterface
     */
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

    /**
     * Returns the id and secret key of Password Grant Client from database.
     * 
     * @return \Illuminate\Database\Eloquent\Model|
     */
    private function getPasswordGrantClient()
    {
        return $this->db->table('oauth_clients')
            ->select('id', 'secret')
            ->where('password_client', true)
            ->first();
    }
}
