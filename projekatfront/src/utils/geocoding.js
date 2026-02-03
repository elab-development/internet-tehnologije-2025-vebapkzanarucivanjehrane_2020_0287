
export async function getCoordinates(lokacija) {

  //ovaj deo pravi URL za geocoding adrese i preko CORS proxy-ja salje zahtev OpenStreetMap servisu  
  const url = `https://nominatim.openstreetmap.org/search?q=
  ${encodeURIComponent(lokacija)}&format=json`; //string (lokaciju) pretvara u url da bi pozvali openStreetMap za geocoding

  const response = await fetch(
    `https://corsproxy.io/?${encodeURIComponent(url)}` 
  );

  const data = await response.json();

  if (!data || data.length === 0) //ako ne uspe da nadje koodinate, vracamo null
    return null;

  return {
    //parseFloat pretvara string koordinate u decimalni broj
    lat: parseFloat(data[0].lat),
    lon: parseFloat(data[0].lon),
  };
}