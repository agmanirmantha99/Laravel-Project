<!DOCTYPE html>
<html>
   <head>
        <title>New Contact Form Submission</title>
   </head>
   <body>
        <h2>Contact Form Details</h2>
        <p><strong>Name:</strong></h2> {{ $data['sender_name'] }} </p>
        <p><strong>Email:</strong></h2> {{ $data['sender_email'] }} </p>
        <p><strong>Message:</strong></h2> {{ $data['sender_message'] }} </p>
   </body>
</html>