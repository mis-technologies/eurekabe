@extends('advocate::layouts.app')

@section('content')
    <main class="flex-grow p-6">

        <!-- Page Title Start -->
        <div class="flex justify-between items-center mb-6">
            <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">Dashboard</h4>

            <div class="md:flex hidden items-center gap-2.5 text-sm font-semibold">
                <div class="flex items-center gap-2">
                    <a href="#" class="text-sm font-medium text-slate-700 dark:text-slate-400">Eureka</a>
                </div>

                <div class="flex items-center gap-2">
                    <i class="mgc_right_line text-lg flex-shrink-0 text-slate-400 rtl:rotate-180"></i>
                    <a href="#" class="text-sm font-medium text-slate-700 dark:text-slate-400">Menu</a>
                </div>

                <div class="flex items-center gap-2">
                    <i class="mgc_right_line text-lg flex-shrink-0 text-slate-400 rtl:rotate-180"></i>
                    <a href="#" class="text-sm font-medium text-slate-700 dark:text-slate-400"
                        aria-current="page">Dashboard</a>
                </div>
            </div>
        </div>
        <!-- Page Title End -->

        <div class="grid 2xl:grid-cols-4 gap-6 mb-6">

            <div class="2xl:col-span-3">
                <div class="grid xl:grid-cols-4 md:grid-cols-2 gap-6 mb-6">
                    <div class="card">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-base mb-1 text-gray-600 dark:text-gray-400">Recent School</h4>
                                    <p class="font-normal text-sm text-gray-400 truncate dark:text-gray-500">
                                        New Task Assign</p>
                                </div>

                                <div>
                                    <button class="text-gray-600 dark:text-gray-400 fc-dropdown" data-fc-type="dropdown"
                                        data-fc-placement="left-start" type="button">
                                        <i class="mgc_more_1_fill text-xl"></i>
                                    </button>

                                    <div
                                        class="hidden fc-dropdown fc-dropdown-open:opacity-100 opacity-0 w-36 z-50 mt-2 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 rounded-lg p-2">
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                            href="javascript:void(0)">
                                            <i class="mgc_add_circle_line"></i> Add
                                        </a>
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                            href="javascript:void(0)">
                                            <i class="mgc_edit_line"></i> Edit
                                        </a>
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                            href="javascript:void(0)">
                                            <i class="mgc_copy_2_line"></i> Copy
                                        </a>
                                        <div class="h-px bg-gray-200 dark:bg-gray-700 my-2 -mx-2"></div>
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-danger hover:bg-danger/5"
                                            href="javascript:void(0)">
                                            <i class="mgc_delete_line"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-end">
                                <div class="flex-grow">
                                    <p class="text-[13px] text-gray-400 dark:text-gray-500 font-semibold"><i
                                            class="mgc_alarm_2_line"></i> 4 Hrs ago</p>
                                </div>
                                <div class="flex">
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                            class="rounded-full h-8 w-8 border-2 border-gray-300 dark:border-gray-700"
                                            alt="friend">
                                    </a>
                                    <a href="javascript:void(0);" class="-ms-2">
                                        <img src="{{ asset('assets/images/users/avatar-2.jpg') }}"
                                            class="rounded-full h-8 w-8 border-2 border-gray-300 dark:border-gray-700"
                                            alt="friend">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-base mb-1 text-gray-600 dark:text-gray-400">Admin Template
                                    </h4>
                                    <p class="font-normal text-sm text-gray-400 truncate dark:text-gray-500">
                                        New Task Assign</p>
                                </div>
                                <div>
                                    <button class="text-gray-600 dark:text-gray-400 fc-dropdown" data-fc-type="dropdown"
                                        data-fc-placement="left-start" type="button">
                                        <i class="mgc_more_1_fill text-xl"></i>
                                    </button>

                                    <div
                                        class="hidden fc-dropdown fc-dropdown-open:opacity-100 opacity-0 w-36 z-50 mt-2 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 rounded-lg p-2">
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                            href="javascript:void(0)">
                                            <i class="mgc_add_circle_line"></i> Add
                                        </a>
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                            href="javascript:void(0)">
                                            <i class="mgc_edit_line"></i> Edit
                                        </a>
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                            href="javascript:void(0)">
                                            <i class="mgc_copy_2_line"></i> Copy
                                        </a>
                                        <div class="h-px bg-gray-200 dark:bg-gray-700 my-2 -mx-2"></div>
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-danger hover:bg-danger/5"
                                            href="javascript:void(0)">
                                            <i class="mgc_delete_line"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-end">
                                <div class="flex-grow">
                                    <p class="text-[13px] text-gray-400 dark:text-gray-500 font-semibold"><i
                                            class="mgc_alarm_2_line"></i> 3 Hrs ago</p>
                                </div>
                                <div class="flex">
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('assets/images/users/avatar-3.jpg') }}"
                                            class="rounded-full h-8 w-8 border-2 border-gray-300 dark:border-gray-700"
                                            alt="friend">
                                    </a>
                                    <a href="javascript:void(0);" class="-ms-2">
                                        <img src="{{ asset('assets/images/users/avatar-4.jpg') }}"
                                            class="rounded-full h-8 w-8 border-2 border-gray-300 dark:border-gray-700"
                                            alt="friend">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-base mb-1 text-gray-600 dark:text-gray-400">Client Project
                                    </h4>
                                    <p class="font-normal text-sm text-gray-400 truncate dark:text-gray-500">
                                        New Task Assign</p>
                                </div>
                                <div>
                                    <button class="text-gray-600 dark:text-gray-400 fc-dropdown" data-fc-type="dropdown"
                                        data-fc-placement="left-start" type="button">
                                        <i class="mgc_more_1_fill text-xl"></i>
                                    </button>

                                    <div
                                        class="hidden fc-dropdown fc-dropdown-open:opacity-100 opacity-0 w-36 z-50 mt-2 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 rounded-lg p-2">
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                            href="javascript:void(0)">
                                            <i class="mgc_add_circle_line"></i> Add
                                        </a>
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                            href="javascript:void(0)">
                                            <i class="mgc_edit_line"></i> Edit
                                        </a>
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                            href="javascript:void(0)">
                                            <i class="mgc_copy_2_line"></i> Copy
                                        </a>
                                        <div class="h-px bg-gray-200 dark:bg-gray-700 my-2 -mx-2"></div>
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-danger hover:bg-danger/5"
                                            href="javascript:void(0)">
                                            <i class="mgc_delete_line"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-end">
                                <div class="flex-grow">
                                    <p class="text-[13px] text-gray-400 dark:text-gray-500 font-semibold"><i
                                            class="mgc_alarm_2_line"></i> 5 Hrs ago</p>
                                </div>
                                <div class="flex">
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('assets/images/users/avatar-5.jpg') }}"
                                            class="rounded-full h-8 w-8 border-2 border-gray-300 dark:border-gray-700"
                                            alt="friend">
                                    </a>
                                    <a href="javascript:void(0);" class="-ms-2">
                                        <img src="{{ asset('assets/images/users/avatar-6.jpg') }}"
                                            class="rounded-full h-8 w-8 border-2 border-gray-300 dark:border-gray-700"
                                            alt="friend">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-base mb-1 text-gray-600 dark:text-gray-400">Figma Design
                                    </h4>
                                    <p class="font-normal text-sm text-gray-400 truncate dark:text-gray-500">
                                        New Task Assign</p>
                                </div>
                                <div>
                                    <button class="text-gray-600 dark:text-gray-400 fc-dropdown" data-fc-type="dropdown"
                                        data-fc-placement="left-start" type="button">
                                        <i class="mgc_more_1_fill text-xl"></i>
                                    </button>

                                    <div
                                        class="hidden fc-dropdown fc-dropdown-open:opacity-100 opacity-0 w-36 z-50 mt-2 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 rounded-lg p-2">
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                            href="javascript:void(0)">
                                            <i class="mgc_add_circle_line"></i> Add
                                        </a>
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                            href="javascript:void(0)">
                                            <i class="mgc_edit_line"></i> Edit
                                        </a>
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                            href="javascript:void(0)">
                                            <i class="mgc_copy_2_line"></i> Copy
                                        </a>
                                        <div class="h-px bg-gray-200 dark:bg-gray-700 my-2 -mx-2"></div>
                                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-danger hover:bg-danger/5"
                                            href="javascript:void(0)">
                                            <i class="mgc_delete_line"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-end">
                                <div class="flex-grow">
                                    <p class="text-[13px] text-gray-400 dark:text-gray-500 font-semibold"><i
                                            class="mgc_alarm_2_line"></i> 1 Day ago</p>
                                </div>
                                <div class="flex">
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('assets/images/users/avatar-7.jpg') }}"
                                            class="rounded-full h-8 w-8 border-2 border-gray-300 dark:border-gray-700"
                                            alt="friend">
                                    </a>
                                    <a href="javascript:void(0);" class="-ms-2">
                                        <img src="{{ asset('assets/images/users/avatar-8.jpg') }}"
                                            class="rounded-full h-8 w-8 border-2 border-gray-300 dark:border-gray-700"
                                            alt="friend">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid lg:grid-cols-3 gap-6">
                    <div class="col-span-1">
                        <div class="card">
                            <div class="p-6" style="position: relative;">
                                <h4 class="card-title">Monthly Target</h4>

                                <div id="monthly-target" class="apex-charts my-8" data-colors="#0acf97,#3073F1"
                                    style="min-height: 258.7px;">
                                    <div id="apexchartsxc7b9aei"
                                        class="apexcharts-canvas apexchartsxc7b9aei apexcharts-theme-light"
                                        style="width: 704px; height: 258.7px;"><svg id="SvgjsSvg1132" width="704"
                                            height="258.7" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"
                                            xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                            style="background: transparent;">
                                            <g id="SvgjsG1134" class="apexcharts-inner apexcharts-graphical"
                                                transform="translate(225, 0)">
                                                <defs id="SvgjsDefs1133">
                                                    <clipPath id="gridRectMaskxc7b9aei">
                                                        <rect id="SvgjsRect1136" width="262" height="280" x="-3"
                                                            y="-1" rx="0" ry="0" opacity="1"
                                                            stroke-width="0" stroke="none" stroke-dasharray="0"
                                                            fill="#fff"></rect>
                                                    </clipPath>
                                                    <clipPath id="gridRectMarkerMaskxc7b9aei">
                                                        <rect id="SvgjsRect1137" width="260" height="282" x="-2"
                                                            y="-2" rx="0" ry="0" opacity="1"
                                                            stroke-width="0" stroke="none" stroke-dasharray="0"
                                                            fill="#fff"></rect>
                                                    </clipPath>
                                                    <filter id="SvgjsFilter1146" filterUnits="userSpaceOnUse"
                                                        width="200%" height="200%" x="-50%" y="-50%">
                                                        <feFlood id="SvgjsFeFlood1147" flood-color="#000000"
                                                            flood-opacity="0.45" result="SvgjsFeFlood1147Out"
                                                            in="SourceGraphic"></feFlood>
                                                        <feComposite id="SvgjsFeComposite1148" in="SvgjsFeFlood1147Out"
                                                            in2="SourceAlpha" operator="in"
                                                            result="SvgjsFeComposite1148Out">
                                                        </feComposite>
                                                        <feOffset id="SvgjsFeOffset1149" dx="1" dy="1"
                                                            result="SvgjsFeOffset1149Out" in="SvgjsFeComposite1148Out">
                                                        </feOffset>
                                                        <feGaussianBlur id="SvgjsFeGaussianBlur1150" stdDeviation="1 "
                                                            result="SvgjsFeGaussianBlur1150Out" in="SvgjsFeOffset1149Out">
                                                        </feGaussianBlur>
                                                        <feMerge id="SvgjsFeMerge1151" result="SvgjsFeMerge1151Out"
                                                            in="SourceGraphic">
                                                            <feMergeNode id="SvgjsFeMergeNode1152"
                                                                in="SvgjsFeGaussianBlur1150Out"></feMergeNode>
                                                            <feMergeNode id="SvgjsFeMergeNode1153"
                                                                in="[object Arguments]"></feMergeNode>
                                                        </feMerge>
                                                        <feBlend id="SvgjsFeBlend1154" in="SourceGraphic"
                                                            in2="SvgjsFeMerge1151Out" mode="normal"
                                                            result="SvgjsFeBlend1154Out"></feBlend>
                                                    </filter>
                                                    <filter id="SvgjsFilter1159" filterUnits="userSpaceOnUse"
                                                        width="200%" height="200%" x="-50%" y="-50%">
                                                        <feFlood id="SvgjsFeFlood1160" flood-color="#000000"
                                                            flood-opacity="0.45" result="SvgjsFeFlood1160Out"
                                                            in="SourceGraphic"></feFlood>
                                                        <feComposite id="SvgjsFeComposite1161" in="SvgjsFeFlood1160Out"
                                                            in2="SourceAlpha" operator="in"
                                                            result="SvgjsFeComposite1161Out">
                                                        </feComposite>
                                                        <feOffset id="SvgjsFeOffset1162" dx="1" dy="1"
                                                            result="SvgjsFeOffset1162Out" in="SvgjsFeComposite1161Out">
                                                        </feOffset>
                                                        <feGaussianBlur id="SvgjsFeGaussianBlur1163" stdDeviation="1 "
                                                            result="SvgjsFeGaussianBlur1163Out" in="SvgjsFeOffset1162Out">
                                                        </feGaussianBlur>
                                                        <feMerge id="SvgjsFeMerge1164" result="SvgjsFeMerge1164Out"
                                                            in="SourceGraphic">
                                                            <feMergeNode id="SvgjsFeMergeNode1165"
                                                                in="SvgjsFeGaussianBlur1163Out"></feMergeNode>
                                                            <feMergeNode id="SvgjsFeMergeNode1166"
                                                                in="[object Arguments]"></feMergeNode>
                                                        </feMerge>
                                                        <feBlend id="SvgjsFeBlend1167" in="SourceGraphic"
                                                            in2="SvgjsFeMerge1164Out" mode="normal"
                                                            result="SvgjsFeBlend1167Out"></feBlend>
                                                    </filter>
                                                </defs>
                                                <g id="SvgjsG1138" class="apexcharts-pie">
                                                    <g id="SvgjsG1139" transform="translate(0, 0) scale(1)">
                                                        <circle id="SvgjsCircle1140" r="77.27073170731708" cx="128"
                                                            cy="128" fill="transparent"></circle>
                                                        <g id="SvgjsG1141" class="apexcharts-slices">
                                                            <g id="SvgjsG1142"
                                                                class="apexcharts-series apexcharts-pie-series"
                                                                seriesname="DonexProjects" rel="1"
                                                                data:realindex="0">
                                                                <path id="SvgjsPath1143"
                                                                    d="M 128 9.121951219512184 A 118.87804878048782 118.87804878048782 0 1 1 17.726017046228435 172.4031436428474 L 56.32191108004848 156.86204336785082 A 77.27073170731708 77.27073170731708 0 1 0 128 50.72926829268292 L 128 9.121951219512184 z"
                                                                    fill="rgba(10,207,151,1)" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="butt"
                                                                    stroke-width="2" stroke-dasharray="0"
                                                                    class="apexcharts-pie-area apexcharts-donut-slice-0"
                                                                    index="0" j="0" data:angle="248.0672268907563"
                                                                    data:startangle="0" data:strokewidth="2"
                                                                    data:value="82"
                                                                    data:pathorig="M 128 9.121951219512184 A 118.87804878048782 118.87804878048782 0 1 1 17.726017046228435 172.4031436428474 L 56.32191108004848 156.86204336785082 A 77.27073170731708 77.27073170731708 0 1 0 128 50.72926829268292 L 128 9.121951219512184 z"
                                                                    stroke="transparent"></path>
                                                            </g>
                                                            <g id="SvgjsG1155"
                                                                class="apexcharts-series apexcharts-pie-series"
                                                                seriesname="PendingxProjects" rel="2"
                                                                data:realindex="1">
                                                                <path id="SvgjsPath1156"
                                                                    d="M 17.726017046228435 172.4031436428474 A 118.87804878048782 118.87804878048782 0 0 1 127.97925186650966 9.121953030128395 L 127.98651371323128 50.72926946958346 A 77.27073170731708 77.27073170731708 0 0 0 56.32191108004848 156.86204336785082 L 17.726017046228435 172.4031436428474 z"
                                                                    fill="rgba(48,115,241,1)" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="butt"
                                                                    stroke-width="2" stroke-dasharray="0"
                                                                    class="apexcharts-pie-area apexcharts-donut-slice-1"
                                                                    index="0" j="1" data:angle="111.9327731092437"
                                                                    data:startangle="248.0672268907563"
                                                                    data:strokewidth="2" data:value="37"
                                                                    data:pathorig="M 17.726017046228435 172.4031436428474 A 118.87804878048782 118.87804878048782 0 0 1 127.97925186650966 9.121953030128395 L 127.98651371323128 50.72926946958346 A 77.27073170731708 77.27073170731708 0 0 0 56.32191108004848 156.86204336785082 L 17.726017046228435 172.4031436428474 z"
                                                                    stroke="transparent"></path>
                                                            </g>
                                                            <g id="SvgjsG1144" class="apexcharts-datalabels"><text
                                                                    id="SvgjsText1145"
                                                                    font-family="Helvetica, Arial, sans-serif"
                                                                    x="209.27516623422903" y="182.89019379918153"
                                                                    text-anchor="middle" dominant-baseline="auto"
                                                                    font-size="12px" font-weight="600" fill="#ffffff"
                                                                    class="apexcharts-text apexcharts-pie-label"
                                                                    filter="url(#SvgjsFilter1146)"
                                                                    style="font-family: Helvetica, Arial, sans-serif;">68.9%</text>
                                                            </g>
                                                            <g id="SvgjsG1157" class="apexcharts-datalabels"><text
                                                                    id="SvgjsText1158"
                                                                    font-family="Helvetica, Arial, sans-serif"
                                                                    x="46.72483376577095" y="73.1098062008185"
                                                                    text-anchor="middle" dominant-baseline="auto"
                                                                    font-size="12px" font-weight="600" fill="#ffffff"
                                                                    class="apexcharts-text apexcharts-pie-label"
                                                                    filter="url(#SvgjsFilter1159)"
                                                                    style="font-family: Helvetica, Arial, sans-serif;">31.1%</text>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                                <line id="SvgjsLine1168" x1="0" y1="0" x2="256"
                                                    y2="0" stroke="#b6b6b6" stroke-dasharray="0"
                                                    stroke-width="1" class="apexcharts-ycrosshairs"></line>
                                                <line id="SvgjsLine1169" x1="0" y1="0" x2="256"
                                                    y2="0" stroke-dasharray="0" stroke-width="0"
                                                    class="apexcharts-ycrosshairs-hidden">
                                                </line>
                                            </g>
                                            <g id="SvgjsG1135" class="apexcharts-annotations"></g>
                                        </svg>
                                        <div class="apexcharts-legend"></div>
                                        <div class="apexcharts-tooltip apexcharts-theme-dark">
                                            <div class="apexcharts-tooltip-series-group" style="order: 1;">
                                                <span class="apexcharts-tooltip-marker"
                                                    style="background-color: rgb(10, 207, 151);"></span>
                                                <div class="apexcharts-tooltip-text"
                                                    style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span
                                                            class="apexcharts-tooltip-text-y-label"></span><span
                                                            class="apexcharts-tooltip-text-y-value"></span>
                                                    </div>
                                                    <div class="apexcharts-tooltip-goals-group"><span
                                                            class="apexcharts-tooltip-text-goals-label"></span><span
                                                            class="apexcharts-tooltip-text-goals-value"></span>
                                                    </div>
                                                    <div class="apexcharts-tooltip-z-group"><span
                                                            class="apexcharts-tooltip-text-z-label"></span><span
                                                            class="apexcharts-tooltip-text-z-value"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="apexcharts-tooltip-series-group" style="order: 2;">
                                                <span class="apexcharts-tooltip-marker"
                                                    style="background-color: rgb(48, 115, 241);"></span>
                                                <div class="apexcharts-tooltip-text"
                                                    style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span
                                                            class="apexcharts-tooltip-text-y-label"></span><span
                                                            class="apexcharts-tooltip-text-y-value"></span>
                                                    </div>
                                                    <div class="apexcharts-tooltip-goals-group"><span
                                                            class="apexcharts-tooltip-text-goals-label"></span><span
                                                            class="apexcharts-tooltip-text-goals-value"></span>
                                                    </div>
                                                    <div class="apexcharts-tooltip-z-group"><span
                                                            class="apexcharts-tooltip-text-z-label"></span><span
                                                            class="apexcharts-tooltip-text-z-value"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-center">
                                    <div class="w-1/2 text-center">
                                        <h5>Pending</h5>
                                        <p class="fw-semibold text-muted">
                                            <i class="mgc_round_fill text-primary"></i> Projects
                                        </p>
                                    </div>
                                    <div class="w-1/2 text-center">
                                        <h5>Done</h5>
                                        <p class="fw-semibold text-muted">
                                            <i class="mgc_round_fill text-success"></i> Projects
                                        </p>
                                    </div>
                                </div>
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 753px; height: 438px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="card">
                            <div class="p-6">
                                <div class="flex justify-between items-center">
                                    <h4 class="card-title">Project Statistics</h4>
                                    <div class="flex gap-2">
                                        <button type="button"
                                            class="btn btn-sm bg-primary/25 text-primary hover:bg-primary hover:text-white">
                                            All
                                        </button>
                                        <button type="button"
                                            class="btn btn-sm bg-gray-400/25 text-gray-400 hover:bg-gray-400 hover:text-white">
                                            6M
                                        </button>
                                        <button type="button"
                                            class="btn btn-sm bg-gray-400/25 text-gray-400 hover:bg-gray-400 hover:text-white">
                                            1Y
                                        </button>
                                    </div>
                                </div>

                                <div dir="ltr" class="mt-2" style="position: relative;">
                                    <div id="crm-project-statistics" class="apex-charts" data-colors="#cbdcfc,#3073F1"
                                        style="min-height: 365px;">
                                        <div id="apexcharts2kxfdjic"
                                            class="apexcharts-canvas apexcharts2kxfdjic apexcharts-theme-light"
                                            style="width: 704px; height: 350px;"><svg id="SvgjsSvg1001" width="704"
                                                height="350" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"
                                                xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                style="background: transparent;">
                                                <foreignObject x="0" y="0" width="704" height="350">
                                                    <div class="apexcharts-legend apexcharts-align-center position-bottom"
                                                        xmlns="http://www.w3.org/1999/xhtml"
                                                        style="inset: auto 0px -2px; position: absolute; max-height: 175px;">
                                                        <div class="apexcharts-legend-series" rel="1"
                                                            seriesname="Projects" data:collapsed="false"
                                                            style="margin: 2px 5px;"><span
                                                                class="apexcharts-legend-marker" rel="1"
                                                                data:collapsed="false"
                                                                style="background: rgb(203, 220, 252) !important; color: rgb(203, 220, 252); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 2px;"></span><span
                                                                class="apexcharts-legend-text" rel="1" i="0"
                                                                data:default-text="Projects" data:collapsed="false"
                                                                style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Projects</span>
                                                        </div>
                                                        <div class="apexcharts-legend-series" rel="2"
                                                            seriesname="WorkingxHours" data:collapsed="false"
                                                            style="margin: 2px 5px;">
                                                            <span class="apexcharts-legend-marker" rel="2"
                                                                data:collapsed="false"
                                                                style="background: rgb(48, 115, 241) !important; color: rgb(48, 115, 241); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 2px;"></span><span
                                                                class="apexcharts-legend-text" rel="2" i="1"
                                                                data:default-text="Working%20Hours" data:collapsed="false"
                                                                style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Working
                                                                Hours</span>
                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        .apexcharts-legend {
                                                            display: flex;
                                                            overflow: auto;
                                                            padding: 0 10px;
                                                        }

                                                        .apexcharts-legend.position-bottom,
                                                        .apexcharts-legend.position-top {
                                                            flex-wrap: wrap
                                                        }

                                                        .apexcharts-legend.position-right,
                                                        .apexcharts-legend.position-left {
                                                            flex-direction: column;
                                                            bottom: 0;
                                                        }

                                                        .apexcharts-legend.position-bottom.apexcharts-align-left,
                                                        .apexcharts-legend.position-top.apexcharts-align-left,
                                                        .apexcharts-legend.position-right,
                                                        .apexcharts-legend.position-left {
                                                            justify-content: flex-start;
                                                        }

                                                        .apexcharts-legend.position-bottom.apexcharts-align-center,
                                                        .apexcharts-legend.position-top.apexcharts-align-center {
                                                            justify-content: center;
                                                        }

                                                        .apexcharts-legend.position-bottom.apexcharts-align-right,
                                                        .apexcharts-legend.position-top.apexcharts-align-right {
                                                            justify-content: flex-end;
                                                        }

                                                        .apexcharts-legend-series {
                                                            cursor: pointer;
                                                            line-height: normal;
                                                        }

                                                        .apexcharts-legend.position-bottom .apexcharts-legend-series,
                                                        .apexcharts-legend.position-top .apexcharts-legend-series {
                                                            display: flex;
                                                            align-items: center;
                                                        }

                                                        .apexcharts-legend-text {
                                                            position: relative;
                                                            font-size: 14px;
                                                        }

                                                        .apexcharts-legend-text *,
                                                        .apexcharts-legend-marker * {
                                                            pointer-events: none;
                                                        }

                                                        .apexcharts-legend-marker {
                                                            position: relative;
                                                            display: inline-block;
                                                            cursor: pointer;
                                                            margin-right: 3px;
                                                            border-style: solid;
                                                        }

                                                        .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series,
                                                        .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series {
                                                            display: inline-block;
                                                        }

                                                        .apexcharts-legend-series.apexcharts-no-click {
                                                            cursor: auto;
                                                        }

                                                        .apexcharts-legend .apexcharts-hidden-zero-series,
                                                        .apexcharts-legend .apexcharts-hidden-null-series {
                                                            display: none !important;
                                                        }

                                                        .apexcharts-inactive-legend {
                                                            opacity: 0.45;
                                                        }
                                                    </style>
                                                </foreignObject>
                                                <g id="SvgjsG1003" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(47.6875, 30)">
                                                    <defs id="SvgjsDefs1002">
                                                        <linearGradient id="SvgjsLinearGradient1007" x1="0"
                                                            y1="0" x2="0" y2="1">
                                                            <stop id="SvgjsStop1008" stop-opacity="0.4"
                                                                stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                                            <stop id="SvgjsStop1009" stop-opacity="0.5"
                                                                stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                            <stop id="SvgjsStop1010" stop-opacity="0.5"
                                                                stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                        </linearGradient>
                                                        <clipPath id="gridRectMask2kxfdjic">
                                                            <rect id="SvgjsRect1012" width="653.3125" height="258.73"
                                                                x="-3.5" y="-1.5" rx="0" ry="0"
                                                                opacity="1" stroke-width="0" stroke="none"
                                                                stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                        <clipPath id="gridRectMarkerMask2kxfdjic">
                                                            <rect id="SvgjsRect1013" width="650.3125" height="259.73"
                                                                x="-2" y="-2" rx="0" ry="0"
                                                                opacity="1" stroke-width="0" stroke="none"
                                                                stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                    </defs>
                                                    <rect id="SvgjsRect1011" width="8.9765625"
                                                        height="255.73000000000002" x="0" y="0" rx="0"
                                                        ry="0" opacity="1" stroke-width="0"
                                                        stroke-dasharray="3" fill="url(#SvgjsLinearGradient1007)"
                                                        class="apexcharts-xcrosshairs" y2="255.73000000000002"
                                                        filter="none" fill-opacity="0.9"></rect>
                                                    <g id="SvgjsG1057" class="apexcharts-xaxis"
                                                        transform="translate(0, 0)">
                                                        <g id="SvgjsG1058" class="apexcharts-xaxis-texts-g"
                                                            transform="translate(0, -4)"><text id="SvgjsText1060"
                                                                font-family="Helvetica, Arial, sans-serif" x="35.90625"
                                                                y="284.73" text-anchor="middle" dominant-baseline="auto"
                                                                font-size="12px" font-weight="400" fill="#373d3f"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1061">Feb</tspan>
                                                                <title>Feb</title>
                                                            </text><text id="SvgjsText1063"
                                                                font-family="Helvetica, Arial, sans-serif" x="107.71875"
                                                                y="284.73" text-anchor="middle" dominant-baseline="auto"
                                                                font-size="12px" font-weight="400" fill="#373d3f"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1064">Mar</tspan>
                                                                <title>Mar</title>
                                                            </text><text id="SvgjsText1066"
                                                                font-family="Helvetica, Arial, sans-serif" x="179.53125"
                                                                y="284.73" text-anchor="middle" dominant-baseline="auto"
                                                                font-size="12px" font-weight="400" fill="#373d3f"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1067">Apr</tspan>
                                                                <title>Apr</title>
                                                            </text><text id="SvgjsText1069"
                                                                font-family="Helvetica, Arial, sans-serif" x="251.34375"
                                                                y="284.73" text-anchor="middle" dominant-baseline="auto"
                                                                font-size="12px" font-weight="400" fill="#373d3f"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1070">May</tspan>
                                                                <title>May</title>
                                                            </text><text id="SvgjsText1072"
                                                                font-family="Helvetica, Arial, sans-serif" x="323.15625"
                                                                y="284.73" text-anchor="middle" dominant-baseline="auto"
                                                                font-size="12px" font-weight="400" fill="#373d3f"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1073">Jun</tspan>
                                                                <title>Jun</title>
                                                            </text><text id="SvgjsText1075"
                                                                font-family="Helvetica, Arial, sans-serif" x="394.96875"
                                                                y="284.73" text-anchor="middle" dominant-baseline="auto"
                                                                font-size="12px" font-weight="400" fill="#373d3f"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1076">Jul</tspan>
                                                                <title>Jul</title>
                                                            </text><text id="SvgjsText1078"
                                                                font-family="Helvetica, Arial, sans-serif" x="466.78125"
                                                                y="284.73" text-anchor="middle" dominant-baseline="auto"
                                                                font-size="12px" font-weight="400" fill="#373d3f"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1079">Aug</tspan>
                                                                <title>Aug</title>
                                                            </text><text id="SvgjsText1081"
                                                                font-family="Helvetica, Arial, sans-serif" x="538.59375"
                                                                y="284.73" text-anchor="middle" dominant-baseline="auto"
                                                                font-size="12px" font-weight="400" fill="#373d3f"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1082">Sep</tspan>
                                                                <title>Sep</title>
                                                            </text><text id="SvgjsText1084"
                                                                font-family="Helvetica, Arial, sans-serif" x="610.40625"
                                                                y="284.73" text-anchor="middle" dominant-baseline="auto"
                                                                font-size="12px" font-weight="400" fill="#373d3f"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1085">Oct</tspan>
                                                                <title>Oct</title>
                                                            </text></g>
                                                        <line id="SvgjsLine1086" x1="0" y1="256.73"
                                                            x2="646.3125" y2="256.73" stroke="#e0e0e0"
                                                            stroke-dasharray="0" stroke-width="1"></line>
                                                    </g>
                                                    <g id="SvgjsG1101" class="apexcharts-grid">
                                                        <g id="SvgjsG1102" class="apexcharts-gridlines-horizontal">
                                                            <line id="SvgjsLine1114" x1="0" y1="0"
                                                                x2="646.3125" y2="0" stroke="#9ca3af20"
                                                                stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1115" x1="0" y1="51.146"
                                                                x2="646.3125" y2="51.146" stroke="#9ca3af20"
                                                                stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1116" x1="0" y1="102.292"
                                                                x2="646.3125" y2="102.292" stroke="#9ca3af20"
                                                                stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1117" x1="0" y1="153.438"
                                                                x2="646.3125" y2="153.438" stroke="#9ca3af20"
                                                                stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1118" x1="0" y1="204.584"
                                                                x2="646.3125" y2="204.584" stroke="#9ca3af20"
                                                                stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1119" x1="0"
                                                                y1="255.73000000000002" x2="646.3125"
                                                                y2="255.73000000000002" stroke="#9ca3af20"
                                                                stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                        </g>
                                                        <g id="SvgjsG1103" class="apexcharts-gridlines-vertical"></g>
                                                        <line id="SvgjsLine1104" x1="0" y1="256.73"
                                                            x2="0" y2="262.73" stroke="#e0e0e0"
                                                            stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                        <line id="SvgjsLine1105" x1="71.8125" y1="256.73"
                                                            x2="71.8125" y2="262.73" stroke="#e0e0e0"
                                                            stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                        <line id="SvgjsLine1106" x1="143.625" y1="256.73"
                                                            x2="143.625" y2="262.73" stroke="#e0e0e0"
                                                            stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                        <line id="SvgjsLine1107" x1="215.4375" y1="256.73"
                                                            x2="215.4375" y2="262.73" stroke="#e0e0e0"
                                                            stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                        <line id="SvgjsLine1108" x1="287.25" y1="256.73"
                                                            x2="287.25" y2="262.73" stroke="#e0e0e0"
                                                            stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                        <line id="SvgjsLine1109" x1="359.0625" y1="256.73"
                                                            x2="359.0625" y2="262.73" stroke="#e0e0e0"
                                                            stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                        <line id="SvgjsLine1110" x1="430.875" y1="256.73"
                                                            x2="430.875" y2="262.73" stroke="#e0e0e0"
                                                            stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                        <line id="SvgjsLine1111" x1="502.6875" y1="256.73"
                                                            x2="502.6875" y2="262.73" stroke="#e0e0e0"
                                                            stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                        <line id="SvgjsLine1112" x1="574.5" y1="256.73"
                                                            x2="574.5" y2="262.73" stroke="#e0e0e0"
                                                            stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                        <line id="SvgjsLine1113" x1="646.3125" y1="256.73"
                                                            x2="646.3125" y2="262.73" stroke="#e0e0e0"
                                                            stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                        <rect id="SvgjsRect1120" width="646.3125" height="51.146" x="0"
                                                            y="0" rx="0" ry="0" opacity="0.2"
                                                            stroke-width="0" stroke="none" stroke-dasharray="0"
                                                            fill="transparent" clip-path="url(#gridRectMask2kxfdjic)"
                                                            class="apexcharts-grid-row"></rect>
                                                        <rect id="SvgjsRect1121" width="646.3125" height="51.146" x="0"
                                                            y="51.146" rx="0" ry="0" opacity="0.2"
                                                            stroke-width="0" stroke="none" stroke-dasharray="0"
                                                            fill="transparent" clip-path="url(#gridRectMask2kxfdjic)"
                                                            class="apexcharts-grid-row"></rect>
                                                        <rect id="SvgjsRect1122" width="646.3125" height="51.146" x="0"
                                                            y="102.292" rx="0" ry="0" opacity="0.2"
                                                            stroke-width="0" stroke="none" stroke-dasharray="0"
                                                            fill="transparent" clip-path="url(#gridRectMask2kxfdjic)"
                                                            class="apexcharts-grid-row"></rect>
                                                        <rect id="SvgjsRect1123" width="646.3125" height="51.146" x="0"
                                                            y="153.438" rx="0" ry="0" opacity="0.2"
                                                            stroke-width="0" stroke="none" stroke-dasharray="0"
                                                            fill="transparent" clip-path="url(#gridRectMask2kxfdjic)"
                                                            class="apexcharts-grid-row"></rect>
                                                        <rect id="SvgjsRect1124" width="646.3125" height="51.146" x="0"
                                                            y="204.584" rx="0" ry="0" opacity="0.2"
                                                            stroke-width="0" stroke="none" stroke-dasharray="0"
                                                            fill="transparent" clip-path="url(#gridRectMask2kxfdjic)"
                                                            class="apexcharts-grid-row"></rect>
                                                        <line id="SvgjsLine1126" x1="0" y1="255.73000000000002"
                                                            x2="646.3125" y2="255.73000000000002" stroke="transparent"
                                                            stroke-dasharray="0"></line>
                                                        <line id="SvgjsLine1125" x1="0" y1="1"
                                                            x2="0" y2="255.73000000000002" stroke="transparent"
                                                            stroke-dasharray="0"></line>
                                                    </g>
                                                    <g id="SvgjsG1014"
                                                        class="apexcharts-bar-series apexcharts-plot-series">
                                                        <g id="SvgjsG1015" class="apexcharts-series" rel="1"
                                                            seriesname="Projects" data:realindex="0">
                                                            <path id="SvgjsPath1019"
                                                                d="M26.9296875 255.73000000000002L26.9296875 207.99373333333335C26.9296875 207.99373333333335 26.9296875 207.99373333333335 26.9296875 207.99373333333335L32.90625 207.99373333333335C32.90625 207.99373333333335 32.90625 207.99373333333335 32.90625 207.99373333333335L32.90625 207.99373333333335L32.90625 255.73000000000002L32.90625 255.73000000000002C32.90625 255.73000000000002 26.9296875 255.73000000000002 26.9296875 255.73000000000002 "
                                                                fill="rgba(203,220,252,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 26.9296875 255.73000000000002L 26.9296875 207.99373333333335Q 26.9296875 207.99373333333335 26.9296875 207.99373333333335L 32.90625 207.99373333333335Q 32.90625 207.99373333333335 32.90625 207.99373333333335L 32.90625 207.99373333333335L 32.90625 255.73000000000002L 32.90625 255.73000000000002z"
                                                                pathfrom="M 26.9296875 255.73000000000002L 26.9296875 255.73000000000002L 32.90625 255.73000000000002L 32.90625 255.73000000000002L 32.90625 255.73000000000002L 32.90625 255.73000000000002L 32.90625 255.73000000000002L 26.9296875 255.73000000000002"
                                                                cy="207.99373333333335" cx="97.2421875" j="0"
                                                                val="56" barheight="47.73626666666667"
                                                                barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1021"
                                                                d="M98.7421875 255.73000000000002L98.7421875 223.33753333333334C98.7421875 223.33753333333334 98.7421875 223.33753333333334 98.7421875 223.33753333333334L104.71875 223.33753333333334C104.71875 223.33753333333334 104.71875 223.33753333333334 104.71875 223.33753333333334L104.71875 223.33753333333334L104.71875 255.73000000000002L104.71875 255.73000000000002C104.71875 255.73000000000002 98.7421875 255.73000000000002 98.7421875 255.73000000000002 "
                                                                fill="rgba(203,220,252,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 98.7421875 255.73000000000002L 98.7421875 223.33753333333334Q 98.7421875 223.33753333333334 98.7421875 223.33753333333334L 104.71875 223.33753333333334Q 104.71875 223.33753333333334 104.71875 223.33753333333334L 104.71875 223.33753333333334L 104.71875 255.73000000000002L 104.71875 255.73000000000002z"
                                                                pathfrom="M 98.7421875 255.73000000000002L 98.7421875 255.73000000000002L 104.71875 255.73000000000002L 104.71875 255.73000000000002L 104.71875 255.73000000000002L 104.71875 255.73000000000002L 104.71875 255.73000000000002L 98.7421875 255.73000000000002"
                                                                cy="223.33753333333334" cx="169.0546875" j="1"
                                                                val="38" barheight="32.39246666666667"
                                                                barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1023"
                                                                d="M170.5546875 255.73000000000002L170.5546875 183.27316666666667C170.5546875 183.27316666666667 170.5546875 183.27316666666667 170.5546875 183.27316666666667L176.53125 183.27316666666667C176.53125 183.27316666666667 176.53125 183.27316666666667 176.53125 183.27316666666667L176.53125 183.27316666666667L176.53125 255.73000000000002L176.53125 255.73000000000002C176.53125 255.73000000000002 170.5546875 255.73000000000002 170.5546875 255.73000000000002 "
                                                                fill="rgba(203,220,252,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 170.5546875 255.73000000000002L 170.5546875 183.27316666666667Q 170.5546875 183.27316666666667 170.5546875 183.27316666666667L 176.53125 183.27316666666667Q 176.53125 183.27316666666667 176.53125 183.27316666666667L 176.53125 183.27316666666667L 176.53125 255.73000000000002L 176.53125 255.73000000000002z"
                                                                pathfrom="M 170.5546875 255.73000000000002L 170.5546875 255.73000000000002L 176.53125 255.73000000000002L 176.53125 255.73000000000002L 176.53125 255.73000000000002L 176.53125 255.73000000000002L 176.53125 255.73000000000002L 170.5546875 255.73000000000002"
                                                                cy="183.27316666666667" cx="240.8671875" j="2"
                                                                val="85" barheight="72.45683333333334"
                                                                barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1025"
                                                                d="M242.3671875 255.73000000000002L242.3671875 194.3548C242.3671875 194.3548 242.3671875 194.3548 242.3671875 194.3548L248.34375 194.3548C248.34375 194.3548 248.34375 194.3548 248.34375 194.3548L248.34375 194.3548L248.34375 255.73000000000002L248.34375 255.73000000000002C248.34375 255.73000000000002 242.3671875 255.73000000000002 242.3671875 255.73000000000002 "
                                                                fill="rgba(203,220,252,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 242.3671875 255.73000000000002L 242.3671875 194.3548Q 242.3671875 194.3548 242.3671875 194.3548L 248.34375 194.3548Q 248.34375 194.3548 248.34375 194.3548L 248.34375 194.3548L 248.34375 255.73000000000002L 248.34375 255.73000000000002z"
                                                                pathfrom="M 242.3671875 255.73000000000002L 242.3671875 255.73000000000002L 248.34375 255.73000000000002L 248.34375 255.73000000000002L 248.34375 255.73000000000002L 248.34375 255.73000000000002L 248.34375 255.73000000000002L 242.3671875 255.73000000000002"
                                                                cy="194.3548" cx="312.6796875" j="3" val="72"
                                                                barheight="61.37520000000001" barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1027"
                                                                d="M314.1796875 255.73000000000002L314.1796875 231.86186666666669C314.1796875 231.86186666666669 314.1796875 231.86186666666669 314.1796875 231.86186666666669L320.15625 231.86186666666669C320.15625 231.86186666666669 320.15625 231.86186666666669 320.15625 231.86186666666669L320.15625 231.86186666666669L320.15625 255.73000000000002L320.15625 255.73000000000002C320.15625 255.73000000000002 314.1796875 255.73000000000002 314.1796875 255.73000000000002 "
                                                                fill="rgba(203,220,252,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 314.1796875 255.73000000000002L 314.1796875 231.86186666666669Q 314.1796875 231.86186666666669 314.1796875 231.86186666666669L 320.15625 231.86186666666669Q 320.15625 231.86186666666669 320.15625 231.86186666666669L 320.15625 231.86186666666669L 320.15625 255.73000000000002L 320.15625 255.73000000000002z"
                                                                pathfrom="M 314.1796875 255.73000000000002L 314.1796875 255.73000000000002L 320.15625 255.73000000000002L 320.15625 255.73000000000002L 320.15625 255.73000000000002L 320.15625 255.73000000000002L 320.15625 255.73000000000002L 314.1796875 255.73000000000002"
                                                                cy="231.86186666666669" cx="384.4921875" j="4"
                                                                val="28" barheight="23.868133333333336"
                                                                barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1029"
                                                                d="M385.9921875 255.73000000000002L385.9921875 196.9121C385.9921875 196.9121 385.9921875 196.9121 385.9921875 196.9121L391.96875 196.9121C391.96875 196.9121 391.96875 196.9121 391.96875 196.9121L391.96875 196.9121L391.96875 255.73000000000002L391.96875 255.73000000000002C391.96875 255.73000000000002 385.9921875 255.73000000000002 385.9921875 255.73000000000002 "
                                                                fill="rgba(203,220,252,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 385.9921875 255.73000000000002L 385.9921875 196.9121Q 385.9921875 196.9121 385.9921875 196.9121L 391.96875 196.9121Q 391.96875 196.9121 391.96875 196.9121L 391.96875 196.9121L 391.96875 255.73000000000002L 391.96875 255.73000000000002z"
                                                                pathfrom="M 385.9921875 255.73000000000002L 385.9921875 255.73000000000002L 391.96875 255.73000000000002L 391.96875 255.73000000000002L 391.96875 255.73000000000002L 391.96875 255.73000000000002L 391.96875 255.73000000000002L 385.9921875 255.73000000000002"
                                                                cy="196.9121" cx="456.3046875" j="5" val="69"
                                                                barheight="58.8179" barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1031"
                                                                d="M457.8046875 255.73000000000002L457.8046875 208.84616666666668C457.8046875 208.84616666666665 457.8046875 208.84616666666665 457.8046875 208.84616666666668L463.78125 208.84616666666668C463.78125 208.84616666666665 463.78125 208.84616666666665 463.78125 208.84616666666668L463.78125 208.84616666666668L463.78125 255.73000000000002L463.78125 255.73000000000002C463.78125 255.73000000000002 457.8046875 255.73000000000002 457.8046875 255.73000000000002 "
                                                                fill="rgba(203,220,252,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 457.8046875 255.73000000000002L 457.8046875 208.84616666666668Q 457.8046875 208.84616666666668 457.8046875 208.84616666666668L 463.78125 208.84616666666668Q 463.78125 208.84616666666668 463.78125 208.84616666666668L 463.78125 208.84616666666668L 463.78125 255.73000000000002L 463.78125 255.73000000000002z"
                                                                pathfrom="M 457.8046875 255.73000000000002L 457.8046875 255.73000000000002L 463.78125 255.73000000000002L 463.78125 255.73000000000002L 463.78125 255.73000000000002L 463.78125 255.73000000000002L 463.78125 255.73000000000002L 457.8046875 255.73000000000002"
                                                                cy="208.84616666666668" cx="528.1171875" j="6"
                                                                val="55" barheight="46.883833333333335"
                                                                barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1033"
                                                                d="M529.6171875 255.73000000000002L529.6171875 211.40346666666667C529.6171875 211.40346666666667 529.6171875 211.40346666666667 529.6171875 211.40346666666667L535.59375 211.40346666666667C535.59375 211.40346666666667 535.59375 211.40346666666667 535.59375 211.40346666666667L535.59375 211.40346666666667L535.59375 255.73000000000002L535.59375 255.73000000000002C535.59375 255.73000000000002 529.6171875 255.73000000000002 529.6171875 255.73000000000002 "
                                                                fill="rgba(203,220,252,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 529.6171875 255.73000000000002L 529.6171875 211.40346666666667Q 529.6171875 211.40346666666667 529.6171875 211.40346666666667L 535.59375 211.40346666666667Q 535.59375 211.40346666666667 535.59375 211.40346666666667L 535.59375 211.40346666666667L 535.59375 255.73000000000002L 535.59375 255.73000000000002z"
                                                                pathfrom="M 529.6171875 255.73000000000002L 529.6171875 255.73000000000002L 535.59375 255.73000000000002L 535.59375 255.73000000000002L 535.59375 255.73000000000002L 535.59375 255.73000000000002L 535.59375 255.73000000000002L 529.6171875 255.73000000000002"
                                                                cy="211.40346666666667" cx="599.9296875" j="7"
                                                                val="52" barheight="44.32653333333334"
                                                                barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1035"
                                                                d="M601.4296875 255.73000000000002L601.4296875 196.9121C601.4296875 196.9121 601.4296875 196.9121 601.4296875 196.9121L607.40625 196.9121C607.40625 196.9121 607.40625 196.9121 607.40625 196.9121L607.40625 196.9121L607.40625 255.73000000000002L607.40625 255.73000000000002C607.40625 255.73000000000002 601.4296875 255.73000000000002 601.4296875 255.73000000000002 "
                                                                fill="rgba(203,220,252,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="0" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 601.4296875 255.73000000000002L 601.4296875 196.9121Q 601.4296875 196.9121 601.4296875 196.9121L 607.40625 196.9121Q 607.40625 196.9121 607.40625 196.9121L 607.40625 196.9121L 607.40625 255.73000000000002L 607.40625 255.73000000000002z"
                                                                pathfrom="M 601.4296875 255.73000000000002L 601.4296875 255.73000000000002L 607.40625 255.73000000000002L 607.40625 255.73000000000002L 607.40625 255.73000000000002L 607.40625 255.73000000000002L 607.40625 255.73000000000002L 601.4296875 255.73000000000002"
                                                                cy="196.9121" cx="671.7421875" j="8" val="69"
                                                                barheight="58.8179" barwidth="8.9765625"></path>
                                                            <g id="SvgjsG1017" class="apexcharts-bar-goals-markers"
                                                                style="pointer-events: none">
                                                                <g id="SvgjsG1018"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1020"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1022"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1024"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1026"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1028"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1030"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1032"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1034"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <g id="SvgjsG1036" class="apexcharts-series" rel="2"
                                                            seriesname="WorkingxHours" data:realindex="1">
                                                            <path id="SvgjsPath1040"
                                                                d="M35.90625 255.73000000000002L35.90625 105.70173333333335C35.90625 105.70173333333335 35.90625 105.70173333333335 35.90625 105.70173333333335L41.8828125 105.70173333333335C41.8828125 105.70173333333335 41.8828125 105.70173333333335 41.8828125 105.70173333333335L41.8828125 105.70173333333335L41.8828125 255.73000000000002L41.8828125 255.73000000000002C41.8828125 255.73000000000002 35.90625 255.73000000000002 35.90625 255.73000000000002 "
                                                                fill="rgba(48,115,241,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 35.90625 255.73000000000002L 35.90625 105.70173333333335Q 35.90625 105.70173333333335 35.90625 105.70173333333335L 41.8828125 105.70173333333335Q 41.8828125 105.70173333333335 41.8828125 105.70173333333335L 41.8828125 105.70173333333335L 41.8828125 255.73000000000002L 41.8828125 255.73000000000002z"
                                                                pathfrom="M 35.90625 255.73000000000002L 35.90625 255.73000000000002L 41.8828125 255.73000000000002L 41.8828125 255.73000000000002L 41.8828125 255.73000000000002L 41.8828125 255.73000000000002L 41.8828125 255.73000000000002L 35.90625 255.73000000000002"
                                                                cy="105.70173333333335" cx="106.21875" j="0"
                                                                val="176" barheight="150.02826666666667"
                                                                barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1042"
                                                                d="M107.71875 255.73000000000002L107.71875 98.02983333333333C107.71875 98.02983333333333 107.71875 98.02983333333333 107.71875 98.02983333333333L113.6953125 98.02983333333333C113.6953125 98.02983333333333 113.6953125 98.02983333333333 113.6953125 98.02983333333333L113.6953125 98.02983333333333L113.6953125 255.73000000000002L113.6953125 255.73000000000002C113.6953125 255.73000000000002 107.71875 255.73000000000002 107.71875 255.73000000000002 "
                                                                fill="rgba(48,115,241,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 107.71875 255.73000000000002L 107.71875 98.02983333333333Q 107.71875 98.02983333333333 107.71875 98.02983333333333L 113.6953125 98.02983333333333Q 113.6953125 98.02983333333333 113.6953125 98.02983333333333L 113.6953125 98.02983333333333L 113.6953125 255.73000000000002L 113.6953125 255.73000000000002z"
                                                                pathfrom="M 107.71875 255.73000000000002L 107.71875 255.73000000000002L 113.6953125 255.73000000000002L 113.6953125 255.73000000000002L 113.6953125 255.73000000000002L 113.6953125 255.73000000000002L 113.6953125 255.73000000000002L 107.71875 255.73000000000002"
                                                                cy="98.02983333333333" cx="178.03125" j="1"
                                                                val="185" barheight="157.7001666666667"
                                                                barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1044"
                                                                d="M179.53125 255.73000000000002L179.53125 37.507066666666674C179.53125 37.507066666666674 179.53125 37.507066666666674 179.53125 37.507066666666674L185.5078125 37.507066666666674C185.5078125 37.507066666666674 185.5078125 37.507066666666674 185.5078125 37.507066666666674L185.5078125 37.507066666666674L185.5078125 255.73000000000002L185.5078125 255.73000000000002C185.5078125 255.73000000000002 179.53125 255.73000000000002 179.53125 255.73000000000002 "
                                                                fill="rgba(48,115,241,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 179.53125 255.73000000000002L 179.53125 37.507066666666674Q 179.53125 37.507066666666674 179.53125 37.507066666666674L 185.5078125 37.507066666666674Q 185.5078125 37.507066666666674 185.5078125 37.507066666666674L 185.5078125 37.507066666666674L 185.5078125 255.73000000000002L 185.5078125 255.73000000000002z"
                                                                pathfrom="M 179.53125 255.73000000000002L 179.53125 255.73000000000002L 185.5078125 255.73000000000002L 185.5078125 255.73000000000002L 185.5078125 255.73000000000002L 185.5078125 255.73000000000002L 185.5078125 255.73000000000002L 179.53125 255.73000000000002"
                                                                cy="37.507066666666674" cx="249.84375" j="2"
                                                                val="256" barheight="218.22293333333334"
                                                                barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1046"
                                                                d="M251.34375 255.73000000000002L251.34375 51.146000000000015C251.34375 51.146000000000015 251.34375 51.146000000000015 251.34375 51.146000000000015L257.3203125 51.146000000000015C257.3203125 51.146000000000015 257.3203125 51.146000000000015 257.3203125 51.146000000000015L257.3203125 51.146000000000015L257.3203125 255.73000000000002L257.3203125 255.73000000000002C257.3203125 255.73000000000002 251.34375 255.73000000000002 251.34375 255.73000000000002 "
                                                                fill="rgba(48,115,241,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 251.34375 255.73000000000002L 251.34375 51.146000000000015Q 251.34375 51.146000000000015 251.34375 51.146000000000015L 257.3203125 51.146000000000015Q 257.3203125 51.146000000000015 257.3203125 51.146000000000015L 257.3203125 51.146000000000015L 257.3203125 255.73000000000002L 257.3203125 255.73000000000002z"
                                                                pathfrom="M 251.34375 255.73000000000002L 251.34375 255.73000000000002L 257.3203125 255.73000000000002L 257.3203125 255.73000000000002L 257.3203125 255.73000000000002L 257.3203125 255.73000000000002L 257.3203125 255.73000000000002L 251.34375 255.73000000000002"
                                                                cy="51.146000000000015" cx="321.65625" j="3"
                                                                val="240" barheight="204.584"
                                                                barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1048"
                                                                d="M323.15625 255.73000000000002L323.15625 96.32496666666668C323.15625 96.32496666666668 323.15625 96.32496666666668 323.15625 96.32496666666668L329.1328125 96.32496666666668C329.1328125 96.32496666666668 329.1328125 96.32496666666668 329.1328125 96.32496666666668L329.1328125 96.32496666666668L329.1328125 255.73000000000002L329.1328125 255.73000000000002C329.1328125 255.73000000000002 323.15625 255.73000000000002 323.15625 255.73000000000002 "
                                                                fill="rgba(48,115,241,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 323.15625 255.73000000000002L 323.15625 96.32496666666668Q 323.15625 96.32496666666668 323.15625 96.32496666666668L 329.1328125 96.32496666666668Q 329.1328125 96.32496666666668 329.1328125 96.32496666666668L 329.1328125 96.32496666666668L 329.1328125 255.73000000000002L 329.1328125 255.73000000000002z"
                                                                pathfrom="M 323.15625 255.73000000000002L 323.15625 255.73000000000002L 329.1328125 255.73000000000002L 329.1328125 255.73000000000002L 329.1328125 255.73000000000002L 329.1328125 255.73000000000002L 329.1328125 255.73000000000002L 323.15625 255.73000000000002"
                                                                cy="96.32496666666668" cx="393.46875" j="4"
                                                                val="187" barheight="159.40503333333334"
                                                                barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1050"
                                                                d="M394.96875 255.73000000000002L394.96875 80.98116666666667C394.96875 80.98116666666667 394.96875 80.98116666666667 394.96875 80.98116666666667L400.9453125 80.98116666666667C400.9453125 80.98116666666667 400.9453125 80.98116666666667 400.9453125 80.98116666666667L400.9453125 80.98116666666667L400.9453125 255.73000000000002L400.9453125 255.73000000000002C400.9453125 255.73000000000002 394.96875 255.73000000000002 394.96875 255.73000000000002 "
                                                                fill="rgba(48,115,241,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 394.96875 255.73000000000002L 394.96875 80.98116666666667Q 394.96875 80.98116666666667 394.96875 80.98116666666667L 400.9453125 80.98116666666667Q 400.9453125 80.98116666666667 400.9453125 80.98116666666667L 400.9453125 80.98116666666667L 400.9453125 255.73000000000002L 400.9453125 255.73000000000002z"
                                                                pathfrom="M 394.96875 255.73000000000002L 394.96875 255.73000000000002L 400.9453125 255.73000000000002L 400.9453125 255.73000000000002L 400.9453125 255.73000000000002L 400.9453125 255.73000000000002L 400.9453125 255.73000000000002L 394.96875 255.73000000000002"
                                                                cy="80.98116666666667" cx="465.28125" j="5"
                                                                val="205" barheight="174.74883333333335"
                                                                barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1052"
                                                                d="M466.78125 255.73000000000002L466.78125 92.91523333333333C466.78125 92.91523333333333 466.78125 92.91523333333333 466.78125 92.91523333333333L472.7578125 92.91523333333333C472.7578125 92.91523333333333 472.7578125 92.91523333333333 472.7578125 92.91523333333333L472.7578125 92.91523333333333L472.7578125 255.73000000000002L472.7578125 255.73000000000002C472.7578125 255.73000000000002 466.78125 255.73000000000002 466.78125 255.73000000000002 "
                                                                fill="rgba(48,115,241,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 466.78125 255.73000000000002L 466.78125 92.91523333333333Q 466.78125 92.91523333333333 466.78125 92.91523333333333L 472.7578125 92.91523333333333Q 472.7578125 92.91523333333333 472.7578125 92.91523333333333L 472.7578125 92.91523333333333L 472.7578125 255.73000000000002L 472.7578125 255.73000000000002z"
                                                                pathfrom="M 466.78125 255.73000000000002L 466.78125 255.73000000000002L 472.7578125 255.73000000000002L 472.7578125 255.73000000000002L 472.7578125 255.73000000000002L 472.7578125 255.73000000000002L 472.7578125 255.73000000000002L 466.78125 255.73000000000002"
                                                                cy="92.91523333333333" cx="537.09375" j="6"
                                                                val="191" barheight="162.81476666666669"
                                                                barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1054"
                                                                d="M538.59375 255.73000000000002L538.59375 158.5526C538.59375 158.5526 538.59375 158.5526 538.59375 158.5526L544.5703125 158.5526C544.5703125 158.5526 544.5703125 158.5526 544.5703125 158.5526L544.5703125 158.5526L544.5703125 255.73000000000002L544.5703125 255.73000000000002C544.5703125 255.73000000000002 538.59375 255.73000000000002 538.59375 255.73000000000002 "
                                                                fill="rgba(48,115,241,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 538.59375 255.73000000000002L 538.59375 158.5526Q 538.59375 158.5526 538.59375 158.5526L 544.5703125 158.5526Q 544.5703125 158.5526 544.5703125 158.5526L 544.5703125 158.5526L 544.5703125 255.73000000000002L 544.5703125 255.73000000000002z"
                                                                pathfrom="M 538.59375 255.73000000000002L 538.59375 255.73000000000002L 544.5703125 255.73000000000002L 544.5703125 255.73000000000002L 544.5703125 255.73000000000002L 544.5703125 255.73000000000002L 544.5703125 255.73000000000002L 538.59375 255.73000000000002"
                                                                cy="158.5526" cx="608.90625" j="7" val="114"
                                                                barheight="97.1774" barwidth="8.9765625"></path>
                                                            <path id="SvgjsPath1056"
                                                                d="M610.40625 255.73000000000002L610.40625 90.35793333333334C610.40625 90.35793333333334 610.40625 90.35793333333334 610.40625 90.35793333333334L616.3828125 90.35793333333334C616.3828125 90.35793333333334 616.3828125 90.35793333333334 616.3828125 90.35793333333334L616.3828125 90.35793333333334L616.3828125 255.73000000000002L616.3828125 255.73000000000002C616.3828125 255.73000000000002 610.40625 255.73000000000002 610.40625 255.73000000000002 "
                                                                fill="rgba(48,115,241,1)" fill-opacity="1"
                                                                stroke="transparent" stroke-opacity="1"
                                                                stroke-linecap="round" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-bar-area"
                                                                index="1" clip-path="url(#gridRectMask2kxfdjic)"
                                                                pathto="M 610.40625 255.73000000000002L 610.40625 90.35793333333334Q 610.40625 90.35793333333334 610.40625 90.35793333333334L 616.3828125 90.35793333333334Q 616.3828125 90.35793333333334 616.3828125 90.35793333333334L 616.3828125 90.35793333333334L 616.3828125 255.73000000000002L 616.3828125 255.73000000000002z"
                                                                pathfrom="M 610.40625 255.73000000000002L 610.40625 255.73000000000002L 616.3828125 255.73000000000002L 616.3828125 255.73000000000002L 616.3828125 255.73000000000002L 616.3828125 255.73000000000002L 616.3828125 255.73000000000002L 610.40625 255.73000000000002"
                                                                cy="90.35793333333334" cx="680.71875" j="8"
                                                                val="194" barheight="165.37206666666668"
                                                                barwidth="8.9765625"></path>
                                                            <g id="SvgjsG1038" class="apexcharts-bar-goals-markers"
                                                                style="pointer-events: none">
                                                                <g id="SvgjsG1039"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1041"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1043"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1045"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1047"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1049"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1051"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1053"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                                <g id="SvgjsG1055"
                                                                    classname="apexcharts-bar-goals-groups">
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <g id="SvgjsG1016" class="apexcharts-datalabels"
                                                            data:realindex="0"></g>
                                                        <g id="SvgjsG1037" class="apexcharts-datalabels"
                                                            data:realindex="1"></g>
                                                    </g>
                                                    <line id="SvgjsLine1127" x1="0" y1="0"
                                                        x2="646.3125" y2="0" stroke="#b6b6b6"
                                                        stroke-dasharray="0" stroke-width="1"
                                                        class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine1128" x1="0" y1="0"
                                                        x2="646.3125" y2="0" stroke-dasharray="0"
                                                        stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                                    <g id="SvgjsG1129" class="apexcharts-yaxis-annotations">
                                                    </g>
                                                    <g id="SvgjsG1130" class="apexcharts-xaxis-annotations">
                                                    </g>
                                                    <g id="SvgjsG1131" class="apexcharts-point-annotations">
                                                    </g>
                                                </g>
                                                <g id="SvgjsG1087" class="apexcharts-yaxis" rel="0"
                                                    transform="translate(17.6875, 0)">
                                                    <g id="SvgjsG1088" class="apexcharts-yaxis-texts-g">
                                                        <text id="SvgjsText1089"
                                                            font-family="Helvetica, Arial, sans-serif" x="20" y="31.5"
                                                            text-anchor="end" dominant-baseline="auto"
                                                            font-size="11px" font-weight="400" fill="#373d3f"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1090">300</tspan>
                                                            <title>300</title>
                                                        </text><text id="SvgjsText1091"
                                                            font-family="Helvetica, Arial, sans-serif" x="20" y="82.646"
                                                            text-anchor="end" dominant-baseline="auto"
                                                            font-size="11px" font-weight="400" fill="#373d3f"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1092">240</tspan>
                                                            <title>240</title>
                                                        </text><text id="SvgjsText1093"
                                                            font-family="Helvetica, Arial, sans-serif" x="20" y="133.792"
                                                            text-anchor="end" dominant-baseline="auto"
                                                            font-size="11px" font-weight="400" fill="#373d3f"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1094">180</tspan>
                                                            <title>180</title>
                                                        </text><text id="SvgjsText1095"
                                                            font-family="Helvetica, Arial, sans-serif" x="20" y="184.938"
                                                            text-anchor="end" dominant-baseline="auto"
                                                            font-size="11px" font-weight="400" fill="#373d3f"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1096">120</tspan>
                                                            <title>120</title>
                                                        </text><text id="SvgjsText1097"
                                                            font-family="Helvetica, Arial, sans-serif" x="20" y="236.084"
                                                            text-anchor="end" dominant-baseline="auto"
                                                            font-size="11px" font-weight="400" fill="#373d3f"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1098">60</tspan>
                                                            <title>60</title>
                                                        </text><text id="SvgjsText1099"
                                                            font-family="Helvetica, Arial, sans-serif" x="20" y="287.23"
                                                            text-anchor="end" dominant-baseline="auto"
                                                            font-size="11px" font-weight="400" fill="#373d3f"
                                                            class="apexcharts-text apexcharts-yaxis-label "
                                                            style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1100">0</tspan>
                                                            <title>0</title>
                                                        </text>
                                                    </g>
                                                </g>
                                                <g id="SvgjsG1004" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-tooltip apexcharts-theme-light">
                                                <div class="apexcharts-tooltip-title"
                                                    style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                </div>
                                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(203, 220, 252);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                                class="apexcharts-tooltip-text-y-value"></span>
                                                        </div>
                                                        <div class="apexcharts-tooltip-goals-group"><span
                                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                                class="apexcharts-tooltip-text-goals-value"></span>
                                                        </div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="apexcharts-tooltip-series-group" style="order: 2;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(48, 115, 241);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                                class="apexcharts-tooltip-text-y-value"></span>
                                                        </div>
                                                        <div class="apexcharts-tooltip-goals-group"><span
                                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                                class="apexcharts-tooltip-text-goals-value"></span>
                                                        </div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                <div class="apexcharts-yaxistooltip-text"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 705px; height: 351px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-1">
                <div class="card mb-6">
                    <div class="px-6 py-5 flex justify-between items-center">
                        <h4 class="header-title">Project Summary</h4>
                        <div>
                            <button class="text-gray-600 dark:text-gray-400 fc-dropdown" data-fc-type="dropdown"
                                data-fc-placement="left-start" type="button">
                                <i class="mgc_more_1_fill text-xl"></i>
                            </button>

                            <div
                                class="hidden fc-dropdown fc-dropdown-open:opacity-100 opacity-0 w-36 z-50 mt-2 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 rounded-lg p-2">
                                <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                    href="javascript:void(0)">
                                    <i class="mgc_add_circle_line"></i> Add
                                </a>
                                <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                    href="javascript:void(0)">
                                    <i class="mgc_edit_line"></i> Edit
                                </a>
                                <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                    href="javascript:void(0)">
                                    <i class="mgc_copy_2_line"></i> Copy
                                </a>
                                <div class="h-px bg-gray-200 dark:bg-gray-700 my-2 -mx-2"></div>
                                <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-danger hover:bg-danger/5"
                                    href="javascript:void(0)">
                                    <i class="mgc_delete_line"></i> Delete
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 bg-warning/20 text-warning" role="alert">
                        <i class="mgc_folder_star_line me-1 text-lg align-baseline"></i> <b>38</b> Total Admin
                        &amp; Client Projects
                    </div>

                    <div class="p-6 space-y-3">
                        <div class="flex items-center border border-gray-200 dark:border-gray-700 rounded px-3 py-2">
                            <div class="flex-shrink-0 me-2">
                                <div
                                    class="w-12 h-12 flex justify-center items-center rounded-full text-primary bg-primary/25">
                                    <i class="mgc_group_line text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h5 class="font-semibold mb-1">Project Discssion</h5>
                                <p class="text-gray-400">6 Person</p>
                            </div>
                            <div>
                                <button class="text-gray-400" data-fc-type="tooltip" data-fc-placement="top">
                                    <i class="mgc_information_line text-xl"></i>
                                </button>
                                <div class="bg-slate-700 hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50"
                                    role="tooltip">
                                    Info <div class="bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"
                                        data-fc-arrow=""></div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center border border-gray-200 dark:border-gray-700 rounded px-3 py-2">
                            <div class="flex-shrink-0 me-2">
                                <div
                                    class="w-12 h-12 flex justify-center items-center rounded-full text-warning bg-warning/25">
                                    <i class="mgc_compass_line text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h5 class="fw-semibold my-0">In Progress</h5>
                                <p>16 Projects</p>
                            </div>
                            <div>
                                <button class="text-gray-400" data-fc-type="tooltip" data-fc-placement="top">
                                    <i class="mgc_information_line text-xl"></i>
                                </button>
                                <div class="bg-slate-700 hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50"
                                    role="tooltip">
                                    Info <div class="bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"
                                        data-fc-arrow=""></div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center border border-gray-200 dark:border-gray-700 rounded px-3 py-2">
                            <div class="flex-shrink-0 me-2">
                                <div
                                    class="w-12 h-12 flex justify-center items-center rounded-full text-danger bg-danger/25">
                                    <i class="mgc_check_circle_line text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h5 class="fw-semibold my-0">Completed Projects</h5>
                                <p>24</p>
                            </div>
                            <div>
                                <button class="text-gray-400" data-fc-type="tooltip" data-fc-placement="top">
                                    <i class="mgc_information_line text-xl"></i>
                                </button>
                                <div class="bg-slate-700 hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50"
                                    role="tooltip">
                                    Info <div class="bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"
                                        data-fc-arrow=""></div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center border border-gray-200 dark:border-gray-700 rounded px-3 py-2">
                            <div class="flex-shrink-0 me-2">
                                <div
                                    class="w-12 h-12 flex justify-center items-center rounded-full text-success bg-success/25">
                                    <i class="mgc_send_line text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h5 class="fw-semibold my-0">Delivery Projects</h5>
                                <p>20</p>
                            </div>
                            <div>
                                <button class="text-gray-400" data-fc-type="tooltip" data-fc-placement="top">
                                    <i class="mgc_information_line text-xl"></i>
                                </button>
                                <div class="bg-slate-700 hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50"
                                    role="tooltip">
                                    Info <div class="bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"
                                        data-fc-arrow=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card p-6">
                    <h4 class="text-gray-600 dark:text-gray-300 mb-2.5">On Time Completed Rate <span
                            class="px-2 py-0.5 rounded bg-success/25 text-success ms-2"><i
                                class="mgc_arrow_up_line text-sm align-baseline me-1"></i>59%</span></h4>
                    <div class="flex justify-between items-center mb-2">
                        <h5 class="text-base font-semibold">Completed Projects</h5>
                        <h5 class="text-gray-600 dark:text-gray-300">65%</h5>
                    </div>
                    <div class="flex w-full h-1 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700 ">
                        <div class="flex flex-col justify-center overflow-hidden bg-primary w-1/4" role="progressbar"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Grid End -->

        <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-6 mb-6">
            <div class="col-span-1">
                <div class="card">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 me-3">
                                <div
                                    class="w-12 h-12 flex justify-center items-center rounded text-primary bg-primary/25">
                                    <i class="mgc_document_2_line text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h5 class="mb-1">Active Projects</h5>
                                <p>85</p>
                            </div>
                            <div>
                                <button class="text-gray-600 dark:text-gray-400 fc-dropdown" data-fc-type="dropdown"
                                    data-fc-placement="left-start" type="button">
                                    <i class="mgc_more_2_fill text-xl"></i>
                                </button>

                                <div
                                    class="hidden fc-dropdown fc-dropdown-open:opacity-100 opacity-0 w-36 z-50 mt-2 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 rounded-lg p-2">
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                        href="javascript:void(0)">
                                        Today
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                        href="javascript:void(0)">
                                        Yesterday
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Last Week
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Last Month
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-1">
                <div class="card">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 me-3">
                                <div
                                    class="w-12 h-12 flex justify-center items-center rounded text-success bg-success/25">
                                    <i class="mgc_group_line text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h5 class="mb-1">Total Employees</h5>
                                <p>32</p>
                            </div>
                            <div>
                                <button class="text-gray-600 dark:text-gray-400 fc-dropdown" data-fc-type="dropdown"
                                    data-fc-placement="left-start" type="button">
                                    <i class="mgc_more_2_fill text-xl"></i>
                                </button>

                                <div
                                    class="hidden fc-dropdown fc-dropdown-open:opacity-100 opacity-0 w-36 z-50 mt-2 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 rounded-lg p-2">
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                        href="javascript:void(0)">
                                        Today
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                        href="javascript:void(0)">
                                        Yesterday
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Last Week
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Last Month
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-1">
                <div class="card">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="w-12 h-12 flex justify-center items-center rounded text-info bg-info/25">
                                    <i class="mgc_star_line text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h5 class="mb-1">Project Reviews</h5>
                                <p>40</p>
                            </div>
                            <div>
                                <button class="text-gray-600 dark:text-gray-400 fc-dropdown" data-fc-type="dropdown"
                                    data-fc-placement="left-start" type="button">
                                    <i class="mgc_more_2_fill text-xl"></i>
                                </button>

                                <div
                                    class="hidden fc-dropdown fc-dropdown-open:opacity-100 opacity-0 w-36 z-50 mt-2 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 rounded-lg p-2">
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                        href="javascript:void(0)">
                                        Today
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                        href="javascript:void(0)">
                                        Yesterday
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Last Week
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Last Month
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-1">
                <div class="card">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 me-3">
                                <div
                                    class="w-12 h-12 flex justify-center items-center rounded text-warning bg-warning/25">
                                    <i class="mgc_new_folder_line text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h5 class="mb-1">New Projects</h5>
                                <p>25</p>
                            </div>
                            <div>
                                <button class="text-gray-600 dark:text-gray-400 fc-dropdown" data-fc-type="dropdown"
                                    data-fc-placement="left-start" type="button">
                                    <i class="mgc_more_2_fill text-xl"></i>
                                </button>

                                <div
                                    class="hidden fc-dropdown fc-dropdown-open:opacity-100 opacity-0 w-36 z-50 mt-2 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 rounded-lg p-2">
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                        href="javascript:void(0)">
                                        Today
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                        href="javascript:void(0)">
                                        Yesterday
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Last Week
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Last Month
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Grid End -->

        <div class="grid 2xl:grid-cols-4 md:grid-cols-2 gap-6">
            <div class="2xl:col-span-2 md:col-span-2">
                <div class="card">
                    <div class="p-6">
                        <div class="flex justify-between items-center">
                            <h4 class="card-title">Project Overview</h4>
                            <div>
                                <button class="text-gray-600 dark:text-gray-400 fc-dropdown" data-fc-type="dropdown"
                                    data-fc-placement="left-start" type="button">
                                    <i class="mgc_more_2_fill text-xl"></i>
                                </button>

                                <div
                                    class="hidden fc-dropdown fc-dropdown-open:opacity-100 opacity-0 w-36 z-50 mt-2 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 rounded-lg p-2">
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                        href="javascript:void(0)">
                                        Today
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                        href="javascript:void(0)">
                                        Yesterday
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Last Week
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Last Month
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 items-center gap-4">
                            <div class="md:order-1 order-2">
                                <div class="flex flex-col gap-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <i
                                                class="mgc_round_fill h-10 w-10 flex justify-center items-center rounded-full bg-primary/25 text-lg text-primary"></i>
                                        </div>
                                        <div class="flex-grow ms-3">
                                            <h5 class="fw-semibold mb-1">Product Design</h5>
                                            <ul class="flex items-center gap-2">
                                                <li class="list-inline-item"><b>26</b> Total Projects</li>
                                                <li class="list-inline-item">
                                                    <div class="w-1 h-1 rounded bg-gray-400"></div>
                                                </li>
                                                <li class="list-inline-item"><b>4</b> Employees</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <i
                                                class="mgc_round_fill h-10 w-10 flex justify-center items-center rounded-full bg-danger/25 text-lg text-danger"></i>
                                        </div>
                                        <div class="flex-grow ms-3">
                                            <h5 class="fw-semibold mb-1">Web Development</h5>
                                            <ul class="flex items-center gap-2">
                                                <li class="list-inline-item"><b>30</b> Total Projects</li>
                                                <li class="list-inline-item">
                                                    <div class="w-1 h-1 rounded bg-gray-400"></div>
                                                </li>
                                                <li class="list-inline-item"><b>5</b> Employees</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <i
                                                class="mgc_round_fill h-10 w-10 flex justify-center items-center rounded-full bg-success/25 text-lg text-success"></i>
                                        </div>
                                        <div class="flex-grow ms-3">
                                            <h5 class="fw-semibold mb-1">Illustration Design</h5>
                                            <ul class="flex items-center gap-2">
                                                <li class="list-inline-item"><b>12</b> Total Projects</li>
                                                <li class="list-inline-item">
                                                    <div class="w-1 h-1 rounded bg-gray-400"></div>
                                                </li>
                                                <li class="list-inline-item"><b>3</b> Employees</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <i
                                                class="mgc_round_fill h-10 w-10 flex justify-center items-center rounded-full bg-warning/25 text-lg text-warning"></i>
                                        </div>
                                        <div class="flex-grow ms-3">
                                            <h5 class="fw-semibold mb-1">UI/UX Design</h5>
                                            <ul class="flex items-center gap-2">
                                                <li class="list-inline-item"><b>8</b> Total Projects</li>
                                                <li class="list-inline-item">
                                                    <div class="w-1 h-1 rounded bg-gray-400"></div>
                                                </li>
                                                <li class="list-inline-item"><b>4</b> Employees</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="md:order-2 order-1" style="position: relative;">
                                <div id="project-overview-chart" class="apex-charts"
                                    data-colors="#3073F1,#ff679b,#0acf97,#ffbc00" style="min-height: 328.7px;">
                                    <div id="apexcharts7r6a74iq"
                                        class="apexcharts-canvas apexcharts7r6a74iq apexcharts-theme-light"
                                        style="width: 344px; height: 328.7px;"><svg id="SvgjsSvg1170" width="344"
                                            height="328.7" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"
                                            xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                            style="background: transparent;">
                                            <g id="SvgjsG1172" class="apexcharts-inner apexcharts-graphical"
                                                transform="translate(10, 0)">
                                                <defs id="SvgjsDefs1171">
                                                    <clipPath id="gridRectMask7r6a74iq">
                                                        <rect id="SvgjsRect1174" width="332" height="350" x="-3"
                                                            y="-1" rx="0" ry="0" opacity="1"
                                                            stroke-width="0" stroke="none" stroke-dasharray="0"
                                                            fill="#fff"></rect>
                                                    </clipPath>
                                                    <clipPath id="gridRectMarkerMask7r6a74iq">
                                                        <rect id="SvgjsRect1175" width="330" height="352" x="-2"
                                                            y="-2" rx="0" ry="0" opacity="1"
                                                            stroke-width="0" stroke="none" stroke-dasharray="0"
                                                            fill="#fff"></rect>
                                                    </clipPath>
                                                </defs>
                                                <g id="SvgjsG1176" class="apexcharts-radialbar">
                                                    <g id="SvgjsG1177">
                                                        <g id="SvgjsG1178" class="apexcharts-tracks">
                                                            <g id="SvgjsG1179"
                                                                class="apexcharts-radialbar-track apexcharts-track"
                                                                rel="1">
                                                                <path id="apexcharts-radialbarTrack-0"
                                                                    d="M 163 30.429268292682934 A 132.57073170731707 132.57073170731707 0 1 1 162.97686204251673 30.429270311850644"
                                                                    fill="none" fill-opacity="1"
                                                                    stroke="rgba(242,242,242,0.85)" stroke-opacity="1"
                                                                    stroke-linecap="butt"
                                                                    stroke-width="9.993365853658537"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-radialbar-area"
                                                                    data:pathorig="M 163 30.429268292682934 A 132.57073170731707 132.57073170731707 0 1 1 162.97686204251673 30.429270311850644">
                                                                </path>
                                                            </g>
                                                            <g id="SvgjsG1181"
                                                                class="apexcharts-radialbar-track apexcharts-track"
                                                                rel="2">
                                                                <path id="apexcharts-radialbarTrack-1"
                                                                    d="M 163 45.73170731707317 A 117.26829268292683 117.26829268292683 0 1 1 162.9795328219488 45.7317091031714"
                                                                    fill="none" fill-opacity="1"
                                                                    stroke="rgba(242,242,242,0.85)" stroke-opacity="1"
                                                                    stroke-linecap="butt"
                                                                    stroke-width="9.993365853658537"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-radialbar-area"
                                                                    data:pathorig="M 163 45.73170731707317 A 117.26829268292683 117.26829268292683 0 1 1 162.9795328219488 45.7317091031714">
                                                                </path>
                                                            </g>
                                                            <g id="SvgjsG1183"
                                                                class="apexcharts-radialbar-track apexcharts-track"
                                                                rel="3">
                                                                <path id="apexcharts-radialbarTrack-2"
                                                                    d="M 163 61.03414634146341 A 101.96585365853659 101.96585365853659 0 1 1 162.98220360138086 61.034147894492165"
                                                                    fill="none" fill-opacity="1"
                                                                    stroke="rgba(242,242,242,0.85)" stroke-opacity="1"
                                                                    stroke-linecap="butt"
                                                                    stroke-width="9.993365853658537"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-radialbar-area"
                                                                    data:pathorig="M 163 61.03414634146341 A 101.96585365853659 101.96585365853659 0 1 1 162.98220360138086 61.034147894492165">
                                                                </path>
                                                            </g>
                                                            <g id="SvgjsG1185"
                                                                class="apexcharts-radialbar-track apexcharts-track"
                                                                rel="4">
                                                                <path id="apexcharts-radialbarTrack-3"
                                                                    d="M 163 76.33658536585365 A 86.66341463414635 86.66341463414635 0 1 1 162.9848743808129 76.33658668581293"
                                                                    fill="none" fill-opacity="1"
                                                                    stroke="rgba(242,242,242,0.85)" stroke-opacity="1"
                                                                    stroke-linecap="butt"
                                                                    stroke-width="9.993365853658537"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-radialbar-area"
                                                                    data:pathorig="M 163 76.33658536585365 A 86.66341463414635 86.66341463414635 0 1 1 162.9848743808129 76.33658668581293">
                                                                </path>
                                                            </g>
                                                        </g>
                                                        <g id="SvgjsG1187">
                                                            <g id="SvgjsG1192"
                                                                class="apexcharts-series apexcharts-radial-series"
                                                                seriesname="ProductxDesign" rel="1"
                                                                data:realindex="0">
                                                                <path id="SvgjsPath1193"
                                                                    d="M 163 30.429268292682934 A 132.57073170731707 132.57073170731707 0 1 1 55.748025092058796 85.07687901681689"
                                                                    fill="none" fill-opacity="0.85"
                                                                    stroke="rgba(48,115,241,0.85)" stroke-opacity="1"
                                                                    stroke-linecap="butt"
                                                                    stroke-width="10.302439024390244"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                    data:angle="306" data:value="85" index="0"
                                                                    j="0"
                                                                    data:pathorig="M 163 30.429268292682934 A 132.57073170731707 132.57073170731707 0 1 1 55.748025092058796 85.07687901681689">
                                                                </path>
                                                            </g>
                                                            <g id="SvgjsG1194"
                                                                class="apexcharts-series apexcharts-radial-series"
                                                                seriesname="WebxDevelopment" rel="2"
                                                                data:realindex="1">
                                                                <path id="SvgjsPath1195"
                                                                    d="M 163 45.73170731707317 A 117.26829268292683 117.26829268292683 0 1 1 51.47122608909517 199.2378953403597"
                                                                    fill="none" fill-opacity="0.85"
                                                                    stroke="rgba(255,103,155,0.85)" stroke-opacity="1"
                                                                    stroke-linecap="butt"
                                                                    stroke-width="10.302439024390244"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-radialbar-area apexcharts-radialbar-slice-1"
                                                                    data:angle="252" data:value="70" index="0"
                                                                    j="1"
                                                                    data:pathorig="M 163 45.73170731707317 A 117.26829268292683 117.26829268292683 0 1 1 51.47122608909517 199.2378953403597">
                                                                </path>
                                                            </g>
                                                            <g id="SvgjsG1196"
                                                                class="apexcharts-series apexcharts-radial-series"
                                                                seriesname="IllustrationxDesign" rel="3"
                                                                data:realindex="2">
                                                                <path id="SvgjsPath1197"
                                                                    d="M 163 61.03414634146341 A 101.96585365853659 101.96585365853659 0 1 1 66.02471043845075 131.49081837356326"
                                                                    fill="none" fill-opacity="0.85"
                                                                    stroke="rgba(10,207,151,0.85)" stroke-opacity="1"
                                                                    stroke-linecap="butt"
                                                                    stroke-width="10.302439024390244"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-radialbar-area apexcharts-radialbar-slice-2"
                                                                    data:angle="288" data:value="80" index="0"
                                                                    j="2"
                                                                    data:pathorig="M 163 61.03414634146341 A 101.96585365853659 101.96585365853659 0 1 1 66.02471043845075 131.49081837356326">
                                                                </path>
                                                            </g>
                                                            <g id="SvgjsG1198"
                                                                class="apexcharts-series apexcharts-radial-series"
                                                                seriesname="UIxUXxDesign" rel="4"
                                                                data:realindex="3">
                                                                <path id="SvgjsPath1199"
                                                                    d="M 163 76.33658536585365 A 86.66341463414635 86.66341463414635 0 1 1 92.88782477041309 213.93947703525893"
                                                                    fill="none" fill-opacity="0.85"
                                                                    stroke="rgba(255,188,0,0.85)" stroke-opacity="1"
                                                                    stroke-linecap="butt"
                                                                    stroke-width="10.302439024390244"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-radialbar-area apexcharts-radialbar-slice-3"
                                                                    data:angle="234" data:value="65" index="0"
                                                                    j="3"
                                                                    data:pathorig="M 163 76.33658536585365 A 86.66341463414635 86.66341463414635 0 1 1 92.88782477041309 213.93947703525893">
                                                                </path>
                                                            </g>
                                                            <circle id="SvgjsCircle1188" r="76.66673170731707"
                                                                cx="163" cy="163"
                                                                class="apexcharts-radialbar-hollow" fill="transparent">
                                                            </circle>
                                                            <g id="SvgjsG1189" class="apexcharts-datalabels-group"
                                                                transform="translate(0, 0) scale(1)"
                                                                style="opacity: 0;"><text id="SvgjsText1190"
                                                                    font-family="Helvetica, Arial, sans-serif" x="163"
                                                                    y="163" text-anchor="middle"
                                                                    dominant-baseline="auto" font-size="16px"
                                                                    font-weight="400" fill="#3073f1"
                                                                    class="apexcharts-text apexcharts-datalabel-label"
                                                                    style="font-family: Helvetica, Arial, sans-serif;"></text><text
                                                                    id="SvgjsText1191"
                                                                    font-family="Helvetica, Arial, sans-serif" x="163"
                                                                    y="195" text-anchor="middle"
                                                                    dominant-baseline="auto" font-size="14px"
                                                                    font-weight="400" fill="#373d3f"
                                                                    class="apexcharts-text apexcharts-datalabel-value"
                                                                    style="font-family: Helvetica, Arial, sans-serif;"></text>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                                <line id="SvgjsLine1200" x1="0" y1="0"
                                                    x2="326" y2="0" stroke="#b6b6b6"
                                                    stroke-dasharray="0" stroke-width="1"
                                                    class="apexcharts-ycrosshairs"></line>
                                                <line id="SvgjsLine1201" x1="0" y1="0"
                                                    x2="326" y2="0" stroke-dasharray="0"
                                                    stroke-width="0" class="apexcharts-ycrosshairs-hidden">
                                                </line>
                                            </g>
                                            <g id="SvgjsG1173" class="apexcharts-annotations"></g>
                                        </svg>
                                        <div class="apexcharts-legend"></div>
                                    </div>
                                </div>
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 345px; height: 330px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-1">
                <div class="card">
                    <div class="card-header">
                        <div class="flex justify-between items-center">
                            <h4 class="card-title">Daily Task</h4>
                            <div>
                                <select class="form-input form-select-sm">
                                    <option selected="">Today</option>
                                    <option value="1">Yesterday</option>
                                    <option value="2">Tomorrow</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="py-6">
                        <div class="px-6" data-simplebar="init" style="max-height: 304px;">
                            <div class="simplebar-wrapper" style="margin: 0px -24px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content"
                                            style="height: auto; overflow: hidden scroll;">
                                            <div class="simplebar-content" style="padding: 0px 24px;">
                                                <div class="space-y-4">
                                                    <div class="border border-gray-200 dark:border-gray-700 rounded p-2">
                                                        <ul class="flex items-center gap-2 mb-2">
                                                            <a href="javascript:void(0);"
                                                                class="text-base text-gray-600 dark:text-gray-400">Landing
                                                                Page Design</a>
                                                            <i class="mgc_round_fill text-[5px]"></i>
                                                            <h5 class="text-sm font-semibold">2 Hrs ago</h5>
                                                        </ul>
                                                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-1">
                                                            Create a new landing page (Saas Product)</p>
                                                        <p class="text-gray-500 dark:text-gray-400 text-sm"><i
                                                                class="mgc_group_line text-xl me-1 align-middle"></i>
                                                            <b>5</b> People
                                                        </p>
                                                    </div>

                                                    <div class="border border-gray-200 dark:border-gray-700 rounded p-2">
                                                        <ul class="flex items-center gap-2 mb-2">
                                                            <a href="javascript:void(0);"
                                                                class="text-base text-gray-600 dark:text-gray-400">Admin
                                                                Dashboard</a>
                                                            <i class="mgc_round_fill text-[5px]"></i>
                                                            <h5 class="text-sm font-semibold">3 Hrs ago</h5>
                                                        </ul>
                                                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-1">
                                                            Create a new Admin dashboard</p>
                                                        <p class="text-gray-500 dark:text-gray-400 text-sm"><i
                                                                class="mgc_group_line text-xl me-1 align-middle"></i>
                                                            <b>2</b> People
                                                        </p>
                                                    </div>

                                                    <div class="border border-gray-200 dark:border-gray-700 rounded p-2">
                                                        <ul class="flex items-center gap-2 mb-2">
                                                            <a href="javascript:void(0);"
                                                                class="text-base text-gray-600 dark:text-gray-400">Client
                                                                Work</a>
                                                            <i class="mgc_round_fill text-[5px]"></i>
                                                            <h5 class="text-sm font-semibold">5 Hrs ago</h5>
                                                        </ul>
                                                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-1">
                                                            Create a new Power Project (Sktech design)</p>
                                                        <p class="text-gray-500 dark:text-gray-400 text-sm"><i
                                                                class="mgc_group_line text-xl me-1 align-middle"></i>
                                                            <b>2</b> People
                                                        </p>
                                                    </div>

                                                    <div class="border border-gray-200 dark:border-gray-700 rounded p-2">
                                                        <ul class="flex items-center gap-2 mb-2">
                                                            <a href="javascript:void(0);"
                                                                class="text-base text-gray-600 dark:text-gray-400">UI/UX
                                                                Design</a>
                                                            <i class="mgc_round_fill text-[5px]"></i>
                                                            <h5 class="text-sm font-semibold">6 Hrs ago</h5>
                                                        </ul>
                                                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-1">
                                                            Create a new UI Kit in figma</p>
                                                        <p class="text-gray-500 dark:text-gray-400 text-sm"><i
                                                                class="mgc_group_line text-xl me-1 align-middle"></i>
                                                            <b>3</b> People
                                                        </p>
                                                    </div>

                                                    <div class="flex items-center justify-center">
                                                        <div class="animate-spin flex">
                                                            <i class="mgc_loading_2_line text-xl"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: auto; height: 467px;">
                                </div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 197px; transform: translate3d(0px, 0px, 0px); display: block;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-1">
                <div class="card">
                    <div class="card-header flex justify-between items-center">
                        <h4 class="card-title">Team Members</h4>
                        <div>
                            <select class="form-select form-select-sm">
                                <option selected="">Active</option>
                                <option value="1">Offline</option>
                            </select>
                        </div>
                    </div>

                    <div class="py-6">
                        <div class="px-6" data-simplebar="init" style="max-height: 304px;">
                            <div class="simplebar-wrapper" style="margin: 0px -24px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content"
                                            style="height: auto; overflow: hidden scroll;">
                                            <div class="simplebar-content" style="padding: 0px 24px;">
                                                <div class="space-y-6">
                                                    <div class="flex items-center">
                                                        <img class="me-3 rounded-full"
                                                            src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                                            width="40" alt="Generic placeholder image">
                                                        <div class="w-full overflow-hidden">
                                                            <h5 class="font-semibold"><a href="javascript:void(0);"
                                                                    class="text-gray-600 dark:text-gray-400">Risa
                                                                    Pearson</a></h5>
                                                            <div class="flex items-center gap-2">
                                                                <div>UI/UX Designer</div>
                                                                <i class="mgc_round_fill text-[5px]"></i>
                                                                <div>2.5 Year Experience</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex items-center">
                                                        <img class="me-3 rounded-full"
                                                            src="{{ asset('assets/images/users/avatar-2.jpg') }}"
                                                            width="40" alt="Generic placeholder image">
                                                        <div class="w-full overflow-hidden">
                                                            <h5 class="font-semibold"><a href="javascript:void(0);"
                                                                    class="text-gray-600 dark:text-gray-400">Margaret
                                                                    D. Evans</a></h5>
                                                            <div class="flex items-center gap-2">
                                                                <div>PHP Developer</div>
                                                                <i class="mgc_round_fill text-[5px]"></i>
                                                                <div>2 Year Experience</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex items-center">
                                                        <img class="me-3 rounded-full"
                                                            src="{{ asset('assets/images/users/avatar-3.jpg') }}"
                                                            width="40" alt="Generic placeholder image">
                                                        <div class="w-full overflow-hidden">
                                                            <h5 class="font-semibold"><a href="javascript:void(0);"
                                                                    class="text-gray-600 dark:text-gray-400">Bryan
                                                                    J. Luellen</a></h5>
                                                            <div class="flex items-center gap-2">
                                                                <div>Front end Developer</div>
                                                                <i class="mgc_round_fill text-[5px]"></i>
                                                                <div>1 Year Experience</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex items-center">
                                                        <img class="me-3 rounded-full"
                                                            src="{{ asset('assets/images/users/avatar-4.jpg') }}"
                                                            width="40" alt="Generic placeholder image">
                                                        <div class="w-full overflow-hidden">
                                                            <h5 class="font-semibold"><a href="javascript:void(0);"
                                                                    class="text-gray-600 dark:text-gray-400">Kathryn
                                                                    S. Collier</a></h5>
                                                            <div class="flex items-center gap-2">
                                                                <div>UI/UX Designer</div>
                                                                <i class="mgc_round_fill text-[5px]"></i>
                                                                <div>3 Year Experience</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex items-center">
                                                        <img class="me-3 rounded-full"
                                                            src="{{ asset('assets/images/users/avatar-5.jpg') }}"
                                                            width="40" alt="Generic placeholder image">
                                                        <div class="w-full overflow-hidden">
                                                            <h5 class="font-semibold"><a href="javascript:void(0);"
                                                                    class="text-gray-600 dark:text-gray-400">Timothy
                                                                    Kauper</a></h5>
                                                            <div class="flex items-center gap-2">
                                                                <div>Backend Developer</div>
                                                                <i class="mgc_round_fill text-[5px]"></i>
                                                                <div>2 Year Experience</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex items-center">
                                                        <img class="me-3 rounded-full"
                                                            src="{{ asset('assets/images/users/avatar-6.jpg') }}"
                                                            width="40" alt="Generic placeholder image">
                                                        <div class="w-full overflow-hidden">
                                                            <h5 class="font-semibold"><a href="javascript:void(0);"
                                                                    class="text-gray-600 dark:text-gray-400">Zara
                                                                    Raws</a></h5>
                                                            <div class="flex items-center gap-2">
                                                                <div>Python Developer</div>
                                                                <i class="mgc_round_fill text-[5px]"></i>
                                                                <div>1 Year Experience</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: auto; height: 414px;">
                                </div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 223px; transform: translate3d(0px, 0px, 0px); display: block;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Grid End -->

    </main>
@endsection
