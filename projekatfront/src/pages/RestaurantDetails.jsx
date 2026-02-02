import React, { useEffect, useState } from 'react'
import api from '../api/api'
import { useParams } from 'react-router-dom';
import RecenzijaCard from '../components/RecenzijaCard';
import '../styles/RestaurantDetails.css';
import { IoClose } from "react-icons/io5";
import FloatingCart from "../components/FloatingCart";


const RestaurantDetails = () => {

const [isMenuOpen, setIsMenuOpen] = useState(false); //da li je Menu otvoren 
const [jela, setJela] = useState([]);
const [korpa, setKorpa] = useState([]);
const [restoran, setRestoran]= useState(null);
const[ocena,setOcena] = useState(5);
const[komentar,setKomentar] = useState("");

const { id } = useParams(); //iz trenutne stranice nam uzima id

//kada se stranica ucita ili se promeni id, uzimamo jedan restoran ciji je id u url adresi
useEffect( ()=>{
        api.get('/restorani/'+id).then((res) => {
        setRestoran(res.data)
        console.log(res.data)
      }) }, [id] )

  function handleOpenMenu(){
      if (isMenuOpen) {
            setIsMenuOpen(false);
          return;
      }
      api.get(`/restorani/${restoran.id}/jela`)
      .then((res)=>{
          setJela(res.data);
          setIsMenuOpen(true);
          console.log(res.data);
      })
      .catch((error)=>{
         console.error("Greška pri učitavanju menija", error);
      })
}

  function handleAddToCart(jelo) {
      setKorpa((prevKorpa) => [...prevKorpa, jelo]); //u trenutnoj korpi, zadrzavamo stara jela, i dodajemo novo
      console.log("Korpa:", [...korpa, jelo]);
}

  function handleSubmitReview() {
      api.post(`/restorani/${restoran.id}/recenzije`, {
        komentar: komentar,
        ocena: ocena
      })
      .then(() => {
        //ispraznimo formu
          setKomentar("");
          setOcena(5);

        //ponovo ucitavamo restoran da bi se nova recenzija pojavila
        return api.get(`/restorani/${restoran.id}`);
        })
        .then((res) => {
          setRestoran(res.data);
        })
        .catch((error) => {
          console.error("Greška pri slanju recenzije", error);
        });

        console.log(localStorage.getItem("token"));
      }

  return (
    restoran &&  //ako restoran postoji (nije null)
    <div className='restaurant-details-page'>
        <h1>{restoran.naziv}</h1> 
        <h3>{restoran.lokacija}</h3>
        <img src ={restoran.image_url}></img>
          <button className='button-menu' onClick={handleOpenMenu}>
              PRIKAŽI MENU
          </button>

         {isMenuOpen && ( //prikazuje se samo kada je Menu otvoren
          <div className="modal-overlay" onClick={() => setIsMenuOpen(false)}>
              <div className = "menu-modal" onClick={(e) => e.stopPropagation()}>

              <button className="close-btn" onClick={() => setIsMenuOpen(false)}> 
                  <IoClose />
              </button>

                <h2>Menu</h2>

              {jela.length === 0 ? (
                <p>Nema jela za ovaj restoran.</p>
              ) : (
                jela.map((jelo) => (
                  <div key={jelo.id} className="menu-item">
                    <h4>{jelo.naziv}</h4>
                    <p>{jelo.opis}</p>

                    <div className='menu-right'>
                       <span className="price">{jelo.cena} RSD</span>
                       <button className="add-to-cart-btn"
                          onClick={() => handleAddToCart(jelo)}>
                            Dodaj u korpu
                       </button>
                    </div>
                  </div>
                  ))
              )}
            </div>
          </div>
        )}

          <div className="review-form">
              <h3>Ostavi recenziju</h3>

            <textarea
                placeholder="Napiši komentar..."
                value={komentar}
                onChange={(e) => setKomentar(e.target.value)}/>

            <select
                value={ocena}
                onChange={(e) => setOcena(e.target.value)}>
                    <option value="5">5 - Odličan</option>
                    <option value="4">4 - Vrlo dobar</option>
                    <option value="3">3 - Dobar</option>
                    <option value="2">2 - Loš</option>
                    <option value="1">1 - Veoma loš</option>
            </select>

            <button onClick={handleSubmitReview}>
                Pošalji recenziju
            </button>
          </div>

          <div className='recenzija-wrapper'>
             {restoran.recenzije.map((recenzija) => 
             <RecenzijaCard key = {recenzija.id} 
             recenzija = {recenzija} />
             )}
          </div>
          <FloatingCart korpa={korpa} setKorpa={setKorpa} />
       </div>
  )
}

export default RestaurantDetails
