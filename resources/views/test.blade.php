<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>BZU Exams</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script
                src="https://code.jquery.com/jquery-3.2.1.min.js"
                integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
                crossorigin="anonymous"></script>
        <!-- Styles -->
    <style>
        .table {
            width: 100%;
        }
    </style>
    </head>
    <body>
    <div class="container">
        <h4 style="color: green">Examination timetabling graduation project done by Mahmoud Abdelkarim, Mohammad Sehweil, Ahmad Zaid</h4>
        <h4 style="color: red">Student ID: {{$student_id}}</h4>
    </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Schedule 1</h2>
                    <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th >Day</th>
                                <th >8 - 11</th>
                                <th >11 - 2</th>
                                <th >2 - 5</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 1 ; $i < 13 ; $i++)
                                <tr>
                                    <td>Day {{$i}}</td>

                                    @for($j = 1 ; $j < 4 ; $j++)

                                        @if(isset($student_course_uni[($i-1)*3 + $j]))
                                            <td class="info">Exam</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                    @endfor
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                    <h2>Schedule 2</h2>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Day</th>
                            <th>8 - 11</th>
                            <th>11 - 2</th>
                            <th>2 - 5</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i = 1 ; $i < 13 ; $i++)
                            <tr>
                                <td>Day {{$i}}</td>

                            @for($j = 1 ; $j < 4 ; $j++)

                                    @if(isset($student_course_our[($i-1)*3 + $j]))
                                        <td class="info">Exam</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                @endfor
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

            <div class="container">
                <strong>The better schedule is: </strong>
                <div class="radio">
                    <label><input type="radio" name="optradio" class=".input-lg" value="1">Schedule 1</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="optradio" class=".input-lg" value="2">Schedule 2</label>
                </div>
                <button type="button" id="answer" class="btn btn-primary btn-block"> Submit </button>
                <input type="button" id="thanks" class="btn btn-danger btn-block hidden" onclick="location.href='/test'" value="Yeslmo ya warde .. To fill another one , refresh the page " href="{{url('/')}}/test"></input>
                <br><br>
            </div>
        </div>
        <script type="text/javascript">
            $( document ).ready(function() {

                $( "body" ).on( "click", "#answer", function(e) {
                    var val = $('input[name=optradio]:checked').val();
                    e.preventDefault();
                    $.ajax({
                        url: 'https://guarded-refuge-82765.herokuapp.com/save',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        data: {
                            'option':val,
                            'randNum': {{$randNum}}
                        },
                        success: function(result){
                        },
                        error: function(result){
                        }
                    });
                    if (val){
                        $("#answer").remove();
                        $("#thanks").removeClass("hidden");
                    }
                });


            });
        </script>
    </body>


</html>


