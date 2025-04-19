<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-success " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i> <span class="label label-primary">{{ $thongKe['thong_bao'] }}</span>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="{{ route('admin.notifications.create') }}">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> You have {{ $thongKe['thong_bao'] }} messages
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
