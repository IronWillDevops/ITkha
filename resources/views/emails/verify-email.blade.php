@component('mail::message')
# 👋 Hello, {{ strtoupper($user->first_name) }}!

Thank you for registering at **{{ config('app.name') }}**.

To complete your registration, please confirm your email address by clicking the button <below></below>:

@component('mail::button', ['url' => $url, 'class' => 'button'])
✅ Confirm Email Address
@endcomponent

@component('mail::panel')
🛡️ This helps us ensure your account stays secure.
@endcomponent

⏳ Please note: this confirmation link is valid for **{{ $time }} minutes**.

If you did not register an account, you can safely ignore this email.

Best regards,  
The **{{ config('app.name') }}** Team

---

If you’re having trouble clicking the "Confirm Email Address" button, copy and paste the URL below into your web browser:  
[{{ $url }}]({{ $url }})

@endcomponent
