<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="[index, follow]">
        <meta name="description" content="{{ $metaTitle }}">
        <title>{{ $metaDesc }}</title>
        @foreach($page->css as $css)
        <link rel="stylesheet" href="{{ asset('css/templates/' . $css) }}" type="text/css" media="all" />
        @endforeach
    </head>
    <body>
