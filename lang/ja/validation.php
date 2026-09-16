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
    'alpha' => ':attribute フィールドには文字のみを含めることができます。',
    'alpha_dash' => ':attribute フィールドには文字、数字、ダッシュ、アンダースコアのみを含めることができます。',
    'alpha_num' => ':attribute フィールドには文字と数字のみを含めることができます。',
    'any_of' => ':attribute フィールドが無効です。',
    'array' => ':attribute フィールドは配列である必要があります。',
    'array_keys' => ':attribute フィールドには次のキーのみを含めることができます: :values。',
    'ascii' => ':attribute フィールドにはシングルバイトの英数字と記号のみを含めることができます。',
    'base64' => ':attribute フィールドは有効なBase64文字列である必要があります。',
    'before' => ':attribute フィールドは :date より前の日付である必要があります。',
    'before_or_equal' => ':attribute フィールドは :date 以前の日付である必要があります。',
    'between' => [
        'array' => ':attribute フィールドの項目数は :min 個から :max 個の間である必要があります。',
        'file' => ':attribute フィールドは :min KBから :max KBの間である必要があります。',
        'numeric' => ':attribute フィールドは :min から :max の間である必要があります。',
        'string' => ':attribute フィールドは :min 文字から :max 文字の間である必要があります。',
    ],
    'boolean' => ':attribute フィールドは true または false である必要があります。',
    'can' => ':attribute フィールドに許可されていない値が含まれています。',
    'confirmed' => ':attribute フィールドの確認入力が一致しません。',
    'contains' => ':attribute フィールドに必須の値がありません。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attribute フィールドは有効な日付である必要があります。',
    'date_equals' => ':attribute フィールドは :date と同じ日付である必要があります。',
    'date_format' => ':attribute フィールドは :format の形式と一致する必要があります。',
    'decimal' => ':attribute フィールドの小数点以下の桁数は :decimal 桁である必要があります。',
    'declined' => ':attribute フィールドは拒否されている必要があります。',
    'declined_if' => ':other が :value の場合、:attribute フィールドは拒否されている必要があります。',
    'different' => ':attribute フィールドと :other フィールドは異なる必要があります。',
    'digits' => ':attribute フィールドは :digits 桁である必要があります。',
    'digits_between' => ':attribute フィールドは :min 桁から :max 桁の間である必要があります。',
    'dimensions' => ':attribute フィールドの画像サイズが無効です。',
    'distinct' => ':attribute フィールドに重複した値があります。',
    'doesnt_contain' => ':attribute フィールドには次のいずれも含めることはできません: :values。',
    'doesnt_end_with' => ':attribute フィールドは次のいずれかで終わることはできません: :values。',
    'doesnt_start_with' => ':attribute フィールドは次のいずれかで始まることはできません: :values。',
    'email' => ':attribute フィールドは有効なメールアドレスである必要があります。',
    'encoding' => ':attribute フィールドは :encoding でエンコードされている必要があります。',
    'ends_with' => ':attributeには、次のいずれかで終わる値を指定してください: :values。',
    'enum' => '選択された:attributeは無効です。',
    'exists' => '選択された:attributeは無効です。',
    'extensions' => ':attributeには、次のいずれかの拡張子を持つファイルを指定してください: :values。',
    'file' => ':attributeにはファイルを指定してください。',
    'filled' => ':attributeには値を指定してください。',
    'gt' => [
        'array' => ':attributeには、:value個より多い項目を指定してください。',
        'file' => ':attributeには、:valueキロバイトより大きい値を指定してください。',
        'numeric' => ':attributeには、:valueより大きい値を指定してください。',
        'string' => ':attributeには、:value文字より多く指定してください。',
    ],
    'gte' => [
        'array' => ':attributeには、:value個以上の項目を指定してください。',
        'file' => ':attributeには、:valueキロバイト以上の値を指定してください。',
        'numeric' => ':attributeには、:value以上の値を指定してください。',
        'string' => ':attributeには、:value文字以上で指定してください。',
    ],
    'hex_color' => ':attributeには、有効な16進数カラーコードを指定してください。',
    'image' => ':attributeには画像を指定してください。',
    'in' => '選択された:attributeは無効です。',
    'in_array' => ':attributeは:otherに存在している必要があります。',
    'in_array_keys' => ':attributeには、次のキーのうち少なくとも1つを含めてください: :values。',
    'integer' => ':attributeには整数を指定してください。',
    'ip' => ':attributeには、有効なIPアドレスを指定してください。',
    'ipv4' => ':attributeには、有効なIPv4アドレスを指定してください。',
    'ipv6' => ':attributeには、有効なIPv6アドレスを指定してください。',
    'json' => ':attributeには、有効なJSON文字列を指定してください。',
    'list' => ':attributeにはリストを指定してください。',
    'lowercase' => ':attributeは小文字で指定してください。',
    'lt' => [
        'array' => ':attributeには、:value個未満の項目を指定してください。',
        'file' => ':attributeには、:valueキロバイト未満の値を指定してください。',
        'numeric' => ':attributeには、:value未満の値を指定してください。',
        'string' => ':attributeには、:value文字未満で指定してください。',
    ],
    'lte' => [
        'array' => ':attributeには、:value個を超える項目を指定できません。',
        'file' => ':attributeには、:valueキロバイト以下の値を指定してください。',
        'numeric' => ':attributeには、:value以下の値を指定してください。',
        'string' => ':attributeには、:value文字以下で指定してください。',
    ],
    'mac_address' => ':attributeには、有効なMACアドレスを指定してください。',
    'max' => [
        'array' => ':attributeには、:max個を超える項目を指定できません。',
        'file' => ':attributeには、:maxキロバイトを超える値を指定できません。',
        'numeric' => ':attributeには、:maxを超える値を指定できません。',
        'string' => ':attributeには、:max文字を超えて指定できません。',
    ],
    'max_digits' => ':attributeには、:max桁を超えて指定できません。',
    'mimes' => ':attributeには、次の形式のファイルを指定してください: :values。',
    'mimetypes' => ':attributeには、次の形式のファイルを指定してください: :values。',
    'min' => [
        'array' => ':attributeには、少なくとも:min個の項目を指定してください。',
        'file' => ':attributeには、少なくとも:minキロバイトの値を指定してください。',
        'numeric' => ':attributeには、少なくとも:min以上の値を指定してください。',
        'string' => ':attributeには、少なくとも:min文字以上で指定してください。',
    ],
    'min_digits' => ':attributeには、少なくとも:min桁を指定してください。',
    'missing' => ':attributeは指定しないでください。',
    'missing_if' => ':otherが:valueの場合、:attributeは指定しないでください。',
    'missing_unless' => ':otherが:valueでない限り、:attributeは指定しないでください。',
    'missing_with' => ':valuesが存在する場合、:attributeフィールドは存在してはいけません。',
    'missing_with_all' => ':valuesが存在する場合、:attributeフィールドは存在してはいけません。',
    'multiple_of' => ':attributeフィールドは:valueの倍数でなければなりません。',
    'not_in' => '選択された:attributeは無効です。',
    'not_regex' => ':attributeフィールドの形式が正しくありません。',
    'numeric' => ':attributeフィールドは数値でなければなりません。',
    'password' => [
        'letters' => ':attributeフィールドには少なくとも1文字の英字を含める必要があります。',
        'mixed' => ':attributeフィールドには少なくとも1文字の大文字と1文字の小文字を含める必要があります。',
        'numbers' => ':attributeフィールドには少なくとも1つの数字を含める必要があります。',
        'symbols' => ':attributeフィールドには少なくとも1つの記号を含める必要があります。',
        'uncompromised' => '指定された:attributeはデータ漏えいで確認されています。別の:attributeを選択してください。',
    ],
    'present' => ':attributeフィールドは存在していなければなりません。',
    'present_if' => ':otherが:valueの場合、:attributeフィールドは存在していなければなりません。',
    'present_unless' => ':otherが:valueでない限り、:attributeフィールドは存在していなければなりません。',
    'present_with' => ':valuesが存在する場合、:attributeフィールドは存在していなければなりません。',
    'present_with_all' => ':valuesが存在する場合、:attributeフィールドは存在していなければなりません。',
    'prohibited' => ':attributeフィールドは禁止されています。',
    'prohibited_if' => ':otherが:valueの場合、:attributeフィールドは禁止されています。',
    'prohibited_if_accepted' => ':otherが承認されている場合、:attributeフィールドは禁止されています。',
    'prohibited_if_declined' => ':otherが拒否されている場合、:attributeフィールドは禁止されています。',
    'prohibited_unless' => ':otherが:valuesに含まれていない限り、:attributeフィールドは禁止されています。',
    'prohibits' => ':attributeフィールドがある場合、:otherを存在させることはできません。',
    'regex' => ':attributeフィールドの形式が正しくありません。',
    'required' => ':attributeフィールドは必須です。',
    'required_array_keys' => ':attributeフィールドには次の項目を含める必要があります: :values。',
    'required_if' => ':otherが:valueの場合、:attributeフィールドは必須です。',
    'required_if_accepted' => ':otherが承認されている場合、:attributeフィールドは必須です。',
    'required_if_declined' => ':otherが拒否されている場合、:attributeフィールドは必須です。',
    'required_unless' => ':otherが:valuesに含まれていない限り、:attributeフィールドは必須です。',
    'required_with' => ':valuesが存在する場合、:attributeフィールドは必須です。',
    'required_with_all' => ':valuesが存在する場合、:attributeフィールドは必須です。',
    'required_without' => ':valuesが存在しない場合、:attributeフィールドは必須です。',
    'required_without_all' => ':valuesのいずれも存在しない場合、:attributeフィールドは必須です。',
    'same' => ':attributeフィールドは:otherと一致しなければなりません。',
    'size' => [
        'array' => ':attributeフィールドには:size個の項目が含まれていなければなりません。',
        'file' => ':attributeフィールドは:sizeキロバイトでなければなりません。',
        'numeric' => ':attributeフィールドは:sizeでなければなりません。',
        'string' => ':attributeフィールドは:size文字でなければなりません。',
    ],
    'starts_with' => ':attributeフィールドは次のいずれかで始まる必要があります: :values。',
    'string' => ':attributeフィールドは文字列でなければなりません。',
    'timezone' => ':attributeフィールドは有効なタイムゾーンでなければなりません。',
    'unique' => 'この:attributeはすでに使用されています。',
    'uploaded' => ':attributeのアップロードに失敗しました。',
    'uppercase' => ':attributeフィールドは大文字でなければなりません。',
    'url' => ':attributeフィールドは有効なURLでなければなりません。',
    'ulid' => ':attributeフィールドは有効なULIDでなければなりません。',
    'uuid' => ':attributeフィールドは有効なUUIDでなければなりません。',

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
        'business_name' => '事業名',
        'client_id' => '顧客ID',
        'company_number' => '会社番号',
        'contact_name' => '連絡先名',
        'currency' => '通貨',
        'default_payment_terms_days' => 'デフォルトの支払条件日数',
        'default_tax_rate' => 'デフォルトの税率',
        'due_on' => '支払期日',
        'email' => 'メールアドレス',
        'invoice' => 'Invoice',
        'invoice_prefix' => '請求書プレフィックス',
        'is_archived' => 'アーカイブ済み',
        'issued_on' => '発行日',
        'items' => '項目',
        'name' => '名前',
        'notes' => 'メモ',
        'number' => '番号',
        'payment_instructions' => '支払い方法の案内',
        'payment_terms_days' => '支払条件日数',
        'phone' => '電話番号',
        'send_payment_reminders' => '支払いのリマインダーを送信',
        'status' => 'ステータス',
        'tax_rate' => '税率',
    ],
];
