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

    'accepted' => ':attribute フィールドを承認してください。',
    'accepted_if' => ':other が :value の場合、:attribute フィールドを承認してください。',
    'active_url' => ':attribute フィールドには有効なURLを入力してください。',
    'after' => ':attribute フィールドには :date より後の日付を入力してください。',
    'after_or_equal' => ':attribute フィールドには :date 以降の日付を入力してください。',
    'alpha' => ':attribute フィールドには英字のみ入力できます。',
    'alpha_dash' => ':attribute フィールドには英字、数字、ダッシュ、アンダースコアのみ入力できます。',
    'alpha_num' => ':attribute フィールドには英字と数字のみ入力できます。',
    'any_of' => ':attribute フィールドが無効です。',
    'array' => ':attribute フィールドは配列である必要があります。',
    'array_keys' => ':attribute フィールドには次のキーのみ含めることができます: :values。',
    'ascii' => ':attribute フィールドには半角英数字と記号のみ入力できます。',
    'base64' => ':attribute フィールドには有効なBase64文字列を入力してください。',
    'before' => ':attribute フィールドには :date より前の日付を入力してください。',
    'before_or_equal' => ':attribute フィールドには :date 以前の日付を入力してください。',
    'between' => [
        'array' => ':attribute フィールドの項目数は :min 個から :max 個の間である必要があります。',
        'file' => ':attribute フィールドは :min KBから :max KBの間である必要があります。',
        'numeric' => ':attribute フィールドは :min から :max の間である必要があります。',
        'string' => ':attribute フィールドは :min 文字から :max 文字の間である必要があります。',
    ],
    'boolean' => ':attribute フィールドは true または false である必要があります。',
    'can' => ':attribute フィールドに未承認の値が含まれています。',
    'confirmed' => ':attribute フィールドの確認入力が一致しません。',
    'contains' => ':attribute フィールドに必須の値がありません。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attribute フィールドには有効な日付を入力してください。',
    'date_equals' => ':attribute フィールドには :date と同じ日付を入力してください。',
    'date_format' => ':attribute フィールドは :format 形式である必要があります。',
    'decimal' => ':attribute フィールドの小数点以下の桁数は :decimal 桁である必要があります。',
    'declined' => ':attribute フィールドは拒否されている必要があります。',
    'declined_if' => ':other が :value の場合、:attribute フィールドは拒否されている必要があります。',
    'different' => ':attribute フィールドと :other フィールドは異なる必要があります。',
    'digits' => ':attribute フィールドは :digits 桁である必要があります。',
    'digits_between' => ':attribute フィールドは :min 桁から :max 桁の間である必要があります。',
    'dimensions' => ':attribute フィールドの画像サイズが無効です。',
    'distinct' => ':attribute フィールドに重複した値があります。',
    'doesnt_contain' => ':attribute フィールドには次のいずれも含めることはできません: :values。',
    'doesnt_end_with' => ':attribute フィールドの末尾を次のいずれかにすることはできません: :values。',
    'doesnt_start_with' => ':attribute フィールドの先頭を次のいずれかにすることはできません: :values。',
    'email' => ':attribute フィールドには有効なメールアドレスを入力してください。',
    'encoding' => ':attribute フィールドは :encoding でエンコードされている必要があります。',
    'ends_with' => ':attribute欄は次のいずれかで終わる必要があります：:values。',
    'enum' => '選択された:attributeは無効です。',
    'exists' => '選択された:attributeは無効です。',
    'extensions' => ':attribute欄には次のいずれかの拡張子が必要です：:values。',
    'file' => ':attribute欄はファイルである必要があります。',
    'filled' => ':attribute欄には値が必要です。',
    'gt' => [
        'array' => ':attribute欄は:value個より多くの項目が必要です。',
        'file' => ':attribute欄は:valueキロバイトより大きい必要があります。',
        'numeric' => ':attribute欄は:valueより大きい必要があります。',
        'string' => ':attribute欄は:value文字より多い必要があります。',
    ],
    'gte' => [
        'array' => ':attribute欄は:value個以上の項目が必要です。',
        'file' => ':attribute欄は:valueキロバイト以上である必要があります。',
        'numeric' => ':attribute欄は:value以上である必要があります。',
        'string' => ':attribute欄は:value文字以上である必要があります。',
    ],
    'hex_color' => ':attribute欄は有効な16進カラーコードである必要があります。',
    'image' => ':attribute欄は画像である必要があります。',
    'in' => '選択された:attributeは無効です。',
    'in_array' => ':attribute欄は:otherに存在する必要があります。',
    'in_array_keys' => ':attribute欄には次のキーのうち少なくとも1つを含める必要があります：:values。',
    'integer' => ':attribute欄は整数である必要があります。',
    'ip' => ':attribute欄は有効なIPアドレスである必要があります。',
    'ipv4' => ':attribute欄は有効なIPv4アドレスである必要があります。',
    'ipv6' => ':attribute欄は有効なIPv6アドレスである必要があります。',
    'json' => ':attribute欄は有効なJSON文字列である必要があります。',
    'list' => ':attribute欄はリストである必要があります。',
    'lowercase' => ':attribute欄は小文字である必要があります。',
    'lt' => [
        'array' => ':attribute欄は:value個未満の項目である必要があります。',
        'file' => ':attribute欄は:valueキロバイト未満である必要があります。',
        'numeric' => ':attribute欄は:value未満である必要があります。',
        'string' => ':attribute欄は:value文字未満である必要があります。',
    ],
    'lte' => [
        'array' => ':attribute欄の項目数は:value個以下である必要があります。',
        'file' => ':attribute欄は:valueキロバイト以下である必要があります。',
        'numeric' => ':attribute欄は:value以下である必要があります。',
        'string' => ':attribute欄は:value文字以下である必要があります。',
    ],
    'mac_address' => ':attribute欄は有効なMACアドレスである必要があります。',
    'max' => [
        'array' => ':attribute欄の項目数は:max個以下である必要があります。',
        'file' => ':attribute欄は:maxキロバイト以下である必要があります。',
        'numeric' => ':attribute欄は:max以下である必要があります。',
        'string' => ':attribute欄は:max文字以下である必要があります。',
    ],
    'max_digits' => ':attribute欄の桁数は:max桁以下である必要があります。',
    'mimes' => ':attribute欄は次の形式のファイルである必要があります：:values。',
    'mimetypes' => ':attribute欄は次の形式のファイルである必要があります：:values。',
    'min' => [
        'array' => ':attribute欄は少なくとも:min個の項目が必要です。',
        'file' => ':attribute欄は少なくとも:minキロバイトである必要があります。',
        'numeric' => ':attribute欄は少なくとも:minである必要があります。',
        'string' => ':attribute欄は少なくとも:min文字である必要があります。',
    ],
    'min_digits' => ':attribute欄は少なくとも:min桁が必要です。',
    'missing' => ':attribute欄は存在してはいけません。',
    'missing_if' => ':otherが:valueの場合、:attribute欄は存在してはいけません。',
    'missing_unless' => ':otherが:valueでない限り、:attribute欄は存在してはいけません。',
    'missing_with' => ':valuesが存在する場合、:attributeフィールドは存在してはいけません。',
    'missing_with_all' => ':valuesが存在する場合、:attributeフィールドは存在してはいけません。',
    'multiple_of' => ':attributeフィールドは:valueの倍数である必要があります。',
    'not_in' => '選択した:attributeが無効です。',
    'not_regex' => ':attributeフィールドの形式が正しくありません。',
    'numeric' => ':attributeフィールドは数値である必要があります。',
    'password' => [
        'letters' => ':attributeフィールドには少なくとも1文字の英字を含める必要があります。',
        'mixed' => ':attributeフィールドには少なくとも1文字の大文字と1文字の小文字を含める必要があります。',
        'numbers' => ':attributeフィールドには少なくとも1つの数字を含める必要があります。',
        'symbols' => ':attributeフィールドには少なくとも1つの記号を含める必要があります。',
        'uncompromised' => '指定された:attributeはデータ漏えいで確認されています。別の:attributeを選択してください。',
    ],
    'present' => ':attributeフィールドが存在している必要があります。',
    'present_if' => ':otherが:valueの場合、:attributeフィールドが存在している必要があります。',
    'present_unless' => ':otherが:valueでない限り、:attributeフィールドが存在している必要があります。',
    'present_with' => ':valuesが存在する場合、:attributeフィールドが存在している必要があります。',
    'present_with_all' => ':valuesが存在する場合、:attributeフィールドが存在している必要があります。',
    'prohibited' => ':attributeフィールドは禁止されています。',
    'prohibited_if' => ':otherが:valueの場合、:attributeフィールドは禁止されています。',
    'prohibited_if_accepted' => ':otherが承認されている場合、:attributeフィールドは禁止されています。',
    'prohibited_if_declined' => ':otherが拒否されている場合、:attributeフィールドは禁止されています。',
    'prohibited_unless' => ':otherが:valuesに含まれていない限り、:attributeフィールドは禁止されています。',
    'prohibits' => ':attributeフィールドが存在する場合、:otherフィールドは存在できません。',
    'regex' => ':attributeフィールドの形式が正しくありません。',
    'required' => ':attributeフィールドは必須です。',
    'required_array_keys' => ':attributeフィールドには次の項目の入力が必要です: :values。',
    'required_if' => ':otherが:valueの場合、:attributeフィールドは必須です。',
    'required_if_accepted' => ':otherが承認されている場合、:attributeフィールドは必須です。',
    'required_if_declined' => ':otherが拒否されている場合、:attributeフィールドは必須です。',
    'required_unless' => ':otherが:valuesに含まれていない限り、:attributeフィールドは必須です。',
    'required_with' => ':valuesが存在する場合、:attributeフィールドは必須です。',
    'required_with_all' => ':valuesが存在する場合、:attributeフィールドは必須です。',
    'required_without' => ':valuesが存在しない場合、:attributeフィールドは必須です。',
    'required_without_all' => ':valuesのいずれも存在しない場合、:attributeフィールドは必須です。',
    'same' => ':attributeフィールドは:otherと一致する必要があります。',
    'size' => [
        'array' => ':attributeフィールドには:size個の項目が必要です。',
        'file' => ':attributeフィールドは:sizeキロバイトである必要があります。',
        'numeric' => ':attributeフィールドは:sizeである必要があります。',
        'string' => ':attributeフィールドは:size文字である必要があります。',
    ],
    'starts_with' => ':attributeフィールドは次のいずれかで始まる必要があります: :values。',
    'string' => ':attributeフィールドは文字列である必要があります。',
    'timezone' => ':attributeフィールドは有効なタイムゾーンである必要があります。',
    'unique' => 'この:attributeは既に使用されています。',
    'uploaded' => ':attributeのアップロードに失敗しました。',
    'uppercase' => ':attributeフィールドは大文字である必要があります。',
    'url' => ':attributeフィールドは有効なURLである必要があります。',
    'ulid' => ':attributeフィールドは有効なULIDである必要があります。',
    'uuid' => ':attributeフィールドは有効なUUIDである必要があります。',

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
        'client_id' => '顧客ID',
        'company_number' => '会社番号',
        'contact_name' => '連絡先名',
        'currency' => '通貨',
        'default_payment_terms_days' => 'デフォルトの支払条件日数',
        'default_tax_rate' => 'デフォルトの税率',
        'due_on' => '支払期限',
        'email' => 'メール',
        'invoice' => '請求書',
        'invoice_prefix' => '請求書プレフィックス',
        'is_archived' => 'アーカイブ済み',
        'issued_on' => '発行日',
        'items' => '項目',
        'name' => '名前',
        'notes' => 'メモ',
        'number' => '番号',
        'payment_instructions' => '支払い案内',
        'payment_terms_days' => '支払条件日数',
        'phone' => '電話番号',
        'send_payment_reminders' => '支払いのリマインダーを送信',
        'status' => 'ステータス',
        'tax_rate' => '税率',
    ],
];
