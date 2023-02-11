<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\SetPasswordRequest;
use App\Models\User;
use Hash;
use Mail;
use Illuminate\Mail\Message;

final class UserService
{
    /**
     * @param User $user
     */
    public function sendEmail(User $user)
    {
        Mail::send("mail.new_user", $user->toArray(), function (Message $message) use ($user) {
            $message->from('robot@buyerchina.com', 'Байер в Китае');
            $message->subject('Регистрация на сайте dev-buyerchina.mdv.pw');
            $message->to($user->email);
        });
    }

    /**
     * @param SetPasswordRequest $request
     * @throws \Throwable
     */
    public function setPassword(SetPasswordRequest $request)
    {
        $user = User::findOrFail(['email' => $request->get('email')]);
        $user->password = Hash::make($request->get('password'));
        $user->saveOrFail();
    }
}
