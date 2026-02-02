import React, { useEffect, useState } from "react";
import api  from "../api/api";
import { Link, useLocation, useNavigate } from "react-router-dom";
import '../styles/Navbar.css'

const Navbar = () => {

const location = useLocation();
 const navigate = useNavigate();
const [isAuth, setIsAuth] = useState(false);

useEffect(() => {
    const token = localStorage.getItem("token");
    setIsAuth(!!token);
    console.log("Location changed to:", location.pathname);
    console.log("Is Authenticated:", isAuth);
    console.log("Token:", token);
  }, [location]);


const handleLogout = async () => {
  try {
    await api.post("/logout");
  } catch (err) {
    console.error("Greška pri logout-u:", err);
    // čak i ako padne poziv, svejedno ćemo da očistimo storage
  } finally {
    localStorage.removeItem("token");
    localStorage.removeItem("user");
   

    setIsAuth(false);
    navigate("/login");
  }
}

return (
    <div className="navbar-container">
      <div className="navbar-left">
        <Link to="/" className="logo">
          NomNom<span>GO</span>
        </Link>
      </div>

      <div className="navbar">
        {isAuth ? (
          <>
            <Link to="/">Početna</Link>
            <Link to="/restaurants">Restorani</Link>
            <button className="logout-button" onClick={handleLogout}>
              Logout
            </button>
          </>
        ) : (
          <>
            <Link to="/login">Login</Link>
            <Link to="/register">Registracija</Link>
          </>
        )}
      </div>
    </div>
  );
};

export default Navbar;