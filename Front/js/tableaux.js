var indexCol = [];  // indice des colonnes 
var orderCol = [];  // ordre des colonnes

// modification de l'ordre pour la colonne colintitu
function updateOrder(colintitu){
    for (const elt in orderCol) {
        if (elt != colintitu) orderCol[elt] = "none";
        else {
            if(orderCol[elt] == "none" || orderCol[elt] == "desc") orderCol[elt] = "asc";
            else orderCol[elt] = "desc";
        }               
    }
}

// trier selon une colonne
function trierCol(colintitu, table) {
    var switching = true;
    var shouldSwitch;
    // Mettre à jour l'ordre de tri de la colonne
    updateOrder(colintitu);
    // Boucle de tri
    while (switching) {

      switching = false;
      var rows = table.rows;

      console.log(rows);
  
      // Boucle à travers toutes les lignes de la table (sauf la première qui contient les en-têtes de colonne)
      for (var i = 1; i < rows.length - 1; i++) {
        // Start by saying there should be no switching:
        shouldSwitch = false;
  
        // Obtenir les deux éléments à comparer, un de la ligne actuelle et un de la suivante
        var x = rows[i].getElementsByTagName("td")[indexCol[colintitu]];
        var y = rows[i + 1].getElementsByTagName("td")[indexCol[colintitu]];

        console.log(x);
        console.log(y);
  
        // Vérifier si les deux lignes doivent échanger de place :
        if (orderCol[colintitu] === "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            shouldSwitch = true;
            break;
          }
        } else if (orderCol[colintitu] === "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            shouldSwitch = true;
            break;
          }
        }
      }
  
      if (shouldSwitch) {
        // Échanger les deux lignes et indiquer que le tri est en cours
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
  }


// Mise en place du tri pour le tableau fourni en argument
function trier(table) {
    // Récupérer la première ligne qui contient les en-têtes de colonne
    var header = document.querySelectorAll('th');
  
    // Ajouter un écouteur d'événements pour chaque en-tête de colonne
    for (var i = 0; i < header.length; i++) {
      let th = header[i];
        indexCol[th.innerHTML] = i;
        orderCol[th.innerHTML] = null;
        th.addEventListener("click", function(){trierCol(th.innerHTML, table);});
      };
}


function effectuerRecherche(colintitu, filtre, table) {
  let input, tr, td, i, txtValue;
  tr = table.getElementsByTagName("tr");
  const n = indexCol[colintitu]
  for (let i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[n];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filtre) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}


function resetRecherche(table) {
  let tr = table.getElementsByTagName("tr");
  for (let i = 0; i < tr.length; i++) {
        tr[i].style.display = ""; 
  }    
}

function preparerRecherche(monSelect, monInputRech, bouton, table) {
  const ths = table.querySelectorAll('thead>tr>th');
    
  for (const th of ths) {
      let option = document.createElement("option");
      option.setAttribute("value", th.textContent);
      option.textContent = th.textContent;
      monSelect.appendChild(option);
  }

  //input recherche
  monInputRech.addEventListener("keyup", function(){
      const colintitu = monSelect.options[monSelect.selectedIndex].text;
      const filter = this.value.toUpperCase();     
      effectuerRecherche(colintitu, filter,table)
  })

  //button reset
  bouton.addEventListener("click", function(){
      monInputRech.value = "";
      monSelect.selectedIndex = 0;
      resetRecherche(table);
  })

  //quand select change de valeur
  monSelect.addEventListener("change", function(){
      monInputRech.value = "";
      resetRecherche(table);
  })
}