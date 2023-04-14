
var indexCol = {"Année": "none", 
"Durée" : "none",
"Genres" : "asc",
"Réalisateur" : "none",
"Titre" : "none"
};  // indice des colonnes 
var orderCol = {"Année": 4,
"Durée": 3,
"Genres": 2,​
"Réalisateur": 1,
Titre: 0};  // ordre des colonnes

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
    
  }

// Mise en place du tri pour le tableau fourni en argument
function trier(table) {
    
  }

function effectuerRecherche(colintitu, filtre, table) {
    
}


function resetRecherche(table) {
    
}

function preparerRecherche(monSelect, monInputRech, bouton, table) {


}