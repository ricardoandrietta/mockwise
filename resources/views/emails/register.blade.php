<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Test</title>
</head>
<body style="margin: 0; padding: 20px; font-family: Arial, sans-serif;">
<h1>Thanks for registering</h1>
<p>This is a test email sent at: {{ now() }}</p>
<!-- Add this marker to help debug -->
<p style="display: none;">Debug ID: {{ uniqid() }}</p>
</body>
</html>
