document.addEventListener("DOMContentLoaded", () => {
  const openMenu = document.getElementById("openMenu");
  const closeMenu = document.getElementById("closeMenu");
  const navBar = document.getElementById("nav-bar");
  const navLinks = document.querySelectorAll(".nav-items");

  openMenu.addEventListener("click", () => {
    navBar.style.display = "flex";
  });

  closeMenu.addEventListener("click", () => {
    navBar.style.display = "none";
  });

  navLinks.forEach((link) => {
    link.addEventListener("click", () => {
      link.classList.toggle("active");
      if (window.innerWidth <= 800) {
        navBar.style.display = "none";
      }
    });
  });

  window.addEventListener("resize", () => {
    if (window.innerWidth > 800) {
      navBar.style.display = "flex";
    }
  });

  const cards = document.querySelectorAll(".card");

  cards.forEach((card) => {
    card.classList.add("row-2");

    card.addEventListener("mouseover", () => {
      const cardId = card.id.split("-")[1];
      let oppositeCardId;

      if (cardId === "1") {
        oppositeCardId = "4";
      } else if (cardId === "2") {
        oppositeCardId = "4";
      } else if (cardId === "4") {
        oppositeCardId = "2";
      } else if (cardId === "3") {
        oppositeCardId = "1";
      }

      const oppositeCard = document.getElementById(`card-${oppositeCardId}`);

      card.classList.add("row-3");
      card.classList.remove("row-2");
      card.querySelector(".paragraph").style.visibility = "visible";

      oppositeCard.classList.add("row-1");
      oppositeCard.classList.remove("row-2");
      oppositeCard.querySelector("img").style.visibility = "hidden";
    });

    // mouse out
    card.addEventListener("mouseout", () => {
      const cardId = card.id.split("-")[1];
      let oppositeCardId;

      if (cardId === "1") {
        oppositeCardId = "4";
      } else if (cardId === "2") {
        oppositeCardId = "4";
      } else if (cardId === "4") {
        oppositeCardId = "2";
      } else if (cardId === "3") {
        oppositeCardId = "1";
      }

      const oppositeCard = document.getElementById(`card-${oppositeCardId}`);

      card.classList.remove("row-3");
      card.classList.add("row-2");
      card.querySelector(".paragraph").style.visibility = "hidden";

      oppositeCard.classList.remove("row-1");
      oppositeCard.classList.add("row-2");
      oppositeCard.querySelector("img").style.visibility = "visible";
    });
  });
});
