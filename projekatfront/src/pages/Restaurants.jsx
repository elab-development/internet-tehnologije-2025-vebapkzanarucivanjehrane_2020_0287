import React, { useEffect, useState } from 'react'
import api from '../api/api';
import RestaurantCard from '../components/RestaurantCard';
import '../styles/Restaurants.css';
import RestaurantsMap from "../components/RestaurantMap";

const Restaurants = () => {
  
  const [restorani, setRestorani]= useState([]) //restorani predstavljaju niz restorana
  const [search, setSearch] = useState("");

  useEffect(() => {   //kada se stranica PRVI PUT ucita, idemo na backend i uzimamo restorane iz baze
      api.get('/restorani').then((res) => {
        setRestorani(res.data)
        console.log(res.data)
      })
    },[])
  
  return (
    
    <div className="restaurants-page">
        <input
          type="text"
          placeholder="Pretraži restorane..."
          value={search}
          onChange={(e) => setSearch(e.target.value)}
          className="search-input"
        />

          <div className= "restaurants-wrapper">  
              {restorani
              .filter(restoran =>  //filtriramo restorane po nazivu
                      restoran.naziv
                      .toLowerCase()
                      .includes(search.toLowerCase())
                )

              .map((restoran) => //prolazimo kroz niz restorana, i za svaki pravimo karticu
                <RestaurantCard key ={restoran.id}  
                restaurant = {restoran} />) }
          </div>

          <div className='restaurant-map'>
               <RestaurantsMap restorani={restorani} />
          </div>
      </div>
  )
}

export default Restaurants
