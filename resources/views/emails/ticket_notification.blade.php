<!DOCTYPE html>
<html>
<head>
    <title>{{ $notificationType === 'closed' ? 'Your Ticket has been closed' : 'New Support Ticket Submitted' }}</title>
</head>
<body>
    <h1>{{ $notificationType === 'closed' ? 'Your Ticket has been closed' : 'New Support Ticket Submitted' }}</h1>
    <p>Subject: {{ $ticketSubject }}</p>

    @if($notificationType === 'closed')
        <p>Tracking Number: {{ $ticketTrackingNo }}</p>
        <p>Status: {{ $ticketStatus }}</p>
        <p>Admin Remarks: {{ $ticketRemarks }}</p>
    @else
        <p>Tracking Number: {{ $ticketTrackingNo }}</p>
        <p>Description: {{ $ticketDescription }}</p>
        <p>Submitted By: {{ $submittedByName }} ({{ $submittedByEmail }})</p>
       
        <p>Please log in to the system to view and respond to this support ticket.</p>
    @endif

    <p>Thank you for using our support ticket system!</p>
</body>
</html>
