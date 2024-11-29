<?php

namespace App\Http\Controllers\Api\Base\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BaseApiController extends Controller
{
    /**
     * Handle validation and callback logic in a standardized way.
     */
    protected function handleRequest(Request $request, array $rules, callable $callback)
    {
        try {
            $validatedData = $request->validate($rules);
            return $callback($validatedData);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error occurred.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
