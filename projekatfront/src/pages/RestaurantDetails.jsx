import React, { useEffect, useState } from 'react'
import api from '../api/api'
import { useParams } from 'react-router-dom';
import RecenzijaCard from '../components/RecenzijaCard';
import '../styles/RestaurantDetails.css';

const RestaurantDetails = () => {

const { id } = useParams(); //iz trenutne stranice nam uzima id
const [restoran, setRestoran]= useState(null);

//kada se stranica ucita, uzimamo jedan restoran ciji je id u adresi
useEffect( ()=>{
        api.get('/restorani/'+id).then((res) => {
        setRestoran(res.data)
        console.log(res.data)
      })
}, [id] ) //ako se promeni id, ponovo ucitavamo restoran

  return (
    restoran &&     
    <div className='restaurant-details-page'>
        <h1>{restoran.naziv}</h1> 
        <h3>{restoran.lokacija}</h3>
        <img src ={restoran.image_url}></img>
          <button className='button-menu'>
              NARUČI
          </button>

          <div className='recenzija-wrapper'>
             {restoran.recenzije.map((recenzija) => <RecenzijaCard key ={recenzija.id} recenzija = {recenzija} />) }
          </div>
    </div>
  )
}

export default RestaurantDetails
