@extends('ui._layouts._app-global')

@section('content-extends')
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('ui.dashboard._layouts.app-navbar')
            @include('ui.dashboard._layouts.app-sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                <div class="section-header flex-column flex-lg-row align-items-start align-items-lg-center mb-3">
                    <h1>@yield('header')</h1>
                    <div class="section-header-breadcrumb flex-column flex-lg-row align-items-start ml-0 my-3 ml-lg-auto">
                        @yield('breadcrumb')
                    </div>
                </div>

                <div class="section-body">
                    <div class="mb-4">
                    @yield('content-header')
                    </div>
                    @yield('content')
                </div>
                </section>
            </div>

            @include('ui.dashboard._layouts.app-footer')
        </div>
    </div>
@endsection

