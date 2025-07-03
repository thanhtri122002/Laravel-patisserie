<x-mail::message>
# Dear, {{ $customer }}

Thank you for your purchase. Your invoice code is **{{ $invoice }}**

<!-- <x-mail::button :url="''">
View Order
</x-mail::button> -->

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
