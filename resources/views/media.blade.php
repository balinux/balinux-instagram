<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="container">
            <div class="content">
                <ul>
                    @foreach($response['data'] as $image)
                        <li><img src="{{ $image->images->thumbnail->url }}" alt=""></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </body>
</html>
