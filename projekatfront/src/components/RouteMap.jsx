import { useEffect, useRef, useState } from "react";
import L from "leaflet";
import "leaflet/dist/leaflet.css";
import "leaflet-routing-machine";
import finishFlag from "../assets/finish-flag.png";
import homePng from "../assets/home.png";

const RouteMap = ({ start, end }) => { //start i end su koordinate restorana i adrese dostave
  const mapRef = useRef(null); //referenca na div gde ce mapa biti prikazana
  const [ruteInfo, setRuteInfo] = useState(null);

  useEffect(() => {
    if (!mapRef.current) return;

    const map = L.map(mapRef.current).setView(start, 13); //postavljamo centar mape na pocetak (restoran)

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map); //dodajemo OpenStreetMap podlogu na mapu

    const routingControl = L.Routing.control({ //crtanje rute pomocu Leaflet Routing Machine
      waypoints: [
        L.latLng(start[0], start[1]),
        L.latLng(end[0], end[1]),
      ],
      routeWhileDragging: false,
      show: false,
      collapsed: true, //sakrivamo uputstva za navigaciju
      addWaypoints: false, 
      createMarker: (i, waypoint) => {
        const icon = L.icon({
            iconUrl: i === 0 ? finishFlag : homePng, //prvi marker je restoran, drugi je adresa dostave
            iconSize: [28, 28],
            iconAnchor: [14, 28],
            popupAnchor: [0, -28],
        });
        const label = i === 0 ? "Restoran" : "Adresa dostave";
        return L.marker(waypoint.latLng, { icon }).bindPopup(label); //dodajemo marker sa odgovarajucom ikonicom
      },
    }).addTo(map);

    routingControl.on('routesfound', (e) => { //kada se ruta pronadje, prikazujemo procenjeno vreme i rastojanje
      const ruta = e.routes[0].summary;
      const km = (ruta.totalDistance / 1000).toFixed(1); //delimo sa 1000 da dobijemo kilometre
      const min = Math.round(ruta.totalTime / 60); //delimo sa 60 da dobijemo minute
      setRuteInfo({ km, min });
      const container = document.querySelector('.leaflet-routing-container');
        if (container) container.style.display = 'none';
    });

    return () => { //brisemo rutu i mapu kada se zatvori modal
      routingControl.getPlan().setWaypoints([]);
      map.remove();
    };
  }, []);

  return (
    <div>
      {ruteInfo && ( //ako imamo informacije o ruti, prikazujemo ih iznad mape
        <p style={{ marginBottom: "8px", fontSize: "14px", color: "#333" }}>
            Procenjeno vreme dostave: <strong>{ruteInfo.min} min</strong> | <strong>{ruteInfo.km} km</strong>
         </p>
    )}
      <div ref={mapRef} style={{ height: "300px", width: "100%", marginTop: "10px" }} />
    </div>
  );
};

export default RouteMap;