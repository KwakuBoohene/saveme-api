<?php
  function api_error()
{
    try {
        $user = auth()->userOrFail();
    } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
        //throw $e;
    return response()->json(['error' => $e->getMessage()]);
    }
}
