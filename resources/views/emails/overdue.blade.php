<!DOCTYPE html>
<html>
<head>
    <title>Overdue Book Notification</title>
</head>
<body>
    <p>Dear Member,</p>
    <p>The book "<strong>{{ $book->title }}</strong>" is overdue. It was due on <strong>{{ $book->due_date->format('d M Y') }}</strong>. Please return it as soon as possible to avoid penalties.</p>
    <p>Thank you!</p>
</body>
</html>
