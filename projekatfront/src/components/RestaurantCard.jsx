import { useNavigate } from "react-router-dom";
import "../styles/RestaurantCard.css"

const RestaurantCard = ({restaurant}) => {
  
  const navigate = useNavigate();

  //klikom na karticu otvaramo detalje o restoranu
  function handleCardClick(){
    console.log(restaurant)
    navigate (`/restaurants/${restaurant.id}`)


  }

  return (
    <div className="restaurant-card" onClick={handleCardClick}> 
        <h3>{restaurant.naziv}</h3>
        <div className="restaurant-card-img">
           <img src ={restaurant.image_url}></img>
        </div>
        <p>{restaurant.prosecna_ocena}</p>
        
      </div>
  );
};

export default RestaurantCard
