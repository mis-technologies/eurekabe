<!DOCTYPE html>
<html lang="en" dir="ltr" data-mode="light" data-layout-width="default" data-layout-position="fixed"
    data-topbar-color="light" data-menu-color="light" data-sidenav-view="md">

<head>
    <meta charset="utf-8">
    <title>Admin | Eureka </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin for Eureka" name="description">
    <meta content="coderthemes" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>


    <style type="text/css">
        .apexcharts-canvas {
            position: relative;
            user-select: none;
            /* cannot give overflow: hidden as it will crop tooltips which overflow outside chart area */
        }


        /* scrollbar is not visible by default for legend, hence forcing the visibility */
        .apexcharts-canvas ::-webkit-scrollbar {
            -webkit-appearance: none;
            width: 6px;
        }

        .apexcharts-canvas ::-webkit-scrollbar-thumb {
            border-radius: 4px;
            background-color: rgba(0, 0, 0, .5);
            box-shadow: 0 0 1px rgba(255, 255, 255, .5);
            -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5);
        }


        .apexcharts-inner {
            position: relative;
        }

        .apexcharts-text tspan {
            font-family: inherit;
        }

        .legend-mouseover-inactive {
            transition: 0.15s ease all;
            opacity: 0.20;
        }

        .apexcharts-series-collapsed {
            opacity: 0;
        }

        .apexcharts-tooltip {
            border-radius: 5px;
            box-shadow: 2px 2px 6px -4px #999;
            cursor: default;
            font-size: 14px;
            left: 62px;
            opacity: 0;
            pointer-events: none;
            position: absolute;
            top: 20px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            white-space: nowrap;
            z-index: 12;
            transition: 0.15s ease all;
        }

        .apexcharts-tooltip.apexcharts-active {
            opacity: 1;
            transition: 0.15s ease all;
        }

        .apexcharts-tooltip.apexcharts-theme-light {
            border: 1px solid #e3e3e3;
            background: rgba(255, 255, 255, 0.96);
        }

        .apexcharts-tooltip.apexcharts-theme-dark {
            color: #fff;
            background: rgba(30, 30, 30, 0.8);
        }

        .apexcharts-tooltip * {
            font-family: inherit;
        }


        .apexcharts-tooltip-title {
            padding: 6px;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .apexcharts-tooltip.apexcharts-theme-light .apexcharts-tooltip-title {
            background: #ECEFF1;
            border-bottom: 1px solid #ddd;
        }

        .apexcharts-tooltip.apexcharts-theme-dark .apexcharts-tooltip-title {
            background: rgba(0, 0, 0, 0.7);
            border-bottom: 1px solid #333;
        }

        .apexcharts-tooltip-text-y-value,
        .apexcharts-tooltip-text-goals-value,
        .apexcharts-tooltip-text-z-value {
            display: inline-block;
            font-weight: 600;
            margin-left: 5px;
        }

        .apexcharts-tooltip-text-y-label:empty,
        .apexcharts-tooltip-text-y-value:empty,
        .apexcharts-tooltip-text-goals-label:empty,
        .apexcharts-tooltip-text-goals-value:empty,
        .apexcharts-tooltip-text-z-value:empty {
            display: none;
        }

        .apexcharts-tooltip-text-y-value,
        .apexcharts-tooltip-text-goals-value,
        .apexcharts-tooltip-text-z-value {
            font-weight: 600;
        }

        .apexcharts-tooltip-text-goals-label,
        .apexcharts-tooltip-text-goals-value {
            padding: 6px 0 5px;
        }

        .apexcharts-tooltip-goals-group,
        .apexcharts-tooltip-text-goals-label,
        .apexcharts-tooltip-text-goals-value {
            display: flex;
        }

        .apexcharts-tooltip-text-goals-label:not(:empty),
        .apexcharts-tooltip-text-goals-value:not(:empty) {
            margin-top: -6px;
        }

        .apexcharts-tooltip-marker {
            width: 12px;
            height: 12px;
            position: relative;
            top: 0px;
            margin-right: 10px;
            border-radius: 50%;
        }

        .apexcharts-tooltip-series-group {
            padding: 0 10px;
            display: none;
            text-align: left;
            justify-content: left;
            align-items: center;
        }

        .apexcharts-tooltip-series-group.apexcharts-active .apexcharts-tooltip-marker {
            opacity: 1;
        }

        .apexcharts-tooltip-series-group.apexcharts-active,
        .apexcharts-tooltip-series-group:last-child {
            padding-bottom: 4px;
        }

        .apexcharts-tooltip-series-group-hidden {
            opacity: 0;
            height: 0;
            line-height: 0;
            padding: 0 !important;
        }

        .apexcharts-tooltip-y-group {
            padding: 6px 0 5px;
        }

        .apexcharts-tooltip-box,
        .apexcharts-custom-tooltip {
            padding: 4px 8px;
        }

        .apexcharts-tooltip-boxPlot {
            display: flex;
            flex-direction: column-reverse;
        }

        .apexcharts-tooltip-box>div {
            margin: 4px 0;
        }

        .apexcharts-tooltip-box span.value {
            font-weight: bold;
        }

        .apexcharts-tooltip-rangebar {
            padding: 5px 8px;
        }

        .apexcharts-tooltip-rangebar .category {
            font-weight: 600;
            color: #777;
        }

        .apexcharts-tooltip-rangebar .series-name {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .apexcharts-xaxistooltip {
            opacity: 0;
            padding: 9px 10px;
            pointer-events: none;
            color: #373d3f;
            font-size: 13px;
            text-align: center;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
            background: #ECEFF1;
            border: 1px solid #90A4AE;
            transition: 0.15s ease all;
        }

        .apexcharts-xaxistooltip.apexcharts-theme-dark {
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(0, 0, 0, 0.5);
            color: #fff;
        }

        .apexcharts-xaxistooltip:after,
        .apexcharts-xaxistooltip:before {
            left: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .apexcharts-xaxistooltip:after {
            border-color: rgba(236, 239, 241, 0);
            border-width: 6px;
            margin-left: -6px;
        }

        .apexcharts-xaxistooltip:before {
            border-color: rgba(144, 164, 174, 0);
            border-width: 7px;
            margin-left: -7px;
        }

        .apexcharts-xaxistooltip-bottom:after,
        .apexcharts-xaxistooltip-bottom:before {
            bottom: 100%;
        }

        .apexcharts-xaxistooltip-top:after,
        .apexcharts-xaxistooltip-top:before {
            top: 100%;
        }

        .apexcharts-xaxistooltip-bottom:after {
            border-bottom-color: #ECEFF1;
        }

        .apexcharts-xaxistooltip-bottom:before {
            border-bottom-color: #90A4AE;
        }

        .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:after {
            border-bottom-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:before {
            border-bottom-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-xaxistooltip-top:after {
            border-top-color: #ECEFF1
        }

        .apexcharts-xaxistooltip-top:before {
            border-top-color: #90A4AE;
        }

        .apexcharts-xaxistooltip-top.apexcharts-theme-dark:after {
            border-top-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-xaxistooltip-top.apexcharts-theme-dark:before {
            border-top-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-xaxistooltip.apexcharts-active {
            opacity: 1;
            transition: 0.15s ease all;
        }

        .apexcharts-yaxistooltip {
            opacity: 0;
            padding: 4px 10px;
            pointer-events: none;
            color: #373d3f;
            font-size: 13px;
            text-align: center;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
            background: #ECEFF1;
            border: 1px solid #90A4AE;
        }

        .apexcharts-yaxistooltip.apexcharts-theme-dark {
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(0, 0, 0, 0.5);
            color: #fff;
        }

        .apexcharts-yaxistooltip:after,
        .apexcharts-yaxistooltip:before {
            top: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .apexcharts-yaxistooltip:after {
            border-color: rgba(236, 239, 241, 0);
            border-width: 6px;
            margin-top: -6px;
        }

        .apexcharts-yaxistooltip:before {
            border-color: rgba(144, 164, 174, 0);
            border-width: 7px;
            margin-top: -7px;
        }

        .apexcharts-yaxistooltip-left:after,
        .apexcharts-yaxistooltip-left:before {
            left: 100%;
        }

        .apexcharts-yaxistooltip-right:after,
        .apexcharts-yaxistooltip-right:before {
            right: 100%;
        }

        .apexcharts-yaxistooltip-left:after {
            border-left-color: #ECEFF1;
        }

        .apexcharts-yaxistooltip-left:before {
            border-left-color: #90A4AE;
        }

        .apexcharts-yaxistooltip-left.apexcharts-theme-dark:after {
            border-left-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip-left.apexcharts-theme-dark:before {
            border-left-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip-right:after {
            border-right-color: #ECEFF1;
        }

        .apexcharts-yaxistooltip-right:before {
            border-right-color: #90A4AE;
        }

        .apexcharts-yaxistooltip-right.apexcharts-theme-dark:after {
            border-right-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip-right.apexcharts-theme-dark:before {
            border-right-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip.apexcharts-active {
            opacity: 1;
        }

        .apexcharts-yaxistooltip-hidden {
            display: none;
        }

        .apexcharts-xcrosshairs,
        .apexcharts-ycrosshairs {
            pointer-events: none;
            opacity: 0;
            transition: 0.15s ease all;
        }

        .apexcharts-xcrosshairs.apexcharts-active,
        .apexcharts-ycrosshairs.apexcharts-active {
            opacity: 1;
            transition: 0.15s ease all;
        }

        .apexcharts-ycrosshairs-hidden {
            opacity: 0;
        }

        .apexcharts-selection-rect {
            cursor: move;
        }

        .svg_select_boundingRect,
        .svg_select_points_rot {
            pointer-events: none;
            opacity: 0;
            visibility: hidden;
        }

        .apexcharts-selection-rect+g .svg_select_boundingRect,
        .apexcharts-selection-rect+g .svg_select_points_rot {
            opacity: 0;
            visibility: hidden;
        }

        .apexcharts-selection-rect+g .svg_select_points_l,
        .apexcharts-selection-rect+g .svg_select_points_r {
            cursor: ew-resize;
            opacity: 1;
            visibility: visible;
        }

        .svg_select_points {
            fill: #efefef;
            stroke: #333;
            rx: 2;
        }

        .apexcharts-svg.apexcharts-zoomable.hovering-zoom {
            cursor: crosshair
        }

        .apexcharts-svg.apexcharts-zoomable.hovering-pan {
            cursor: move
        }

        .apexcharts-zoom-icon,
        .apexcharts-zoomin-icon,
        .apexcharts-zoomout-icon,
        .apexcharts-reset-icon,
        .apexcharts-pan-icon,
        .apexcharts-selection-icon,
        .apexcharts-menu-icon,
        .apexcharts-toolbar-custom-icon {
            cursor: pointer;
            width: 20px;
            height: 20px;
            line-height: 24px;
            color: #6E8192;
            text-align: center;
        }

        .apexcharts-zoom-icon svg,
        .apexcharts-zoomin-icon svg,
        .apexcharts-zoomout-icon svg,
        .apexcharts-reset-icon svg,
        .apexcharts-menu-icon svg {
            fill: #6E8192;
        }

        .apexcharts-selection-icon svg {
            fill: #444;
            transform: scale(0.76)
        }

        .apexcharts-theme-dark .apexcharts-zoom-icon svg,
        .apexcharts-theme-dark .apexcharts-zoomin-icon svg,
        .apexcharts-theme-dark .apexcharts-zoomout-icon svg,
        .apexcharts-theme-dark .apexcharts-reset-icon svg,
        .apexcharts-theme-dark .apexcharts-pan-icon svg,
        .apexcharts-theme-dark .apexcharts-selection-icon svg,
        .apexcharts-theme-dark .apexcharts-menu-icon svg,
        .apexcharts-theme-dark .apexcharts-toolbar-custom-icon svg {
            fill: #f3f4f5;
        }

        .apexcharts-canvas .apexcharts-zoom-icon.apexcharts-selected svg,
        .apexcharts-canvas .apexcharts-selection-icon.apexcharts-selected svg,
        .apexcharts-canvas .apexcharts-reset-zoom-icon.apexcharts-selected svg {
            fill: #008FFB;
        }

        .apexcharts-theme-light .apexcharts-selection-icon:not(.apexcharts-selected):hover svg,
        .apexcharts-theme-light .apexcharts-zoom-icon:not(.apexcharts-selected):hover svg,
        .apexcharts-theme-light .apexcharts-zoomin-icon:hover svg,
        .apexcharts-theme-light .apexcharts-zoomout-icon:hover svg,
        .apexcharts-theme-light .apexcharts-reset-icon:hover svg,
        .apexcharts-theme-light .apexcharts-menu-icon:hover svg {
            fill: #333;
        }

        .apexcharts-selection-icon,
        .apexcharts-menu-icon {
            position: relative;
        }

        .apexcharts-reset-icon {
            margin-left: 5px;
        }

        .apexcharts-zoom-icon,
        .apexcharts-reset-icon,
        .apexcharts-menu-icon {
            transform: scale(0.85);
        }

        .apexcharts-zoomin-icon,
        .apexcharts-zoomout-icon {
            transform: scale(0.7)
        }

        .apexcharts-zoomout-icon {
            margin-right: 3px;
        }

        .apexcharts-pan-icon {
            transform: scale(0.62);
            position: relative;
            left: 1px;
            top: 0px;
        }

        .apexcharts-pan-icon svg {
            fill: #fff;
            stroke: #6E8192;
            stroke-width: 2;
        }

        .apexcharts-pan-icon.apexcharts-selected svg {
            stroke: #008FFB;
        }

        .apexcharts-pan-icon:not(.apexcharts-selected):hover svg {
            stroke: #333;
        }

        .apexcharts-toolbar {
            position: absolute;
            z-index: 11;
            max-width: 176px;
            text-align: right;
            border-radius: 3px;
            padding: 0px 6px 2px 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .apexcharts-menu {
            background: #fff;
            position: absolute;
            top: 100%;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 3px;
            right: 10px;
            opacity: 0;
            min-width: 110px;
            transition: 0.15s ease all;
            pointer-events: none;
        }

        .apexcharts-menu.apexcharts-menu-open {
            opacity: 1;
            pointer-events: all;
            transition: 0.15s ease all;
        }

        .apexcharts-menu-item {
            padding: 6px 7px;
            font-size: 12px;
            cursor: pointer;
        }

        .apexcharts-theme-light .apexcharts-menu-item:hover {
            background: #eee;
        }

        .apexcharts-theme-dark .apexcharts-menu {
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
        }

        @media screen and (min-width: 768px) {
            .apexcharts-canvas:hover .apexcharts-toolbar {
                opacity: 1;
            }
        }

        .apexcharts-datalabel.apexcharts-element-hidden {
            opacity: 0;
        }

        .apexcharts-pie-label,
        .apexcharts-datalabels,
        .apexcharts-datalabel,
        .apexcharts-datalabel-label,
        .apexcharts-datalabel-value {
            cursor: default;
            pointer-events: none;
        }

        .apexcharts-pie-label-delay {
            opacity: 0;
            animation-name: opaque;
            animation-duration: 0.3s;
            animation-fill-mode: forwards;
            animation-timing-function: ease;
        }

        .apexcharts-canvas .apexcharts-element-hidden {
            opacity: 0;
        }

        .apexcharts-hide .apexcharts-series-points {
            opacity: 0;
        }

        .apexcharts-gridline,
        .apexcharts-annotation-rect,
        .apexcharts-tooltip .apexcharts-marker,
        .apexcharts-area-series .apexcharts-area,
        .apexcharts-line,
        .apexcharts-zoom-rect,
        .apexcharts-toolbar svg,
        .apexcharts-area-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
        .apexcharts-line-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
        .apexcharts-radar-series path,
        .apexcharts-radar-series polygon {
            pointer-events: none;
        }


        /* markers */

        .apexcharts-marker {
            transition: 0.15s ease all;
        }

        @keyframes opaque {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }


        /* Resize generated styles */

        @keyframes resizeanim {
            from {
                opacity: 0;
            }

            to {
                opacity: 0;
            }
        }

        .resize-triggers {
            animation: 1ms resizeanim;
            visibility: hidden;
            opacity: 0;
        }

        .resize-triggers,
        .resize-triggers>div,
        .contract-trigger:before {
            content: " ";
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        .resize-triggers>div {
            background: #eee;
            overflow: auto;
        }

        .contract-trigger:before {
            width: 200%;
            height: 200%;
        }
    </style>


    @stack('styles')
</head>

<body>

    <div class="flex wrapper">

        <!-- Sidenav Menu -->
        @include('admin::partials.sidebar')

        <!-- Sidenav Menu End  -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">
            @include('admin::partials.header')
            @yield('content')
            @include('admin::partials.footer')
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>

    <!-- Back to Top Button -->
    <button data-toggle="back-to-top"
        class="fixed h-10 w-10 items-center justify-center rounded-full z-10 bottom-20 end-14 p-2.5 bg-primary cursor-pointer shadow-lg text-white flex">
        <i class="mgc_arrow_up_line text-lg"></i>
    </button>

    <!-- Theme Settings -->
    <div>
        <!-- Theme Setting Button -->
        <div class="fixed end-0 bottom-20">
            <button data-fc-type="offcanvas" data-fc-target="theme-customization" type="button"
                class="bg-white rounded-s-full shadow-lg p-2.5 ps-3 transition-all dark:bg-slate-800">
                <span class="sr-only">Setting</span>
                <span class="flex items-center justify-center animate-spin">
                    <i class="mgc_settings_4_line text-2xl"></i>
                </span>
            </button>
        </div>

        <!-- Theme Settings Offcanvas -->
        <div id="theme-customization"
            class="fc-offcanvas-open:translate-x-0 hidden translate-x-full rtl:-translate-x-full fixed inset-y-0 end-0 transition-all duration-300 transform max-w-sm w-full z-50 bg-white border-s border-gray-900/10 dark:bg-gray-800 dark:border-white/10 fc-offcanvas"
            tabindex="-1">
            <div
                class="h-16 flex items-center text-gray-800 dark:text-white border-b border-dashed border-gray-900/10 dark:border-white/10 px-6 gap-3">
                <h5 class="text-base grow">Theme Settings</h5>
                <button type="button" class="p-2" id="reset-layout"><i
                        class="mgc_refresh_1_line text-xl"></i></button>
                <button type="button" data-fc-dismiss=""><i class="mgc_close_line text-xl"></i></button>
            </div>

            <div class="h-[calc(100vh-64px)]" data-simplebar="init">
                <div class="simplebar-wrapper" style="margin: 0px;">
                    <div class="simplebar-height-auto-observer-wrapper">
                        <div class="simplebar-height-auto-observer"></div>
                    </div>
                    <div class="simplebar-mask">
                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                <div class="simplebar-content" style="padding: 0px;">
                                    <div class="divide-y divide-dashed divide-slate-900/10  dark:divide-white/10">
                                        <div class="p-6">
                                            <h5 class="font-semibold text-sm mb-3">Theme</h5>
                                            <div class="grid grid-cols-3 gap-2">
                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-mode"
                                                        id="layout-color-light" value="light">
                                                    <label class="form-label rounded-md" for="layout-color-light">
                                                        <span class="flex items-center justify-center px-4 py-3">
                                                            <i class="mgc_sun_line text-2xl"></i>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Light </div>
                                                </div>

                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-mode"
                                                        id="layout-color-dark" value="dark">
                                                    <label class="form-label rounded-md" for="layout-color-dark">
                                                        <span class="flex items-center justify-center px-4 py-3">
                                                            <i class="mgc_moon_line text-2xl"></i>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Dark </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-6">
                                            <h5 class="font-semibold text-sm mb-3">Direction</h5>
                                            <div class="grid grid-cols-3 gap-2">
                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="dir"
                                                        id="direction-ltr" value="ltr">
                                                    <label class="form-label rounded-md" for="direction-ltr">
                                                        <span class="flex items-center justify-center px-4 py-3">
                                                            <i class="mgc_align_left_line text-2xl"></i>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        LTR </div>
                                                </div>

                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="dir"
                                                        id="direction-rtl" value="rtl">
                                                    <label class="form-label rounded-md" for="direction-rtl">
                                                        <span class="flex items-center justify-center px-4 py-3">
                                                            <i class="mgc_align_right_line text-2xl"></i>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        RTL </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-6 2xl:block hidden">
                                            <h5 class="font-semibold text-sm mb-3">Content Width</h5>
                                            <div class="grid grid-cols-3 gap-2">
                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-layout-width"
                                                        id="layout-mode-default" value="default">
                                                    <label class="form-label rounded-md" for="layout-mode-default">
                                                        <span class="flex items-center justify-center px-4 py-3">
                                                            <i class="mgc_fullscreen_2_line text-2xl rotate-45"></i>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Fluid </div>
                                                </div>

                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-layout-width"
                                                        id="layout-mode-boxed" value="boxed">
                                                    <label class="form-label rounded-md" for="layout-mode-boxed">
                                                        <span class="flex items-center justify-center px-4 py-3">
                                                            <i
                                                                class="mgc_fullscreen_exit_2_line text-2xl rotate-45"></i>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Boxed </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-6">
                                            <h5 class="font-semibold text-sm mb-3">Sidenav View</h5>
                                            <div class="grid grid-cols-3 gap-3">
                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-sidenav-view"
                                                        id="sidenav-view-default" value="default">
                                                    <label class="form-label rounded-md" for="sidenav-view-default">
                                                        <span class="flex h-16 overflow-hidden">
                                                            <span class="block w-8 bg-gray-100 dark:bg-gray-800">
                                                                <span class="mt-1.5 mx-1.5 block space-y-1">
                                                                    <span
                                                                        class="h-1 block rounded-sm mb-2.5 bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="h-1 block rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="h-1 block rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="h-1 block rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="h-1 block rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="h-1 block rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                </span>
                                                            </span>
                                                            <span
                                                                class="flex flex-col flex-auto border-s border-gray-200 dark:border-gray-700">
                                                                <span class="h-3 bg-gray-100 dark:bg-gray-800">
                                                                    <span
                                                                        class="flex items-center justify-end h-full mr-1.5">
                                                                        <span
                                                                            class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    </span>
                                                                </span>
                                                                <span
                                                                    class="flex flex-auto border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900"></span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Default </div>
                                                </div>

                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-sidenav-view"
                                                        id="sidenav-view-hover" value="hover">
                                                    <label class="form-label rounded-md" for="sidenav-view-hover">
                                                        <span class="flex h-16 overflow-hidden">
                                                            <span class="w-3 bg-gray-100 dark:bg-gray-800">
                                                                <span
                                                                    class="w-1.5 h-1.5 mt-1 mx-auto rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                <span
                                                                    class="flex flex-col items-center w-full mt-1.5 space-y-1">
                                                                    <span
                                                                        class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                </span>
                                                            </span>
                                                            <span
                                                                class="flex flex-col flex-auto border-s border-gray-200 dark:border-gray-700">
                                                                <span class="h-3 bg-gray-100 dark:bg-gray-800">
                                                                    <span
                                                                        class="flex items-center justify-end h-full mr-1.5">
                                                                        <span
                                                                            class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    </span>
                                                                </span>
                                                                <span
                                                                    class="flex flex-auto border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900"></span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Hover </div>
                                                </div>

                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-sidenav-view"
                                                        id="sidenav-view-hover-active" value="hover-active">
                                                    <label class="form-label rounded-md"
                                                        for="sidenav-view-hover-active">
                                                        <span class="flex h-16 overflow-hidden">
                                                            <span class="w-8 bg-gray-100 dark:bg-gray-800">
                                                                <span class="mt-1.5 mx-1.5 block space-y-1">
                                                                    <span class="flex mb-2.5 gap-1">
                                                                        <span
                                                                            class="h-1 block w-full rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="h-1 block w-2 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    </span>
                                                                    <span
                                                                        class="h-1 block rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="h-1 block rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="h-1 block rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="h-1 block rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="h-1 block rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                </span>
                                                            </span>
                                                            <span
                                                                class="flex flex-col flex-auto border-s border-gray-200 dark:border-gray-700">
                                                                <span class="h-3 bg-gray-100 dark:bg-gray-800">
                                                                    <span
                                                                        class="flex items-center justify-end h-full mr-1.5">
                                                                        <span
                                                                            class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    </span>
                                                                </span>
                                                                <span
                                                                    class="flex flex-auto border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900"></span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Hover Active </div>
                                                </div>

                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-sidenav-view"
                                                        id="sidenav-view-sm" value="sm">
                                                    <label class="form-label rounded-md" for="sidenav-view-sm">
                                                        <span class="flex h-16 overflow-hidden">
                                                            <span class="w-3 bg-gray-100 dark:bg-gray-800">
                                                                <span
                                                                    class="w-1.5 h-1.5 mt-1 mx-auto rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                <span
                                                                    class="flex flex-col items-center w-full mt-1.5 space-y-1">
                                                                    <span
                                                                        class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                </span>
                                                            </span>
                                                            <span
                                                                class="flex flex-col flex-auto border-s border-gray-200 dark:border-gray-700">
                                                                <span class="h-3 bg-gray-100 dark:bg-gray-800">
                                                                    <span class="flex items-center h-full mr-1.5">
                                                                        <span class="grow">
                                                                            <span
                                                                                class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        </span>
                                                                        <span
                                                                            class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    </span>
                                                                </span>
                                                                <span
                                                                    class="flex flex-auto border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900"></span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Small </div>
                                                </div>

                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-sidenav-view"
                                                        id="sidenav-view-md" value="md">
                                                    <label class="form-label rounded-md" for="sidenav-view-md">
                                                        <span class="flex h-16 rounded-md overflow-hidden">
                                                            <span class="w-4 bg-gray-100 dark:bg-gray-800">
                                                                <span
                                                                    class="w-2 h-2 mt-2 mx-auto rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                <span
                                                                    class="flex flex-col items-center w-full mt-2 space-y-1">
                                                                    <span
                                                                        class="w-2 h-2 rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="w-2 h-2 rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                    <span
                                                                        class="w-2 h-2 rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                </span>
                                                            </span>
                                                            <span
                                                                class="flex flex-col flex-auto border-s border-gray-200 dark:border-gray-700">
                                                                <span class="h-3 bg-gray-100 dark:bg-gray-800">
                                                                    <span class="flex items-center h-full mr-1.5">
                                                                        <span class="grow">
                                                                            <span
                                                                                class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        </span>
                                                                        <span
                                                                            class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ml-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    </span>
                                                                </span>
                                                                <span
                                                                    class="flex flex-auto border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900"></span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Compact </div>
                                                </div>

                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-sidenav-view"
                                                        id="sidenav-view-mobile" value="mobile">
                                                    <label class="form-label rounded-md" for="sidenav-view-mobile">
                                                        <span class="flex h-16 overflow-hidden">
                                                            <span class="flex flex-col flex-auto">
                                                                <span class="h-3 bg-gray-100 dark:bg-gray-800">
                                                                    <span class="flex items-center h-full mr-1.5">
                                                                        <span
                                                                            class="w-1.5 h-1.5  ms-1 rounded-sm bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ms-1  rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ms-auto rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ms-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ms-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ms-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    </span>
                                                                </span>
                                                                <span
                                                                    class="flex flex-auto border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900"></span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Mobile </div>
                                                </div>

                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-sidenav-view"
                                                        id="sidenav-view-hidden" value="hidden">
                                                    <label class="form-label rounded-md" for="sidenav-view-hidden">
                                                        <span class="flex h-16 overflow-hidden">
                                                            <span class="flex flex-col flex-auto">
                                                                <span class="h-3 bg-gray-100 dark:bg-gray-800">
                                                                    <span
                                                                        class="flex flex-auto items-center h-full me-1.5">
                                                                        <span
                                                                            class="w-1 h-1 block ms-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ms-auto rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ms-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ms-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                        <span
                                                                            class="w-1 h-1 block ms-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                                                                    </span>
                                                                </span>
                                                                <span
                                                                    class="flex flex-auto border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900"></span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Hidden </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-6">
                                            <h5 class="font-semibold text-sm mb-3">Menu Color</h5>
                                            <div class="grid grid-cols-4 gap-2">
                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-menu-color"
                                                        id="menu-color-light" value="light">
                                                    <label class="form-label rounded-md" for="menu-color-light">
                                                        <span
                                                            class="flex items-center justify-center px-4 py-3 bg-gray-100 dark:bg-gray-900">
                                                            <span
                                                                class="w-5 h-5 shadow-lg rounded-full bg-white"></span>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Light </div>
                                                </div>

                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-menu-color"
                                                        id="menu-color-dark" value="dark">
                                                    <label class="form-label rounded-md" for="menu-color-dark">
                                                        <span
                                                            class="flex items-center justify-center px-4 py-3 bg-gray-100 dark:bg-gray-900">
                                                            <span
                                                                class="w-5 h-5 shadow-lg rounded-full bg-dark"></span>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Dark </div>
                                                </div>

                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-menu-color"
                                                        id="menu-color-brand" value="brand">
                                                    <label class="form-label rounded-md" for="menu-color-brand">
                                                        <span
                                                            class="flex items-center justify-center px-4 py-3 bg-gray-100 dark:bg-gray-900">
                                                            <span
                                                                class="w-5 h-5 shadow-lg rounded-full bg-primary"></span>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Brand </div>
                                                </div>

                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-menu-color"
                                                        id="menu-color-gradient" value="gradient">
                                                    <label class="form-label rounded-md" for="menu-color-gradient">
                                                        <span
                                                            class="flex items-center justify-center px-4 py-3 bg-gray-100 dark:bg-gray-900">
                                                            <span class="w-5 h-5 shadow-lg rounded-full"
                                                                style="background: linear-gradient(135deg, #6379c3 0%, #546ee5 60%);"></span>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Gradient </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-6">
                                            <h5 class="font-semibold text-sm mb-3">Topbar Color</h5>
                                            <div class="grid grid-cols-4 gap-2">
                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-topbar-color"
                                                        id="topbar-color-light" value="light">
                                                    <label class="form-label rounded-md" for="topbar-color-light">
                                                        <span
                                                            class="flex items-center justify-center px-4 py-3 bg-gray-100 dark:bg-gray-900">
                                                            <span
                                                                class="w-5 h-5 shadow-lg rounded-full bg-white"></span>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Light </div>
                                                </div>

                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-topbar-color"
                                                        id="topbar-color-dark" value="dark">
                                                    <label class="form-label rounded-md" for="topbar-color-dark">
                                                        <span
                                                            class="flex items-center justify-center px-4 py-3 bg-gray-100 dark:bg-gray-900">
                                                            <span
                                                                class="w-5 h-5 shadow-lg rounded-full bg-dark"></span>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Dark </div>
                                                </div>

                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-topbar-color"
                                                        id="topbar-color-brand" value="brand">
                                                    <label class="form-label rounded-md" for="topbar-color-brand">
                                                        <span
                                                            class="flex items-center justify-center px-4 py-3 bg-gray-100 dark:bg-gray-900">
                                                            <span
                                                                class="w-5 h-5 shadow-lg rounded-full bg-primary"></span>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Brand </div>
                                                </div>

                                                <div class="card-radio">
                                                    <input class="form-radio" type="radio" name="data-topbar-color"
                                                        id="topbar-color-gradient" value="gradient">
                                                    <label class="form-label rounded-md" for="topbar-color-gradient">
                                                        <span
                                                            class="flex items-center justify-center px-4 py-3 bg-gray-100 dark:bg-gray-900">
                                                            <span class="w-5 h-5 shadow-lg rounded-full"
                                                                style="background: linear-gradient(135deg, #6379c3 0%, #546ee5 60%);"></span>
                                                        </span>
                                                    </label>
                                                    <div
                                                        class="mt-1 text-md font-medium text-center text-gray-600 dark:text-gray-300">
                                                        Gradient </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-6">
                                            <h5 class="font-semibold text-sm mb-3">Layout Position</h5>
                                            <div class="flex btn-radio">
                                                <input type="radio" class="form-radio hidden"
                                                    name="data-layout-position" id="layout-position-fixed"
                                                    value="fixed">
                                                <label class="btn rounded-e-none bg-gray-100 dark:bg-gray-700"
                                                    for="layout-position-fixed">Fixed</label>
                                                <input type="radio" class="form-radio hidden"
                                                    name="data-layout-position" id="layout-position-scrollable"
                                                    value="scrollable">
                                                <label class="btn rounded-s-none bg-gray-100 dark:bg-gray-700"
                                                    for="layout-position-scrollable">Scrollable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                </div>
                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                </div>
                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                    <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Plugin Js -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/%40frostui/tailwindcss/frostui.js') }}"></script>
    <div class="transition-all fixed inset-0 z-40 bg-gray-900 bg-opacity-50 dark:bg-opacity-80 hidden"
        data-fc-overlay-backdrop=""></div>

    <!-- App Js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Apexcharts js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Dashboard Project Page js -->
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <svg id="SvgjsSvg1202" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1"
        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
        style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
        <defs id="SvgjsDefs1203"></defs>
        <polyline id="SvgjsPolyline1204" points="0,0"></polyline>
        <path id="SvgjsPath1205" d="M0 0 "></path>
    </svg>


     <!-- NOTIFY -->
    <script>
        "use strict";

        // notify('success', 'dssds');
        function notify(status, message) {
            if (typeof message == 'string') {
                iziToast[status]({
                    message: message,
                    position: "topRight"
                });
            } else {
                $.each(message, function (i, val) {
                    iziToast[status]({
                        message: val,
                        position: "topRight"
                    });
                });
            }
        }
        </script>

    @stack('scripts')
</body>

</html>
