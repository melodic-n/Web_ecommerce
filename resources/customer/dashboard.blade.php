<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')
@section('content')
    <h1>Customer Dashboard</h1>
    <p>Welcome {{ auth()->user()->name }}!</p>
@endsection
</body>
</html>