import { MapContainer, TileLayer, Marker, Popup } from "react-leaflet";
import "leaflet/dist/leaflet.css";
import { useEffect, useState } from "react";
import L from "leaflet";
import { getCoordinates } from "../utils/geocoding";
import "../styles/RestaurantMap.css";


const RestaurantsMap = ({ restorani }) => {
  const [mapirani, setMapirani] = useState([]);

  useEffect(() => {
  const ucitaj = async () => { 
    const rezultat = await Promise.all( //paralelno izvrsavanje zahteva za geocoding svih restorana 
      restorani.map(async (restoran) => { 
        const koordinate = await getCoordinates(restoran.lokacija);
        console.log("GEOCODE:", restoran.lokacija, koordinate);
        return koordinate
          ? { ...restoran, lat: koordinate.lat, lon: koordinate.lon } //ako postoji restoran vratice njegove koordinate
          : null;
      })
    );

    setMapirani(rezultat.filter(Boolean)); //mapirani samo restorani sa validnim koordinatama 
  };

  ucitaj();
}, [restorani]);    //ako dodamo novi restoran u bazi, automatski ce se pojaviti na mapi

   const svgIcon = L.divIcon({
        className: "svg-marker",
        html: `<img src="/marker.svg" />`,
        iconSize: [30, 40],   
        iconAnchor: [15, 40],
    });

  return (
    <MapContainer
      center={[44.7866, 20.4489]} // Beograd
      zoom={13}
      style={{ height: "500px", width: "100%" }}>

      <TileLayer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" /> 

      {mapirani.map((r) => (
        <Marker key={r.id} position={[r.lat, r.lon]} icon={svgIcon}>
          <Popup>
            <strong>{r.naziv}</strong>
            <br />
            {r.lokacija}
          </Popup>
        </Marker>
      ))}
    </MapContainer>
  );
};

export default RestaurantsMap;
