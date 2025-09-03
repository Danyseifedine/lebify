<html lang="en" class="{{ $name }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Box Shadow Generator</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    @if ($name == 'Gradient generator')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
    @endif
</head>

<body class="{{ $name }}">
    <style>
        {!! $codes['css'] ?? '' !!}
    </style>
    {!! $codes['html'] ?? '' !!}
    <script>
        {!! $codes['js'] ?? '' !!}
    </script>
</body>

@if ($name == 'Gradient generator')
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
@endif

@if ($name == 'Clip-path & shape generator')
    <script src="https://cdn.jsdelivr.net/npm/simplex-noise@2.4.0/simplex-noise.min.js"></script>
@endif

</html>
