<?php

namespace App\Http\Controllers\Public\Auth\Login;

use App\Exceptions\User\AccountInactiveException;
use App\Exceptions\User\AuthFailedException;
use App\Exceptions\User\EmailNotVerifiedException;
use App\Http\Controllers\Public\Auth\Login\BaseController;
use App\Http\Requests\Public\Auth\Login\StoreRequest;
use App\Services\Public\Auth\LoginService;
use Exception;
use Illuminate\Http\RedirectResponse;

class StoreController extends BaseController
{
   
    /**
     * Обробка запиту логіну
     */
    public function __invoke(StoreRequest $request): RedirectResponse
    {
        try {
            $credentials = $request->validated();
            $this->service->login($credentials, $request->boolean('remember'));

            return redirect()->intended(route('public.post.index'));
        } catch (EmailNotVerifiedException $ex) {
            return redirect()
                ->route('public.auth.reverification.index')
                ->with('error', $ex->getMessage());
        } catch (AccountInactiveException $ex) {
            // Використовуємо повідомлення з винятку
            return back()
                ->withErrors(['error' => $ex->getMessage()])
                ->onlyInput('email');
        } catch (AuthFailedException $ex) {
            // Повертаємо назад із повідомленням помилки
            return back()
                ->withErrors(['error' => $ex->getMessage()])
                ->onlyInput('email');
        } catch (Exception $ex) {
            // Показати загальну сторінку помилки 500
            abort(500, 'Server Error');
        }
    }
}
