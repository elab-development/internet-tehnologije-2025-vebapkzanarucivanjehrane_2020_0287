import React, { useEffect, useState } from 'react'
import api from '../api/api';
import RestaurantCard from '../components/RestaurantCard';
import '../styles/Restaurants.css';

const Restaurants = () => {
  
  const [restorani, setRestorani]= useState([]) //restorani predstavljaju niz restorana

  useEffect(() => {   //kada se stranica PRVI PUT ucita, idemo na backend i uzimamo restorane iz baze
      api.get('/restorani').then((res) => {
        setRestorani(res.data)
        console.log(res.data)
      })
    },[])
  
  return (
    <div className= "restaurants-wrapper">  
        {restorani.map((restoran) => //prolazimo kroz niz restorana, i za svaki pravimo karticu
          <RestaurantCard key ={restoran.id}  
          restaurant = {restoran} />) }
    </div>
  )
}

export default Restaurants
