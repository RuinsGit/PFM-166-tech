<!DOCTYPE html>
<html>
<head>
    <title>Yeni İletişim Talebi</title>
</head>
<body>
    @component('mail::message')
    # Yeni Əlaqə Tələbi

    **Ad:** {{ $name }}  
    **E-poçt:** {{ $email }}  
    **Telefon:** {{ $number }}  
    **Mesaj:** {{ $description }}

    Tarix: {{ now()->format('d.m.Y H:i:s') }}

    @endcomponent
</body>
</html> 