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

    'accepted' => 'يجب قبول حقل :attribute.',
    'accepted_if' => 'يجب قبول حقل :attribute عندما تكون قيمة :other هي :value.',
    'active_url' => 'يجب أن يكون حقل :attribute رابط URL صالحًا.',
    'after' => 'يجب أن يكون حقل :attribute تاريخًا بعد :date.',
    'after_or_equal' => 'يجب أن يكون حقل :attribute تاريخًا بعد :date أو مساويًا له.',
    'alpha' => 'يجب أن يحتوي حقل :attribute على أحرف فقط.',
    'alpha_dash' => 'يجب أن يحتوي حقل :attribute على أحرف وأرقام وشرطات سفلية وواصلات فقط.',
    'alpha_num' => 'يجب أن يحتوي حقل :attribute على أحرف وأرقام فقط.',
    'any_of' => 'حقل :attribute غير صالح.',
    'array' => 'يجب أن يكون حقل :attribute مصفوفة.',
    'array_keys' => 'يجب أن يحتوي حقل :attribute على المفاتيح التالية فقط: :values.',
    'ascii' => 'يجب أن يحتوي حقل :attribute على أحرف وأرقام ورموز أحادية البايت فقط.',
    'base64' => 'يجب أن يكون حقل :attribute سلسلة Base64 صالحة.',
    'before' => 'يجب أن يكون حقل :attribute تاريخًا قبل :date.',
    'before_or_equal' => 'يجب أن يكون حقل :attribute تاريخًا قبل :date أو مساويًا له.',
    'between' => [
        'array' => 'يجب أن يحتوي حقل :attribute على عدد عناصر بين :min و:max.',
        'file' => 'يجب أن يكون حجم حقل :attribute بين :min و:max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة حقل :attribute بين :min و:max.',
        'string' => 'يجب أن يحتوي حقل :attribute على عدد أحرف بين :min و:max.',
    ],
    'boolean' => 'يجب أن تكون قيمة حقل :attribute صحيحة أو خاطئة.',
    'can' => 'يحتوي حقل :attribute على قيمة غير مصرح بها.',
    'confirmed' => 'تأكيد حقل :attribute غير متطابق.',
    'contains' => 'حقل :attribute يفتقد قيمة مطلوبة.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => 'يجب أن يكون حقل :attribute تاريخًا صالحًا.',
    'date_equals' => 'يجب أن يكون حقل :attribute تاريخًا مساويًا لـ :date.',
    'date_format' => 'يجب أن يطابق حقل :attribute التنسيق :format.',
    'decimal' => 'يجب أن يحتوي حقل :attribute على :decimal منازل عشرية.',
    'declined' => 'يجب رفض حقل :attribute.',
    'declined_if' => 'يجب رفض حقل :attribute عندما تكون قيمة :other هي :value.',
    'different' => 'يجب أن يكون حقل :attribute وحقل :other مختلفين.',
    'digits' => 'يجب أن يتكون حقل :attribute من :digits أرقام.',
    'digits_between' => 'يجب أن يتكون حقل :attribute من بين :min و:max أرقام.',
    'dimensions' => 'أبعاد صورة حقل :attribute غير صالحة.',
    'distinct' => 'يحتوي حقل :attribute على قيمة مكررة.',
    'doesnt_contain' => 'يجب ألا يحتوي حقل :attribute على أي مما يلي: :values.',
    'doesnt_end_with' => 'يجب ألا ينتهي حقل :attribute بأحد القيم التالية: :values.',
    'doesnt_start_with' => 'يجب ألا يبدأ حقل :attribute بأحد القيم التالية: :values.',
    'email' => 'يجب أن يكون حقل :attribute عنوان بريد إلكتروني صالحًا.',
    'encoding' => 'يجب أن يكون حقل :attribute مرمّزًا بـ :encoding.',
    'ends_with' => 'يجب أن ينتهي الحقل :attribute بأحد القيم التالية: :values.',
    'enum' => 'القيمة المحددة للحقل :attribute غير صالحة.',
    'exists' => 'القيمة المحددة للحقل :attribute غير صالحة.',
    'extensions' => 'يجب أن يكون للحقل :attribute أحد الامتدادات التالية: :values.',
    'file' => 'يجب أن يكون الحقل :attribute ملفًا.',
    'filled' => 'يجب أن تكون للحقل :attribute قيمة.',
    'gt' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على أكثر من :value عناصر.',
        'file' => 'يجب أن يكون الحقل :attribute أكبر من :value كيلوبايت.',
        'numeric' => 'يجب أن يكون الحقل :attribute أكبر من :value.',
        'string' => 'يجب أن يكون الحقل :attribute أطول من :value حرفًا.',
    ],
    'gte' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على :value عناصر أو أكثر.',
        'file' => 'يجب أن يكون الحقل :attribute أكبر من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن يكون الحقل :attribute أكبر من أو يساوي :value.',
        'string' => 'يجب أن يكون الحقل :attribute أطول من أو يساوي :value حرفًا.',
    ],
    'hex_color' => 'يجب أن يكون الحقل :attribute لونًا سداسيًا عشريًا صالحًا.',
    'image' => 'يجب أن يكون الحقل :attribute صورة.',
    'in' => 'القيمة المحددة للحقل :attribute غير صالحة.',
    'in_array' => 'يجب أن يكون الحقل :attribute موجودًا في :other.',
    'in_array_keys' => 'يجب أن يحتوي الحقل :attribute على مفتاح واحد على الأقل من المفاتيح التالية: :values.',
    'integer' => 'يجب أن يكون الحقل :attribute عددًا صحيحًا.',
    'ip' => 'يجب أن يكون الحقل :attribute عنوان IP صالحًا.',
    'ipv4' => 'يجب أن يكون الحقل :attribute عنوان IPv4 صالحًا.',
    'ipv6' => 'يجب أن يكون الحقل :attribute عنوان IPv6 صالحًا.',
    'json' => 'يجب أن يكون الحقل :attribute سلسلة JSON صالحة.',
    'list' => 'يجب أن يكون الحقل :attribute قائمة.',
    'lowercase' => 'يجب أن يكون الحقل :attribute بأحرف صغيرة.',
    'lt' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على أقل من :value عناصر.',
        'file' => 'يجب أن يكون الحقل :attribute أقل من :value كيلوبايت.',
        'numeric' => 'يجب أن يكون الحقل :attribute أقل من :value.',
        'string' => 'يجب أن يكون الحقل :attribute أقل من :value حرفًا.',
    ],
    'lte' => [
        'array' => 'يجب ألا يحتوي الحقل :attribute على أكثر من :value عناصر.',
        'file' => 'يجب أن يكون الحقل :attribute أقل من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن يكون الحقل :attribute أقل من أو يساوي :value.',
        'string' => 'يجب أن يكون الحقل :attribute أقل من أو يساوي :value حرفًا.',
    ],
    'mac_address' => 'يجب أن يكون الحقل :attribute عنوان MAC صالحًا.',
    'max' => [
        'array' => 'يجب ألا يحتوي الحقل :attribute على أكثر من :max عناصر.',
        'file' => 'يجب ألا يكون الحقل :attribute أكبر من :max كيلوبايت.',
        'numeric' => 'يجب ألا يكون الحقل :attribute أكبر من :max.',
        'string' => 'يجب ألا يكون الحقل :attribute أطول من :max حرفًا.',
    ],
    'max_digits' => 'يجب ألا يحتوي الحقل :attribute على أكثر من :max أرقام.',
    'mimes' => 'يجب أن يكون الحقل :attribute ملفًا من النوع: :values.',
    'mimetypes' => 'يجب أن يكون الحقل :attribute ملفًا من النوع: :values.',
    'min' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على :min عناصر على الأقل.',
        'file' => 'يجب أن يكون الحقل :attribute بحجم :min كيلوبايت على الأقل.',
        'numeric' => 'يجب أن يكون الحقل :attribute على الأقل :min.',
        'string' => 'يجب أن يكون الحقل :attribute بطول :min حرفًا على الأقل.',
    ],
    'min_digits' => 'يجب أن يحتوي الحقل :attribute على :min أرقام على الأقل.',
    'missing' => 'يجب أن يكون الحقل :attribute غير موجود.',
    'missing_if' => 'يجب ألا يكون الحقل :attribute موجودًا عندما تكون قيمة :other هي :value.',
    'missing_unless' => 'يجب ألا يكون الحقل :attribute موجودًا إلا إذا كانت قيمة :other هي :value.',
    'missing_with' => 'يجب ألا يكون الحقل :attribute موجودًا عند وجود :values.',
    'missing_with_all' => 'يجب ألا يكون الحقل :attribute موجودًا عند وجود :values.',
    'multiple_of' => 'يجب أن يكون الحقل :attribute من مضاعفات :value.',
    'not_in' => 'القيمة المحددة لـ :attribute غير صالحة.',
    'not_regex' => 'تنسيق الحقل :attribute غير صالح.',
    'numeric' => 'يجب أن يكون الحقل :attribute رقمًا.',
    'password' => [
        'letters' => 'يجب أن يحتوي الحقل :attribute على حرف واحد على الأقل.',
        'mixed' => 'يجب أن يحتوي الحقل :attribute على حرف كبير وحرف صغير واحد على الأقل.',
        'numbers' => 'يجب أن يحتوي الحقل :attribute على رقم واحد على الأقل.',
        'symbols' => 'يجب أن يحتوي الحقل :attribute على رمز واحد على الأقل.',
        'uncompromised' => 'ظهر :attribute المحدد في تسرّب بيانات. يرجى اختيار :attribute مختلف.',
    ],
    'present' => 'يجب أن يكون الحقل :attribute موجودًا.',
    'present_if' => 'يجب أن يكون الحقل :attribute موجودًا عندما تكون قيمة :other هي :value.',
    'present_unless' => 'يجب أن يكون الحقل :attribute موجودًا ما لم تكن قيمة :other هي :value.',
    'present_with' => 'يجب أن يكون الحقل :attribute موجودًا عند وجود :values.',
    'present_with_all' => 'يجب أن يكون الحقل :attribute موجودًا عند وجود :values.',
    'prohibited' => 'الحقل :attribute غير مسموح به.',
    'prohibited_if' => 'الحقل :attribute غير مسموح به عندما تكون قيمة :other هي :value.',
    'prohibited_if_accepted' => 'الحقل :attribute غير مسموح به عندما يكون :other مقبولًا.',
    'prohibited_if_declined' => 'الحقل :attribute غير مسموح به عندما يكون :other مرفوضًا.',
    'prohibited_unless' => 'الحقل :attribute غير مسموح به ما لم تكن قيمة :other ضمن :values.',
    'prohibits' => 'وجود الحقل :attribute يمنع وجود :other.',
    'regex' => 'تنسيق الحقل :attribute غير صالح.',
    'required' => 'حقل :attribute مطلوب.',
    'required_array_keys' => 'يجب أن يحتوي الحقل :attribute على إدخالات للقيم التالية: :values.',
    'required_if' => 'حقل :attribute مطلوب عندما تكون قيمة :other هي :value.',
    'required_if_accepted' => 'حقل :attribute مطلوب عندما يكون :other مقبولًا.',
    'required_if_declined' => 'حقل :attribute مطلوب عندما يكون :other مرفوضًا.',
    'required_unless' => 'حقل :attribute مطلوب ما لم تكن قيمة :other ضمن :values.',
    'required_with' => 'حقل :attribute مطلوب عند وجود :values.',
    'required_with_all' => 'حقل :attribute مطلوب عند وجود :values.',
    'required_without' => 'حقل :attribute مطلوب عند عدم وجود :values.',
    'required_without_all' => 'حقل :attribute مطلوب عندما لا يكون أي من :values موجودًا.',
    'same' => 'يجب أن يتطابق الحقل :attribute مع :other.',
    'size' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على :size عناصر.',
        'file' => 'يجب أن يكون الحقل :attribute بحجم :size كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute هي :size.',
        'string' => 'يجب أن يكون الحقل :attribute مكوّنًا من :size أحرف.',
    ],
    'starts_with' => 'يجب أن يبدأ الحقل :attribute بأحد القيم التالية: :values.',
    'string' => 'يجب أن يكون الحقل :attribute نصًا.',
    'timezone' => 'يجب أن يكون الحقل :attribute منطقة زمنية صالحة.',
    'unique' => 'القيمة :attribute مستخدمة بالفعل.',
    'uploaded' => 'فشل رفع :attribute.',
    'uppercase' => 'يجب أن يكون الحقل :attribute بأحرف كبيرة.',
    'url' => 'يجب أن يكون الحقل :attribute رابط URL صالحًا.',
    'ulid' => 'يجب أن يكون الحقل :attribute قيمة ULID صالحة.',
    'uuid' => 'يجب أن يكون الحقل :attribute قيمة UUID صالحة.',

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
        'billing_address' => 'عنوان الفوترة',
        'business_name' => 'اسم النشاط التجاري',
        'client_id' => 'معرّف العميل',
        'company_number' => 'رقم الشركة',
        'contact_name' => 'اسم جهة الاتصال',
        'currency' => 'العملة',
        'default_payment_terms_days' => 'أيام شروط الدفع الافتراضية',
        'default_tax_rate' => 'معدل الضريبة الافتراضي',
        'due_on' => 'تاريخ الاستحقاق',
        'email' => 'البريد الإلكتروني',
        'invoice' => 'Invoice',
        'invoice_prefix' => 'بادئة الفاتورة',
        'is_archived' => 'مؤرشف',
        'issued_on' => 'تاريخ الإصدار',
        'items' => 'العناصر',
        'name' => 'الاسم',
        'notes' => 'ملاحظات',
        'number' => 'الرقم',
        'payment_instructions' => 'تعليمات الدفع',
        'payment_terms_days' => 'أيام شروط الدفع',
        'phone' => 'الهاتف',
        'send_payment_reminders' => 'إرسال تذكيرات الدفع',
        'status' => 'الحالة',
        'tax_rate' => 'معدل الضريبة',
    ],
];
