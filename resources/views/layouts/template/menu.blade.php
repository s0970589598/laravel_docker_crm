<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li>
                <a class="active-menu" href="#"><i class="fa fa-dashboard"></i>{{trans('views.menu.system')}}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::to('/') }}">{{trans('views.menu.dashboard')}}</a>
                        <a href="{{ route('settings') }}">{{trans('views.menu.settings')}}</a>
                        <a href="{{ route('clientsIEport') }}">{{trans('views.menu.clients_ieport')}}</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-user"></i>{{trans('views.menu.dependencies')}}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('clients') }}">{{trans('views.menu.clients')}}<span class="label label-dependencies pull-right" style="margin-top:4px;">{{ Cache::get('countClients') }}</span></a>
                        <a href="{{ route('employees') }}">{{trans('views.menu.employees')}}<span class="label label-dependencies pull-right" style="margin-top:4px">{{ Cache::get('countEmployees') }}</span></a>
                        <a href="{{ route('deals') }}">{{trans('views.menu.deals')}}<span class="label label-dependencies pull-right" style="margin-top:4px">{{ Cache::get('countDeals') }}</span></a>
                        <a href="{{ route('companies') }}">{{trans('views.menu.companies')}}<span class="label label-dependencies pull-right" style="margin-top:4px">{{ Cache::get('countCompanies') }}</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-money"></i>{{trans('views.menu.marketing')}}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('products') }}">{{trans('views.menu.products')}}<span class="label label-marketing pull-right" style="margin-top:4px">{{ Cache::get('countProducts') }}</span></a>
                        <a href="{{ route('tasks') }}">{{trans('views.menu.tasks')}}<span class="label label-marketing pull-right" style="margin-top:4px">{{ Cache::get('countTasks') }}</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-shopping-cart"></i> {{trans('views.menu.sales')}}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('finances') }}">{{trans('views.menu.finances')}}<span class="label label-sales pull-right" style="margin-top:4px">{{ Cache::get('countFinances') }}</span></a>
                        <a href="{{ route('sales') }}">{{trans('views.menu.sales')}}<span class="label label-sales pull-right" style="margin-top:4px">{{ Cache::get('countSales') }}</span></a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul style="margin-top: 10px; color: #dee7f1;margin-left:-30px;font-size: 14px;">
            <h4>{{trans('views.menu.informations')}} </h4>
            <li><i class="fa fa-money" aria-hidden="true"></i> {{trans('views.menu.today_income')}}  {{ Cache::get('todayIncome') }}</li>
            <li><i class="fa fa-money" aria-hidden="true"></i> {{trans('views.menu.yesterday_income')}} {{ Cache::get('yesterdayIncome') }}</li>
            <li><i class="fa fa-money" aria-hidden="true"></i> {{trans('views.menu.cash_turnover')}}  {{ Cache::get('cashTurnover') }}</li>
            <br>
            <li><i class="fa fa-cogs" aria-hidden="true"></i> {{trans('views.menu.operations')}} {{ Cache::get('countAllRowsInDb')  }}</li>
            <li><i class="fa fa-book" aria-hidden="true"></i> {{trans('views.menu.system_logs')}} {{ Cache::get('countSystemLogs') }}</li>
        </ul>
    </div>
</nav>
