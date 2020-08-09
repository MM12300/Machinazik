let mymap, marqueur // Variables pour la carte et le marqueur

// Au chargement de la page
window.onload = () => {
    // Instanciation de la map
   

    // Appelle de la fonction getCity au submit du form
    document.querySelector("#searchAddr").addEventListener("click", getCity)
}

function getCity(e){

    e.preventDefault();
  

    let adresse = document.querySelector("#address").value ;
    let cp = document.querySelector("#postcode").value ;
    let ville = document.querySelector("#ville").value ;


    if(adresse == '' || cp == '' || ville == ''){
        alert('Vous devez renseigner une adresse');
    }
    else {
        // On crée l'adresse
        let adresseFull = adresse+ ", " +cp + " " +ville

        // Initialisation d'une requête Ajax
        const xmlhttp = new XMLHttpRequest

        xmlhttp.onreadystatechange = () => {
            // Vérification de fin de requête
            if(xmlhttp.readyState == 4){
                // Vérification de la réponse
                if(xmlhttp.status == 200){
                    // Suppression de la précédente map
                    if (mymap != null) { // Je vérifie que la map existe
                        mymap.remove();  // Je la supprime
                    }
                    // Récupération de la réponse
                    let response = JSON.parse(xmlhttp.response)

                    if(response.length == 0){
                        document.querySelector("#searchAddr").innerHTML = 'Adresse non valide !';
                    }
                    else {

                        let lat = response[0]["lat"]
                        let lon = response[0]["lon"]
                        document.querySelector("#latitude").value = lat
                        document.querySelector("#longitude").value = lon
    
                        let pos = [lat, lon] 
    
                        mymap = L.map("detailsMap")
                        mymap.setView(pos, 11)
                        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                            // Lien vers la source des données
                            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                            minZoom: 1,
                            maxZoom: 20
                        }).addTo(mymap)
    
                        addMarker(pos)
    
                        document.querySelector("#searchAddr").innerHTML = 'Adresse valide !';
                    }

                }
            }
        }

        // Ouverture de la requête
        xmlhttp.open("get", `https://nominatim.openstreetmap.org/search?q=${adresseFull}&format=json&addressdetails=1&limit=1&polygon_svg=1`)

        xmlhttp.send()

    }

    
    
}



// Ajoute le marker sur la map
function addMarker(pos) {
    // Vérification de l'existence d'un précédent marqueur
    if (marqueur != undefined) {
        mymap.removeLayer(marqueur)
    }

    marqueur = L.marker(pos, {
        // Permet au marqueur d'être déplacé sur la carte
        draggable: true
    })

    // On écoute le glisser/déposer sur le marqueur
    marqueur.on("dragend", function (e) {
        pos = e.target.getLatLng()
        document.querySelector("#latitude").value = pos.lat
        document.querySelector("#longitude").value = pos.lng
    })

    marqueur.addTo(mymap)
}