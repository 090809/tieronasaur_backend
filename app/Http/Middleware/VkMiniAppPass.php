<?php

namespace App\Http\Middleware;

use Closure;

class VkMiniAppPass
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //if (config('app.debug'))
        //  return $next($request);

        $sign_params = [];
        $client_secret = config('app.vk.secret');

        foreach ($request->toArray() as $key => $item) {
            if (strpos($key, 'vk_') !== 0)
                continue;
            $sign_params[$key] = $item;
        }

        ksort($sign_params);

        $sign_params_query = http_build_query($sign_params);
        $sign = rtrim(strtr(base64_encode(hash_hmac('sha256', $sign_params_query, $client_secret, true)), '+/', '-_'), '=');

        if ($request->sign === $sign)
            return $next($request);

        return response()->json(['status' => 'error', 'message' => 'VK not authenticated!'])->setStatusCode(401);
    }
}
