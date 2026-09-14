export type InvoiceStatusValue =
    | 'draft'
    | 'sent'
    | 'paid'
    | 'overdue'
    | 'cancelled';

export type BadgeVariant = 'default' | 'secondary' | 'destructive' | 'outline';

export type StatusOption = {
    value: InvoiceStatusValue;
    label: string;
    description: string;
};

export type ClientOption = {
    value: number;
    label: string;
};

export type ClientRow = {
    id: number;
    name: string;
    contact_name: string | null;
    email: string;
    phone: string | null;
    payment_terms_days: number;
    invoices_count: number;
    is_archived: boolean;
};

export type ClientRecord = {
    id: number;
    name: string;
    contact_name: string | null;
    email: string;
    phone: string | null;
    company_number: string | null;
    billing_address: string | null;
    currency: string;
    payment_terms_days: number;
    notes: string | null;
    is_archived: boolean;
};

export type InvoiceRow = {
    id: number;
    number: string;
    status: InvoiceStatusValue;
    status_label: string;
    status_variant: BadgeVariant;
    status_description: string;
    client_id: number;
    client_name: string;
    issued_on: string;
    due_on: string;
    paid_on: string | null;
    payment_method: string | null;
    total: string;
    is_overdue: boolean;
    days_until_due: number;
};

export type InvoiceLine = {
    id: number;
    description: string;
    quantity: number;
    unit_amount: string;
    line_total: string;
};

export type InvoiceDetail = InvoiceRow & {
    notes: string | null;
    currency: string;
    tax_rate: number;
    subtotal: string;
    tax: string;
    public_url: string;
    client: {
        id: number;
        name: string;
        contact_name: string | null;
        email: string;
        billing_address: string | null;
    };
    items: InvoiceLine[];
};

export type InvoiceFormItem = {
    description: string;
    quantity: number;
    unit_amount: number;
};

export type InvoiceFormRecord = {
    id: number;
    client_id: number;
    number: string;
    status: InvoiceStatusValue;
    issued_on: string;
    due_on: string;
    tax_rate: number;
    currency: string;
    notes: string | null;
    items: InvoiceFormItem[];
};

export type DashboardMetrics = {
    outstanding_total: string;
    paid_this_year_total: string;
    overdue_count: number;
    client_count: number;
    draft_count: number;
};

export type InvoicingPreferences = {
    business_name: string;
    invoice_prefix: string;
    default_payment_terms_days: number;
    default_tax_rate: number;
    payment_instructions: string;
    send_payment_reminders: boolean;
};
