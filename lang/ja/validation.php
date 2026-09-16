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

    'accepted' => ':attribute フィールドは承認が必要です。',
    'accepted_if' => ':other が :value の場合、:attribute フィールドは承認が必要です。',
    'active_url' => ':attribute フィールドは有効なURLである必要があります。',
    'after' => ':attribute フィールドは :date より後の日付である必要があります。',
    'after_or_equal' => ':attribute フィールドは :date 以降の日付である必要があります。',
    'alpha' => ':attribute フィールドには文字のみ使用できます。',
    'alpha_dash' => ':attribute フィールドには文字、数字、ダッシュ、アンダースコアのみ使用できます。',
    'alpha_num' => ':attribute フィールドには文字と数字のみ使用できます。',
    'any_of' => ':attribute フィールドが無効です。',
    'array' => ':attribute フィールドは配列である必要があります。',
    'array_keys' => ':attribute フィールドには次のキーのみ含めることができます: :values。',
    'ascii' => ':attribute フィールドには1バイトの英数字と記号のみ使用できます。',
    'base64' => ':attribute フィールドは有効なBase64文字列である必要があります。',
    'before' => ':attribute フィールドは :date より前の日付である必要があります。',
    'before_or_equal' => ':attribute フィールドは :date 以前の日付である必要があります。',
    'between' => [
        'array' => ':attribute フィールドの項目数は :min 個以上 :max 個以下である必要があります。',
        'file' => ':attribute フィールドは :min KB以上 :max KB以下である必要があります。',
        'numeric' => ':attribute フィールドは :min 以上 :max 以下である必要があります。',
        'string' => ':attribute フィールドは :min 文字以上 :max 文字以下である必要があります。',
    ],
    'boolean' => ':attribute フィールドは true または false である必要があります。',
    'can' => ':attribute フィールドに許可されていない値が含まれています。',
    'confirmed' => ':attribute フィールドの確認入力が一致しません。',
    'contains' => ':attribute フィールドに必須の値がありません。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attribute フィールドは有効な日付である必要があります。',
    'date_equals' => ':attribute フィールドは :date と同じ日付である必要があります。',
    'date_format' => ':attribute フィールドは :format 形式と一致する必要があります。',
    'decimal' => ':attribute フィールドは小数点以下 :decimal 桁である必要があります。',
    'declined' => ':attribute フィールドは拒否されている必要があります。',
    'declined_if' => ':other が :value の場合、:attribute フィールドは拒否されている必要があります。',
    'different' => ':attribute フィールドと :other フィールドは異なる必要があります。',
    'digits' => ':attribute フィールドは :digits 桁である必要があります。',
    'digits_between' => ':attribute フィールドは :min 桁以上 :max 桁以下である必要があります。',
    'dimensions' => ':attribute フィールドの画像サイズが無効です。',
    'distinct' => ':attribute フィールドに重複した値があります。',
    'doesnt_contain' => ':attribute フィールドには次のいずれも含めることはできません: :values。',
    'doesnt_end_with' => ':attribute フィールドは次のいずれかで終わってはいけません: :values。',
    'doesnt_start_with' => ':attribute フィールドは次のいずれかで始まってはいけません: :values。',
    'email' => ':attribute フィールドは有効なメールアドレスである必要があります。',
    'encoding' => ':attribute フィールドは :encoding でエンコードされている必要があります。',
    'ends_with' => ':attribute欄位は次のいずれかで終わる必要があります: :values。',
    'enum' => '選択された:attributeは無効です。',
    'exists' => '選択された:attributeは無効です。',
    'extensions' => ':attribute欄位の拡張子は次のいずれかである必要があります: :values。',
    'file' => ':attribute欄位はファイルである必要があります。',
    'filled' => ':attribute欄位には値が必要です。',
    'gt' => [
        'array' => ':attribute欄位の項目数は:value個より多い必要があります。',
        'file' => ':attribute欄位は:valueキロバイトより大きい必要があります。',
        'numeric' => ':attribute欄位は:valueより大きい必要があります。',
        'string' => ':attribute欄位は:value文字より多い必要があります。',
    ],
    'gte' => [
        'array' => ':attribute欄位の項目数は:value個以上である必要があります。',
        'file' => ':attribute欄位は:valueキロバイト以上である必要があります。',
        'numeric' => ':attribute欄位は:value以上である必要があります。',
        'string' => ':attribute欄位は:value文字以上である必要があります。',
    ],
    'hex_color' => ':attribute欄位は有効な16進カラーコードである必要があります。',
    'image' => ':attribute欄位は画像である必要があります。',
    'in' => '選択された:attributeは無効です。',
    'in_array' => ':attribute欄位は:otherに存在する必要があります。',
    'in_array_keys' => ':attribute欄位には次のキーのうち少なくとも1つが含まれている必要があります: :values。',
    'integer' => ':attribute欄位は整数である必要があります。',
    'ip' => ':attribute欄位は有効なIPアドレスである必要があります。',
    'ipv4' => ':attribute欄位は有効なIPv4アドレスである必要があります。',
    'ipv6' => ':attribute欄位は有効なIPv6アドレスである必要があります。',
    'json' => ':attribute欄位は有効なJSON文字列である必要があります。',
    'list' => ':attribute欄位はリストである必要があります。',
    'lowercase' => ':attribute欄位は小文字である必要があります。',
    'lt' => [
        'array' => ':attribute欄位の項目数は:value個未満である必要があります。',
        'file' => ':attribute欄位は:valueキロバイト未満である必要があります。',
        'numeric' => ':attribute欄位は:value未満である必要があります。',
        'string' => ':attribute欄位は:value文字未満である必要があります。',
    ],
    'lte' => [
        'array' => ':attribute欄位の項目数は:value個以下である必要があります。',
        'file' => ':attribute欄位は:valueキロバイト以下である必要があります。',
        'numeric' => ':attribute欄位は:value以下である必要があります。',
        'string' => ':attribute欄位は:value文字以下である必要があります。',
    ],
    'mac_address' => ':attribute欄位は有効なMACアドレスである必要があります。',
    'max' => [
        'array' => ':attribute欄位の項目数は:max個以下である必要があります。',
        'file' => ':attribute欄位は:maxキロバイト以下である必要があります。',
        'numeric' => ':attribute欄位は:max以下である必要があります。',
        'string' => ':attribute欄位は:max文字以下である必要があります。',
    ],
    'max_digits' => ':attribute欄位の桁数は:max桁以下である必要があります。',
    'mimes' => ':attribute欄位は次のタイプのファイルである必要があります: :values。',
    'mimetypes' => ':attribute欄位は次のタイプのファイルである必要があります: :values。',
    'min' => [
        'array' => ':attribute欄位の項目数は少なくとも:min個必要です。',
        'file' => ':attribute欄位は少なくとも:minキロバイトである必要があります。',
        'numeric' => ':attribute欄位は少なくとも:minである必要があります。',
        'string' => ':attribute欄位は少なくとも:min文字である必要があります。',
    ],
    'min_digits' => ':attribute欄位の桁数は少なくとも:min桁必要です。',
    'missing' => ':attribute欄位は存在してはいけません。',
    'missing_if' => ':attribute欄位は、:otherが:valueの場合は存在してはいけません。',
    'missing_unless' => ':attribute欄位は、:otherが:valueでない限り存在してはいけません。',
    'missing_with' => ':values が存在する場合、:attribute フィールドは含めてはいけません。',
    'missing_with_all' => ':values が存在する場合、:attribute フィールドは含めてはいけません。',
    'multiple_of' => ':attribute フィールドは :value の倍数でなければなりません。',
    'not_in' => '選択された :attribute は無効です。',
    'not_regex' => ':attribute フィールドの形式が無効です。',
    'numeric' => ':attribute フィールドは数値でなければなりません。',
    'password' => [
        'letters' => ':attribute フィールドには少なくとも1文字の英字を含める必要があります。',
        'mixed' => ':attribute フィールドには少なくとも1文字の大文字と1文字の小文字を含める必要があります。',
        'numbers' => ':attribute フィールドには少なくとも1つの数字を含める必要があります。',
        'symbols' => ':attribute フィールドには少なくとも1つの記号を含める必要があります。',
        'uncompromised' => '指定された :attribute はデータ漏えいで確認されています。別の :attribute を選択してください。',
    ],
    'present' => ':attribute フィールドを含める必要があります。',
    'present_if' => ':other が :value の場合、:attribute フィールドを含める必要があります。',
    'present_unless' => ':other が :value でない限り、:attribute フィールドを含める必要があります。',
    'present_with' => ':values が存在する場合、:attribute フィールドを含める必要があります。',
    'present_with_all' => ':values が存在する場合、:attribute フィールドを含める必要があります。',
    'prohibited' => ':attribute フィールドは禁止されています。',
    'prohibited_if' => ':other が :value の場合、:attribute フィールドは禁止されています。',
    'prohibited_if_accepted' => ':other が承認されている場合、:attribute フィールドは禁止されています。',
    'prohibited_if_declined' => ':other が拒否されている場合、:attribute フィールドは禁止されています。',
    'prohibited_unless' => ':other が :values に含まれていない限り、:attribute フィールドは禁止されています。',
    'prohibits' => ':attribute フィールドがある場合、:other フィールドを含めることはできません。',
    'regex' => ':attribute フィールドの形式が無効です。',
    'required' => ':attribute フィールドは必須です。',
    'required_array_keys' => ':attribute フィールドには次の項目を含める必要があります: :values。',
    'required_if' => ':other が :value の場合、:attribute フィールドは必須です。',
    'required_if_accepted' => ':other が承認されている場合、:attribute フィールドは必須です。',
    'required_if_declined' => ':other が拒否されている場合、:attribute フィールドは必須です。',
    'required_unless' => ':other が :values に含まれていない限り、:attribute フィールドは必須です。',
    'required_with' => ':values が存在する場合、:attribute フィールドは必須です。',
    'required_with_all' => ':values が存在する場合、:attribute フィールドは必須です。',
    'required_without' => ':values が存在しない場合、:attribute フィールドは必須です。',
    'required_without_all' => ':values のいずれも存在しない場合、:attribute フィールドは必須です。',
    'same' => ':attribute フィールドは :other と一致する必要があります。',
    'size' => [
        'array' => ':attribute フィールドには :size 個の項目を含める必要があります。',
        'file' => ':attribute フィールドは :size キロバイトでなければなりません。',
        'numeric' => ':attribute フィールドは :size でなければなりません。',
        'string' => ':attribute フィールドは :size 文字でなければなりません。',
    ],
    'starts_with' => ':attribute フィールドは次のいずれかで始まる必要があります: :values。',
    'string' => ':attribute フィールドは文字列でなければなりません。',
    'timezone' => ':attribute フィールドは有効なタイムゾーンでなければなりません。',
    'unique' => 'この :attribute は既に使用されています。',
    'uploaded' => ':attribute のアップロードに失敗しました。',
    'uppercase' => ':attribute フィールドは大文字でなければなりません。',
    'url' => ':attribute フィールドは有効なURLでなければなりません。',
    'ulid' => ':attribute フィールドは有効なULIDでなければなりません。',
    'uuid' => ':attribute フィールドは有効なUUIDでなければなりません。',

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
            'rule-name' => '',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'billing_address' => '請求先住所',
        'business_name' => '事業者名',
        'client_id' => 'クライアントID',
        'company_number' => '会社番号',
        'contact_name' => '連絡先名',
        'currency' => '通貨',
        'default_payment_terms_days' => 'デフォルトの支払条件日数',
        'default_tax_rate' => 'デフォルトの税率',
        'due_on' => '支払期日',
        'email' => 'メールアドレス',
        'invoice' => '請求書',
        'invoice_prefix' => '請求書接頭辞',
        'is_archived' => 'アーカイブ済み',
        'issued_on' => '発行日',
        'items' => '項目',
        'name' => '名前',
        'notes' => 'メモ',
        'number' => '番号',
        'payment_instructions' => '支払い方法の案内',
        'payment_terms_days' => '支払条件日数',
        'phone' => '電話番号',
        'send_payment_reminders' => '支払いリマインダーを送信',
        'status' => 'ステータス',
        'tax_rate' => '税率',
    ],
];
