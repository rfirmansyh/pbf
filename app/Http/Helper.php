<?php 

use Carbon\Carbon;

    if (!function_exists('api_response')) {
        function api_response($success, $message = null, $data = null, $code = 200)
        {
            return response()->json([
                'status' => $success == 1 ? 'success' : 'failed',
                'message' => $message,
                'data' => $data
            ], $code);
        }
    }

    if (!function_exists('getIdrFormat')) {
        function getIdrFormat($value) {
            return number_format($value,2,',','.');
        }
    }

    if (!function_exists('getCompensation')) {
        function getCompensation($date_confirmed, $date_deadline) {
            $confirmed = Carbon::parse($date_confirmed);
            $deadline = Carbon::parse($date_deadline);
            if ($confirmed > $deadline) {
                return $confirmed->diffInDays($deadline) * 500;
            }
            // return number_format($value,2,',','.');
        }
    }
        
?>