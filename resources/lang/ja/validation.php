<?php

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

    'accepted'   => ':attribute を承認してください。',
    'active_url' => ':attribute は、有効なURLではありません。',
    'after'      => ':attribute は、:date以前の日付は指定できません。',
    'alpha'      => ':attribute は、アルファベッドのみ使用できます。',
    'alpha_dash' => ":attribute は、英数字('A-Z','a-z','0-9')とハイフンと下線('-','_')が使用できます。",
    'alpha_num'  => ":attribute は、英数字('A-Z','a-z','0-9')が使用できます。",
    'array'      => ':attribute は、配列を指定してください。',
    'before'     => ':attribute は、:date 以前の日付を指定してください。',
    'between'    => [
        'numeric' => ':attribute は、:min から、:max までの数値を指定してください。',
        'file'    => ':attribute は、:min KBから:max KBまでのサイズのファイルを指定してください。',
        'string'  => ':attribute は、:min 文字から:max 文字にしてください。',
        'array'   => ':attribute の項目は、:min 個から:max 個にしてください。',
    ],
    'boolean'              => ":attribute は、'true'か'false'を指定してください。",
    'confirmed'            => ':attribute の確認が一致しません。',
    'date'                 => ':attribute は、正しい日付ではありません。',
    'date_format'          => ":attribute の形式が正しくありません。",
    'different'            => ':attribute と:otherは、異なるものを指定してください。',
    'digits'               => ':attribute は、:digits 桁にしてください。',
    'digits_between'       => ':attribute は、:min 桁から:max 桁にしてください。',
    'email'                => ':attribute は有効なメールアドレス形式で入力してください。',
    'exists'               => '入力された :attribute は存在しないか、不正なデータです。',
    'filled'               => ':attribute は必須です。',
    'image'                => ':attributeは、画像を指定してください。',
    'in'                   => '選択された :attribute は、有効ではありません。',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => ':attribute は、整数を指定してください。',
    'ip'                   => ':attribute は、有効なIPアドレスを指定してください。',
    'json'                 => ':attribute は、有効なJSON文字列を指定してください。',
    'max'                  => [
        'numeric' => ':attribute は、:max 以下の数値を指定してください。',
        'file'    => ':attribute は、:max KB以下のファイルを指定してください。',
        'string'  => ':attribute は、:max 文字以下にしてください。',
        'array'   => ':attribute の項目は、:max 個以下にしてください。',
    ],
    'mimes'                => ':attribute の形式は [:values] です。',
    'min'                  => [
        'numeric' => ':attribute は、:min 以上の数値を指定してください。',
        'file'    => ':attribute は、:min KB以上のファイルを指定してください。',
        'string'  => ':attribute は :min 文字以上入力してください。',
        'array'   => ':attribute の項目は、:max 個以上にしてください。',
    ],
    'not_in'               => '選択された:attribute は、有効ではありません。',
    'numeric'              => ':attribute は数値で入力してください。',
    'regex'                => ':attribute の形式が不正です。',
    'required'             => ':attribute は必須項目です。',
    'required_if'          => ':other が :value の場合、 :attribute を指定してください。',
    'required_unless'      => ':otherが :value 以外の場合、 :attribute を指定してください。',
    'required_with'        => ':values が指定されている場合、 :attribute も指定してください。',
    'required_with_all'    => ':values が全て指定されている場合、 :attribute も指定してください。',
    'required_without'     => ':values が指定されていない場合、 :attribute を指定してください。',
    'required_without_all' => ':values が全て指定されていない場合、 :attribute を指定してください。',
    'same'                 => ':attribute と :other が一致しません。',
    'size'                 => [
        'numeric' => ':attribute は、 :size を指定してください。',
        'file'    => ':attribute は、 :size KBのファイルを指定してください。',
        'string'  => ':attribute は、 :size 文字にしてください。',
        'array'   => ':attribute の項目は、 :size 個にしてください。',
    ],
    'string'               => ':attribute は、文字を指定してください。',
    'timezone'             => ':attribute は、有効なタイムゾーンを指定してください。',
    'unique'               => '指定の :attribute は既に使用されています。',
    'url'                  => ':attribute は、有効なURL形式で指定してください。',

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
