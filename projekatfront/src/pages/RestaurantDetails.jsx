import React, { useEffect, useState, useRef } from 'react'
import api from '../api/api'
import { useParams } from 'react-router-dom';
import '../styles/RestaurantDetails.css';
import { IoClose } from "react-icons/io5";
import { FaStar, FaMapMarkerAlt, FaShoppingCart } from 'react-icons/fa';
import FloatingCart from "../components/FloatingCart";

const RestaurantDetails = () => {

  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const [jela, setJela] = useState([]);
  const [korpa, setKorpa] = useState([]);
  const [restoran, setRestoran] = useState(null);
  const [ocena, setOcena] = useState(5);
  const [komentar, setKomentar] = useState("");
  const [currentSlide, setCurrentSlide] = useState(0);
  const intervalRef = useRef(null);

  const { id } = useParams();

  // ucitavamo restoran kada se stranica ucita ili promeni id
  useEffect(() => {
    api.get('/restorani/' + id).then((res) => {
      setRestoran(res.data);
    });
  }, [id]);

  // automatsko vrtenje recenzija na svake 3 sekunde
  useEffect(() => {
    if (!restoran || !restoran.recenzije?.length)
      return; // ako nema restorana ili recenzija, ne pokreci timer

    intervalRef.current = setInterval(() => {
      setCurrentSlide(prev => (prev + 1) % restoran.recenzije.length); // prelazimo na sledecu, % vraca na pocetak kada dodjemo do kraja
    }, 3000); // svake 3 sekunde

    return () => clearInterval(intervalRef.current); // kada predjemo na drugi restoran, ocistimo timer
  }, [restoran]);

  function handleOpenMenu() {
    if (isMenuOpen) { setIsMenuOpen(false); return; }
    api.get(`/restorani/${restoran.id}/jela`)
      .then((res) => { setJela(res.data); setIsMenuOpen(true); })
      .catch((error) => { console.error("Greška pri učitavanju menija", error); });
  }

  function handleAddToCart(jelo) {
    setKorpa((prevKorpa) => [...prevKorpa, jelo]); // dodajemo jelo u korpu
  }

  function handleSubmitReview() {
    api.post(`/restorani/${restoran.id}/recenzije`, { komentar, ocena })
      .then(() => {
        setKomentar(""); // praznimo formu
        setOcena(5);
        return api.get(`/restorani/${restoran.id}`); // ponovo ucitavamo restoran da bi se nova recenzija pojavila
      })
      .then((res) => { setRestoran(res.data); })
      .catch((error) => { console.error("Greška pri slanju recenzije", error); });
  }

  if (!restoran) 
    return null;

  const recenzije = restoran.recenzije || [];
  const trenutnaRecenzija = recenzije[currentSlide]; // trenutno prikazana recenzija

  return (
    <div className='restaurant-details-page'>

      <div className="rd-hero">
        <img src={restoran.image_url} alt={restoran.naziv} className="rd-hero-img" />
        <div className="rd-hero-overlay">
          <h1>{restoran.naziv}</h1>
          <p><FaMapMarkerAlt /> {restoran.lokacija}</p>
          <button className='rd-menu-btn' onClick={handleOpenMenu}>
            <FaShoppingCart /> Prikaži meni
          </button>
        </div>
      </div>

      {isMenuOpen && (
        <div className="modal-overlay" onClick={() => setIsMenuOpen(false)}>
          <div className="menu-modal" onClick={(e) => e.stopPropagation()}>
            <button className="close-btn" onClick={() => setIsMenuOpen(false)}>
              <IoClose />
            </button>
            <h2>Meni</h2>

            {jela.length === 0 ? (
              <p>Nema jela za ovaj restoran.</p>
            ) : (
              jela.map((jelo) => (
                <div key={jelo.id} className="menu-item">
                  <div>
                    <h4>{jelo.naziv}</h4>
                    <p>{jelo.opis}</p>
                  </div>
                  <div className='menu-right'>
                    <span className="price">{jelo.cena} RSD</span>
                    <button className="add-to-cart-btn" onClick={() => handleAddToCart(jelo)}>
                      Dodaj
                    </button>
                  </div>
                </div>
              ))
            )}
          </div>
        </div>
      )}

      <div className="rd-bottom">

        <div className="rd-review-form">
          <h3>Ostavi recenziju</h3>
          <textarea
            placeholder="Napiši komentar..."
            value={komentar}
            onChange={(e) => setKomentar(e.target.value)}
          />
          {/* Zvezdice za ocenu - klik na zvezdicu postavlja ocenu */}
          <div className="rd-stars">
            {[1, 2, 3, 4, 5].map(s => (
              <FaStar
                key={s}
                className={s <= ocena ? 'star active' : 'star'}
                onClick={() => setOcena(s)}
              />
            ))}
          </div>

          <button className="rd-submit-btn" onClick={handleSubmitReview}>
            Pošalji recenziju
          </button>
        </div>


        <div className="rd-reviews">
          <h3>Recenzije</h3>
          {recenzije.length === 0 ? (
            <p className="no-reviews">Još nema recenzija.</p>
          ) : (
            <>
              <div className="rd-review-card active">
                <div className="rd-review-header">
                  <span className="rd-review-user">
                    {trenutnaRecenzija.korisnik
                      ? `${trenutnaRecenzija.korisnik.ime} ${trenutnaRecenzija.korisnik.prezime}`
                      : 'Anonimno'} {/* ako korisnik nije ucitan, prikazujemo Anonimno */}
                  </span>
                  <span className="rd-review-stars">
                    {Array.from({ length: trenutnaRecenzija.ocena }).map((_, i) =>
                      <FaStar key={i} /> // crtamo zvezdice na osnovu ocene
                    )}
                  </span>
                </div>
                <p>{trenutnaRecenzija.komentar}</p>
              </div>
            </>
          )}
        </div>
      </div>

      <FloatingCart korpa={korpa} setKorpa={setKorpa} restoran={restoran} />
    </div>
  );
};

export default RestaurantDetails;