<?php


namespace App\Support;


use Illuminate\Validation\ValidationException;

class RedirectResponse extends \Illuminate\Http\RedirectResponse
{
    /**
     * Flash a piece of data to the session.
     *
     * @param  mixed  $value
     * @return $this
     */
    public function withSuccess($value = null): RedirectResponse
    {
        return $this->with('success', $value);
    }

    /**
     * @param $value
     * @return RedirectResponse
     */
    public function withCustomErrors($value): RedirectResponse
    {
        return parent::with('custom_error', $value);
    }
}
