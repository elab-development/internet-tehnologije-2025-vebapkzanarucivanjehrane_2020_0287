import React, { useEffect, useState } from 'react';
import api from '../api/api';
import { useNavigate } from 'react-router-dom';
import { FaMapMarkerAlt, FaMoneyBillWave, FaClock } from 'react-icons/fa';
import "../styles/CourierPage.css";
import RouteMap from "../components/RouteMap";
import { getCoordinates } from "../utils/geocoding";

const CourierPage = () => {
  const navigate = useNavigate();
  const user = JSON.parse(localStorage.getItem("user") || "{}"); //citamo ulogovanog korisnika iz localStorage
  const [porudzbine, setPorudzbine] = useState([]);
  const [aktivnaRuta, setAktivnaRuta] = useState(null); //stanje koje cuva informacije o trenutno aktivnoj ruti

useEffect(() => {
    api.get('/moje-dostave').then(res => { //zahtev ka backendu za ucitavanje porudzbina koje su dodeljene dostavljacu
      console.log(res.data);
      setPorudzbine(res.data); });
  }, []);

  if (user.role !== 'dostavljac') { //ako korisnik nije dostavljac, preusmeravamo ga na pocetnu stranu
    navigate('/');
    return null;
  }

  const handleStatus = (id, status) => {  //funkcija se poziva kada dostavljac klikne na dugme za promenu statusa porudzbine
    api.patch(`/porudzbine/${id}/status`, { status }) //salje se zahtev sa novim statusom porudzbine (patch menja samo taj atribut)
      .then(() => {
        setPorudzbine(prev =>
          prev.map(p => p.id === id ? { ...p, status } : p) 
        );
      })
      .catch(err => console.error(err));
  };

  // sledece dugme za svaki status
  const nextStatus = {
    'na_cekanju': { label: 'Preuzmi', status: 'u_pripremi' },
    'u_pripremi': { label: 'Krenuo na dostavu', status: 'dostava_u_toku' },
    'dostava_u_toku': { label: 'Isporučeno', status: 'isporuceno' },
  };

  async function prikaziRutu(porudzbina) { //funkcija koja prikazuje rutu od restorana do adrese
    if (aktivnaRuta?.id === porudzbina.id) {
      setAktivnaRuta(null);
      return;
    }

  const res = await api.get(`/restorani/${porudzbina.restoran_id}`);
  const koordinateRestorana = await getCoordinates(res.data.lokacija);
  const koordinateIsporuke = await getCoordinates(porudzbina.adresa_isporuke);

  if (!koordinateRestorana || !koordinateIsporuke) 
    return;

  setAktivnaRuta({
    id: porudzbina.id,
    start: [koordinateRestorana.lat, koordinateRestorana.lon], //adresa restorana se koristi kao pocetna tacka rute
    end: [koordinateIsporuke.lat, koordinateIsporuke.lon], //adresa isporuke se koristi kao krajnja tacka rute
  });
}

  return (
    <div className="courier-page">
      <h1>Moje dostave</h1>
      {porudzbine.length === 0 ? (  //ako nema porudzbina, prikazuje se poruka
        <p>Nema dostava.</p>
      ) : (
        porudzbine.map(p => ( //ako ima porudzbina metodom map prolazimo kroz niz porudzbina i prikazujemo informacije o svakoj porudzbini u kartici
          <div key={p.id} className="courier-card">
            <div className="courier-card-left">
              <p className="courier-order-id">Porudžbina #{p.id}</p>
                <p><FaMapMarkerAlt /> {p.adresa_isporuke}</p>
                <p><FaMoneyBillWave /> {p.ukupna_cena} RSD</p> 
                <p><FaClock /> {new Date(p.vreme_kreiranja).toLocaleDateString('sr-RS')}</p> 
            </div>

            <div className="courier-card-right">
              <span className={`status-badge status-${p.status}`}>{p.status}</span>
                {nextStatus[p.status] && (  //proverava da li postoji sledeci status za trenutni status porudzbine, i ako postoji prikazuje dugme za promenu statusa
                  <button className="btn-next-status" onClick={() => handleStatus(p.id, nextStatus[p.status].status)}>
                      {nextStatus[p.status].label}
                  </button>
                )}

                <button className="btn-next-status" onClick={() => prikaziRutu(p)}>
                    {aktivnaRuta?.id === p.id ? "Zatvori rutu" : "Prikaži rutu"}
                </button>
                  {aktivnaRuta?.id === p.id && (
                    <RouteMap start={aktivnaRuta.start} end={aktivnaRuta.end} />
                )}
            </div>
          </div>
        ))
      )}
    </div>
  );
};

export default CourierPage;