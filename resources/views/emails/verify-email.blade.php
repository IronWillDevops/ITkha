@component('mail::message')
{{-- Header --}}
# 👋 Hello, {{ strtoupper($user->name) }}!

Thank you for registering at **{{ config('app.name') }}**.

To complete your registration, please confirm your email address by clicking the button below:

{{-- Confirmation Button --}}
@component('mail::button', ['url' => $url, 'color' => 'success'])
✅ Confirm Email Address
@endcomponent

@component('mail::panel')
🛡️ This helps us ensure your account stays secure.
@endcomponent

If you did not create an account, no further action is required.

Best regards,  
The **{{ config('app.name') }}** Team

---

If you’re having trouble clicking the "Confirm Email Address" button, copy and paste the URL below into your web browser:  
[{{ $url }}]({{ $url }})
@endcomponent
