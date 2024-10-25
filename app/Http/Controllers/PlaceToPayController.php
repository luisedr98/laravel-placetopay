<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PlaceToPayController extends Controller
{

    public CONST  BODY_ECOMMERCE = 'body_eb.json';
    public CONST BODY_P2P = 'body.json';


    public function createSession()
    {
        try {
            $body = $this->getOrderDetail(self::BODY_ECOMMERCE);
            $placeToPay = $this->getPlaceToPayClient();
            $response = $placeToPay->request($body);
            if ($response->isSuccessful()) {
                $processUrl = $response->processUrl();
                $requestId = $response->requestId();
                return response()->json([ 'status' => true ,'placetopayUrl' => $processUrl, 'requestId' => $requestId ]);
            } else {
                Log::error('Error creating request', ['response' => $response->toArray()]);
                return response()->json([ 'status' => false ,'error' => $response->toArray() ], 500);

            }
        } catch (\Throwable $th) {
            Log::error('Error processOrder', ['error' => $th->getMessage(), 'line' => $th->getLine()]);
            return response()->json([ 'status' => false ,'error' => $th->getMessage() ], 500);
        }
    }

    private function getOrderDetail(string $file)
    {
        $file = File::get(public_path($file));
        $body = json_decode($file, true);
        $body['payment']['reference'] = 'TEST_' . time();
        $body['expiration'] = date('c', strtotime('+1 hour'));
        $body['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
        $body['ipAddress'] = $_SERVER['REMOTE_ADDR'];
        return $body;
    }

    private function getPlaceToPayClient()
    {
        return new \Dnetix\Redirection\PlacetoPay([
            'login' => env('PLACETOPAY_LOGIN'),
            'tranKey' => env('PLACETOPAY_TRANKEY'),
            'baseUrl' => env('PLACETOPAY_BASE_URL'),
            'timeout' => 45,
            'verifySsl' => false,
        ]);
    }
    public function getInformationOfSession(string $requestId)
    {
        try {
            $placeToPay = $this->getPlaceToPayClient();
            $response = $placeToPay->query($requestId);
            if ($response->isSuccessful()) {
                return response()->json([ 'status' => true ,'response' => $response->toArray() ]);
            } else {
                Log::error('Error getting request', ['response' => $response->toArray()]);
                return response()->json([ 'status' => false ,'error' => $response->toArray() ], 500);
            }
        } catch (\Throwable $th) {
            Log::error('Error getStatusSession', ['error' => $th->getMessage(), 'line' => $th->getLine()]);
            return response()->json([ 'status' => false ,'error' => $th->getMessage() ], 500);
        }

    }

}
