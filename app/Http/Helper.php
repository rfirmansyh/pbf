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
    
    if (!function_exists('getRandomPassword')) {
        function getRandomPassword() {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass);
        }
    }

    if (!function_exists('getProgress')) {
        function getProgress($start_date, $end_date)
        {
            $start = Carbon::parse($start_date);
            $end = Carbon::parse($end_date);
            $now = Carbon::now();
            
            $diff_from_now = $end->diff($now);
            $diff_from_start = $end->diff($start);
            $total_min_from_start = (($diff_from_start->d * 24 + $diff_from_start->h) * 60)+$diff_from_start->i;
            $total_min_from_now = (($diff_from_now->d * 24 + $diff_from_now->h) * 60)+$diff_from_now->i;

            // dd($total_min_from_now, $total_min_from_start);

            $dfn = $diff_from_now;
            $time_remain = '';
            $percentage = 0;

            // dd($total_min_from_start, $total_min_from_now);

            if ($total_min_from_now > $total_min_from_start || $now->greaterThan($end)) {
                $time_remain = 'Selesai';
                $percentage = 100;
            } else {
                if ($dfn->d != 0) {$time_remain = "$dfn->d Hari Tersisa";} 
                else if ($dfn->d === 0 && $dfn->h !== 0 && $dfn->i !== 0) {$time_remain = "$dfn->h Jam $dfn->i Menit Tersisa";}
                else if ($dfn->d === 0 && $dfn->h === 0 && $dfn->i !== 0) {$time_remain = "$dfn->i Menit Tersisa";}
                // dd($total_min_from_start);
                $percentage = $total_min_from_start !== 0 || $total_min_from_start < 0 ? (($total_min_from_start - $total_min_from_now) / $total_min_from_start) * 100 : 100;
            }

            $progress = (object) [
                'percentage' => $percentage,
                'time_remain' => $time_remain
            ];

            return $progress;
        }
    }

    if (!function_exists('getIdrFormat')) {
        function getIdrFormat($value) {
            return number_format($value,2,',','.');
        }
    }
        
    if (!function_exists('getForecast')) {
        function getForecasts($data, $bobot=3, $next=0) {
            $data_forecasted = [];
            
            // WMA : MIN 3 BULAN
            for ($i=count($data); $i > 0; $i--) { 
                if ($i > $bobot) {
                    $total = 0;
                    $bbt = 0;
                    $b = $bobot;
                    for ($j = $i; $j > $i-$bobot; $j--) {
                        $total += $data[$j-2]['total']*$b;
                        $b--;
                    }
                    for($k = $bobot; $k > 0; $k--) {
                        $bbt += $k;
                    }
                    array_unshift($data_forecasted,  [
                        'created_at' => Carbon::parse($data[$i-1]['created_at']),
                        'month_year' => Carbon::parse($data[$i-1]['created_at'])->format('M Y'),
                        'total' => $total/$bbt
                    ]);
                } else {
                    array_unshift($data_forecasted,  [
                        'created_at' => Carbon::parse($data[$i-1]['created_at']),
                        'month_year' => Carbon::parse($data[$i-1]['created_at'])->format('M Y'),
                        'total' => 0
                    ]);
                }
            }

            for ($i = count($data_forecasted); $i < count($data)+$next; $i++) {
                if ($i > $bobot) {
                    $total = 0;
                    $bbt = 0;
                    $b = $bobot;
                    for($j = $i; $j > $i-$bobot; $j--) {
                        $total += isset($data[$j-1]) ? $data[$j-1]['total']*$b : $data_forecasted[$j-1]['total']*$b;
                        $b--;
                    }
                    for($k = $bobot; $k > 0; $k--) {
                        $bbt += $k;
                    }
                    array_push($data_forecasted, [
                        'created_at' => $data_forecasted[$i-1]['created_at'],
                        'month_year' => $data_forecasted[$i-1]['created_at']->addMonths(1)->format('M Y'),
                        'total' => $total/$bbt
                    ]);
                } else {
                    array_push($data_forecasted, [
                        'created_at' => $data_forecasted[$i-1]['created_at'],
                        'month_year' => $data_forecasted[$i-1]['created_at']->addMonths(1)->format('M Y'),
                        'total' => 0
                    ]);
                }
            }

            // dd($data_forecasted);

            return $data_forecasted;
        }
    }

?>