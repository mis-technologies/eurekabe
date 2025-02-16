@extends('layout.app')
@section('content')

<div
      id="mini-nav-header"
      class="container flex flex-col items-start justify-between py-10 gap-10 lg:flex-row lg:gap-20 lg:items-center"
    >
      <div
        class="relative w-full p-1 rounded-xl bg-gray-300 max-w-80 focus-within:border-primary focus-within:border-2 dark:text-dark"
      >
        <span class="absolute left-4 top-1/2 -translate-y-1/2">
          <i class="fa-solid fa-magnifying-glass opacity-60"></i>
        </span>
        <input
          type="text"
          name="search"
          id="search"
          class="w-full p-1 pl-10 text-sm font-semibold outline-none bg-transparent"
          placeholder="Search a topic"
        />
      </div>
      <ul
        class="flex items-start justify-start w-full gap-3 overflow-x-scroll md:w-10/12 md:gap-10 md:justify-between md:items-center hide-scrollbar"
      >
        <li
          class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80 whitespace-nowrap"
          onclick="showSection('trendingNow')"
        >
          Trending Now
        </li>
        <li
          class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80"
          onclick="showSection('technology')"
        >
          Technology
        </li>
        <li
          class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80"
          onclick="showSection('sports')"
        >
          Sports
        </li>
        <li
          class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80"
          onclick="showSection('entertainment')"
        >
          Entertainment
        </li>
        <li
          class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80"
          onclick="showSection('marketing')"
        >
          Marketing
        </li>
        <li
          class="mini-nav cursor-pointer font-bold capitalize hover:text-primary opacity-80"
          onclick="showSection('politics')"
        >
          Politics
        </li>
      </ul>
    </div>

    <div
      id="programContent"
      class="container flex flex-wrap gap-8 items-center justify-between mb-8 md:items-start"
    ></div>
    <template id="cardTemplate">
      <div class="card w-full max-w-[350px] space-y-4 text-[15px]">
        <div class="image-container w-full h-[240px]">
          <img src="" alt="" class="w-full h-full object-cover" />
        </div>
        <div class="cardContent space-y-3">
          <h4 class="font-bold"></h4>
          <p class="opacity-50 text-[13px]"></p>
          <h6 class="font-bold text-[11px]"></h6>
          <a
            href="#"
            class="bg-primary rounded-[5px] p-2 font-bold text-white text-[12px] inline-flex items-center justify-between gap-x-2 hover:bg-opacity-85 readArticle"
          >
            <span>Read article </span>
            <span
              class="border-2 border-white rounded-full inline-flex items-center w-4 h-4"
              ><i class="fa-solid fa-arrow-right text-[9px]"></i></span
          ></a>
        </div>
      </div>
    </template>

    <script type="module">
      //my data
      const trendingNow = [
  {
    title: "The revolution Ai Chatbot Training library for NodeJS",
    content:
      "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
    image: "./images/programs/man.png",
    date: "11 Npvember, 2023",
    link: "https://mistech.io",
    article:
      "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
  },
  {
    title: "The revolution Ai Chatbot Training library for NodeJS",
    content:
      "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
    image: "./images/programs/man.png",
    date: "11 Npvember, 2023",
    link: "https://mistech.io",
    article:
      "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
  },
  {
    title: "Tall women have longer life span compared to short women",
    content:
      "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
    image: "./images/programs/ladies.png",
    date: "11 Npvember, 2023",
    link: "https://mistech.io",
    article:
      "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
  },
  {
    title: "The revolution Ai Chatbot Training library for NodeJS",
    content:
      "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
    image: "./images/programs/man.png",
    date: "11 Npvember, 2023",
    link: "https://mistech.io",
    article:
      "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
  },
  {
    title: "The revolution Ai Chatbot Training library for NodeJS",
    content:
      "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
    image: "./images/programs/man.png",
    date: "11 Npvember, 2023",
    link: "https://mistech.io",
    article:
      "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
  },
  {
    title: "Tall women have longer life span compared to short women",
    content:
      "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
    image: "./images/programs/ladies.png",
    date: "11 Npvember, 2023",
    link: "https://mistech.io",
    article:
      "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
  },
];

      const technology = [
        {
          title: "TTall women have longer life span compared to short women",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/ladies.png",
          date: "11 Npvember, 2023",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "TechB",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/man.png",
          date: "11 Npvember, 2023",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "TechB",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/man.png",
          date: "11 Npvember, 2023",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "TeTall women have longer life span compared to short women",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/ladies.png",
          date: "11 Npvember, 2023",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "Tech",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/man.png",
          date: "11 Npvember, 2023",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "Tech",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/man.png",
          date: "11 Npvember, 2023",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
      ];

      const marketing = [
        {
          title: "Marketing",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/man.png",
          date: "11 Npvember, 2023",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "MarketTall women have longer life span compared to short women",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/ladies.png",
          date: "11 Npvember, 2023",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "MarketTall women have longer life span compared to short women",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/ladies.png",
          date: "11 Npvember, 2023",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "technology",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/man.png",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "technology",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/man.png",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "technolTall women have longer life span compared to short women",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/ladies.png",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
      ];

      const politics = [
        {
          title: "Marketing",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/politics.jpg",
          date: "11 Npvember, 2023",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "MarketTall women have longer life span compared to short women",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/flag-nigeria.jpg",
          date: "11 Npvember, 2023",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "technology",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/politics.jpg",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "technolTall women have longer life span compared to short women",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/flag-nigeria.jpg",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
      ];

      const entertainment = [
        {
          title: "Marketing",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/entertainment.jpg",
          date: "11 Npvember, 2023",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "MarketTall women have longer life span compared to short women",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/ent.jpg",
          date: "11 Npvember, 2023",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "MarketTall women have longer life span compared to short women",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/ent.jpg",
          date: "11 Npvember, 2023",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "technology",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/entertainment.jpg",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "technology",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/entertainment.jpg",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
        {
          title: "technolTall women have longer life span compared to short women",
          content:
            "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
          image: "./images/programs/ent.jpg",
          link: "https://mistech.io",
          article:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
        },
      ];

      const sports = [
  {
    title: "Marketing",
    content:
      "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
    image: "./images/programs/001.jpg",
    date: "11 Npvember, 2023",
    link: "https://mistech.io",
    article:
      "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
  },
  {
    title: "MarketTall women have longer life span compared to short women",
    content:
      "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
    image: "./images/programs/giannis.jpg",
    date: "11 Npvember, 2023",
    link: "https://mistech.io",
    article:
      "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
  },
  {
    title: "MarketTall women have longer life span compared to short women",
    content:
      "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
    image: "./images/programs/001.jpg",
    date: "11 Npvember, 2023",
    link: "https://mistech.io",
    article:
      "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
  },
  {
    title: "technology",
    content:
      "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
    image: "./images/programs/002.jpg",
    link: "https://mistech.io",
    article:
      "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
  },
  {
    title: "technology",
    content:
      "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
    image: "./images/programs/001.jpg",
    link: "https://mistech.io",
    article:
      "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
  },
  {
    title: "technolTall women have longer life span compared to short women",
    content:
      "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum tempore, numquam unde natus quidem tenetur aliquam cum dolore ex iste.",
    image: "./images/programs/giannis.jpg",
    link: "https://mistech.io",
    article:
      "Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium, fuga maxime ex natus quo saepe facilis nam recusandae non aliquid voluptatum minus ipsa voluptatibus tempora, in amet. Vel fuga doloribus, quis ad nemo animi voluptatum dolorum aperiam similique, totam consequatur, vitae ratione illum adipisci minima repellat qui ipsa! Asperiores natus corrupti iste recusandae quidem quas, placeat, quis, maxime sapiente blanditiis assumenda nam suscipit distinctio aspernatur? Ut, incidunt facilis. Delectus accusamus, dolor ad obcaecati atque quas placeat explicabo consequatur facilis officia dolores enim molestias hic, magni cum numquam similique eos quod reprehenderit temporibus laudantium alias culpa natus est. Cumque, dolorum?",
  },
];



      // Function to render card dynamically
      const renderCards = (cards) => {
        const contentDiv = document.getElementById("programContent");
        contentDiv.innerHTML = "";

        cards.forEach((card) => {
          const cardTemplate = document
            .querySelector("#cardTemplate")
            .content.cloneNode(true);

          const cardDiv = cardTemplate.querySelector(".card");
          const image = cardDiv.querySelector("img");
          const title = cardDiv.querySelector("h4");
          const details = cardDiv.querySelector("p");
          const cardDate = cardDiv.querySelector("h6");
          const cardLink = cardDiv.querySelector("a");

          image.src = card.image;
          image.alt = card.title;
          title.textContent = card.title;
          details.textContent = card.content;
          cardDate.textContent = card.date;

          cardLink.href = `./blog.html#${card.title.replace(/\s+/g, "_")}`;
          cardLink.onclick = (e) => {
            e.preventDefault();
            navigateTo(card);
          };

          contentDiv.appendChild(cardDiv);
        });
      };

      //  function to navigate to differnt section on the page
      const showSection = (section) => {
        const miniNavs = document.querySelectorAll(".mini-nav");
        miniNavs.forEach((nav) => nav.classList.remove("active-mini-nav"));

        if (section === "trendingNow") {
          renderCards(trendingNow);
          document
            .querySelector(`.mini-nav[onclick="showSection('trendingNow')"]`).classList.add("active-mini-nav");
        } else if (section === "technology") {
          renderCards(technology);
          document.querySelector(`.mini-nav[onclick="showSection('technology')"]`).classList.add("active-mini-nav");
        } else if (section === "marketing") {
          renderCards(marketing);
          document.querySelector(`.mini-nav[onclick="showSection('marketing')"]`).classList.add("active-mini-nav");
        } else if (section === "sports") {
          renderCards(sports);
          document.querySelector(`.mini-nav[onclick="showSection('sports')"]`).classList.add("active-mini-nav");
        } else if (section === "politics") {
          renderCards(politics);
          document.querySelector(`.mini-nav[onclick="showSection('politics')"]`).classList.add("active-mini-nav");
        } else if (section === "entertainment") {
          renderCards(entertainment);
          document.querySelector(`.mini-nav[onclick="showSection('entertainment')"]`).classList.add("active-mini-nav");
        }
      };

      window.showSection = showSection;

      // function to render the article of each card clicked
      const navigateTo = (card) => {
        const contentDiv = document.getElementById("programContent");
        contentDiv.innerHTML = `
          <div class="container flex flex-col items-center gap-8 w-full max-w-[1024px] mx-auto">
            <div class='w-full'>
              <button onclick="showSection('${getCurrentSection()}')" class="text-primary uppercase font-bold hover:underline">← Back to ${getCurrentSection()}</button>
            </div>
            <h1 class="font-bold text-3xl uppercase">${card.title}</h1>
            <img src="${card.image}" alt="${card.title} class="w-full h-autp md:w-auto md:h-80" />
            <p class="font-semibold">${card.content}</p>
            <p class="text-base text-justify">${card.article}</p>
            <p class="text-base text-justify">${card.article}</p>
            <p class="font-bold italic">Date: ${card.date}</p>
          </div>
            `;

        window.scrollTo({ top: 0, behavior: "smooth" });

        // Display the param 
        history.pushState(
          null,
          "",
          `./blog.html#${card.title.replace(/\s+/g, "_")}`
        );
      };

      const getCurrentSection = () => {
    const activeNav = document.querySelector(".mini-nav.active-mini-nav");
    if (activeNav) {
        return activeNav.getAttribute("onclick").match(/showSection\('([^']+)'\)/)[1];
    }
    return "trendingNow"; 
};

      showSection("trendingNow");
    </script>
@endsection