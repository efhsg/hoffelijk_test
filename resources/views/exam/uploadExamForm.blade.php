<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Upload Exam</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .form {
            padding: 1rem;
        }

        .error {
            color: red;
        }

        .right {
            text-align: right;
        }

        .left {
            text-align: left;
        }

    </style>
</head>
<body>
<div class="content">
    <div class="title m-b-md">
        Upload Exam
    </div>

    @if(session('errors'))
        @foreach($errors as $error)
            <div class="error">{{ $error }}</div>
        @endforeach
    @endif

    <div class="form">
        <form action="{{ url('/exam/upload') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div>
                Select Excel file to upload
            </div>
            <div>
                <input type="file" name="file" id="file">
                <button type="submit">Upload File</button>
            </div>
        </form>
    </div>

    @if(session('studentResults'))
        <table class="flex-center">
            <tr>
                <th class="left">Student</th>
                <th class="right">Points</th>
                <th class="right">Grade</th>
                <th class="left">Passed</th>
            </tr>
            @foreach(session('studentResults') as $student => $studentResult)
                <tr>
                    <td class="left">{{ $student }}</td>
                    <td class="right">{{ $studentResult['points'] }}</td>
                    <td class="right">{{ $studentResult['grade'] }}</td>
                    <td class="left">{{ $studentResult['passed'] ? 'Yes' : 'No'}}</td>
                </tr>
            @endforeach
        </table>
    @endif

</div>
</body>
</html>
