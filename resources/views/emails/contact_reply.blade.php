<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $subjectLine }}</title>
</head>
<body>
    <p>Доброго дня, {{ $contact->name }}!</p>

    <p>{{ $replyMessage }}</p>

    <hr>
    <p style="font-size: 12px; color: #777;">
        Відповідь на ваше повідомлення: "{{ $contact->subject }}"
    </p>
</body>
</html>
