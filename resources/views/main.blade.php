<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test task</title>
</head>
<body>
    <form id="form">
        @csrf
        Марка: <br>
        <select name="car_id" id="car_id">
            <option value="0">Виберіть марку</option>
            @foreach($cars as $car)
                <option value="{{ $car->id }}">{{ $car->name }}</option>
            @endforeach
        </select>
        <br>
        Модель: <br>
        <select name="car_model" id="car_model" disabled>
            <option value="0">Виберіть модель</option>
        </select>
        <br>
        <br>
        <button id="send-button">Надіслати дані</button>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{ asset('/js/index.js') }}"></script>
</body>
</html>
