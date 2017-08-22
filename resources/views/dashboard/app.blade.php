<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Radar | Dashboard</title>

    <link href="{{asset('img/favicon.144x144.png')}}" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="{{asset('img/favicon.114x114.png')}}" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="{{asset('img/favicon.72x72.png')}}" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="{{asset('img/favicon.57x57.png')}}" rel="apple-touch-icon" type="image/png">
    <link href="{{asset('img/favicon.png')}}" rel="icon" type="image/png">
    <link href="{{asset('img/favicon.ico')}}" rel="shortcut icon">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{asset('css/lib/lobipanel/lobipanel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/separate/vendor/lobipanel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/jqueryui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/separate/pages/widgets.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    @yield('stylesheets')

</head>
<body class="with-side-menu control-panel control-panel-compact">

    <header class="site-header">
        <div class="container-fluid">
            <a href="{{url('dashboard')}}" class="site-logo">
                <img class="hidden-md-down" src="{{asset('img/logo-2.png')}}" alt="">
                <img class="hidden-lg-up" src="{{asset('img/logo-2-mob.png')}}" alt="">
            </a>

            <span id="show-hide-sidebar" class="checkbox-toggle">
                <input type="checkbox" id="show-hide-sidebar-toggle" checked>
                <label for="show-hide-sidebar-toggle"></label>
            </span>

            <button class="hamburger hamburger--htla">
                <span>toggle menu</span>
            </button>
            <div class="site-header-content">
                <div class="site-header-content-in">
                    <div class="site-header-shown">
                        <div class="dropdown dropdown-notification notif">
                            <a href="#"
                            class="header-alarm dropdown-toggle active"
                            id="dd-notification"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="font-icon-alarm"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-notif" aria-labelledby="dd-notification">
                            <div class="dropdown-menu-notif-header">
                                Notifications
                                <span class="label label-pill label-danger">4</span>
                            </div>
                            <div class="dropdown-menu-notif-list">
                                <div class="dropdown-menu-notif-item">
                                    <div class="photo">
                                        <img src="img/photo-64-1.jpg" alt="">
                                    </div>
                                    <div class="dot"></div>
                                    <a href="#">Morgan</a> was bothering about something
                                    <div class="color-blue-grey-lighter">7 hours ago</div>
                                </div>
                                <div class="dropdown-menu-notif-item">
                                    <div class="photo">
                                        <img src="img/photo-64-2.jpg" alt="">
                                    </div>
                                    <div class="dot"></div>
                                    <a href="#">Lioneli</a> had commented on this <a href="#">Super Important Thing</a>
                                    <div class="color-blue-grey-lighter">7 hours ago</div>
                                </div>
                                <div class="dropdown-menu-notif-item">
                                    <div class="photo">
                                        <img src="img/photo-64-3.jpg" alt="">
                                    </div>
                                    <div class="dot"></div>
                                    <a href="#">Xavier</a> had commented on the <a href="#">Movie title</a>
                                    <div class="color-blue-grey-lighter">7 hours ago</div>
                                </div>
                                <div class="dropdown-menu-notif-item">
                                    <div class="photo">
                                        <img src="img/photo-64-4.jpg" alt="">
                                    </div>
                                    <a href="#">Lionely</a> wants to go to <a href="#">Cinema</a> with you to see <a href="#">This Movie</a>
                                    <div class="color-blue-grey-lighter">7 hours ago</div>
                                </div>
                            </div>
                            <div class="dropdown-menu-notif-more">
                                <a href="#">See more</a>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown dropdown-notification messages">
                        <a href="#"
                        class="header-alarm dropdown-toggle active"
                        id="dd-messages"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        <i class="font-icon-mail"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-messages" aria-labelledby="dd-messages">
                        <div class="dropdown-menu-messages-header">
                            <ul class="nav" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active"
                                    data-toggle="tab"
                                    href="#tab-incoming"
                                    role="tab">
                                    Inbox
                                    <span class="label label-pill label-danger">8</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                data-toggle="tab"
                                href="#tab-outgoing"
                                role="tab">Outbox</a>
                            </li>
                        </ul>
                        <!--<button type="button" class="create">
                        <i class="font-icon font-icon-pen-square"></i>
                    </button>-->
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-incoming" role="tabpanel">
                        <div class="dropdown-menu-messages-list">
                            <a href="#" class="mess-item">
                                <span class="avatar-preview avatar-preview-32"><img src="img/photo-64-2.jpg" alt=""></span>
                                <span class="mess-item-name">Tim Collins</span>
                                <span class="mess-item-txt">Morgan was bothering about something!</span>
                            </a>
                            <a href="#" class="mess-item">
                                <span class="avatar-preview avatar-preview-32"><img src="img/avatar-2-64.png" alt=""></span>
                                <span class="mess-item-name">Christian Burton</span>
                                <span class="mess-item-txt">Morgan was bothering about something! Morgan was bothering about something.</span>
                            </a>
                            <a href="#" class="mess-item">
                                <span class="avatar-preview avatar-preview-32"><img src="img/photo-64-2.jpg" alt=""></span>
                                <span class="mess-item-name">Tim Collins</span>
                                <span class="mess-item-txt">Morgan was bothering about something!</span>
                            </a>
                            <a href="#" class="mess-item">
                                <span class="avatar-preview avatar-preview-32"><img src="img/avatar-2-64.png" alt=""></span>
                                <span class="mess-item-name">Christian Burton</span>
                                <span class="mess-item-txt">Morgan was bothering about something...</span>
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-outgoing" role="tabpanel">
                        <div class="dropdown-menu-messages-list">
                            <a href="#" class="mess-item">
                                <span class="avatar-preview avatar-preview-32"><img src="img/avatar-2-64.png" alt=""></span>
                                <span class="mess-item-name">Christian Burton</span>
                                <span class="mess-item-txt">Morgan was bothering about something! Morgan was bothering about something...</span>
                            </a>
                            <a href="#" class="mess-item">
                                <span class="avatar-preview avatar-preview-32"><img src="img/photo-64-2.jpg" alt=""></span>
                                <span class="mess-item-name">Tim Collins</span>
                                <span class="mess-item-txt">Morgan was bothering about something! Morgan was bothering about something.</span>
                            </a>
                            <a href="#" class="mess-item">
                                <span class="avatar-preview avatar-preview-32"><img src="img/avatar-2-64.png" alt=""></span>
                                <span class="mess-item-name">Christian Burtons</span>
                                <span class="mess-item-txt">Morgan was bothering about something!</span>
                            </a>
                            <a href="#" class="mess-item">
                                <span class="avatar-preview avatar-preview-32"><img src="img/photo-64-2.jpg" alt=""></span>
                                <span class="mess-item-name">Tim Collins</span>
                                <span class="mess-item-txt">Morgan was bothering about something!</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="dropdown-menu-notif-more">
                    <a href="#">See more</a>
                </div>
            </div>
        </div>


        <div class="dropdown user-menu">
            <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{Auth::user()->full_name}} <img src="img/avatar-2-64.png" alt="">
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">


                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{url('/logout')}}"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
            </div>
        </div>

        <button type="button" class="burger-right">
            <i class="font-icon-menu-addl"></i>
        </button>
    </div><!--.site-header-shown-->

    <div class="mobile-menu-right-overlay"></div>
    <div class="site-header-collapsed">

    </div><!--.site-header-collapsed-->
</div><!--site-header-content-in-->
</div><!--.site-header-content-->
</div><!--.container-fluid-->
</header><!--.site-header-->

<div class="mobile-menu-left-overlay"></div>
<nav class="side-menu">
    <ul class="side-menu-list">

        <li class="brown with-sub">
            <span>
                <i class="fa fa-user-secret"></i>
                <span class="lbl">Admins</span>
            </span>
            <ul>
                <li><a href="{{route('dashboard.admin.create.admin')}}"><span class="lbl">Add </span></a></li>
                <li><a href="{{route('dashboard.admins.all')}}"><span class="lbl">All Admins</span></a></li>

            </ul>
        </li>


        <li class="brown with-sub">
            <span>
                <i class="fa fa-users"></i>
                <span class="lbl">Drivers</span>
            </span>
            <ul>
                <li><a href="{{route('dashboard.drivers.create')}}"><span class="lbl">Add </span></a></li>
                <li><a href="{{route('dashboard.drivers.index')}}"><span class="lbl">All Drivers</span></a></li>

            </ul>
        </li>

        <li class="brown with-sub">
            <span>
                <i class="font-icon glyphicon glyphicon-user"></i>
                <span class="lbl">Car Owners</span>
            </span>
            <ul>
                <li><a href="{{route('dashboard.carOwners.create')}}"><span class="lbl">Add </span></a></li>
                <li><a href="{{route('dashboard.carOwners.index')}}"><span class="lbl">All Car Owners</span></a></li>

            </ul>
        </li>

        <li class="brown with-sub">
            <span>
                <i class="fa fa-car"></i>
                <span class="lbl">Cars</span>
            </span>
            <ul>

                <li><a href="{{route('dashboard.cars.index')}}"><span class="lbl">All Cars</span></a></li>

            </ul>
        </li>

        <li class="brown with-sub">
            <span>
                <i class="fa fa-map"></i>
                <span class="lbl">Radars</span>
            </span>
            <ul>
                <li>
                    <a href="{{ route('dashboard.radar.index') }}">
                        <span class="lbl">All Radars</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.radar.create') }}">
                        <span class="lbl">Add new</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="brown with-sub">
            <span>
                <i class="fa fa-map"></i>
                <span class="lbl">Locations</span>
            </span>
            <ul>
                <li>
                    <a href="{{ route('dashboard.locations.index') }}">
                        <span class="lbl">All locations</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="brown with-sub">
            <span>
                <i class="fa fa-map"></i>
                <span class="lbl">Lagnas</span>
            </span>
            <ul>
                <li>
                    <a href="{{ route('dashboard.lagnas.index') }}">
                        <span class="lbl">All lagnas</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="brown with-sub">
            <span>
                <i class="fa fa-car"></i>
                <span class="lbl">Tow trucks</span>
            </span>
            <ul>
                <li><a href="{{route('dashboard.towtrucks.index')}}"><span class="lbl">All</span></a></li>
                <li><a href="{{route('dashboard.towtrucks.create')}}"><span class="lbl">Add new</span></a></li>
            </ul>
        </li>
        <li class="brown">
            <a href="{{ route('dashboard.accidents.index') }}">
                <span>
                    <i class="fa fa-car"></i>
                    <span class="lbl">
                        Accidents
                    </span>
                </span>
            </a>
        </li>
        <li class="brown">
            <a href="{{ route('dashboard.helprequests.index') }}">
                <span>
                    <i class="fa fa-envelope"></i>
                    <span class="lbl">
                        Help requests
                    </span>
                </span>
            </a>
        </li>
    </ul>
</nav><!--.side-menu-->

<div class="page-content">

    <h1>
        @yield('title')
        <small style="font-size: 20px;">@yield('description')</small>
    </h1>
    @include('dashboard.error')
    @include('dashboard.info')
    @include('dashboard.success')
    @yield('content')
</div><!--.page-content-->



<script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/lib/tether/tether.min.js')}}"></script>
<script src="{{asset('js/lib/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins.js')}}"></script>

<script type="text/javascript" src="{{asset('js/lib/jqueryui/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/lib/lobipanel/lobipanel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/lib/match-height/jquery.matchHeight.min.js')}}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
$(document).ready(function() {
    $('.panel').lobiPanel({
        sortable: true
    });
    $('.panel').on('dragged.lobiPanel', function(ev, lobiPanel){
        $('.dahsboard-column').matchHeight();
    });

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn('string', 'Day');
        dataTable.addColumn('number', 'Values');
        // A column for custom tooltip content
        dataTable.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
        dataTable.addRows([
            ['MON',  130, ' '],
            ['TUE',  130, '130'],
            ['WED',  180, '180'],
            ['THU',  175, '175'],
            ['FRI',  200, '200'],
            ['SAT',  170, '170'],
            ['SUN',  250, '250'],
            ['MON',  220, '220'],
            ['TUE',  220, ' ']
        ]);

        var options = {
            height: 314,
            legend: 'none',
            areaOpacity: 0.18,
            axisTitlesPosition: 'out',
            hAxis: {
                title: '',
                textStyle: {
                    color: '#fff',
                    fontName: 'Proxima Nova',
                    fontSize: 11,
                    bold: true,
                    italic: false
                },
                textPosition: 'out'
            },
            vAxis: {
                minValue: 0,
                textPosition: 'out',
                textStyle: {
                    color: '#fff',
                    fontName: 'Proxima Nova',
                    fontSize: 11,
                    bold: true,
                    italic: false
                },
                baselineColor: '#16b4fc',
                ticks: [0,25,50,75,100,125,150,175,200,225,250,275,300,325,350],
                gridlines: {
                    color: '#1ba0fc',
                    count: 15
                },
            },
            lineWidth: 2,
            colors: ['#fff'],
            curveType: 'function',
            pointSize: 5,
            pointShapeType: 'circle',
            pointFillColor: '#f00',
            backgroundColor: {
                fill: '#008ffb',
                strokeWidth: 0,
            },
            chartArea:{
                left:0,
                top:0,
                width:'100%',
                height:'100%'
            },
            fontSize: 11,
            fontName: 'Proxima Nova',
            tooltip: {
                trigger: 'selection',
                isHtml: true
            }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(dataTable, options);
    }
    $(window).resize(function(){
        drawChart();
        setTimeout(function(){
        }, 1000);
    });
});
</script>
<script src="{{asset('js/app.js')}}"></script>
@yield('scripts')

</body>
</html>
