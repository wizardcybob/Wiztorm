//ATTENTION : certaines compétences ne peuvent être réaliser dû à la première construction de mon site en INFO3


// Niveau 1 : 
// 1 - Afficher des articles sous forme de carte -> déjà fait en INFO3


// 2 - Accordéon d'infos
var accordeon = document.getElementsByClassName("accordeon");

for (i = 0; i < accordeon.length; i++) {
  accordeon[i].addEventListener("click", function() {
    var texte_statu = document.querySelector(".texte_statu");
    if (texte_statu.getAttribute("id") === "texte_hidden") {
      texte_statu.setAttribute("id", "texte_showed");
      texte_statu.style.cssText = 'max-height: auto;';
    }
    else if (texte_statu.getAttribute("id") === "texte_showed") {
      texte_statu.setAttribute("id", "texte_hidden");
      texte_statu.style.cssText = 'max-height: 0px; overflow:hidden;';
    }
  });
}


// 3 - Mode sombre
function btn_mode_style() {
  let btn_claire_sombre = document.createElement("button");
  btn_claire_sombre.classList.add("bouton");
  btn_claire_sombre.style.cssText = 'margin:0;';
  btn_claire_sombre.innerText = "Activer le mode clair";
  let select_zone = document.querySelector(".menu");
  if (select_zone != null) {
    select_zone.appendChild(btn_claire_sombre);
  }

  let select_linkvide = document.querySelector("#linkvide");
  btn_claire_sombre.addEventListener("click", function () {
    if (select_linkvide.getAttribute("href") === "#") {
      btn_claire_sombre.innerHTML = "Désactiver le mode clair";
      select_linkvide.setAttribute("href", "style/mode_clair.css");
    } 
    else {
      btn_claire_sombre.innerHTML = "Activer le mode clair";
      select_linkvide.setAttribute("href", "#");
    }
  });
}



// Niveau 2 : 
// 1 - Faire un sous-menu qui tri
let liste_item = [];

function menu_automatique() {
  let select_zone = document.querySelector(".sous-menu");
  if (select_zone != null) {
    let item_tous = document.createElement("div");
    item_tous.classList.add("item");
    item_tous.classList.add("tri_tous");
    item_tous.innerText = "Tous";
    item_tous.style.cssText = 'padding: 5px 15px; background: maroon; border-radius: 5px; color: white; margin: 0.5rem; width: 25%; cursor: pointer;';
    select_zone.appendChild(item_tous);
  
    let items = document.querySelectorAll('.liste-article-bloc__titre');
    for (let i = 0; i < items.length; i++) {
      let nom_items = items[i].dataset.typepheno;
      if (liste_item.indexOf(nom_items) === -1) {
          liste_item.push(nom_items);
      }
    }
    for (let i = 0; i < liste_item.length; i++) {
      let new_menuElement = document.createElement("div");
      new_menuElement.innerText = liste_item[i];
      new_menuElement.classList.add("item");
      new_menuElement.style.cssText = 'padding: 5px 15px; background: maroon; border-radius: 5px; color: white; margin: 0.5rem; width: 25%; cursor: pointer;';
      select_zone.appendChild(new_menuElement);
    }
  }
}

function select_item_menu() {
  let select_article = document.querySelectorAll(".item");
  let items = document.querySelectorAll(".liste-article-bloc__titre");
  
  select_article.forEach((element) => {
    element.onclick = function () {
      items.forEach((cat) => {
        if (cat.dataset.typepheno === element.innerText) {
          cat.parentElement.parentElement.parentElement.style.display = "block";
        } 
        else if (element.innerText === "Tous") {
          cat.parentElement.parentElement.parentElement.style.display = "block";
        } 
        else {
          cat.parentElement.parentElement.parentElement.style.display = "none";
        }
      });
    };
  });
}


// 2 - Faire un tri alphabétique
function tri_alphabetique_ZA() {
  let select_zone = document.querySelector(".sous-menu");
  if (select_zone != null) {
    let item_tri = document.createElement("div");
    item_tri.classList.add("item");
    item_tri.classList.add("tri_alpha_ZA");
    item_tri.innerText = "Tri alphabétique (Z-A)";
    item_tri.style.cssText = 'padding: 5px 15px; background: maroon; border-radius: 5px; color: white; margin: 0.5rem; width: 25%; cursor: pointer;';
    select_zone.appendChild(item_tri);

    item_tri.addEventListener('click', function() {
      let liens = document.querySelector(".liste-article");
      let items = document.querySelectorAll(".liste-article-bloc");
      let tabcarte2 = Array.from(items);
      tabcarte2.sort(function(a,b) { //2 val tab : a, b qui servent à trier un premier titre avec un autre
        let titre1 = a.children[0].children[1].children[0].innerText; //children -> pour reccuperer le titre
        let titre2 = b.children[0].children[1].children[0].innerText;
        return titre2.localeCompare(titre1); //pour definir ordre alphabetique
      });
      for (let n=0; n<tabcarte2.length; n++){
        tabcarte2[n].style.display = 'block';
        let node = tabcarte2[n].cloneNode(true); //faire une copie de la carte pour en avoir 2 pour faire fonctionner le replace
        liens.replaceChild(node, items[n]);
      }
      tabcarte2 = document.querySelectorAll(".liste-article-bloc");
      for (let n=0; n<tabcarte2.length; n++){
        tabcarte2[n].style.display = 'block';
      }
    });
  }
}

function tri_alphabetique_AZ() {
  let select_zone = document.querySelector(".sous-menu");
  if (select_zone != null) {
    let item_tri = document.createElement("div");
    item_tri.classList.add("item");
    item_tri.classList.add("tri_alpha_AZ");
    item_tri.innerText = "Tri alphabétique (A-Z)";
    item_tri.style.cssText = 'padding: 5px 15px; background: maroon; border-radius: 5px; color: white; margin: 0.5rem; width: 25%; cursor:pointer;';
    select_zone.appendChild(item_tri);

    item_tri.addEventListener('click', function() {
      let liens = document.querySelector(".liste-article");
      let items = document.querySelectorAll(".liste-article-bloc");
      let tabcarte2 = Array.from(items);
      tabcarte2.sort(function(a,b) { //2 val tab : a, b qui servent à trier un premier titre avec un autre
        let titre1 = a.children[0].children[1].children[0].innerText; //children -> pour reccuperer le titre
        let titre2 = b.children[0].children[1].children[0].innerText;
        return titre1.localeCompare(titre2); //pour definir ordre alphabetique
      });
      for (let n=0; n<tabcarte2.length; n++){
        tabcarte2[n].style.display = 'block';
        let node = tabcarte2[n].cloneNode(true); //faire une copie de la carte pour en avoir 2 pour faire fonctionner le replace
        liens.replaceChild(node, items[n]);
      }
      tabcarte2 = document.querySelectorAll(".liste-article-bloc");
      for (let n=0; n<tabcarte2.length; n++) {
        tabcarte2[n].style.display = 'block';
      }
    });
  }
}


// 3 - Afficher une image en grand (dans ft_article)
function grande_image() {
  let select_big_bloc = document.querySelector(".article");
  let select_img = document.querySelectorAll(".article-info__img");

  for (let i = 0; i < select_img.length; i++) {
    let new_div = document.createElement("div");
    let select_src = select_img[i].getAttribute("src");
    select_img[i].addEventListener("click", function () {
      if (select_img[i].getAttribute("id") === "on") {
        new_div.innerHTML = `<img style="width: 100%;" class="image_carte" src="${select_src}" alt="">`;
        select_big_bloc.appendChild(new_div);
        select_img[i].setAttribute("id", "off");
      } 
      else if (select_img[i].getAttribute("id") === "off") {
        select_big_bloc.removeChild(new_div);
        select_img[i].setAttribute("id", "on");
      }
    });
  }
}



// Niveau 3 : 
// 1 - Double tri -> fonctionne avec pagination & le tri des types de phénomène


// 2 - Pagination
function pagination() {
  let un = document.querySelector(".un_art");
  if (un != null) {
    un.addEventListener("click", function () {
      let bloc_cards_tri = document.querySelector(".liste-article-tri");
      let item_un = document.querySelector(".un_art");
      let item_cinq = document.querySelector(".cinq_art");
      let item_sept = document.querySelector(".sept_art");
      let item_tri_AZ = document.querySelector(".tri_alpha_AZ");
      let item_tri_ZA = document.querySelector(".tri_alpha_ZA");
      let item_menu_tous = document.querySelector(".tri_tous");
      let bloc_cards = document.querySelector(".liste-article");
      let all_card = document.querySelectorAll(".liste-article-bloc");
      for (let i = 0; i < 1; i++) {
        bloc_cards.style.cssText = "display: none;";
        item_un.style.cssText = "display: none;";
        item_cinq.style.cssText = "display: none;";
        item_sept.style.cssText = "display: none;";
        item_tri_AZ.style.cssText = "display: none;";
        item_tri_ZA.style.cssText = "display: none;";
        item_menu_tous.style.cssText = "display: none;";
        bloc_cards_tri.classList.add("liste-article");
        bloc_cards_tri.appendChild(all_card[i]);
      }  
    });
  }
  
  let cinq = document.querySelector(".cinq_art");
  if (cinq != null) {
    cinq.addEventListener("click", function () {
      let bloc_cards_tri = document.querySelector(".liste-article-tri");
      let item_un = document.querySelector(".un_art");
      let item_cinq = document.querySelector(".cinq_art");
      let item_sept = document.querySelector(".sept_art");
      let item_tri_AZ = document.querySelector(".tri_alpha_AZ");
      let item_tri_ZA = document.querySelector(".tri_alpha_ZA");
      let item_menu_tous = document.querySelector(".tri_tous");
      let bloc_cards = document.querySelector(".liste-article");
      let all_card = document.querySelectorAll(".liste-article-bloc");
      for (let i = 0; i < 5; i++) {
        bloc_cards.style.cssText = "display: none;";
        item_un.style.cssText = "display: none;";
        item_cinq.style.cssText = "display: none;";
        item_sept.style.cssText = "display: none;";
        item_tri_AZ.style.cssText = "display: none;";
        item_tri_ZA.style.cssText = "display: none;";
        item_menu_tous.style.cssText = "display: none;";
        bloc_cards_tri.classList.add("liste-article");
        bloc_cards_tri.appendChild(all_card[i]);
      } 
    });
  }
  
  let sept = document.querySelector(".sept_art");
  if (sept != null) {
    sept.addEventListener("click", function () {
      let bloc_cards_tri = document.querySelector(".liste-article-tri");
      let item_un = document.querySelector(".un_art");
      let item_cinq = document.querySelector(".cinq_art");
      let item_sept = document.querySelector(".sept_art");
      let item_tri_AZ = document.querySelector(".tri_alpha_AZ");
      let item_tri_ZA = document.querySelector(".tri_alpha_ZA");
      let item_menu_tous = document.querySelector(".tri_tous");
      let bloc_cards = document.querySelector(".liste-article");
      let all_card = document.querySelectorAll(".liste-article-bloc");
      for (let i = 0; i < 7; i++) {
        bloc_cards.style.cssText = "display: none;";
        item_un.style.cssText = "display: none;";
        item_cinq.style.cssText = "display: none;";
        item_sept.style.cssText = "display: none;";
        item_tri_AZ.style.cssText = "display: none;";
        item_tri_ZA.style.cssText = "display: none;";
        item_menu_tous.style.cssText = "display: none;";
        bloc_cards_tri.classList.add("liste-article");
        bloc_cards_tri.appendChild(all_card[i]);
      } 
    });
  }
  
  let all = document.querySelector(".all_art");
  if (all != null) {
    all.addEventListener("click", function () {
      location.reload();
    });
  }
}


// 3 - Barre de recherche
function barre_recherche() {
  let items = document.querySelectorAll(".liste-article-bloc");
  let tabcarte2 = Array.from(items);
  let barre_recherche = document.getElementById('searchbar').value;
  barre_recherche = barre_recherche.toLowerCase();
  for (let n = 0; n<tabcarte2.length; n++) {
    let x = [];
    x.push(tabcarte2[n].children[0].children[1].children[0]); //0 pcq a - 1 pcq div w/class=liste-article-bloc__infos - 0 pcq h4

    for (i = 0; i < x.length; i++) { 
      if (!x[i].innerHTML.toLowerCase().includes(barre_recherche)) {
          x[i].parentElement.parentElement.parentElement.style.display="none";
      }
      else {
          x[i].parentElement.parentElement.parentElement.style.display="block";
      }
    }
  }
}



// FONCTIONS
btn_mode_style();
menu_automatique();
select_item_menu();
tri_alphabetique_ZA();
tri_alphabetique_AZ();
grande_image();
pagination();
barre_recherche();