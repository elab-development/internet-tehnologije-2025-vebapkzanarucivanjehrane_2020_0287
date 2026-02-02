import { useNavigate } from "react-router-dom";
import "../styles/RestaurantCard.css"
import { FaRegStar } from "react-icons/fa";


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
        <p> <FaRegStar /> {restaurant.recenzije_avg_ocena
            ? Number(restaurant.recenzije_avg_ocena).toFixed(2) //backend vraca string, Number pretvara u int, toFixed zaokruzuje na 2 decimale
            : "Nema ocena"}
        </p>
        
      </div>
  );
};

export default RestaurantCard
