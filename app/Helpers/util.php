<?php

if (!function_exists('carbon_now')) {
    /**
     * 必ず固定時間を返す
     *
     * @return \Carbon\CarbonImmutable
     */
    function carbon_now(): \Carbon\CarbonImmutable
    {
        return app('carbon_now');
    }
}

if (!function_exists('lang')) {
    /**
     * 言語取得
     *
     * @return string
     */
    function lang(): string
    {
        return str_replace('_', '-', app()->getLocale());
    }
}

if (!function_exists('json_success')) {
    /**
     * JSONレスポンス成功
     *
     * @param array $contents
     * @return \Illuminate\Http\Response|mixed
     */
    function json_success(array $contents = [])
    {
        try {
            return response()->json([
                'status' => 'OK',
                'contents' => $contents,
            ]);
        } catch (Throwable $throwable) {
            return json_failure($throwable);
        }
    }
}

if (!function_exists('json_failure')) {
    /**
     * JSONレスポンス失敗
     *
     * @param Throwable|null $throwable
     * @return \Illuminate\Http\Response|mixed|string
     */
    function json_failure(Throwable $throwable = null)
    {
        try {
            return response()->json([
                'status' => 'NG',
                'error' => [
                    'code' => $throwable->getCode(),
                    'message' => \App::isProduction() ? __('message.error.default') : $throwable->getMessage()
                ],
            ], 500);
        } catch (Throwable $throwable) {
            return '';
        }
    }
}

if (!function_exists('error_messages')) {
    /**
     * Get Error Messages from Throwable
     *
     * @param Throwable $throwable
     * @return array
     */
    function error_messages(Throwable $throwable): array
    {
        if ($throwable instanceof \Illuminate\Validation\ValidationException) {
            $message = $throwable->validator->errors()->all();
        } else {
            $message = [$throwable->getMessage()];
        }
        return $message;
    }
}
