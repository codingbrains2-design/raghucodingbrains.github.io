 <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <style>
        .sidebar-main-menu ul li{position: relative; list-style: none;}
        .sidebar-main-menu ul a{color: #fff;}
        .sidebar-main-menu ul ul{ }
        .sidebar-main-menu ul > li:hover > ul{ opacity: 1; visibility: visible; }
        .sidebar-main-menu ul ul:after{content: '';border-top:solid 10px transparent;border-bottom:solid 10px transparent;border-right:solid 10px #222; position: absolute;left:-10px;top:10px;}
    </style>

    <div class="sidebar-wrapper sidebar-main-menu">
        <div class="logo">
            <a href="" class="simple-text">
                HRM
            </a>
        </div>

        <ul class="nav">
            <li class="active">
                <a href="dashboard.html">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="leave" id="">
                    <i class="pe-7s-user"></i>
                    <p>User Profile</p>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" >
                    <i class="pe-7s-shopbag"></i>
                    <p  id="leave">Leave</p>
                </a>
                <ul id="leave_sub" style="display: none; ">
                    <li><a href=" {{URL('/user/apply_leave')}} ">Apply</a></li>
                    <li><a href="{{URL('/user/my_leave')}}">My Leaves</a></li>
                    <li><a href="{{URL('/user/leave_report')}}">Reports</a></li>
                    <li><a href="{{URL('/user/leave_calender')}}">Leave Calender</a></li>
                </ul>
            </li>
            <li>
                <a href="typography.html">
                    <i class="pe-7s-news-paper"></i>
                    <p>Typography</p>
                </a>
            </li>
            <li>
                <a href="icons.html">
                    <i class="pe-7s-science"></i>
                    <p>Icons</p>
                </a>
            </li>
            <li>
                <a href="maps.html">
                    <i class="pe-7s-map-marker"></i>
                    <p>Maps</p>
                </a>
            </li>
            <li>
                <a href="notifications.html">
                    <i class="pe-7s-bell"></i>
                    <p>Notifications</p>
                </a>
            </li>

        </ul>
    </div>
</div>