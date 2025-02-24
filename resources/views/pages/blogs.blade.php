@extends('layout.app')
@section('content')

<!-- Navigation -->
<div id="mini-nav-header"
    class="container flex flex-col items-start justify-between py-10 gap-10 lg:flex-row lg:gap-20 lg:items-center">
    <div
        class="relative w-full p-1 rounded-xl bg-gray-300 max-w-80 focus-within:border-primary focus-within:border-2 dark:text-dark">
        <span class="absolute left-4 top-1/2 -translate-y-1/2">
            <i class="fa-solid fa-magnifying-glass opacity-60"></i>
        </span>
        <input type="text" name="search" id="search"
            class="w-full p-1 pl-10 text-sm font-semibold outline-none bg-transparent" placeholder="Search a topic" />
    </div>
    <ul
        class="flex items-start justify-start w-full gap-3 overflow-x-scroll md:w-10/12 md:gap-10 md:justify-between md:items-center hide-scrollbar">
        <li class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80 whitespace-nowrap">
            <a href="#tech" class="tab">Trending Now</a>
        </li>
        <li class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80">
            <a href="#dev" class="tab">Technology</a>
        </li>
        <li class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80">
            <a href="#entertainment" class="tab">Entertainment</a>
        </li>
        <li class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80">
            <a href="#marketing" class="tab">Marketing</a>
        </li>
        <li class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80">
            <a href="#sports" class="tab">Sports</a>
        </li>
        <li class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80">
            <a href="#politics" class="tab">Politics</a>
        </li>
    </ul>
</div>


<div id="programContent" class="container flex flex-wrap gap-8 items-center justify-between mb-8 md:items-start">
</div>

<!-- Trending Now Section -->
<div id="tech" class="content container">
    <div class="flex flex-wrap justify-center lg:justify-between gap-auto items-center  md:items-start">
        <!-- Card 1 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/man.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">The revolution Ai Chatbot Training library for NodeJS</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/man.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">The revolution Ai Chatbot Training library for NodeJS</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/ladies.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">Tall women have longer life span compared to short women</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/man.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">The revolution Ai Chatbot Training library for NodeJS</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/man.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">The revolution Ai Chatbot Training library for NodeJS</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 6 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/ladies.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">Tall women have longer life span compared to short women</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Technology Section -->
<div id="dev" class="content container">
    <div class="flex flex-wrap justify-between gap-auto items-center  md:items-start">
        <!-- Card 1 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/ladies.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">TTall women have longer life span compared to short women</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/man.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">TechB</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/man.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">TechB</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/ladies.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">TeTall women have longer life span compared to short women</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/man.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">Tech</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 6 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/man.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">Tech</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Marketing Section -->
<div id="marketing" class="content container">
    <div class="flex flex-wrap justify-between gap-auto items-center  md:items-start">
        <!-- Card 1 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/man.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">Marketing</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/ladies.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">MarketTall women have longer life span compared to short women</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/ladies.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">MarketTall women have longer life span compared to short women</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/man.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">technology</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/man.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">technology</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 6 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/ladies.png" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">technolTall women have longer life span compared to short women</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Politics Section -->
<div id="politics" class="content container">
    <div class="flex flex-wrap justify-between gap-auto items-center  md:items-start">
        <!-- Card 1 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/politics.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">Marketing</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/flag-nigeria.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">MarketTall women have longer life span compared to short women</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/politics.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">technology</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/flag-nigeria.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">technolTall women have longer life span compared to short women</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Entertainment Section -->
<div id="entertainment" class="content container">
    <div class="flex flex-wrap justify-between gap-auto items-center  md:items-start">
        <!-- Card 1 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/entertainment.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">Marketing</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/ent.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">MarketTall women have longer life span compared to short women</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/ent.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">MarketTall women have longer life span compared to short women</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/entertainment.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">technology</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/entertainment.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">technology</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 6 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/ent.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">technolTall women have longer life span compared to short women</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sports Section -->
<div id="sports" class="content container">
    <div class="flex flex-wrap justify-between gap-auto items-center  md:items-start">
        <!-- Card 1 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/001.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">Marketing</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/giannis.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">MarketTall women have longer life span compared to short women</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/001.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">MarketTall women have longer life span compared to short women</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/002.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">technology</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/001.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">technology</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 6 -->
        <div class="col-lg-3 m-5 p-5">
            <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
                <div class="image-container w-full h-[240px]">
                    <img src="/asset/images/programs/giannis.jpg" alt="" class="w-full h-full object-cover" />
                </div>
                <div class="cardContent space-y-3">
                    <h4 class="font-bold">technolTall women have longer life span compared to short women</h4>
                    <p class="opacity-50 text-[13px]">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum
                        tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.</p>
                    <h6 class="font-bold text-[11px]">11 Npvember, 2023</h6>
                    <a href="https://mistech.io"
                        class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle">
                        <span>Read article </span>
                        <span class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"><i
                                class="fa-solid fa-arrow-right text-[9px]"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tabs = document.querySelectorAll(".tab");
        const sections = document.querySelectorAll(".content");

        function showSection(id) {
            sections.forEach(section => {
                section.style.display = section.id === id ? "block" : "none";
            });

            tabs.forEach(tab => {
                tab.classList.toggle("active", tab.getAttribute("href") === `#${id}`);
            });
        }

        const currentHash = window.location.hash.substring(1);
        showSection(currentHash || "tech");

        tabs.forEach(tab => {
            tab.addEventListener("click", function (event) {
                const targetId = this.getAttribute("href").substring(1);
                showSection(targetId);
            });
        });
    });
</script>

@endsection