<?php
/**
 * Date 10/04/2023
 * @author   Simon Siva <simonsiva13@gmail.com>
 */

namespace Ssiva\CurrencyExchange\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;
use Ssiva\CurrencyExchange\Exchange\Exchange;

class CurrencyConverterController extends Controller
{
    /**
     * @OA\Get(
     *     path="/currency-exchange",
     *     summary="Convert currency",
     *     tags={"Currency Converter"},
     *     @OA\Parameter(
     *         name="amount",
     *         in="query",
     *         description="The amount to convert",
     *         required=true,
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="currency",
     *         in="query",
     *         description="The currency to convert to",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Conversion result",
     *         @OA\JsonContent(
     *             @OA\Property(property="amount", type="number", example="1.23"),
     *             @OA\Property(property="currency", type="string", example="USD")
     *         )
     *     )
     * )
     * @throws GuzzleException
     */
    public function exchange(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'currency' => 'string|max:4|min:2'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $amount = $request->get('amount');
        $toCurrency = $request->get('currency');

        // Fetch exchange rate from ECB daily reference
        $exchangeRate = (new Exchange())->getExchangeRate($toCurrency);

        if (!$exchangeRate) {
            return response()->json([
                'error' => 'Invalid currency'
            ], 400);
        }

        $total = $amount * $exchangeRate;

        return response()->json([
            'exchange_rate' => $exchangeRate,
            'amount' => $total,
            'currency' => $toCurrency
        ]);
    }
}
