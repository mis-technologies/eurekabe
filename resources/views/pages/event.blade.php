@extends('layout.app')
@section('content')

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
    import {
      trendingNow,
      technology,
      marketing,
      entertainment,
      politics,
      sports,
    } from "./src/scripts/data.js";

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

        cardLink.href = `./program.html#${card.title.replace(/\s+/g, "_")}`;
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
      miniNavs.forEach((nav) => nav.classList.remove("active"));

      if (section === "trendingNow") {
        renderCards(trendingNow);
        document
          .querySelector(`.mini-nav[onclick="showSection('trendingNow')"]`)
          .classList.add("active");
      } else if (section === "technology") {
        renderCards(technology);
        document
          .querySelector(`.mini-nav[onclick="showSection('technology')"]`)
          .classList.add("active");
      } else if (section === "marketing") {
        renderCards(marketing);
        document
          .querySelector(`.mini-nav[onclick="showSection('marketing')"]`)
          .classList.add("active");
      } else if (section === "sports") {
        renderCards(sports);
        document
          .querySelector(`.mini-nav[onclick="showSection('sports')"]`)
          .classList.add("active");
      } else if (section === "politics") {
        renderCards(politics);
        document
          .querySelector(`.mini-nav[onclick="showSection('politics')"]`)
          .classList.add("active");
      } else if (section === "entertainment") {
        renderCards(entertainment);
        document
          .querySelector(`.mini-nav[onclick="showSection('entertainment')"]`)
          .classList.add("active");
      }
    };

    window.showSection = showSection;

    // function to render the article of each card clicked
    const navigateTo = (card) => {
      const contentDiv = document.getElementById("programContent");
      contentDiv.innerHTML = `
        <div class="container flex flex-col items-center gap-8 w-full max-w-[1024px] mx-auto">
          <h1 class="font-bold text-3xl uppercase">${card.title}</h1>
          <img src="${card.image}" alt="${card.title} class="w-full h-autp md:w-auto md:h-80" />
          <p class="font-semibold">${card.content}</p>
          <p class="text-base text-justify">${card.article}</p>
          <p class="text-base text-justify">${card.article}</p>
          <p class="font-bold italic">Date: ${card.date}</p>
        </div>
          `;

      // Displaying the param but not working active now
      history.pushState(
        null,
        "",
        `./program.html#${card.title.replace(/\s+/g, "_")}`
      );
    };

    showSection("trendingNow");
  </script>

@endsection