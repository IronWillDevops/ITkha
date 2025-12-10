@component('mail::message')
# 🔐 Hello, {{ strtoupper($user->first_name) }}!

We received a request to reset your password for your **{{ config('app.name') }}** account.

To proceed, please click the button below:

@component('mail::button', ['url' => $url])
🔁 Reset Password
@endcomponent

@component('mail::panel')
⚠️ For your security, this link will expire in **{{ $time }} minutes**.
@endcomponent

If you did not request a password reset, you can safely ignore this email — no changes will be made.

Best regards,  
The **{{ config('app.name') }}** Team

---

If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your browser:  
[{{ $url }}]({{ $url }})

@endcomponent
