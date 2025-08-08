<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Reservasi;

class BpjsController extends Controller
{
    /**
     * Base URL for the webservice endpoint.
     */
    private $baseEndpoint = 'http://41.216.186.239/webservice/registrasionline/bpjs';

    /**
     * Hospital GPS coordinates
     */
    private $hospitalLat = -3.5224191943463126;
    private $hospitalLng = 115.95746613629129;
    private $allowedRadius = 1200;

    /**
     * Function to fetch the token.
     */
    public function getToken()
    {
        $response = Http::withHeaders([
            'x-username' => '9990',
            'x-password' => 'JHMD1R8PQ8',
            'Accept' => 'application/json',
        ])->get("{$this->baseEndpoint}/getToken");

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['response']['token'])) {
                return $data['response']['token'];
            }
        }

        return null;
    }

    /**
     * Function to perform check-in using the token.
     */
    public function checkIn(Request $request)
    {
        $kodebooking = $request->input('kodebooking');
        // $latitude = $request->input('latitude');
        // $longitude = $request->input('longitude');

        // if (!$this->validateLocation($latitude, $longitude)) {
        //     return response()->json([
        //         'metadata' => [
        //             'code' => 403,
        //             'message' => 'Checkin mjkn maksimal 1 km dari rumah sakit.',
        //         ],
        //     ]);
        // }

        $token = $this->getToken();

        if (!$token) {
            return response()->json([
                'metadata' => [
                    'code' => 500,
                    'message' => 'Failed to get token',
                ],
            ]);
        }

        $checkAntrianResponse = $this->checkKodebookingAntrian($token, $kodebooking);

        if (!$checkAntrianResponse['valid']) {
            return response()->json([
                'metadata' => [
                    'code' => 201,
                    'message' => 'Antrian tidak ditemukan',
                ],
            ]);
        }

        $waktu = now()->timestamp * 1000;

        try {
            $response = Http::withHeaders([
                'x-token' => $token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post("{$this->baseEndpoint}/checkInAntrian", [
                        'kodebooking' => $kodebooking,
                        'waktu' => $waktu,
                    ]);

            if ($response->successful()) {
                return $response->json();
            }

            return response()->json([
                'metadata' => [
                    'code' => $response->status(),
                    'message' => 'Check-in failed. ' . $response->body(),
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Check-in request failed: ' . $e->getMessage());

            return response()->json([
                'metadata' => [
                    'code' => 500,
                    'message' => 'An error occurred',
                ],
            ]);
        }
    }

    /**
     * Function to check kodebooking validity.
     */
    private function checkKodebookingAntrian($token, $kodebooking)
    {
        try {
            $response = Http::withHeaders([
                'x-token' => $token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post("{$this->baseEndpoint}/getSisaAntrian", [
                        'kodebooking' => $kodebooking,
                    ]);

            if ($response->successful()) {
                $data = $response->json();

                Log::info('Response from getSisaAntrian: ' . $response->body());

                if ($data['metadata']['code'] == 200) {
                    return ['valid' => true];
                }

                if ($data['metadata']['code'] == 201) {
                    return ['valid' => false];
                }
            }

            return ['valid' => false, 'message' => 'Failed to fetch sisa antrian.'];
        } catch (\Exception $e) {
            Log::error('Failed to check kodebooking: ' . $e->getMessage());
            return ['valid' => false, 'message' => 'An error occurred'];
        }
    }

    /**
     * Validate if the user's location is within the allowed radius.
     */
    private function validateLocation($latitude, $longitude)
    {
        if (is_null($latitude) || is_null($longitude)) {
            Log::error('Latitude or Longitude is null');
            return false;
        }

        $distance = $this->calculateDistance($this->hospitalLat, $this->hospitalLng, $latitude, $longitude);

        Log::info("Calculated distance: {$distance} km");

        return $distance <= $this->allowedRadius / 1000;
    }

    /**
     * Calculate distance between two coordinates.
     */
    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // Earth's radius in kilometers

        $latDelta = deg2rad($lat2 - $lat1);
        $lngDelta = deg2rad($lng2 - $lng1);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lngDelta / 2) * sin($lngDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return $distance;
    }

    // public function batalAntrian(Request $request)
    // {
    //     $kodeBooking = $request->input('kodebooking');

    //     if (!$kodeBooking) {
    //         return response()->json([
    //             'metadata' => [
    //                 'code' => 400,
    //                 'message' => 'Kode Booking harus diisi!',
    //             ],
    //         ]);
    //     }

    //     $token = $this->getToken();

    //     if (!$token) {
    //         return response()->json([
    //             'metadata' => [
    //                 'code' => 500,
    //                 'message' => 'Gagal mendapatkan token',
    //             ],
    //         ]);
    //     }

    //     try {
    //         $response = Http::withHeaders([
    //             'x-token' => $token,
    //             'Content-Type' => 'application/json',
    //             'Accept' => 'application/json',
    //         ])->post("{$this->baseEndpoint}/setBatalAntrian", [
    //             'kodebooking' => $kodeBooking,
    //         ]);

    //         if ($response->successful()) {
    //             return $response->json();
    //         }

    //         return response()->json([
    //             'metadata' => [
    //                 'code' => $response->status(),
    //                 'message' => 'Pembatalan antrian gagal: ' . $response->body(),
    //             ],
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Batal antrian request failed: ' . $e->getMessage());

    //         return response()->json([
    //             'metadata' => [
    //                 'code' => 500,
    //                 'message' => 'Terjadi kesalahan saat membatalkan antrian',
    //             ],
    //         ]);
    //     }
    // }
    public function batalAntrian(Request $request)
    {
        $kodeBooking = $request->input('kodebooking');

        if (!$kodeBooking) {
            return response()->json([
                'metadata' => [
                    'code' => 400,
                    'message' => 'Kode Booking harus diisi!',
                ],
            ]);
        }

        try {
            $reservation = Reservasi::where('ID', $kodeBooking)->first();

            if ($reservation && in_array($reservation->JENIS_APLIKASI, [3, 22])) {
                $reservation->STATUS = 99;
                $reservation->save();
                Log::info("Reservation {$kodeBooking} (JENIS_APLIKASI {$reservation->JENIS_APLIKASI}) updated STATUS to 99.");
            }
        } catch (\Exception $e) {
            Log::error('Error updating reservation via model: ' . $e->getMessage());
        }

        $token = $this->getToken();

        if (!$token) {
            return response()->json([
                'metadata' => [
                    'code' => 500,
                    'message' => 'Gagal mendapatkan token',
                ],
            ]);
        }

        try {
            $response = Http::withHeaders([
                'x-token' => $token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post("{$this->baseEndpoint}/setBatalAntrian", [
                        'kodebooking' => $kodeBooking,
                    ]);

            if ($response->successful()) {
                return $response->json();
            }

            return response()->json([
                'metadata' => [
                    'code' => $response->status(),
                    'message' => 'Pembatalan antrian gagal: ' . $response->body(),
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Batal antrian request failed: ' . $e->getMessage());

            return response()->json([
                'metadata' => [
                    'code' => 500,
                    'message' => 'Terjadi kesalahan saat membatalkan antrian',
                ],
            ]);
        }
    }
}