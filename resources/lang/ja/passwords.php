<?php
declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */

    'password' => 'パスワードは最低6文字で、確認のために2回入力してください。',
    'reset'    => 'パスワードを再設定しました。',
    'sent'     => 'パスワード再設定用メールを送信しました。',
    'token'    => '申請されたEメールアドレスと一致しないか、有効期限切れ、またはURLが不正です。',

    /**
     * For avoiding the purpose of searching for a mail address,
     * even if there is no registration, it seems as if it sent normally.
     */
    'user'     => "パスワード再設定用メールを送信しました。",
//     'user'     => "入力されたEメールアドレスは登録されていません。",
];
