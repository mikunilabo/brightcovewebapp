<?php
declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'   => ':attributeを承認してください。',
    'active_url' => ':attributeは、有効なURLではありません。',
    'after'      => ':attributeは、:date以前の日付は指定できません。',
    'alpha'      => ':attributeは、アルファベッドのみ使用できます。',
    'alpha_dash' => ":attributeは、英数字('A-Z','a-z','0-9')とハイフンと下線('-','_')が使用できます。",
    'alpha_num'  => ":attributeは、英数字('A-Z','a-z','0-9')が使用できます。",
    'array'      => ':attributeは、配列を指定してください。',
    'before'     => ':attributeは、:date 以前の日付を指定してください。',
    'between'    => [
        'numeric' => ':attributeは、:min から、:max までの数値を指定してください。',
        'file'    => ':attributeは、:min KBから:max KBまでのサイズのファイルを指定してください。',
        'string'  => ':attributeは、:min 文字から:max 文字にしてください。',
        'array'   => ':attributeの項目は、:min 個から:max 個にしてください。',
    ],
    'boolean'              => ":attributeは、'true'か'false'を指定してください。",
    'confirmed'            => ':attributeの確認が一致しません。',
    'date'                 => ':attributeは、正しい日付ではありません。',
    'date_format'          => ":attributeの形式が正しくありません。",
    'different'            => ':attributeと:otherは、異なるものを指定してください。',
    'digits'               => ':attributeは、:digits 桁にしてください。',
    'digits_between'       => ':attributeは、:min 桁から:max 桁にしてください。',
    'dimensions'           => ':attributeの図形サイズが正しくありません。',
    'distinct'             => ':attributeの値が重複しています。',
    'email'                => ':attributeは有効なメールアドレス形式で入力してください。',
    'exists'               => '入力された:attributeは存在しないか、不正なデータです。',
    'filled'               => ':attributeは必須です。',
    'image'                => ':attributeは、画像を指定してください。',
    'in'                   => '選択された:attributeは、有効ではありません。',
    'in_array'             => 'The:attributefield does not exist in :other.',
    'integer'              => ':attributeは、整数を指定してください。',
    'ip'                   => ':attributeは、有効なIPアドレスを指定してください。',
    'json'                 => ':attributeは、有効なJSON文字列を指定してください。',
    'max'                  => [
        'numeric' => ':attributeは、:max 以下の数値を指定してください。',
        'file'    => ':attributeは、:max KB以下のファイルを指定してください。',
        'string'  => ':attributeは、:max 文字以下にしてください。',
        'array'   => ':attributeの項目は、:max 個以下にしてください。',
    ],
    'mimes'                => ':attributeの形式は [:values] です。',
    'min'                  => [
        'numeric' => ':attributeは、:min 以上の数値を指定してください。',
        'file'    => ':attributeは、:min KB以上のファイルを指定してください。',
        'string'  => ':attributeは :min 文字以上入力してください。',
        'array'   => ':attributeの項目は、:max 個以上にしてください。',
    ],
    'not_in'               => '選択された:attributeは、有効ではありません。',
    'numeric'              => ':attributeは数値で入力してください。',
    'regex'                => ':attributeの形式が不正です。',
    'required'             => ':attributeは必須項目です。',
    'required_if'          => ':other が :value の場合、:attributeを指定してください。',
    'required_unless'      => ':otherが :value 以外の場合、:attributeを指定してください。',
    'required_with'        => ':values が指定されている場合、:attributeも指定してください。',
    'required_with_all'    => ':values が全て指定されている場合、:attributeも指定してください。',
    'required_without'     => ':values が指定されていない場合、:attributeを指定してください。',
    'required_without_all' => ':values が全て指定されていない場合、:attributeを指定してください。',
    'same'                 => ':attributeと :other が一致しません。',
    'size'                 => [
        'numeric' => ':attributeは、 :size を指定してください。',
        'file'    => ':attributeは、 :size KBのファイルを指定してください。',
        'string'  => ':attributeは、 :size 文字にしてください。',
        'array'   => ':attributeの項目は、 :size 個にしてください。',
    ],
    'string'               => ':attributeは、文字を指定してください。',
    'timezone'             => ':attributeは、有効なタイムゾーンを指定してください。',
    'unique'               => '指定の:attributeは既に使用されています。',
    'url'                  => ':attributeは、有効なURL形式で指定してください。',

    /*
     |--------------------------------------------------------------------------
     | Custom Validation Validation Rules
     |--------------------------------------------------------------------------
     |
     */

    'custom_alpha_dash'  => ':attributeは、半角英数字と半角ハイフンが使用できます。',
    'format' => ":attributeの形式が正しくありません。",
    'invalid' => '送信された:attributeの値が無効か、又は不正です。',
    'zenkaku_katakana' => ':attributeは、全角カタカナで入力してください。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name'  => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'attribute-name' => 'custom-message',
    ],

];
